<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require $_SERVER['DOCUMENT_ROOT'] . '/project/backend/config.php';
require $_SERVER['DOCUMENT_ROOT'] . '/project/backend/lang.php';

if (!isset($_SESSION['uid']) || $_SESSION['rights'] != 101) {
    header('Location: /project/login.php?error=no_permission');
    exit();
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $_SESSION['message'] = lang('Érvénytelen adat');
    exit('Érvénytelen adat');
}

$id = intval($_GET['id']);

// Fetch current project data first
$sql = "SELECT id, name, pattern, yarn, hook, description, image, start, finish FROM projects WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    exit('Nincs projekt hozzáadva!');
}
$row = $result->fetch_assoc();
$current_yarn_id = $row['yarn']; // Get the yarn ID from the project
$existing_image_paths = !empty($row['image']) ? explode(',', $row['image']) : [];

// Fetch brand of the currently selected yarn
$current_yarn_brand_sql = "SELECT brand FROM yarns WHERE id=?";
$current_yarn_brand_stmt = $conn->prepare($current_yarn_brand_sql);
$current_yarn_brand_stmt->bind_param("i", $current_yarn_id);
$current_yarn_brand_stmt->execute();
$current_yarn_brand_result = $current_yarn_brand_stmt->get_result();
$current_yarn_brand = '';
if ($current_yarn_brand_row = $current_yarn_brand_result->fetch_assoc()) {
    $current_yarn_brand = $current_yarn_brand_row['brand'];
}
$current_yarn_brand_stmt->close();


if (isset($_POST['update_project'])) {
    $name = htmlspecialchars($_POST['name']);
    $pattern = htmlspecialchars($_POST['pattern']);
    // Updated to use yarn_id from the form
    $yarn_id = !empty($_POST['variety']) ? htmlspecialchars($_POST['variety']) : NULL;
    $hook = htmlspecialchars($_POST['hook']);
    $description = htmlspecialchars($_POST['description']);
    $start = !empty($_POST['start']) ? htmlspecialchars($_POST['start']) : NULL;
    $finish = !empty($_POST['finish']) ? htmlspecialchars($_POST['finish']) : NULL;

    // Define the absolute and relative paths for uploads
    $upload_dir_abs = $_SERVER['DOCUMENT_ROOT'] . '/project/uploads/';
    $upload_dir_rel = '/project/uploads/';

    // Fetch existing image paths from the database
    $current_image_paths_sql = "SELECT image FROM projects WHERE id=?";
    $current_stmt = $conn->prepare($current_image_paths_sql);
    $current_stmt->bind_param("i", $id);
    $current_stmt->execute();
    $current_result = $current_stmt->get_result();
    $current_row = $current_result->fetch_assoc();

    // Correctly handle the case where the image string is empty
    $existing_image_paths_db = !empty($current_row['image']) ? explode(',', $current_row['image']) : [];

    // Handle deleted images
    $deleted_images = $_POST['deleted_images'] ?? '';
    $deleted_image_paths = !empty($deleted_images) ? explode(',', $deleted_images) : [];
    
    // Use a foreach loop to delete each file from the server
    foreach ($deleted_image_paths as $deleted_path) {
        $trimmed_path = trim($deleted_path);
        if (!empty($trimmed_path)) {
            // Construct the full server path for deletion
            $file_to_delete = $upload_dir_abs . basename($trimmed_path);
            
            // Check if the file exists before attempting to delete it
            if (file_exists($file_to_delete)) {
                unlink($file_to_delete);
            }
        }
    }

    // Remove deleted images from the main array
    $image_paths_to_keep = array_diff($existing_image_paths_db, $deleted_image_paths);

    // Handle new image uploads
    if (!empty($_FILES['image']['name'][0])) {
        foreach ($_FILES['image']['name'] as $key => $file_name) {
            if ($_FILES['image']['error'][$key] == 0) {
                $unique_file_name = uniqid() . '_' . basename($file_name);
                
                // Use the absolute path for the move operation
                $target_file_abs = $upload_dir_abs . $unique_file_name;
                // Use the relative path for database storage
                $target_file_rel = $upload_dir_rel . $unique_file_name;
                
                $imageFileType = strtolower(pathinfo($target_file_abs, PATHINFO_EXTENSION));

                $check = getimagesize($_FILES["image"]["tmp_name"][$key]);
                if ($check !== false && $_FILES["image"]["size"][$key] <= 5000000 && in_array($imageFileType, ["jpg", "png", "jpeg", "gif"])) {
                    if (move_uploaded_file($_FILES["image"]["tmp_name"][$key], $target_file_abs)) {
                        $image_paths_to_keep[] = $target_file_rel;
                    }
                }
            }
        }
    }
    // Check if total images exceed 5 after adding new ones
    if (count($image_paths_to_keep) > 5) {
        $_SESSION['message'] = 'Legfeljebb 5 kép lehet összesen.';
        header("Location: /project/edit_project.php?id=" . $id);
        exit();
    }


    // Combine all paths into a single string for the database
    $final_image_path_string = implode(',', array_filter($image_paths_to_keep));

    // Update the database
    $sql = "UPDATE projects SET name=?, pattern=?, yarn=?, hook=?, description=?, image=?, start=?, finish=? WHERE id=?";
    // Updated to use the new yarn ID and string data
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssi", $name, $pattern, $yarn_id, $hook, $description, $final_image_path_string, $start, $finish, $id);

    if ($stmt->execute()) {
        header("Location: /project/project_page.php?id=" . $id);
        exit();
    } else {
        $_SESSION['message'] = lang('Hiba történt a projekt frissítésekor.');
    }
    $stmt->close();
}

