<?php
$title = 'Accueil';
require 'elements/header.php';
$sqlQuery = 'SELECT * FROM properties ORDER BY id DESC LIMIT 6';
$propertiesStatement = $mysqlConnection->prepare($sqlQuery);
$propertiesStatement->execute();
$propertiesList = $propertiesStatement->fetchAll();
?>

<section class="banner">
  <div>La maison de vos rêves est chez nous !</div>
</section>

<section>
  <h2>Nos Services</h2>
  <div class="flex g-2 flex-wrap justify-center">
    <div class="services">
      <h3>Vente de domaines habitables</h3>
      <p>Avez-vous envie de déménager alors que vous n'avez aucune idée d'où vous installer ? Vous êtes à la bonne adresse. Nous vous proposons une bonne variété de domaines et appartements habitables.</p>
    </div>
    <div class="services">
      <h3>Location d'Appartements meublés</h3>
      <p>Que ce soit pour des vacances ou des missions loin de chez vous, vous aurez besoin d'un endroit calme et paisible pour vous poser. Avec Bénin Immo, plus de soucis à vous faire. Nous vous proposons des propriétés adaptées à votre besoin sur toute l'étendue du territoire.</p>
    </div>
  </div>
</section>

<section class="property-list">
  <h2>Nos dernières propriétés</h2>
  <div>
    <div class="card-container flex justify-center g-2">

      <?php foreach ($propertiesList as $property) : ?>
        <div style="background: url('<?= 'dashboard/' . $property['p_image'] ?>') center/cover;" class="card flex flex-column g-1 ">
          <div class="card-title">
            <h2><?= $property['p_location'] ?></h2>
          </div>

          <div class="card-body flex flex-column">
            <span>À <?= $property['p_category'] === 'sale' ? 'vendre' : 'louer' ?> | <?= $property['p_price'] ?> FCFA</span>
            <span><a href="single-property.php?id=<?= $property['id'] ?>">En savoir plus &rarr;</a></span>
          </div>

          <div class="card-footer flex g-1 justify-between align-center">
            <div><span>Surface</span> <span><?= $property['p_area'] ?> m<sup>2</sup></span></div>
            <div><span>Chambres</span><span><?= $property['p_beds'] ?></span></div>
            <div><span>Salle de bain</span><span><?= $property['p_baths'] ?></span></div>
          </div>
        </div>
      <?php endforeach ?>
    </div>
    <div class="more"><a href="./catalogue.php">En voir plus <i class="fas fa-plus"></i></a></div>

  </div>
</section>

<?php require 'elements/footer.php' ?>