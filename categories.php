<?php
include 'header.php';

include 'config/bdd.php';
$categories = $db->query('SELECT * FROM categorie');

?>

<h1>Nos Produits</h1>
<?php
if (isset($_SESSION['user']['role']) && $_SESSION['user']['role'] == 'admin') {
    echo '<a href="addcategories.php">Ajouter une catégorie</a><br>';
    echo '<a href="addproduits.php">Ajouter un produit</a>';
}
?>
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