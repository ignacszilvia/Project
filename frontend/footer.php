<?php

$redirect_url = '/project/index.php'; 

if (isset($_SESSION['rights'])) {
    if ($_SESSION['rights'] == 103) {
        $redirect_url = '/project/admin/home_admin.php'; 
    } else {
        $redirect_url = '/project/home.php'; 
    }
}

?>

<!DOCTYPE html>
<head>
</head>
<body>
    
    <footer>
        <div class="footer">
            <a class="footer_link" href="<?= $redirect_url ?>"><?= lang('Főoldal') ?></a>
             | 
            <a class="footer_link" href="/project/footer/about_us.php"><?= lang('Rólunk') ?></a>
             | 
            <a class="footer_link" href="/project/footer/faq.php"><?= lang('GYIK') ?></a>
            <!-- | 
            <a class="footer_link" href="/project/footer/terms.php"><?= lang('Felhasználási feltételek') ?></a>-->
        </div>
    </footer>
    
</body>
</html>