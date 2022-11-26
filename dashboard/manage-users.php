<?php
$link = '<link href="js/datatables/dataTables.bootstrap4.min.css" rel="stylesheet"/>';
$script = '
            <script src="js/datatables/jquery.dataTables.min.js"></script>
            <script src="js/datatables/dataTables.bootstrap4.min.js"></script>
            <script src="js/demo/datatables-demo.js"></script>
';
require 'elements/dashboard-header.php';
// require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'functions' . DIRECTORY_SEPARATOR . 'connectToDatabase.php';

$error = $success = null;
if (isset($_GET['delete'])) {
    $sqlQuery = 'DELETE FROM users WHERE `id` = ?';
    $deleteUser = $mysqlConnection->prepare($sqlQuery);
    $deleteUser->execute([$_GET['delete']]);
}

if (count($_POST) !== 0) {

    $admin_name = $_POST['name'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT, ['cost' => 14]);
    $sqlQuery = 'INSERT INTO users (brand, email, username, lastName, u_password, is_admin) VALUES (?, ?, ?, ?, ?, ?)';
    $addAdminStatement = $mysqlConnection->prepare($sqlQuery);
    try {
        $addAdminStatement->execute([$admin_name[0] . $lastName[0], $email, $admin_name, $lastName, $password, 1]);
        $success = 'Administrateur ajouté avec succès !';
    } catch (Exception $e) {
        if ($e->getCode() === '23000')
            $error = 'Cette adresse email existe déja dans la base de données';
    }
}

$sqlQuery = 'SELECT id, username, lastName, email, is_admin FROM users';
$usersListStatement = $mysqlConnection->prepare($sqlQuery);
$usersListStatement->execute();
$usersList = $usersListStatement->fetchAll();


?>

<div class="container-fluid">
    <h2>Ajoutez un administrateur</h2>
    <?php if ($error) : ?>
        <div class="alert alert-danger text-center">
            <?= $error ?>
        </div>
    <?php elseif ($success) : ?>
        <div class="alert alert-success text-center">
            <?= $success ?>
        </div>
    <?php endif ?>
    <form action="" method="post">
        <div class="mb-3">
            <label for="lastName" class="form-label">Nom</label>
            <input type="text" class="form-control" name="lastName" id="lastName" aria-describedby="helpLastName" minlength="3" maxlength="20">
            <small id="helpLastName" class="form-text text-muted">Le nom doit faire entre 3 et 20 caractères et ne doit pas contenir de chiffres</small>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Prénom</label>
            <input type="text" class="form-control" name="name" id="name" aria-describedby="helpName" minlength="3" maxlength="20">
            <small id="helpName" class="form-text text-muted">Le prénom doit faire entre 3 et 20 caractères et ne doit pas contenir de chiffres</small>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="nom@domaine.com">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" name="password" id="password" aria-describedby="helpPassword" minlength="8">
            <small id="helpPassword" class="form-text text-muted">Le mot de passe doit faire au moins 8 caractères, doit contenir une majuscule et un chiffre et ne doit pas contenir de caractères spéciaux</small>
        </div>
        <button type="submit" class="btn btn-primary mx-auto d-block">Soumettre</button>
    </form>
</div>
<div class="container-fluid">

    <!-- Page Heading -->
    <h2 class="h3 mb-2 text-gray-800">Tables</h2>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Base de données Utilisateurs</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($usersList as $users) : ?>
                            <tr>
                                <td><?= $users['username'] ?></td>
                                <td><?= $users['lastName'] ?></td>
                                <td><?= $users['email'] ?></td>
                                <td><?= $users['is_admin'] === 0 ? 'Utilisateur' : 'Administrateur' ?></td>
                                <td><a class="btn btn-danger" href="manage-users.php?delete=<?= $users['id'] ?>" role="button">Supprimer</a></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

<?php require 'elements/dashboard-footer.php' ?>