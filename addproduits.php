<?php
include 'header.php';

include 'config/bdd.php';

var_dump($_POST);
if(!empty($_POST['MARQUE']) || !empty($_POST['MODEL']) || !empty($_POST['PRIX']) || !empty($_POST['IMAGE']) || !empty($_POST['CARACTERISTIQUES']) || !empty($_POST['ID_CATEGORIE'])){
    //Faire un tableau pour les caractéristiques
    $caracteristiques = preg_split('/[\s,]+/', trim($_POST['CARACTERISTIQUES']));
    //$caracteristiques = json_encode($caracteristiques);
    var_dump($caracteristiques);

    if (!empty($_FILES['IMAGE']['name'])) {
        $uploadDir = 'image/'.$_POST['ID_CATEGORIE'].'/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
    
        $chemin_destination = $uploadDir . basename($_FILES['IMAGE']);
        if (move_uploaded_file($_FILES['IMAGE'], $chemin_destination)) {
            echo '<script type="text/javascript">alert("Fichier téléchargé avec succès")</script>';
        } else {
            echo '<script type="text/javascript">alert("Erreur sur la copie du fichier")</script>';
        }
    }else{
        echo "erreur fichier";
    }
}

//$produits = $db->exec('INSERT INTO produits (MARQUE, MODEL, PRIX, IMAGE, CARACTERISTIQUES, ID_CATEGORIE) VALUES ("'.$_POST['MARQUER'].'", "'.$_POST['MODEL'].'", "'.$_POST['PRIX'].'", "'.$_POST['IMAGE'].'", "'.$_POST['CARACTERISTIQUES'].'", "'.$_POST['ID_CATEGORIE'].'")');

?>

<h1>Produit ajouté</h1>
<div class="categories">
    <div class="container">
        <form action="" method="post" enctype="multipart/form-data">
            <?php 
            if(empty($_POST['MARQUE']) || empty($_POST['MODEL']) || empty($_POST['PRIX']) || empty($_POST['IMAGE']) || empty($_POST['CARACTERISTIQUES']) || empty($_POST['ID_CATEGORIE'])){
                echo '<p style="color: red">Veuillez remplir tous les champs</p>';
            }
            ?>
            <label for="MARQUE">Marque du produit :</label><br>
            <input type="text" name="MARQUE" placeholder="Nom du produit" value="<?php if(isset($_POST['MARQUE'])) { echo $_POST['MARQUE']; } ?>"><br>

            <label for="MODEL">Modèle du produit :</label><br>
            <input type="text" name="MODEL" placeholder="Modèle du produit" value="<?php if(isset($_POST['MODEL'])) { echo $_POST['MODEL']; } ?>"><br>

            <label for="PRIX">Prix du produit :</label><br>
            <input type="number" step="0.01" name="PRIX" placeholder="Prix du produit" value="<?php if(isset($_POST['PRIX'])) { echo $_POST['PRIX']; } ?>"><br>

            <label for="IMAGE">Image du produit :</label><br>
            <input type="file" name="IMAGE[]" id="file" accept="image/*" placeholder="Image du produit"><br>

            <label for="CARACTERISTIQUES">Caractéristiques du produit :</label><br>
            <textarea style="min-height: 20vh; min-width: 30vh" type="text" name="CARACTERISTIQUES" placeholder="Caractéristiques, 
du,
produit" value="<?php if(isset($_POST['CARACTERISTIQUES'])) { echo $_POST['CARACTERISTIQUES']; } ?>"></textarea><br>

            <label for="ID_CATEGORIE">Catégorie du produit :</label><br>
            <?php 
                $categories = $db->query('SELECT * FROM categorie');
                echo '<select name="ID_CATEGORIE">';
                foreach ($categories as $category) {
                    echo '<option value="'.$category['ID'].'">'.$category['LIBELLE'].'</option>';
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