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

$error_message = NULL;

// A márkák lekérése az adatbázisból
$brands = [];
if ($conn) {
    $sql_brands = "SELECT DISTINCT brand FROM yarns ORDER BY brand ASC";
    $result_brands = $conn->query($sql_brands);
    if ($result_brands && $result_brands->num_rows > 0) {
        while ($row = $result_brands->fetch_assoc()) {
            $brands[] = $row['brand'];
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Leellenőrzi hogy a márka és a fajta mezőlétezik-e, valamint hogy nem üres-e
    if (isset($_POST['brand']) && isset($_POST['variety']) && !empty($_POST['brand']) && !empty($_POST['variety'])) {
        $brand = $_POST['brand'];
        $variety = $_POST['variety'];

        // Ha a kiválasztott mező az új márka hozzáadása akkor a new_brand_name beviteli mezőt használja
        if ($brand === 'new_brand' && isset($_POST['new_brand_name']) && !empty($_POST['new_brand_name'])) {
            $brand = $_POST['new_brand_name'];
        }

        if ($conn) {
            // SQL előkészítése
            $sql = "INSERT INTO yarns (brand, variety) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $brand, $variety);

            if ($stmt->execute()) {
                $error_message = lang('Fonal sikeresen hozzáadva!');
            } else {
                $error_message = lang('Nem sikerült hozzáadni.');
            }

            $stmt->close();
        } else {
            $error_message = lang('Adatbázis kapcsolat megszakadt.');
        }
    } else {
        $error_message = lang('Kérjük töltsd ki az összes mezőt.');
    }
}
?>

<!DOCTYPE html>
<head>
    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/project/frontend/header.php';
    ?>
    <script src="/project/scripts/sidebar_toggle.js"></script>
    <script src="/project/scripts/new_brand_input.js"></script>
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
                    <h2><?= lang('Új fonal hozzáadása') ?></h2>
                    <form action="add_yarn.php" method="post">
                        <div class="loginlabel">
                            <label for="brand"><?= lang('Márka') ?></label><br>
                            <select id="brand" name="brand" class="yarn_add" required onchange="toggleNewBrandInput()"> <!-- Az onchange funkcióval megváltoztatjuk a html elemet, ebben az esetben a Válassz márkát lenyló menüt. -->
                                <option value=""><?= lang('Válassz márkát') ?></option>
                                <?php foreach ($brands as $existing_brand): ?>
                                    <option value="<?= htmlspecialchars($existing_brand) ?>">
                                        <?= htmlspecialchars($existing_brand) ?>
                                    </option>
                                <?php endforeach; ?>
                                <option value="new_brand"><?= lang('Új márka hozzáadása') ?></option>
                            </select>
                            <br>
                            <div class="new_brand">
                                <input type="text" id="new_brand_name" name="new_brand_name" placeholder="<?= lang('Új márka neve') ?>" class="new_brand_input"><br>
                            </div>
                        </div>
                        <div class="loginlabel">
                            <label for="variety"><?= lang('Fajta') ?></label><br>
                            <input type="text" id="variety" name="variety" placeholder="<?= lang('Fajta') ?>" required><br>
                        </div>
                        <br>
                                    
                        <p>
                            <?php
                                if (!empty($error_message)) {
                                    echo htmlspecialchars($error_message);
                                }
                            ?>
                        </p>
                        <br>
                        <button type="submit" class="button"><?= lang('Fonal hozzáadása') ?></button>
                        <br><br>
                        <a href="/project/yarn.php" class="button-link"><?= lang('Vissza') ?></a>
                    </form>
                    <img src="/project/images/yarn2flipped.png" class="image-center">
                </div>
            </div>
        </main>
    </div>

    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/project/frontend/footer.php';
    ?>

</body>
</html>
