<?php
include 'header.php';

//Vérifier si il est administrateur
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    header('Location: index.php');
    exit;
}

$id = $_GET['id'] ?? null;

// Vérifier si un ID est fourni
if (!$id) {
    header('Location: index.php');
    exit;
}

// Vérifier si le produit existe
$stmt = $db->prepare('SELECT * FROM produits WHERE ID = ?');
$stmt->execute([$id]);
$produit = $stmt->fetch();

if (!$produit) {
    header('Location: index.php');
    exit;
}

// Supprimer l'image associée au produit
if (!empty($produit['IMAGE']) && file_exists($produit['IMAGE'])) {
    unlink($produit['IMAGE']);
}

// Supprimer le produit de la base de données
$stmt = $db->prepare('DELETE FROM produits WHERE ID = ?');
$stmt->execute([$id]);

// Rediriger après suppression
echo "<script>Swal.fire({
    icon: 'success',
    title: 'Produit supprimé',
    text: 'Le produit a été supprimé avec succès.',
}).then(function() {
    window.history.back();
});</script>";
?>