// Fetch all unique brands for the brand dropdown
$brands = [];
$sql_brands = "SELECT DISTINCT brand FROM yarns ORDER BY brand ASC";
$result_brands = $conn->query($sql_brands);
if ($result_brands->num_rows > 0) {
    while($b_row = $result_brands->fetch_assoc()) {
        $brands[] = $b_row['brand'];
    }
}
$conn->close();

?>

<!DOCTYPE html>
<head>
    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/project/frontend/header.php';
    ?>

    <script src="/project/scripts/delete_image.js"></script>
    <script src="/project/scripts/sidebar_toggle.js"></script>

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
                    <h2><?= lang('Projekt szerkesztése') ?></h2>
                    <div>
                        <?php if (isset($_SESSION['message'])) : ?>
                            <p><?= $_SESSION['message'] ?></p>
                            <?php unset($_SESSION['message']); ?>
                        <?php endif; ?>

                        <form action="edit_project.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
                            <div class="loginlabel">
                                <label class="label" for="name"><?= lang('Név') ?></label>
                                <br>
                                <input type="text" placeholder="<?= lang('Név') ?>" id="name" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required>
                            </div>
                            <div class="loginlabel">
                                <label for="pattern"><?= lang('Minta') ?></label>
                                <br>
                                <input type="url" placeholder="<?= lang('Link') ?>" id="pattern" value="<?php echo htmlspecialchars($row['pattern']); ?>" name="pattern">
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
                                            <option value="<?= htmlspecialchars($brand) ?>" <?= ($brand == $current_yarn_brand) ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($brand) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="yarn_choice">
                                    <label for="variety"><?= lang('Fajta') ?></label>
                                    <br>
                                    <select class="yarn_select" id="variety" name="variety">
                                        <option value=""> <?= lang('Válassz fajtát') ?> </option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="loginlabel">
                                <label for="hook"><?= lang('Horgolótű') ?></label>
                                <br>
                                <input type="number" step=".1" placeholder="<?= lang('Horgolótű') ?>" id="hook" name="hook" value="<?php echo htmlspecialchars($row['hook']); ?>">
                            </div>

                            <div class="loginlabel">
                                <label for="description"><?= lang('Leírás') ?></label>
                                <br>
                                <textarea class="textarea" id="description" name="description"><?php echo htmlspecialchars($row['description']); ?></textarea>
                            </div>

                            <div class="loginlabel">
                                <label for="image"><?= lang('Kép') ?></label>
                                <br>
                                <p style="font-size: 12px;"><?= lang('Csak 5 kép feltöltése lehetséges.') ?></p>
                                <div id="existing-images-container" style="display: flex; flex-wrap: wrap;">
                                    <?php foreach ($existing_image_paths as $image_path):
                                        $trimmed_path = trim($image_path);
                                        if (!empty($trimmed_path)): ?>
                                            <div class="image-preview-item" data-path="<?= htmlspecialchars($trimmed_path) ?>">
                                                <img src="<?= htmlspecialchars($trimmed_path) ?>" style="max-width: 150px; height: auto;">
                                                <button type="button" class="delete-image-btn">&times;</button>
                                            </div>
                                        <?php endif;
                                    endforeach; ?>
                                </div>
                                <input type="file" id="image" name="image[]" class="fileupload" multiple>
                            </div>

                            <input type="hidden" name="deleted_images" id="deleted-images-input">

                            <div class="loginlabel">
                                <label for="start"><?= lang('Kezdés dátuma') ?></label>
                                <br>
                                <input type="date" id="start" name="start" value="<?php echo htmlspecialchars($row['start'] === '0000-00-00' ? '' : $row['start'] ?? ''); ?>">
                            </div>

                            <div class="loginlabel">
                                <label for="finish"><?= lang('Befejezés dátuma') ?></label>
                                <br>
                                <input type="date" id="finish" name="finish" value="<?php echo htmlspecialchars($row['finish'] === '0000-00-00' ? '' : $row['finish'] ?? ''); ?>">
                            </div>
                            <br><br>
                            <div class="loginlabel">
                                <button class="button" type="submit" name="update_project"><?= lang('Projekt frissítése') ?></button>
                            <br><br>
                                <button type="button" class="button"onclick="location.href = 'project_page.php?id=<?php echo $id; ?>';"><?= lang('Vissza') ?></button>
                            </div>
                        </form>
                        <img src="/project/images/yarn2flipped.png" class="image-center">
                    </div>
                </div>
            </div>
        </main>
    </div>

    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/project/frontend/footer.php';
    ?>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const brandSelect = document.getElementById('brand');
            const varietySelect = document.getElementById('variety');
            const currentYarnId = <?php echo json_encode($current_yarn_id); ?>;

            const populateVarieties = (brand, selectedId = null) => {
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
                                if (variety.id == selectedId) {
                                    option.selected = true;
                                }
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

            // Initial population on page load
            const initialBrand = brandSelect.value;
            if (initialBrand) {
                populateVarieties(initialBrand, currentYarnId);
            }
        });
    </script>
</body>
</html>