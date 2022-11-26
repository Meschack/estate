<?php

function nav_link(string $link, string $item): string
{
    $classe = '';
    if (strpos($_SERVER['SCRIPT_NAME'], $link)) {
        $classe = 'active-link';
    }
    return <<<HTML
    <li><a class="$classe" href="$link">$item</a></li>
HTML;
}

function nav_menu(): string
{
    return
        nav_link('index.php', 'Accueil') .
        nav_link('catalogue.php', 'Catalogue') .
        nav_link('about.php', 'A Propos') .
        nav_link('contact.php', 'Contacts');
}
