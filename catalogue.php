<?php
$title = 'Catalogue';
require 'elements/header.php';
$sqlQuery = 'SELECT * FROM properties ORDER BY id DESC';

if (isset($_GET['value'])) {
    if (!($_GET['value'] !== "rent" && $_GET['value'] !== "sale")) {
        $sqlQuery = 'SELECT * FROM properties WHERE `p_category` = "' . $_GET["value"] . '"' . ' ORDER BY id DESC';
    }
}

$propertiesStatement = $mysqlConnection->prepare($sqlQuery);
$propertiesStatement->execute();
$propertiesList = $propertiesStatement->fetchAll();

$i = $_GET['more'] ?? 0;

?>
<h2>Toutes nos propriétés</h2>
<div class="filter flex flex-column justify-end">
    <div class="flex align-center justify-between g-1">
        <span class="flex align-center justify-center">Filtrer par</span>
        <i class="fas fa-chevron-down filter-icon"></i>
    </div>

    <div class="dropdown-filter-menu none">
        <ul>
            <li value="sale"><a href="catalogue.php?value=sale">Vente</a></li>
            <li value="rent"><a href="catalogue.php?value=rent">Location</a></li>
        </ul>
    </div>
</div>

<section>
    <div class="card-container flex justify-center g-2">
        <?php for ($property = 0 + $i; $property < (count($propertiesList) - $i >= 12 ? 12 : count($propertiesList)); $property++) : ?>
            <div style="background: url('dashboard/<?= $propertiesList[$property]['p_image'] ?>') center/cover;" class="card flex flex-column g-1 ">
                <div class="card-title">
                    <h2><?= $propertiesList[$property]['p_location'] ?></h2>
                </div>

                <div class="card-body flex flex-column">
                    <span>À <?= $propertiesList[$property]['p_category'] === 'sale' ? 'vendre' : 'louer' ?> | <?= $propertiesList[$property]['p_price'] ?> FCFA</span>
                    <span><a href="single-property.php?id=<?= $propertiesList[$property]['id'] ?>">En savoir plus &rarr;</a></span>
                </div>

                <div class="card-footer flex g-1 justify-between align-center">
                    <div><span>Surface</span> <span><?= $propertiesList[$property]['p_area'] ?> m<sup>2</sup></span></div>
                    <div><span>Chambres</span><span><?= $propertiesList[$property]['p_beds'] ?></span></div>
                    <div><span>Salle de bain</span><span><?= $propertiesList[$property]['p_baths'] ?></span></div>
                </div>
            </div>
        <?php endfor ?>
    </div>
    <?php if (count($propertiesList) - $i > 12) : ?>
        <div class="more"><a href="catalogue.php?more=<?= $i + 12 ?>">Suivant &rarr;</a></div>
    <?php endif ?>
</section>

<?php require 'elements/footer.php' ?>