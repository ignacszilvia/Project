<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

require $_SERVER['DOCUMENT_ROOT'] . '/project/backend/config.php';
require $_SERVER['DOCUMENT_ROOT'] . '/project/backend/lang.php';

if (!isset($_SESSION['uid']) || $_SESSION['rights'] != 103) {
    header('Location: /project/login.php?error=no_permission');
    exit();
}

// Lekérdezi a felhasználó és a projekt id-t az url-ből
$target_uid = $_GET['uid'] ?? $_SESSION['uid'];
$project_id = $_GET['id'] ?? null;

if (empty($project_id) || !is_numeric($project_id) || !is_numeric($target_uid)) {
    die("Érvénytelen projekt- vagy felhasználói azonosító megadva.");
}

// Adatbázisból lekéri a projekt adatait
$sql = "SELECT p.id, p.name, p.pattern, p.hook, p.description, p.image, p.start, p.finish, y.brand, y.variety FROM projects p LEFT JOIN yarns y ON p.yarn = y.id WHERE p.id = ? AND p.uid = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    error_log("Error preparing statement: " . $conn->error);
    die("Adatbázishiba. Kérjük, próbálja újra később.");
}

// Lekéri az adatokat és berakja egy tömbbe
$stmt->bind_param("ii", $project_id, $target_uid);
$stmt->execute();
$result = $stmt->get_result();
$project_data = $result->fetch_assoc();

$stmt->close();
$conn->close();

$nev = lang('Név');
$minta = lang('Minta');
$fonal = lang('Fonal');
$tu = lang('Horgolótű');
$leiras = lang('Leírás');
$kep = lang('Kép');
$kezdes = lang('Kezdés dátuma');
$befejezes = lang('Befejezés dátuma');
$torles = lang('Törlés');
$szerkesztes = lang('Szerkesztés');
$vissza = lang('Vissza');

?>

<!DOCTYPE html>
<head>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/project/frontend/header.php'; ?>

    <script src="/project/scripts/sidebar_toggle.js"></script>
</head>
<body>
    <div class="page_container">
        <main class="page_content">
            <div class="main_body">
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/project/frontend/sidebar_admin.php'; ?>
                <div class="main_container">
                    <img src="/project/images/yarn2.png" class="image-center">
                    <?php if ($project_data): ?>
                    <div>
                        <p style='font-size:2.5em'><b><?= htmlspecialchars($project_data['name']) ?></b></p>
                        <p><b><?= $minta ?></b><br><a href='<?= htmlspecialchars($project_data['pattern']) ?>' style='text-decoration:none; color:rgb(122, 100, 155); margin-bottom:15px;' target='_blank'>Link</a></p>

                        <p style='margin-bottom:15px;'><b><?= $fonal ?></b><br>
                        <?php if (!empty($project_data['brand']) && !empty($project_data['variety'])): ?>
                            <?= htmlspecialchars($project_data['brand'] . ' - ' . $project_data['variety']) ?>
                        <?php else: ?>
                            <?= lang('Nincs megadva fonal.') ?>
                        <?php endif; ?>
                        </p>

                        <p><b><?= $tu ?></b><br><?= htmlspecialchars($project_data['hook']) ?></p>

                        <p style='text-align: center;'>
                            <b><?= $leiras ?></b>
                            <br>
                            <p style='text-align:justify; text-justify: inter-word; width: 80%; margin: 0 auto;'><?= htmlspecialchars($project_data['description']) ?></p>
                        </p>

                        <p><b><?= $kep ?></b></p>
                        <?php if (!empty($project_data['image'])): ?>
                            <?php $image_paths = explode(',', $project_data['image']); ?>
                            <?php foreach ($image_paths as $image_path): ?>
                                <?php $image_path = trim($image_path); ?>
                                <?php if (!empty($image_path)): ?>
                                    <img src='<?= htmlspecialchars($image_path) ?>' alt='Project image' style='max-width: 200px; height: auto; margin: 5px;'>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p><?= lang('Nincs kép feltöltve.') ?></p>
                        <?php endif; ?>

                        <p><b><?= $kezdes ?></b><br><?= htmlspecialchars($project_data['start']) ?></p>
                        <p><b><?= $befejezes ?></b><br><?= htmlspecialchars($project_data['finish'] ?? '') ?></p>
                        <br>

                        <a class='link' href='/project/backend/delete_project.php?id=<?= htmlspecialchars($project_data['id']) ?>&uid=<?= htmlspecialchars($target_uid) ?>' onclick='return ConfirmDelete();'><?= $torles ?></a>
                    </div>
                    <?php else: ?>
                        <div style='border: 1px solid rgb(90, 90, 90) text-align=center;'><p colspan='6'>Nincs elérhető adat!</p></div>
                    <?php endif; ?>

                    <br>    

                    <a href="projects_admin.php?id=<?= htmlspecialchars($target_uid) ?>" class="button-link">
                        <?= lang('Vissza') ?>
                    </a>
                    
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