<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

require $_SERVER['DOCUMENT_ROOT'] . '/project/backend/config.php';
require $_SERVER['DOCUMENT_ROOT'] . '/project/backend/lang.php';

if (!isset($_SESSION['uid'])) {
    header('Location: /project/login.php?error=no_permission');
    exit();
}

$uid = $_SESSION['uid'];

// A rendezés és a kereséshez tartozó paramáterek
$sort_by = $_GET['sort_by'] ?? 'name';
$search_query = htmlspecialchars($_GET['search_query'] ?? '');
$search_filter = $_GET['search_filter'] ?? 'name';

// A rendezéshez és a kereséshez szükséges adatok lekérése az adatbázisból.
$sql = "SELECT p.id, p.name, p.yarn, p.hook, p.image, p.description FROM projects AS p";

// Ha a felhasználó fonalak szerint keres akkor belső csatlakozást hoz létre a yarns táblával hogy márka és fajta szerint együtt lehessen keresni
if (!empty($search_query) && $search_filter === 'yarn') {
    $sql .= " INNER JOIN yarns AS y ON p.yarn = y.id";
}

// Csak a bejelentkezett felhasználókhoz tartozó projekteket jeleníti meg
// Az sql változót kiegészíti ezzel
$sql .= " WHERE p.uid = ?";
$params = [$uid];
$param_types = "i";

// A switch segtíségével átláthatóbbak a szűrési és rendezési feltételek. 
// A search_query változó tartalmazza a felhasználó által beírt keresési kifejezést
if (!empty($search_query)) {
    switch ($search_filter) {
        case 'name':
            // Az sql változót tovább egészíti ki ezekkel a keresési feltételekkel
            // Az AND hozzáadja melyik oszlopban történik meg a keresés
            $sql .= " AND name LIKE ?";
            // Ez lehetővé teszi hogy a kifejezés a szó bármelyik részén megtörténjen
            $params[] = "%" . $search_query . "%";
            // Jelzi hogy ez egy string
            $param_types .= "s";
            // A végrehajtás befejeződik
            break;
        case 'hook':
            $sql .= " AND hook LIKE ?";
            $params[] = "%" . $search_query . "%";
            $param_types .= "s";
            break;
        case 'yarn':
            // Mivel két oszlopban is keres ezért az OR feltételt használ
            $sql .= " AND (y.brand LIKE ? OR y.variety LIKE ?)";
            $params[] = "%" . $search_query . "%";
            $params[] = "%" . $search_query . "%";
            $param_types .= "ss";
            break;
        case 'description':
            $sql .= " AND description LIKE ?";
            $params[] = "%" . $search_query . "%";
            $param_types .= "s";
            break;
        default:
            // Ez akkor fut le ha érvénytelen értékkel rendelkezik a search_query változó
            $sql .= " AND name LIKE ?";
            $params[] = "%" . $search_query . "%";
            $param_types .= "s";
            break;
    }
}

switch ($sort_by) {
    case 'id_desc':
        // Az sql változót tovább egészíti ki ezekkel a keresési feltételekkel
        $sql .= " ORDER BY p.id DESC";
        break;
    case 'id_asc':
        $sql .= " ORDER BY p.id ASC";
        break;
    case 'name':
    default:
        $sql .= " ORDER BY p.name ASC";
        break;
}

// Előkészíti a lekérdezést
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}
$stmt->bind_param($param_types, ...$params);
$stmt->execute();
$result = $stmt->get_result();
$noprojects = lang('Nincs projekt hozzáadva');
$projects = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
$conn->close();

?>

