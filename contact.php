<?php
session_start();
require 'functions/auth.php';
forceUserToConnect();
$title = 'Contact';
require 'elements/header.php';
if (count($_POST) !== 0) {
    require __DIR__ . DIRECTORY_SEPARATOR . 'functions' . DIRECTORY_SEPARATOR . 'connectToDatabase.php';
    $sqlQuery = 'SELECT id FROM users WHERE email = ?';
    $contactStatement = $mysqlConnection->prepare($sqlQuery);
    $contactStatement->execute([$_SESSION['email']]);
    $contact = $contactStatement->fetch();

    $sqlQuery = 'INSERT INTO `messages`(m_subject, u_id, created_at, u_message) VALUES (?, ?, ?, ?)';
    $messageStatement = $mysqlConnection->prepare($sqlQuery);
    $messageStatement->execute([$_POST['subject'], $contact['id'], date('Y-m-d h:i:s'), $_POST['message']]);
    $message = $messageStatement->fetchAll();
}

echo "<pre>";
print_r($_SESSION);
echo "</pre>";
?>
<h2>Nous contacter</h2>

<main class="flex g-5 contacts">
    <div class="w-50">
        <div class="form-contact">
            <form action="" method="post" class="flex flex-column g-2">
                <h2>Formulaire de contact</h2>
                <div>
                    <input type="text" name="subject" placeholder="Sujet" class="form-control" required>
                </div>
                <div>
                    <textarea name="message" placeholder="Message" class="form-control" required></textarea>
                </div>

                <button type="submit">Envoyer</button>
            </form>
        </div>
    </div>
    <div class="w-50 flex flex-column g-2">
        <div class="flex flex-column">
            <h2>Dire bonjour</h2>
            <span> <i class="fa-solid fa-envelope"></i>Email : benin-immo@gmail.com</span>
            <span> <i class="fa-solid fa-mobile"></i>Téléphone : .........</span>
        </div>
        <div>
            <h2>Nous retrouver</h2>
            <ul>
                <li><i class="fa-solid fa-chevron-right"></i>Cotonou</li>
                <li><i class="fa-solid fa-chevron-right"></i>Abomey-Calavi</li>
            </ul>
        </div>
        <div>
            <h2>Réseaux sociaux</h2>
            <ul class="flex align-center g-1">
                <li><a href="<?= $infos['a_facebook'] ?>" target="_blank"><i class="fa-brands fa-facebook"></i></a></li>
                <li><a href="<?= $infos['a_linkedin'] ?>" target="_blank"><i class="fa-brands fa-linkedin"></i></a></li>
                <li><a href="<?= $infos['a_instagram'] ?>" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
                <li><a href="<?= $infos['a_twitter'] ?>" target="_blank"><i class="fa-brands fa-twitter"></i></a></li>
            </ul>
        </div>
    </div>
</main>

<main class="flex flex-column g-1">
    <h2>Prendre rendez-vous</h2>
    <p>Vous pouvez nous envoyer un message un message direct par notre canal Whatsapp pour avoir une discussion beaucoup plus classique et plus directe avec nous. Cliquez sur ce bouton si c'est ce que vous souhaitez. </p>
    <?php
    $sqlQuery = 'SELECT username, lastName FROM users WHERE email = ?';
    $userStatement = $mysqlConnection->prepare($sqlQuery);
    $userStatement->execute([$_SESSION['email']]);
    $user = $userStatement->fetch();
    ?>
    <div><a class="button-whatsapp" href="https://wa.me/00229<?= $infos['a_telephoneNumber'] ?>?text=Je suis <?= $user['username'] . ' ' . $user['lastName'] ?>. Je vous contacte depuis votre site immobilier." target="_blank"><i class="fa-brands fa-whatsapp"></i>Whatsapp</a></div>

</main>

<?php require 'elements/footer.php' ?>