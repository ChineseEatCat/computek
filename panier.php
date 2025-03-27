<?php
include 'header.php';
//session_start(); // Activer les sessions
// Vérifier si le panier existe, sinon le créer
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

// Vérifier si l'utilisateur a cliqué sur "Vider le panier"
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['panier']) && $_POST['panier'] === 'vider') {
    // Vider le panier
    $_SESSION['panier'] = [];
    // Rediriger pour éviter de renvoyer le formulaire en cas de rafraîchissement
    header('Location: panier.php');
    exit;
}

// Vérifier si les données du produit sont envoyées
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['marque'], $_POST['model'], $_POST['prix'], $_POST['image'])) {
    $produit = [
        'id' => $_POST['id'],
        'marque' => $_POST['marque'],
        'model' => $_POST['model'],
        'prix' => $_POST['prix'],
        'image' => $_POST['image'],
        'quantite' => 1 // Par défaut, ajouter une quantité de 1
    ];

    // Vérifier si le produit est déjà dans le panier
    $existe = false;
    foreach ($_SESSION['panier'] as &$item) {
        if ($item['id'] == $produit['id']) {
            $item['quantite']++; // Incrémenter la quantité
            $existe = true;
            break;
        }
    }

    // Si le produit n'est pas encore dans le panier, l'ajouter
    if (!$existe) {
        $_SESSION['panier'][] = $produit;
    }

    // Rediriger vers la page précédente
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

?>

<h1>Mon Panier</h1>
<div class="liste-panier">
    <div class="panier">
        <table>
            <thead>
                <tr>
                    <th class="produit">
                        <p>Produit</p>
                    </th>
                    <th>
                        <p>Quantité</p>
                    </th>
                    <th>
                        <p>Prix unitaire</p>
                    </th>
                    <th>
                        <p>Total intermédiaire</p>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                foreach ($_SESSION['panier'] as $produit) :
                    $total_intermediaire = $produit['prix'] * $produit['quantite'];
                    $total += $total_intermediaire;
                ?>
                    <tr>
                        <td class="produit">
                            <div style="display: flex;">
                                <img src="<?= $produit['image'] ?>" alt="" style="width: 64px;">
                                <p><?= $produit['marque'] . " " . $produit['model'] ?></p>
                            </div>
                        </td>
                        <td class="quantite"><?= $produit['quantite'] ?></td>
                        <td class="prix-unitaire"><?= number_format($produit['prix'], 2, ',', ' ') ?> €</td>
                        <td class="total-intermediaire"><?= number_format($total_intermediaire, 2, ',', ' ') ?> €</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="resultat">
        <div class="resume">
            <h2>Résumé</h2>
            <div>
                <p>Total intermédiaire</p>
                <p class="prix"><?= number_format($total, 2, ',', ' ') ?> €</p>
            </div>
            <div>
                <p>Frais de livraison</p>
                <p class="prix">24,90 €</p>
            </div>
        </div>
        <div class="total">
            <hr>
            <div>
                <h2>Total</h2>
                <p class="prix"><strong> <?= number_format($total + 24.9, 2, ',', ' ') ?> €</strong></p>
            </div>
            <div>
                <p>Total hors TVA</p>
                <p class="prix"><?= number_format($total - ($total * 0.2), 2, ',', ' ') ?> €</p>
            </div>
            <div>
                <p>20% TVA inclus</p>
                <p class="prix"><?= number_format($total * 0.2, 2, ',', ' ') ?> €</p>
            </div>
        </div>
        <a href="commande.php" class="cart"><span><i class="bi bi-cart"></i></span> Valider mon panier</a>
        <form action="panier.php" method="post" style="margin: 25px 0;">
            <input type="hidden" name="panier" value="vider">
            <button type="submit" class="cart" style="background-color: red; color: white;">
                <span><i class="bi bi-trash"></i></span> Vider le panier
            </button>
        </form>
    </div>
</div>

<?php
include 'footer.php';
?>