<!DOCTYPE html>
<head>

    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/project/frontend/header.php';
    ?>

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
                    <h2>
                        <a href="/project/my_projects.php" class="project_link">
                            <?= lang('Projektjeim') ?>
                        </a>
                    </h2>
                    <div class="search-container">
                        <form method="GET">
                            <input type="text" placeholder="<?= lang('Projekt keresése...') ?>" name="search_query" value="<?= htmlspecialchars($_GET['search_query'] ?? '') ?>">
                            <select name="search_filter" class="select-search">
                                <option value="name" <?= ($search_filter === 'name') ? 'selected' : '' ?>><?= lang('Név') ?></option>
                                <option value="yarn" <?= ($search_filter === 'yarn') ? 'selected' : '' ?>><?= lang('Fonal') ?></option>
                                <option value="hook" <?= ($search_filter === 'hook') ? 'selected' : '' ?>><?= lang('Horgolótű') ?></option>
                                <option value="description" <?= ($search_filter === 'description') ? 'selected' : '' ?>><?= lang('Leírás') ?></option>
                            </select>
                            <button type="submit" class="button-search"><?= lang('Keresés') ?></button>
                        </form>
                    </div>
                    <br>
                    <div class="sort-container">
                        <form method="GET">
                            <!--A search_query-re azért van szükség hogy a keresésben talált elemek között jöjjön létre a szűrés (ha volt keresve). Ez segít megőrizni ezeket az elemeket.-->
                            <input type="hidden" name="search_query" value="<?= htmlspecialchars($_GET['search_query'] ?? '') ?>">
                            <input type="hidden" name="search_filter" value="<?= htmlspecialchars($_GET['search_filter'] ?? '') ?>">
                            <!---->
                            <label for="sort_by"><?= lang('Rendezés:') ?></label>
                            <select name="sort_by" id="sort_by" class="select-sort" onchange="this.form.submit()">
                                <option value="name" <?= (!isset($_GET['sort_by']) || $_GET['sort_by'] === 'name') ? 'selected' : '' ?>><?= lang('Név szerint') ?></option>
                                <option value="id_desc" <?= (isset($_GET['sort_by']) && $_GET['sort_by'] === 'id_desc') ? 'selected' : '' ?>><?= lang('Legújabb') ?></option>
                                <option value="id_asc" <?= (isset($_GET['sort_by']) && $_GET['sort_by'] === 'id_asc') ? 'selected' : '' ?>><?= lang('Legrégebbi') ?></option>
                            </select>
                        </form>
                    </div>
                    <div class="projects-grid">
                        <?php if (!empty($projects)): ?>
                        <?php foreach ($projects as $row): ?>
                            <div class='project-item'>
                                <div>
                                    <p style='font-size:1em;'>
                                        <img src='/project/images/yarnlilac.png' style='width:25px; vertical-align: middle;'>
                                        <a href='/project/user/project_page.php?id=<?= htmlspecialchars($row['id']) ?>' style='text-decoration:none; color:rgb(75, 75, 75); margin-top:40px'>
                                            <b><?= htmlspecialchars($row['name']) ?></b>
                                        </a>
                                        <img src='/project/images/yarnlilac.png' style='width:25px; vertical-align: middle;'>
                                    </p>
                                </div>
                                <div>
                                    <?php
                                    // A képek eléréi útvonalát stringként van tárolva
                                    $image_paths = array_filter(explode(',', $row['image']));
                                    
                                    // Ha található benne kép akkor véletlenszerűen kiválaszt egy képet
                                    if (!empty($image_paths)) {
                                        $random_image_path = $image_paths[array_rand($image_paths)];
                                        $image_source = trim($random_image_path);
                                    } else {
                                        // Ha nincs kép ezt az alapméretezett képet jeleníti meg a projekt
                                        $image_source = '/project/images/no-file-found-yarn-ball.png';
                                    }
                                    ?>
                                    <a href='/project/project_page.php?id=<?= htmlspecialchars($row['id']) ?>' style='text-decoration:none; color:rgb(75, 75, 75); margin-top:40px'>
                                        <img src='<?= htmlspecialchars($image_source) ?>' alt='Project image' class="project-image">
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <?php else: ?>
                            <div style='border: 1px solid rgb(90, 90, 90) text-align=center;'><p colspan='6'><?= htmlspecialchars($noprojects) ?></p></div>
                        <?php endif; ?>
                    </div>
                    <div>
                        <a href="/project/add_project.php" class="button-link">
                            <?= lang('Projekt hozzáadása') ?>
                        </a>
                    </div>
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