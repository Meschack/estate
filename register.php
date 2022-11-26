<?php
$title = "Page d'enregistrement";
$error = null;
if (
    !empty($_POST['username']) &&
    !empty($_POST['password']) &&
    !empty($_POST['email']) &&
    !empty($_POST['lastName'])
) {
    require 'functions/loginFormValidate.php';

    $username = htmlentities($_POST['username']);
    $password = $_POST['password'];
    $email = $_POST['email'];
    $lastName = htmlentities($_POST['lastName']);

    if (!validateInput($username, 3, 30)) {
        $username = null;
    }

    if (!validateInput($lastName, 3, 30)) {
        $lastName = null;
    }

    if (!validateInput($password, 6, 20)) {
        $password = null;
    } else {
        $password = password_hash($password, PASSWORD_DEFAULT, ['cost' => 14]);
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email = null;
    }

    if ($username && $email && $password && $lastName) {
        require 'functions/connectToDatabase.php';
        $sqlQuery = 'INSERT INTO users (brand, email, username, lastName, u_password) VALUES (?, ?, ?, ?, ?)';
        $addUserStatement = $mysqlConnection->prepare($sqlQuery);
        try {
            $addUserStatement->execute([$username[0] . $lastName[0], $email, $username, $lastName, $password]);
            session_start();
            $_SESSION['connecte'] = 1;
            $_SESSION['user_brand'] = $username[0] . $lastName[0];
            $_SESSION['email'] = $email;
            $_SESSION['is_admin'] = 0;
        } catch (Exception $e) {
            if ($e->getCode() === '23000')
                $error = 'Cette adresse email est déja utilisé sur ce site !';
        }
    } else {
        $error = 'Identifiants incorrects !';
    }
}

require 'elements/header.php';
if (isConnect()) {
    header('Location: ./contact.php');
    exit();
}
?>

<form action="" method="post" class="flex flex-column g-2 register-form">
    <h2>Formulaire d'enregistrement</h2>

    <?php if ($error) : ?>
        <div class="alert alert-danger">
            <?= $error ?>
        </div>
    <?php endif ?>

    <div class="lastName-container">
        <input type="text" name="lastName" placeholder="Nom" class="form-control" id="lastName" value="<?= $lastName ?? '' ?>" autocomplete="off" required>
        <span></span>
    </div>

    <div class="username-container">
        <input type="text" name="username" placeholder="Prénom" class="form-control" id="username" value="<?= $username ?? '' ?>" autocomplete="off" required>
        <span></span>
    </div>

    <div class="email-container">
        <input type="email" name="email" placeholder="Adresse email" class="form-control" id="email" value="<?= $email ?? '' ?>" autocomplete="off" required>
        <span></span>
    </div>

    <div class="password-container">
        <div id="password-container">
            <input type="password" name="password" placeholder="Mot de passe" class="form-control" id="password" value="<?= $_POST['password'] ?? '' ?>" autocomplete="off" required>
            <i class="fas fa-eye-slash" id="view-password"></i>
        </div>
        <span></span>
        <p id="progress-bar"></p>
    </div>

    <button type="submit">Envoyer</button>
    <div>Avez vous déja un compte ? <a href="login.php">Connectez vous</a></div>
</form>


<?php require 'elements/footer.php' ?>