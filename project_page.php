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

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid project ID provided.");
}

$project_id = $_GET['id'];

$stmt = $conn->prepare("SELECT p.id, p.name, p.pattern, p.hook, p.description, p.image, p.start, p.finish, y.brand, y.variety FROM projects p LEFT JOIN yarns y ON p.yarn = y.id WHERE p.id = ? AND p.uid = ?");
                    
if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}

$stmt->bind_param("ii", $project_id, $_SESSION['uid']);
$stmt->execute();
$result = $stmt->get_result();

$nev = lang('Név');
$minta = lang('Minta');
$fonal = lang('Fonal');
$horgolotu = lang('Horgolótű');
$leiras = lang('Leírás');
$kep = lang('Kép');
$kezdes = lang('Kezdés dátuma');
$befejezes = lang('Befejezés dátuma');
$torles = lang('Törlés');
$szerkesztes = lang('Szerkesztés');

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
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<div>";
                            echo "<p style='font-size:2.5em'><b>{$row['name']}</b></p>";
                            echo "<p><b>$minta</b><br><a href='{$row['pattern']}' style='text-decoration:none; color:rgb(122, 100, 155); margin-bottom:15px;' target='_blank'>Link</a></p>";
                            echo "<p style='margin-bottom:15px;'><b>$fonal</b><br>";
                            
                            if (!empty($row['brand']) && !empty($row['variety'])) {
                                echo "{$row['brand']} - {$row['variety']}";
                            } else {
                                echo lang('Nincs megadva fonal.');
                            }

                            echo "</p>";
                            echo "<p><b>$horgolotu</b><br>{$row['hook']}</p>";
                            echo "<p style='text-align: center; '>";
                            echo "<b>$leiras</b>";
                            echo "<br>";
                            echo "<p style='text-align:justify; text-justify: inter-word; width: 80%; margin: 0 auto;'>{$row['description']}</p>";
                            echo "</p>";
                            echo "<p><b>$kep</b></p>";

                            if (!empty($row['image'])) {
                                $image_paths = explode(',', $row['image']);
                                foreach ($image_paths as $image_path) {
                                    $image_path = trim($image_path);
                                    if (!empty($image_path)) {
                                        echo "<img src='{$image_path}' alt='Project image' style='max-width: 200px; height: auto; margin: 5px;'>";
                                    }
                                }
                            } else {
                                echo "<p>Nincs kép feltöltve.</p>";
                            }

                            echo "<p><b>$kezdes</b><br>{$row['start']}</p>";
                            echo "<p><b>$befejezes</b><br>{$row['finish']}</p>";
                            echo "<br>";
                            echo "<a href='edit_project.php?id={$row['id']}' class='link'>$szerkesztes</a>";
                            echo "<a href='backend/delete_project.php?id={$row['id']}' class='link' onclick='return ConfirmDelete();'>$torles</a>";
                            echo "</div>";
                        }
                    } else {
                        echo "<div style='border: 1px solid rgb(90, 90, 90) text-align=center;'><p colspan='6'>Nincs elérhető adat!</p></div>";
                    }

                    $stmt->close();
                    $conn->close();
                    ?>

                    <br>

                    <a href="/project/my_projects.php" class="button-link">
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
    
    <noscript>Free cookie consent management tool by <a href="https://www.termsfeed.com/">TermsFeed Generator</a></noscript>

</body>
</html>