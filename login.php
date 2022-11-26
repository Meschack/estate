<?php
session_start();
$title = 'Page de connexion';
require 'elements/header.php';
$error = null;
if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $sqlQuery = 'SELECT `username`, `lastName`, `u_password`, `email`, `is_admin` FROM `users` WHERE `email` = "' . $_POST['email'] . '"';
    $authStatement = $mysqlConnection->prepare($sqlQuery);
    $authStatement->execute();
    $auth = $authStatement->fetch();

    if (!empty($auth)) {
        if (password_verify($_POST['password'], $auth['u_password'])) {
            $_SESSION['connecte'] = 1;
            $_SESSION['user_brand'] = $auth['username'][0] . $auth['lastName'][0];
            $_SESSION['email'] = $auth['email'];
            $_SESSION['is_admin'] = $auth['is_admin'] == 1 ? "1" : "0";
        } else {
            $error = 'Mot de passe erroné !';
        }
    } else {
        $error = 'Adresse email incorrect !';
    }
}

if (isConnect()) {
    header('Location: ./contact.php');
    exit();
}
?>



<form action="" method="post" class="flex flex-column g-2">
    <?php if ($error) : ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif ?>

    <h2>Veuillez vous connecter pour nous contacter</h2>
    <div>
        <input type="email" name="email" placeholder="Adresse email" class="form-control" id="email" required>
    </div>

    <div id="password-container">
        <input type="password" name="password" placeholder="Mot de passe" class="form-control" required>
        <i class="fas fa-eye-slash" id="view-password"></i>
    </div>

    <button type="submit">Envoyer</button>

    <div>Vous n'avez pas encore de compte ? <a href="register.php">Inscrivez vous</a></div>
</form>



<?php require 'elements/footer.php'; ?>