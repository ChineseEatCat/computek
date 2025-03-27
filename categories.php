<?php
include 'header.php';

include 'config/bdd.php';
$categories = $db->query('SELECT * FROM categorie');

?>

<h1>Nos Catégories</h1>
<div class="categories">
    <?php foreach ($categories as $category) : ?>
        <div class="container">
            <img style="width: 64px" src="image/<?= $category['ID'] ?>/<?= $category['IMAGE'] ?>" alt="">
            <a href="produits.php?id=<?= $category['ID'] ?>"><?= $category['LIBELLE'] ?></a>
        </div>
    <?php endforeach; ?>
</div>

<?php
include 'footer.php';
?>