<?php
$title = 'Présentation de propriété';
require 'elements/header.php';

$sqlQuery = 'SELECT * FROM `properties` WHERE `id` = ?';
$propertyStatement = $mysqlConnection->prepare($sqlQuery);
$propertyStatement->execute([$_GET['id']]);
$property = $propertyStatement->fetch();

// $link = explode('/', $_SERVER["REQUEST_URI"])[2];

if (isset($_GET['reserve'])) {
    $sqlQuery = 'SELECT id FROM users WHERE email = ?';
    $senderStatement = $mysqlConnection->prepare($sqlQuery);
    $senderStatement->execute([$_SESSION['email']]);
    $sender = $senderStatement->fetch();

    $id = $sender['id'];

    $sqlQuery = 'INSERT INTO `messages`(m_subject, u_id, created_at, u_message) VALUES (?, ?, ?, ?)';
    $reservationStatement = $mysqlConnection->prepare($sqlQuery);
    $reservationStatement->execute(['Réservation', $id, date('Y-m-d h:i:s'), 'Réservation de la propriété ' . $_GET['reserve']]);
    $success = 'Réservation faite';
}

?>

<div class="services single-property">
    <h2><?= $property['p_description'] ?></h2>
    <strong><?= $property['p_location'] ?></strong>
</div>

<section style="background: url(dashboard/<?= $property['p_image'] ?>) center no-repeat" class="flex flex-column">
    <div>Prix | <?= $property['p_price'] ?></div>

    <?php if (isset($_SESSION['connecte'])) : ?>
        <div>
            <a href="single-property.php?id=<?= $_GET['id'] ?>&reserve=<?= $property['id'] ?>"><?= $success ?? 'Réserver' ?></a>
        </div>
    <?php else : ?>
        <div>
            <a href="login.php">Connectez-vous pour réserver</a>
        </div>
    <?php endif ?>
</section>

<div>
    <h2>Sommaire</h2>
    <ul class="flex flex-column g-1">
        <li class="flex justify-between">
            <strong>Identifiant</strong>
            <small><?= $property['id'] ?></small>
        </li>

        <li class="flex justify-between">
            <strong>Situation</strong>
            <small><?= $property['p_location'] ?></small>
        </li>

        <li class="flex justify-between">
            <strong>Statut</strong>
            <small><?= $property['p_category'] === 'sale' ? 'Vente' : 'Location' ?></small>
        </li>

        <li class="flex justify-between">
            <strong>Surface</strong>
            <small><?= $property['p_area'] ?> m<sup>2</sup></small>
        </li>

        <li class="flex justify-between">
            <strong>Chambres</strong>
            <small><?= $property['p_beds'] ?></small>
        </li>

        <li class="flex justify-between">
            <strong>Douches</strong>
            <small><?= $property['p_baths'] ?></small>
        </li>
    </ul>
</div>

<?php require 'elements/footer.php' ?>