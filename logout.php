<?php
$title = 'Page de déconnexion';
session_start();
$_SESSION = [];
header('Location: login.php');
