<?php
include 'header.php';

$sql = 'SELECT * FROM categorie';
$stmt = $db->prepare($sql);
$stmt->execute();

?>

<h1>Nos Catégories</h1>
<div class="categories">
    <?php foreach ($stmt as $category) : ?>
        <div class="container">
            <img style="width: 64px" src="image/<?= $category['ID'] ?>/<?= $category['IMAGE'] ?>" alt="">
            <a href="produits.php?id=<?= $category['ID'] ?>"><?= $category['LIBELLE'] ?></a>
        </div>
    <?php endforeach; ?>
</div>

<?php
include 'footer.php';
?>