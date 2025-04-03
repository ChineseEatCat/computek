<?php
include 'header.php';

// Vérifier si l'utilisateur est administrateur
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    header('Location: index.php');
    exit;
}

// Récupérer l'ID de la catégorie
$id = $_GET['id'] ?? null;

$stmt = $db->prepare('SELECT * FROM categorie WHERE ID = ?');
$stmt->execute([$id]);
$categorie = $stmt->fetch();

if (!$categorie) {
    header('Location: panel.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mettre à jour la catégorie dans la base de données
    $stmt = $db->prepare('UPDATE categorie SET LIBELLE = ?, IMAGE = ? WHERE ID = ?');
    $image = !empty($_FILES['image']['name']) ? $_FILES['image']['name'] : $categorie['IMAGE'];
    $stmt->execute([
        $_POST['libelle'],
        $image,
        $id
    ]);

    // Gestion de l'image si elle est modifiée
    if (!empty($_FILES['image']['name'])) {
        $uploadDir = 'image/'.$id.'/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $chemin_destination = $uploadDir . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $chemin_destination);
    }

    echo "<script>Swal.fire({
        icon: 'success',
        title: 'Catégorie modifiée',
        text: 'La catégorie a été modifiée avec succès.',
    }).then(function() {
        window.location.href = 'panel.php';
    });</script>";
}
?>

<h1>Modifier la catégorie</h1>
<div class="categories" style="max-width: 60%;">
    <div class="produits">
        <img style="width:300px; height:100%" src="image/<?= $categorie['ID'].'/'.$categorie['IMAGE'] ?>" alt="">
        <div>
            <form action="#" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $categorie['ID'] ?>">

                <label for="libelle">Nom de la catégorie:</label>
                <input type="text" name="libelle" id="libelle" value="<?= htmlspecialchars($categorie['LIBELLE']) ?>" required><br>

                <label for="image">Image:</label>
                <input type="file" name="image" id="image" required><br>

                <button type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>