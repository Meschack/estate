<?php
require 'elements/dashboard-header.php';

if (count($_POST) !== 0) {
  $sqlQuery = 'UPDATE `agency_infos` SET `a_name` = ?,`a_email` = ?,`a_telephoneNumber` = ?,`a_location` = ?,`a_openingTime` = ?,`a_closureHour` = ?,`a_facebook` = ?,`a_instagram` = ?,`a_linkedin` = ?,`a_twitter` = ? WHERE 1';
  $infosStatement = $mysqlConnection->prepare($sqlQuery);
  $infosStatement->execute([$_POST['name'], $_POST['email'], $_POST['telephone'], $_POST['location'], $_POST['opening'], $_POST['closure'], $_POST['facebook'], $_POST['instagram'], $_POST['linkedin'], $_POST['twitter']]);
  $infos = $infosStatement->fetch();
}

$sqlQuery = 'SELECT * FROM `agency_infos`';
$infosStatement = $mysqlConnection->prepare($sqlQuery);
$infosStatement->execute();
$infos = $infosStatement->fetch();

?>
<div class="container-fluid">
  <h1 class="h1">Mettre à jour les informations de l'agence</h1>

  <form action="" method="post">
    <div class="mb-3">
      <label for="name" class="form-label">Nom de l'agence</label>
      <input type="text" class="form-control" name="name" id="name" aria-describedby="helpId" value="<?= $infos['a_name'] ?>">
      <small id="helpId" class="form-text text-muted">Taille maximale de 20 caractères</small>
    </div>

    <div class="mb-3">
      <label for="email" class="form-label">Adresse Email</label>
      <input type="email" class="form-control" name="email" id="email" value="<?= $infos['a_email'] ?>">
    </div>

    <div class="mb-3">
      <label for="telephone" class="form-label">Numéro de téléphone</label>
      <input type="tel" class="form-control" name="telephone" id="telephone" aria-describedby="telhelpId" value="<?= $infos['a_telephoneNumber'] ?>">
      <small id="telhelpId" class="form-text text-muted">Numéro de téléphone valide de l'agence</small>
    </div>

    <div class="mb-3">
      <label for="location" class="form-label">Ville</label>
      <select class="form-control" name="location" id="location">
        <?php foreach (['Dassa', 'Cotonou', 'Abomey-Calavi', 'Ouidah', 'Parakou', 'Porto-Novo', 'Abomey', 'Bohicon', 'Ganvié', 'Natitingou'] as $city) : ?>
          <option value="<?= $city ?>" <?= $city === $infos['a_location'] ? 'selected' : '' ?>><?= $city ?></option>
        <?php endforeach ?>
      </select>
    </div>

    <div class="mx-0 mb-3 d-md-flex d-sm-block justify-content-between gap-2">
      <div class="col-sm-12 col-md-6">
        <label for="opening" class="form-label text-truncate">Heure d'ouverture</label>
        <select class="form-control" name="opening" id="opening">
          <?php for ($i = 0; $i < 24; $i++) : ?>
            <option value="<?= $i ?>" <?= $i == $infos['a_openingTime'] ? 'selected' : '' ?>><?= $i ?></option>
          <?php endfor ?>
        </select>
      </div>

      <div class="col-sm-12 col-md-6">
        <label for="closure" class="form-label text-truncate">Heure de fermeture</label>
        <select class="form-control" name="closure" id="closure">
          <?php for ($i = 0; $i < 24; $i++) : ?>
            <option value="<?= $i ?>" <?= $i == $infos['a_closureHour'] ? 'selected' : '' ?>><?= $i ?></option>
          <?php endfor ?>
        </select>
      </div>
    </div>

    <div class="mb-3">
      <label for="facebook" class="form-label">Lien facebook</label>
      <input type="text" class="form-control" name="facebook" id="facebook" placeholder="https://facebook.com/" value=<?= $infos['a_facebook'] ?? '' ?>>
    </div>

    <div class="mb-3">
      <label for="linkedin" class="form-label">Lien linkedin</label>
      <input type="text" class="form-control" name="linkedin" id="linkedin" placeholder="https://fr.linkedin.com" value=<?= $infos['a_linkedin'] ?? '' ?>>
    </div>

    <div class="mb-3">
      <label for="instagram" class="form-label">Lien instagram</label>
      <input type="text" class="form-control" name="instagram" id="instagram" placeholder="https://www.instagram.com" value=<?= $infos['a_instagram'] ?? '' ?>>
    </div>

    <div class="mb-3">
      <label for="twitter" class="form-label">Lien twitter</label>
      <input type="text" class="form-control" name="twitter" id="twitter" placeholder="https://twitter.com" value=<?= $infos['a_twitter'] ?? '' ?>>
    </div>

    <div class="mb-3">
      <button type="submit" class="btn btn-primary mx-auto d-block col-sm-12 col-md-4">Soumettre</button>
    </div>
  </form>
</div>
<?php require 'elements/dashboard-footer.php'; ?>