<?php
include 'header.php';

include 'testadmin.php';

//Vérification des champs
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['category_name']) && isset($_FILES['category_image'])) {

    $stmt = $db->prepare('INSERT INTO categorie (libelle, image) VALUES (:category_name, :category_image)');
    $stmt->bindParam(':category_name', $_POST['category_name']);
    $stmt->bindParam(':category_image', $_FILES['category_image']['name']);
    $stmt->execute();

    if (!empty($_FILES['category_image']['name'])) {
        //image/$id/ recuperer l'id de la base de donnée
        $uploadDir = 'image/' . $db->lastInsertId() . '/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $chemin_destination = $uploadDir . basename($_FILES['category_image']['name']);
        try {
            $data = move_uploaded_file($_FILES['category_image']['tmp_name'], $chemin_destination);
            echo "<script>Swal.fire({
                icon: 'success',
                title: 'Création effectuée',
                text: 'Catégorie ajoutée avec succès',
            }).then(function() {
                window.location.href = 'categories.php';
            });</script>";
        } catch (Exception $e) {
            echo `<script type="text/javascript">Swal.fire({title: "Création catégorie" text: "Erreur : Copie du fichier ` . $e . `", icon: 'error', confirmButtonText: 'OK'}).then(function () {window.location.href = '#';});</script>`;
        }
    } else {
        echo "<script>Swal.fire({
            icon: 'error',
            title: 'Création catégorie',
            text: 'Erreur : Fichier vide',
        }).then(function() {
            window.location.href = '#';
        });</script>";
    }
}
?>

<style>
    /* Bouton */
    button[type="submit"] {
        max-width: 90%;
        padding: 10px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button[type="submit"]:hover {
        background-color: #0056b3;
    }
</style>

<h1>Ajouter Catégorie</h1>
<div class="categories">
    <div class="container">
        <form action="addcategories.php" method="post" enctype="multipart/form-data">
            <?php
            if (empty($_POST['MARQUE']) || empty($_POST['MODEL']) || empty($_POST['PRIX']) || empty($_POST['IMAGE']) || empty($_POST['CARACTERISTIQUES']) || empty($_POST['ID_CATEGORIE'])) {
                echo '<p style="color: red">Veuillez remplir tous les champs</p>';
            }
            ?>
            <div>
                <label for="category_name">Nom de la catégorie :</label>
                <input type="text" id="category_name" name="category_name" required>
            </div>
            <div>
                <label for="category_image">Image de la catégorie :</label>
                <input type="file" id="category_image" name="category_image" accept="image/*" required>
            </div>
            <div>
                <button type="submit">Ajouter la catégorie</button>
            </div>
        </form>
    </div>
</div>

<?php
include 'footer.php';
?>