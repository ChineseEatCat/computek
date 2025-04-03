<?php
include 'header.php';

$sql_categorie = 'SELECT * FROM categoerie WHERE ID=:ID';
$stmt = $db->prepare($sql_categorie);
$stmt->execute([':id' => $_GET['id']]);


$sql_produit = 'SELECT * FROM produits WHERE ID_CATEGORIE=:ID';
$stmt = $db->prepare($sql_produit);
$stmt->execute([':id' => $_GET['id']]);

foreach ($categories as $category) {
    if ($category['ID'] == $_GET['id']) {
        $category = $category['LIBELLE'];
    }
}

?>
<h1><?= isset($category) ? $category : "Produits non trouvés" ?></h1>
<div class="categories" style="max-width: 60%;">
    <?php
    $found = false;
    foreach ($produits as $k => $produit) :
        $found = true; ?>
        <div class="produits">
            <img style="width:300px; height:100%" src="<?= $produit['IMAGE'] ?>" alt="">
            <div>
                <p><?= $produit['MARQUE'] . " " . $produit['MODEL'] ?></p>
                <div class="caracteristiques">
                    <ul>
                        <?php
                        $caracteristiques = json_decode($produit['DESCRIPTION'], true); // Décodage en tableau associatif
                        if (!empty($caracteristiques)) {
                            foreach ($caracteristiques as $key => $value) : ?>
                                <li><strong><?= htmlspecialchars($key) ?>:</strong> <?= htmlspecialchars($value) ?></li>
                            <?php endforeach;
                        } else { ?>
                            <li>Aucune caractéristique disponible</li>
                        <?php } ?>
                    </ul>
                </div>
                <p><?= $produit['PRIX'] ?>€</p>
                <form action="panier.php" method="post">
                    <input type="hidden" name="id" value="<?= $produit['ID'] ?>">
                    <input type="hidden" name="marque" value="<?= htmlspecialchars($produit['MARQUE']) ?>">
                    <input type="hidden" name="model" value="<?= htmlspecialchars($produit['MODEL']) ?>">
                    <input type="hidden" name="prix" value="<?= $produit['PRIX'] ?>">
                    <input type="hidden" name="image" value="<?= $produit['IMAGE'] ?>">
                    <button type="submit" class="cart"><span><i class="bi bi-cart"></i></span> Ajouter au panier</button>
                </form>
                <?php if (isset($_SESSION['user']) && !empty($_SESSION['user']) && $_SESSION['user']['role'] == "admin") : ?>
                    <a href="editproduits?id=<?= $produit['ID'] ?>" class="modifier">Modifier</a>
                    <a href="delproduits?id=<?= $produit['ID'] ?>" class="supprimer">Supprimer</a>
                    <!--<button class="cart"><span><i class="bi bi-cart"></i></span> Ajouter au panier</button>-->
                <?php endif; ?>
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