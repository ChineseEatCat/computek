<?php
include 'header.php';

include 'testadmin.php';

if (!empty($_POST['MARQUE']) || !empty($_POST['MODEL']) || !empty($_POST['PRIX']) || !empty($_POST['IMAGE']) || !empty($_POST['CARACTERISTIQUES']) || !empty($_POST['ID_CATEGORIE'])) {
    // Faire un tableau pour les caractéristiques
    $caracteristiques = array_filter(explode(',', trim($_POST['CARACTERISTIQUES'])), function ($value) {
        return strpos($value, ':') !== false; // Garde uniquement les paires clé-valeur
    });

    $caracteristiques_assoc = [];
    foreach ($caracteristiques as $caracteristique) {
        list($key, $value) = array_map('trim', explode(':', $caracteristique, 2)); // Sépare clé et valeur
        $caracteristiques_assoc[$key] = $value; // Ajoute au tableau associatif
    }

    $caracteristiques_json = json_encode($caracteristiques_assoc, JSON_UNESCAPED_UNICODE);

    // Debugging pour vérifier le JSON généré
    //var_dump($caracteristiques_json);

    // Insérer le produit dans la base de données
    $stmt = $db->prepare('INSERT INTO produits (MARQUE, MODEL, PRIX, IMAGE, DESCRIPTION, ID_CATEGORIE) VALUES (:marque, :model, :prix, :image, :caracteristiques, :id_categorie)');
    $stmt->bindParam(':marque', $_POST['MARQUE']);
    $stmt->bindParam(':model', $_POST['MODEL']);
    $stmt->bindParam(':prix', $_POST['PRIX']);
    $stmt->bindParam(':image', $_FILES['IMAGE']['name']); // Nom du fichier temporairement
    $stmt->bindParam(':caracteristiques', $caracteristiques_json);
    $stmt->bindParam(':id_categorie', $_POST['ID_CATEGORIE']);
    $stmt->execute();

    // Récupérer l'ID du produit inséré
    $lastInsertId = $db->lastInsertId();

    // Gestion de l'image
    if (!empty($_FILES['IMAGE']['name'])) {
        // Créer le répertoire pour l'image : image/<id_categorie>/<marque_model>/
        $marque_model = $_POST['MARQUE'] . ' ' . $_POST['MODEL'] . '.png';
        $marque_model = str_replace('|', '', $marque_model);
        $uploadDir = 'image/' . $_POST['ID_CATEGORIE'] . '/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $chemin_destination = $uploadDir . basename($marque_model);
        if (move_uploaded_file($_FILES['IMAGE']['tmp_name'], $chemin_destination)) {
            // Mettre à jour la colonne IMAGE avec le chemin final
            $stmt = $db->prepare('UPDATE produits SET IMAGE = :image WHERE ID = :id');
            $stmt->bindParam(':image', $chemin_destination);
            $stmt->bindParam(':id', $lastInsertId);
            $stmt->execute();

            echo "<script>Swal.fire({
                icon: 'success',
                title: 'Produit ajouté',
                text: 'Le produit a été ajouté avec succès.',
            }).then(function() {
                window.location.href = 'produits.php?id=" . $_POST['ID_CATEGORIE'] . "';
            });</script>";
        } else {
            echo "<script>Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: 'Erreur lors du téléchargement de l\'image.',
            });</script>";
        }
    } else {
        echo "<script>Swal.fire({
            icon: 'error',
            title: 'Erreur',
            text: 'Erreur : Fichier vide',
        }).then(function() {
            window.location.href = '#';
        });</script>";
    }
}

//$produits = $db->exec('INSERT INTO produits (MARQUE, MODEL, PRIX, IMAGE, CARACTERISTIQUES, ID_CATEGORIE) VALUES ("'.$_POST['MARQUER'].'", "'.$_POST['MODEL'].'", "'.$_POST['PRIX'].'", "'.$_POST['IMAGE'].'", "'.$_POST['CARACTERISTIQUES'].'", "'.$_POST['ID_CATEGORIE'].'")');

?>

<h1>Ajouter un Produit</h1>
<div class="categories">
    <div class="container">
        <form action="" method="post" enctype="multipart/form-data">
            <?php
            if (empty($_POST['MARQUE']) || empty($_POST['MODEL']) || empty($_POST['PRIX']) || empty($_POST['IMAGE']) || empty($_POST['CARACTERISTIQUES']) || empty($_POST['ID_CATEGORIE'])) {
                echo '<p style="color: red">Veuillez remplir tous les champs</p>';
            }
            ?>
            <label for="MARQUE">Marque du produit :</label><br>
            <input type="text" name="MARQUE" placeholder="Nom du produit" value="<?php if (isset($_POST['MARQUE'])) {
                                                                                        echo $_POST['MARQUE'];
                                                                                    } ?>"><br>

            <label for="MODEL">Modèle du produit :</label><br>
            <input type="text" name="MODEL" placeholder="Modèle du produit" value="<?php if (isset($_POST['MODEL'])) {
                                                                                        echo $_POST['MODEL'];
                                                                                    } ?>"><br>

            <label for="PRIX">Prix du produit :</label><br>
            <input type="number" step="0.01" name="PRIX" placeholder="Prix du produit" value="<?php if (isset($_POST['PRIX'])) {
                                                                                                    echo $_POST['PRIX'];
                                                                                                } ?>"><br>

            <label for="IMAGE">Image du produit :</label><br>
            <input type="file" id="IMAGE" name="IMAGE" accept="image/*" placeholder="Image du produit"><br>

            <label for="CARACTERISTIQUES">Caractéristiques du produit :</label><br>
            <textarea style="min-height: 20vh; min-width: 30vh" type="text" name="CARACTERISTIQUES" placeholder="Caractéristiques: données, 
du: données,
produit: données" value="<?php if (isset($_POST['CARACTERISTIQUES'])) {
                                echo $_POST['CARACTERISTIQUES'];
                            } ?>"></textarea><br>

            <label for="ID_CATEGORIE">Catégorie du produit :</label><br>
            <?php
            $categories = $db->query('SELECT * FROM categorie');
            echo '<select name="ID_CATEGORIE">';
            foreach ($categories as $category) {
                echo '<option value="' . $category['ID'] . '">' . $category['LIBELLE'] . '</option>';
            }
            ?>
            <br>
            <br>
            <input style="width: max-content !important" type="submit" value="Ajouter le produit">
        </form>
    </div>
</div>

<?php
include 'footer.php';
?>