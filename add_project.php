<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

require $_SERVER['DOCUMENT_ROOT'] . '/project/backend/config.php';
require $_SERVER['DOCUMENT_ROOT'] . '/project/backend/lang.php';

if (!isset($_SESSION['uid']) || $_SESSION['rights'] != 101) {
    header('Location: /project/login.php?error=no_permission');
    exit();
}

$message = NULL;

// Fetch all unique brands for the brand dropdown
$brands = [];
$sql_brands = "SELECT DISTINCT brand FROM yarns ORDER BY brand ASC";
$result_brands = $conn->query($sql_brands);
if ($result_brands->num_rows > 0) {
    while($b_row = $result_brands->fetch_assoc()) {
        $brands[] = $b_row['brand'];
    }
}


// Az űrlap elküldésének megkezdése
if (isset($_POST['submit'])) {
    // A bejövő adatok ellenőrzése
    $name = htmlspecialchars($_POST['name']);
    $pattern = htmlspecialchars($_POST['pattern']);
    $yarn_id = !empty($_POST['variety']) ? htmlspecialchars($_POST['variety']) : NULL;
    $hook = htmlspecialchars($_POST['hook']);
    $description = htmlspecialchars($_POST['description']);
    $start = htmlspecialchars($_POST['start']);
    $finish = !empty($_POST['finish']) ? htmlspecialchars($_POST['finish']) : NULL;

    $image_paths = [];

    // Itt kezdődik a fájl feltöltés
    // Fájlok leellenőrzése
    if (!empty($_FILES['image']['name'][0])) {
        // Leellenőrzi hány fájlt próbáltak feltölteni és ha több mint 5 akkor hibát ír ki
        if (count($_FILES['image']['name']) > 5) {
            $_SESSION['message'] = 'Legfeljebb 5 kép tölthető fel egyszerre.'; 
            header("Location: /project/add_project.php"); 
            exit();
        }

        // Ezek a feltöltés abszolút és relatív útjai.
        $upload_dir_abs = $_SERVER['DOCUMENT_ROOT'] . '/project/uploads/';
        $upload_dir_rel = '/project/uploads/';

        // Ha nincs létrehozva a mappa a fájloknak, létrehoz egyet
        if (!is_dir($upload_dir_abs)) {
            mkdir($upload_dir_abs, 0755, true);
        }

        foreach ($_FILES['image']['name'] as $key => $file_name) {
            // Leellenőrzi hogy van-e hiba feltöltésben
            if ($_FILES['image']['error'][$key] == 0) {
                // Generál egy egyedi nevet a fájlnak
                $unique_file_name = uniqid() . '_' . basename($file_name);
                $target_file_abs = $upload_dir_abs . $unique_file_name;
                $target_file_rel = $upload_dir_rel . $unique_file_name;
                $imageFileType = strtolower(pathinfo($target_file_abs, PATHINFO_EXTENSION));

                //Leellenőrzi a hogy a fájl egy kép-e, a méretét és a fájl formátumot
                $check = getimagesize($_FILES["image"]["tmp_name"][$key]);
                if ($check === false) {
                    $_SESSION['message'] = 'A fájl nem egy kép.';
                    continue;
                }

                if ($_FILES["image"]["size"][$key] > 5000000) {
                    $_SESSION['message'] = 'A fájl túl nagy!';
                    continue;
                }

                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                    $_SESSION['message'] = 'Csak JPG, JPEG, PNG és GIF fájlok engedélyezettek.';
                    continue;
                }

                // A fájl áthelyezése az abszolút helyre
                if (move_uploaded_file($_FILES["image"]["tmp_name"][$key], $target_file_abs)) {
                    // A relatív út hozzáadása a tömbhöz
                    $image_paths[] = $target_file_rel;
                } else {
                    $_SESSION['message'] = 'Hiba történt a fájl feltöltésekor.';
                }
            }
        }
    }

    // A képeket egy string-be teszi elválasztójelekkel
    $image_path_string = implode(',', $image_paths);

    // A felhasználó ID-nak lekérése
    $uid = $_SESSION['uid'];

    // Az űrlapba bevitt értékek bevitele az adatbázisba
    $sql="INSERT INTO projects(uid,name,pattern,yarn,hook,description,image,start,finish) VALUES (?,?,?,?,?,?,?,?,?)";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("issssssss", $uid, $name, $pattern, $yarn_id, $hook, $description, $image_path_string, $start, $finish);

    // Végrehajtás
    if ($stmt->execute()) {
        header("Location: /project/my_projects.php");
        exit();
    } else {
        $message = 'Hiba történt az új projekt hozzáadása során.';
    }
    $stmt->close();
}

$conn->close();

?>

<!DOCTYPE html>
<head>
    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/project/frontend/header.php';
    ?>
