<?php
if (!isset($_SESSION['user']) || empty($_SESSION['user']) || $_SESSION['user']['role'] != "admin") {
    header('Location: connexion.php');
}
?>