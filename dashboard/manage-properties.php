<?php
require 'elements/dashboard-header.php';
require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'functions' . DIRECTORY_SEPARATOR . 'connectToDatabase.php';

if (isset($_GET['delete'])) {
    $sqlQuery = 'SELECT `p_image` FROM properties WHERE `id` = ?';
    $deleteProperties = $mysqlConnection->prepare($sqlQuery);
    $deleteProperties->execute([$_GET['delete']]);
    $file = $deleteProperties->fetch();
    unlink($file['p_image']);

    $sqlQuery = 'DELETE FROM properties WHERE `id` = ?';
    $deleteProperties = $mysqlConnection->prepare($sqlQuery);
    $deleteProperties->execute([$_GET['delete']]);
}

$error = $success = null;

if (count($_POST) !== 0 && count($_FILES) !== 0) {
    $category = $_POST['category'];
    $location = $_POST['location'];
    $price = $_POST['price'];
    $beds = $_POST['beds'];
    $baths = $_POST['baths'];
    $area = $_POST['area'];
    $description = $_POST['description'];

    $tmpName = $_FILES['image']['tmp_name'];
    $name = $_FILES['image']['name'];
    $size = $_FILES['image']['size'];
    $uploadError = $_FILES['image']['error'];
    $type = $_FILES['image']['type'];

    $extensions = ['jpeg', 'jpg', 'png', 'gif'];
    $maxSize = 1500000;
    $file_extension = strtolower(explode('/', $type)[1]);


    if (in_array($file_extension, $extensions)) {
        if ($uploadError === 0) {
            if ($size < $maxSize) {
                // Upload the property image
                $name = uniqid('property-', true) . '.' . $file_extension;
                $filePath = __DIR__ . DIRECTORY_SEPARATOR . 'upload';
                move_uploaded_file($tmpName, __DIR__ . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR . $name);

                $sqlQuery = 'INSERT INTO properties (p_category, p_location, p_beds, p_baths, p_area, p_description, p_price, p_image) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
                $addPropertyStatement = $mysqlConnection->prepare($sqlQuery);
                $addPropertyStatement->execute([$category, $location, $beds, $baths, $area, $description, $price, 'upload/' . $name]);

                $success = 'Propriété ajouté avec succès';
            } else {
                $error = 'Fichier trop volumineux';
            }
        } else {
            echo 'Code !!!';
        }
    } else {
        $error = 'Mauvaise extension !';
    }
}

$sqlQuery = 'SELECT `id`, `p_location`, `p_category`, `p_area`, `p_beds`, `p_baths`, `p_description`, `p_price` FROM `properties` ORDER BY `id` DESC';
$propertiesListStatement = $mysqlConnection->prepare($sqlQuery);
$propertiesListStatement->execute();
$propertiesList = $propertiesListStatement->fetchAll();

?>

<!-- 1. #Content Wrapper
2. #Content -->


<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ajoutez une propriété</h1>
    </div>

    <div class="row">
        <div class="col-12 mx-auto">
            <?php if ($error) : ?>
                <div class="alert alert-danger text-center">
                    <?= $error ?>
                </div>
            <?php elseif ($success) : ?>
                <div class="alert alert-success text-center">
                    <?= $success ?>
                </div>
            <?php endif ?>

            <form action="" method="post" enctype="multipart/form-data" class="<?= $success != null ? 'd-none' : '' ?>">

                <div class="mb-3">
                    <label for="category" class="form-label">Catégorie</label>
                    <select class="form-control" name="category" id="category" required>
                        <option value="sale" selected>Vente</option>
                        <option value="rent">Location</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="location" class="form-label">Ville</label>
                    <select class="form-control" name="location" id="location">
                        <?php foreach (['Cotonou', 'Abomey-Calavi', 'Ouidah', 'Parakou', 'Porto-Novo', 'Abomey', 'Bohicon', 'Ganvié', 'Natitingou'] as $city) : ?>
                            <option value="<?= $city ?>"><?= $city ?></option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Prix</label>
                    <input type="number" class="form-control" name="price" id="price" min="0" placeholder="(FCFA)" required>
                </div>

                <div class="mb-3">
                    <label for="beds" class="form-label">Nombre de Chambres</label>
                    <input type="number" class="form-control" name="beds" id="beds" min="0" required>
                </div>

                <div class="mb-3">
                    <label for="baths" class="form-label">Nombres de Douches</label>
                    <input type="number" class="form-control" name="baths" id="baths" min="0" required>
                </div>

                <div class="mb-3">
                    <label for="area" class="form-label">Surface</label>
                    <input type="number" class="form-control" name="area" id="area" min="0" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description de la propriété</label>
                    <textarea class="form-control" name="description" id="description" required style="resize: none;"></textarea>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Une image de la propriété</label>
                    <input type="file" class="form-control" name="image" id="image" aria-describedby="fileHelpId" required>
                    <div id="fileHelpId" class="form-text">Taille d'image inférieure à 2Mo</div>
                </div>
                <button type="submit" class="btn btn-primary mx-auto d-block">Soumettre</button>
            </form>
        </div>
    </div>
</div>

<div class="container-fluid">
    <h2 class="h3 mb-2 text-gray-800">Tables</h2>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Base de données Propriétés</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Situation</th>
                            <th>Catégorie</th>
                            <th>Chambres</th>
                            <th>Douches</th>
                            <th>Surface</th>
                            <th>Description</th>
                            <th>Prix</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Situation</th>
                            <th>Catégorie</th>
                            <th>Chambres</th>
                            <th>Douches</th>
                            <th>Surface</th>
                            <th>Description</th>
                            <th>Prix</th>
                            <th>Acion</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($propertiesList as $properties) : ?>
                            <tr>
                                <td><?= $properties['p_location'] ?></td>
                                <td><?= $properties['p_category'] === 'sale' ? 'Vente' : 'Location' ?></td>
                                <td><?= $properties['p_beds'] ?></td>
                                <td><?= $properties['p_baths'] ?></td>
                                <td><?= $properties['p_area'] ?> m<sup>2</sup></td>
                                <td><?= $properties['p_description'] ?></td>
                                <td><?= $properties['p_price'] ?> FCFA</td>
                                <td><a class="btn btn-danger" href="manage-properties.php?delete=<?= $properties['id'] ?>" role="button">Supprimer</a></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php require 'elements/dashboard-footer.php' ?>