</head>
<body>
    <div class="page_container">
        <main class="page_content">
            <div class="main_body">
                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/project/frontend/sidebar.php';
                ?>
                <div class="main_container">
                    <img src="/project/images/yarn2.png" class="image-center">
                    
                    <h2><?= lang('Projekt hozzáadása') ?></h2>

                    <div>
                        <form action="add_project.php" method="POST" enctype=multipart/form-data>
                            <div class="loginlabel">
                                <label for="name"><?= lang('Név') ?></label>
                                <br>
                                <input type="text" placeholder="<?= lang('Név') ?>" id="name" name="name" required>
                            </div>

                            <div class="loginlabel">
                                <label for="pattern"><?= lang('Minta') ?></label>
                                <br>
                                <input type="url" placeholder="<?= lang('Link') ?>" id="pattern" name="pattern">
                            </div>

                            <div class="loginlabel">
                                <label><?= lang('Fonal') ?></label>
                                <br>
                                <div class="yarn_choice">
                                    <label for="brand"><?= lang('Márka') ?></label>
                                    <br>
                                    <select class="yarn_select" id="brand" name="brand">
                                    <option value=""><?= lang('Válassz márkát') ?></option>
                                    <?php foreach ($brands as $brand): ?>
                                        <option value="<?= htmlspecialchars($brand) ?>"><?= htmlspecialchars($brand) ?></option>
                                    <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="yarn_choice">
                                    <label for="variety"><?= lang('Fajta') ?></label>
                                    <br>
                                    <select class="yarn_select"id="variety" name="variety" disabled>
                                    <option value=""><?= lang('Válassz fajtát') ?></option>
                                    </select>
                                </div>

                            </div>

                            <div class="loginlabel">
                                <label for="hook"><?= lang('Horgolótű') ?></label>
                                <br>
                                <input type="number" step=".1" placeholder="<?= lang('Horgolótű') ?>" id="hook" name="hook">
                            </div>

                            <div class="loginlabel">
                                <label for="description"><?= lang('Leírás') ?></label>
                                <br>
                                <textarea class="textarea"  placeholder="<?= lang('Leírás') ?>" id="description" name="description"></textarea>
                            </div>

                            <div class="loginlabel">
                                <label for="image"><?= lang('Kép') ?></label>
                                <br>
                                <p style="font-size: 12px;"><?= lang('Csak 5 kép feltöltése lehetséges.') ?></p>
                                <input type="file" placeholder="<?= lang('Kép') ?>" id="image" class="fileupload" name="image[]" multiple>
                            </div>

                            <div class="loginlabel">
                                <label for="start"><?= lang('Kezdés dátuma') ?></label>
                                <br>
                                <input type="date" id="start" name="start" required>
                            </div>

                            <div class="loginlabel">
                                <label for="finish"><?= lang('Befejezés dátuma') ?></label>
                                <br>
                                <input type="date" id="finish" name="finish">
                            </div>
                            <br>
                            <div>
                                <p>
                                    <?php echo $message; ?>
                                </p>
                            </div>
                            <div class="loginlabel">
                                <button class="button" type="submit" name="submit"><?= lang('Hozzáadás') ?></button>
                            </div>
                        </form>
                        <br>
                        <div>
                            <button type="button" class="button"onclick="location.href = '/project/my_projects.php';"><?= lang('Vissza') ?></button>
                        </div>
                    </div> 
                    <img src="/project/images/yarn2flipped.png" class="image-center">
            </div>
        </main>
    </div> 

    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/project/frontend/footer.php';
    ?>

    <noscript>Free cookie consent management tool by <a href="https://www.termsfeed.com/">TermsFeed Generator</a></noscript>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const brandSelect = document.getElementById('brand');
            const varietySelect = document.getElementById('variety');
            
            const populateVarieties = (brand) => {
                varietySelect.innerHTML = '<option value=""> <?= lang('Válassz fajtát') ?> </option>';
                
                if (brand) {
                    fetch('/project/backend/get_yarn_varieties.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `brand=${encodeURIComponent(brand)}`
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.varieties.length > 0) {
                            data.varieties.forEach(variety => {
                                const option = document.createElement('option');
                                option.value = variety.id;
                                option.textContent = variety.variety;
                                varietySelect.appendChild(option);
                            });
                            varietySelect.disabled = false;
                        } else {
                            varietySelect.disabled = true;
                        }
                    })
                    .catch(error => console.error('Error fetching varieties:', error));
                } else {
                    varietySelect.disabled = true;
                }
            };
            // Event listener for brand change
            brandSelect.addEventListener('change', function() {
                const selectedBrand = this.value;
                populateVarieties(selectedBrand);
            });
        });
    </script>

</body>
</html>