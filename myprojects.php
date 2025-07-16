<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require 'backend/lang.php';
?>


<!DOCTYPE html>
<head>
    <?php
	include 'header.php';
	?>
</head>
<body>
    


    <?php
    include 'footer.php';
    ?>
</body>
</html>