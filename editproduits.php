<?php
include 'header.php';

//Vérifier si il est administrateur
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    header('Location: index.php');
    exit;
}

$id = $_GET['id'] ?? null;

$stmt = $db->prepare('SELECT * FROM produits WHERE ID = ?');
$stmt->execute([$id]);
$produit = $stmt->fetch();

if (!$produit) {
    header('Location: index.php');
    exit;
}

// Convertir les caractéristiques JSON en texte modifiable
$caracteristiques = json_decode($produit['DESCRIPTION'], true);
$caracteristiques_text = '';
if (!empty($caracteristiques)) {
    foreach ($caracteristiques as $key => $value) {
        $caracteristiques_text .= $key . ': ' . $value . ",\n";
    }
    $caracteristiques_text = rtrim($caracteristiques_text, ', '); // Supprimer la dernière virgule
}

$categories = $db->prepare('SELECT * FROM categorie');
$categories->execute();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Convertir les caractéristiques texte en JSON
    $caracteristiques = array_filter(explode(',', trim($_POST['description'])), function ($value) {
        return strpos($value, ':') !== false; // Garde uniquement les paires clé-valeur
    });

    foreach ($caracteristiques as $caracteristique) {
        list($key, $value) = array_map('trim', explode(':', $caracteristique, 2));
        $caracteristiques_array[$key] = $value;
    }

    $caracteristiques_json = json_encode($caracteristiques_array, JSON_UNESCAPED_UNICODE);

    // Mettre à jour le produit dans la base de données
    $stmt = $db->prepare('UPDATE produits SET MARQUE = ?, MODEL = ?, PRIX = ?, IMAGE = ?, DESCRIPTION = ?, ID_CATEGORIE = ? WHERE ID = ?');
    $image = !empty($_FILES['image']['name']) ? $_FILES['image']['name'] : $produit['IMAGE'];
    $stmt->execute([
        $_POST['marque'],
        $_POST['model'],
        $_POST['prix'],
        $image,
        $caracteristiques_json,
        $_POST['id_categorie'],
        $id
    ]);

    // Gestion de l'image si elle est modifiée
    if (!empty($_FILES['image']['name'])) {
        $uploadDir = 'image/' . $_POST['id_categorie'] . '/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $chemin_destination = $uploadDir . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $chemin_destination);
    }

    echo "<script>Swal.fire({
        icon: 'success',
        title: 'Produit modifié',
        text: 'Le produit a été modifié avec succès.',
    }).then(function() {
        window.location.href = 'produits.php?id=" . $_POST['id_categorie'] . "';
    });</script>";
}
?>

<h1>Modifier le produit</h1>
<div class="categories" style="max-width: 60%";>
    <div class="produits">
        <img style="width:300px; height:100%" src="<?= $produit['IMAGE'] ?>" alt="">
        <div>
            <form action="#" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $produit['ID'] ?>">
                <label for="marque">Marque:</label>
                <input type="text" name="marque" id="marque" value="<?= htmlspecialchars($produit['MARQUE']) ?>" required><br>

                <label for="model">Modèle:</label>
                <input type="text" name="model" id="model" value="<?= htmlspecialchars($produit['MODEL']) ?>" required><br>

                <label for="prix">Prix:</label>
                <input type="number" step="0.01" name="prix" id="prix" placeholder="Prix du produit" value="<?= htmlspecialchars($produit['PRIX']) ?>" required> <span>€</span><br>

                <label for="image">Image:</label>
                <input type="file" name="image" id="image"><br>

                <label for="description">Caractéristiques (format: clé: valeur, clé: valeur):</label><br>
                <textarea name="description" id="description" style="min-height: 20vh; min-width: 30vh"><?= htmlspecialchars($caracteristiques_text) ?></textarea><br>

                <label for="id_categorie">Catégorie:</label>
                <select name="id_categorie" id="id_categorie">
                    <?php foreach ($categories as $category) : ?>
                        <option value="<?= $category['ID'] ?>" <?= $category['ID'] == $produit['ID_CATEGORIE'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($category['LIBELLE']) ?>
                        </option>
                    <?php endforeach; ?>
                </select><br>
                
                <button type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>