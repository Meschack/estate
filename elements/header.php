<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'functions' . DIRECTORY_SEPARATOR . 'navFunctions.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'functions' . DIRECTORY_SEPARATOR . 'auth.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'functions' . DIRECTORY_SEPARATOR . 'connectToDatabase.php';

$sqlQuery = 'SELECT * FROM `agency_infos`';
$infosStatement = $mysqlConnection->prepare($sqlQuery);
$infosStatement->execute();
$infos = $infosStatement->fetch();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>
    <?php if (isset($title)) : ?>
      <?= $infos['a_name'] . ' | ' . $title ?>
    <?php else : ?>
      <?= $infos['a_name'] ?>
    <?php endif ?>
  </title>
  <link rel="stylesheet" href="./css/all.min.css" />
  <link rel="stylesheet" href="./css/style.css" />
  <link rel="shortcut icon" href="./images/house-solid.svg" type="image/x-icon">
</head>

<body>
  <header class="flex align-center justify-between">
    <h1><?= $infos['a_name'] ?> <i class="fa-solid fa-home"></i></h1>
    <div class="flex justify-end align-center g-2">
      <div class="open-menu"><i class="fa-solid fa-bars"></i></div>
      <nav class="flex g-2">
        <ul>
          <div class="close-menu">
            <i class="fa-solid fa-close"></i>
          </div>
          <?= nav_menu() ?>
        </ul>

      </nav>

      <?php if (isConnect()) : ?>
        <div class="account flex flex-column justify-center">
          <div class="flex justify-between align-center"><span class="brand flex align-center justify-center"><span><?= $_SESSION['user_brand'] ?></span></span><i class="fas fa-chevron-down dropdown"></i></div>

          <div class="dropdown-menu flex flex-column justify-center ">
            <?php if ($_SESSION['is_admin'] === "1") : ?>
              <div>
                <i class="fa fa-tachometer-alt"></i>
                <a href="dashboard/dashboard.php">Dashboard</a>
              </div>
            <?php endif ?>
            <div>
              <i class="fas fa-sign-out"></i>
              <a href="logout.php">Déconnexion</a>
            </div>
          </div>
        </div>
      <?php endif ?>
    </div>
  </header>