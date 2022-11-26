<footer>
    <div class="flex agency-infos">
        <div>
            <h2><?= $infos['a_name'] ?></h2>
            <div class="flex flex-column">
                <span> <i class="fa-solid fa-envelope"></i>Email : <?= $infos['a_email'] ?></span>
                <span> <i class="fa-solid fa-mobile"></i>Téléphone : <?= $infos['a_telephoneNumber'] ?></span>
            </div>
        </div>
        <div>
            <h2>Nos Agences</h2>
            <ul>
                <li><i class="fa-solid fa-chevron-right"></i><?= $infos['a_location'] ?></li>
                <li><i class="fa-solid fa-chevron-right"></i>Abomey-Calavi</li>
            </ul>
        </div>
    </div>
    
    <div class="flex flex-column g-1 justify-between align-center">
        <ul class="social-links flex align-center justify-center g-1">
            <li><a href="<?= $infos['a_facebook'] ?>" target="_blank"><i class="fa-brands fa-facebook"></i></a></li>
            <li><a href="<?= $infos['a_linkedin'] ?>" target="_blank"><i class="fa-brands fa-linkedin"></i></a></li>
            <li><a href="<?= $infos['a_instagram'] ?>" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
            <li><a href="<?= $infos['a_twitter'] ?>" target="_blank"><i class="fa-brands fa-twitter"></i></a></li>
            <li><a href="https://wa.me/00229<?= $infos['a_telephoneNumber'] ?>" target="_blank"><i class="fa-brands fa-whatsapp"></i></a></li>
        </ul>
        <p>Avec nous, votre rêve prend <em>forme</em></p>
    </div>
</footer>

<script src="./js/index.js"></script>

</body>

</html>