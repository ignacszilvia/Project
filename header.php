<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= lang('Hobbihorgolás') ?></title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="images/yarnballlogolilac.png">
</head>
<body>   

    <header>
      <nav class="navbar">
        <div class="navbar-container">
          <div class="navbar-intro">
            <a href="dashboard.php" class="logolink">
              <img src="images/yarnballlogoblacksmall.png" class="catlogo">
              <h1 class="navbar-logo" class="intro"><?= lang('HOBBIHORGOLÁS') ?></h1>
            </a>
          </div>

          
          <div class="rightnav">
          <ul class="navbar-menu">
            <button class="navbutton" onclick="window.location.href='dashboard.php';"><?= lang('Főoldal') ?></button>
            <button class="navbutton" onclick="window.location.href='#';"><?= lang('Rólunk') ?></button>
            <button class="navbutton" onclick="window.location.href='#';"><?= lang('Kapcsolat') ?></button>
          </ul>     
          
          <div class="lang-menu">
            <div class="selected-lang">
              <?= lang('Nyelv') ?>
            </div>
            <ul>
              <li>
                <a href="?lang=hu" class="hu">Magyar</a>
              </li>
              <li>
                <a href="?lang=en" class="en">English</a>
              </li>
              <li>
                <a href="#" class="es">Español</a>
              </li>
            </ul>   
          </div>
        </div>
          <!-- <button class="navbar-toggle">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
          </button> -->
        </div>
        </nav>
</header>

</body>
</html>