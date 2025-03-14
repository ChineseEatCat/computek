<?php
include 'header.php';

//Vérification des champs
if(empty($_POST['category_name']) || empty($_FILES['category_image']['name'])){
    echo '<p style="color: red">Veuillez remplir tous les champs</p>';
}else{

    //Connexion à la base de données
    $db = new PDO('mysql:host=localhost;dbname=computek', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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
        try{
            $data = move_uploaded_file($_FILES['category_image']['tmp_name'], $chemin_destination);
        }catch(Exception $e){
            echo '<script type="text/javascript">alert("Erreur sur la copie du fichier : '.$e.'")</script>';
        }
    }else{
        echo "erreur fichier";
    }

    var_dump($_POST);
    var_dump($_FILES);
}

?>

<body>
    <h1>Ajouter Catégorie</h1>
    <form action="addcategories.php" method="post" enctype="multipart/form-data">
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
</body>

</html>