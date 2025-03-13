<?php
include 'header.php';

include 'config/bdd.php';
$categories = $db->query('SELECT * FROM categorie');

?>

<h1>Nos Produits</h1>
<a href="addcategories.php">Ajouter une catégorie</a>
<div class="categories">
    <?php $i = 1; ?>
    <?php foreach ($categories as $category) : ?>
        <div class="container">
            <img src="<?= $category['IMAGE'] ?>" alt="">
            <a href="produits.php?id=<?= $i ?>"><?= $category['LIBELLE'] ?></a>
        </div>
        <?php $i++; ?>
    <?php endforeach; ?>
    <!-- <div class="container">
        <img src="https://picsum.photos/64/64" alt="">
        <a href="produits.php">Ordinateur Fixe & Portable</a>
    </div>

    <div class="container">
        <img src="https://picsum.photos/64/64" alt="">
        <a href="produits.php">Carte graphiques</a>
    </div>-->
</div>

<?php
include 'footer.php';
?>