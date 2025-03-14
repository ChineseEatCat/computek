<?php
include 'header.php';

include 'config/bdd.php';
$categories = $db->query('SELECT * FROM categorie WHERE ID ='. $_GET['id']);
$produits = $db->query('SELECT * FROM produits WHERE ID_CATEGORIE ='. $_GET['id']);

foreach ($categories as $category){
    if ($category['ID'] == $_GET['id']) {
        $category = $category['LIBELLE'];
    }
}

?>
<h1><?= isset($category) ? $category : "Produits non trouvés"?></h1>
<div class="categories" style="max-width: 60%;">
    <?php
    $found = false;
    foreach ($produits as $k => $produit) :
        $found = true; ?>
        <div class="produits">
            <img src="<?= $produit['IMAGE'] ?>" alt="">
            <div>
                <p><?= $produit['MARQUE'] . " " . $produit['MODEL'] ?></p>
                <div class="caracteristiques">
                    <ul>
                        <?php
                        foreach (json_decode($produit['DESCRIPTION']) as $caracteristique) : ?>
                            <li><?= $caracteristique ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <p><?= $produit['PRIX'] ?>€</p>
                <button class="cart"><span><i class="bi bi-cart"></i></span> Ajouter au panier</button>
            </div>
        </div>
    <?php endforeach;
    if (!$found) : ?>
        <p>Produits non trouvés</p>
    <?php endif; ?>
</div>

<?php
include 'footer.php';
?>