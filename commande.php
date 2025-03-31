<?php
include 'header.php';

//Si le panier est vide alors le marquer en erreur
if (empty($_SESSION['panier'])) {
    echo "<h1>Votre panier est vide</h1>";
    include 'footer.php';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['nom'], $_POST['prenom'], $_POST['adresse'], $_POST['cp'], $_POST['ville'], $_POST['tel'], $_POST['email'], $_POST['card-number'], $_POST['card-name'], $_POST['expiry-date'], $_POST['cvv'])) {
        header('Location: commande.php?msg=Veuillez remplir tous les champs');
        exit;
    } else {
        echo "<script>Swal.fire({
            icon: 'success',
            title: 'Paiement effectué',
            text: 'Votre paiement a été effectué avec succès',
        }).then(function() {
            window.location.href = 'index.php';
        });</script>";
        $_SESSION['panier'] = [];
    }
}
?>

<style>
    .container label {
        display: inline-block;
        margin-bottom: 5px;
        font-weight: bold;
        color: #555;
    }

    .container input,
    .container select {
        width: 90%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 14px;
    }

    .container input:focus,
    .container select:focus {
        border-color: #007bff;
        outline: none;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    .container input[type="submit"] {
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .container input[type="submit"]:hover {
        background-color: #0056b3;
    }

    .nom-prenom {
        display: flex;
        gap: 30px;
    }

    .nom-prenom div {
        flex: 1;
    }

    input:invalid+span::after {
        content: "✖";
        padding-left: 5px;
        color: #8b0000;
    }

    input:valid+span::after {
        content: "✓";
        padding-left: 5px;
        color: #009000;
    }
</style>

<h1>Commande</h1>

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
                            <div style="display: flex; align-items: center;">
                                <img src="<?= $produit['image'] ?>" alt="" style="width: 64px; margin-right: 10px;">
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
            <div>
                <h2>Total</h2>
                <p class="prix"><strong><?= number_format($total + 24.9, 2, ',', ' ') ?> €</strong></p>
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
    </div>
</div>

<br>
<hr>
<br>

<div class="container" style="max-width: 450px; margin: auto;">
    <div>
        <h2>Informations de paiement</h2>
        <p style="color: red"><?= isset($_GET['msg']) ? $_GET['msg'] : "" ?></p>
        <form action="#" method="post">
            <label for="civilite">Civilité :</label>
            <select name="civilite" id="">
                <option value="monsieur">Monsieur</option>
                <option value="madame">Madame</option>
                <option value="chose">Helicoptère de combat</option>
            </select>

            <div class="nom-prenom">
                <div>
                    <label for="nom">Nom :</label>
                    <input type="text" id="nom" name="nom" value="<?= isset($_POST['nom']) ? $_POST['nom'] : "" ?>">
                </div>
                <div>
                    <label for="prenom">Prénom :</label>
                    <input type="text" id="prenom" name="prenom" value="<?= isset($_POST['prenom']) ? $_POST['prenom'] : "" ?>">
                </div>
            </div>

            <label>Adresse :</label>
            <input type="text" name="adresse" value="<?= isset($_POST['adresse']) ? $_POST['adresse'] : "" ?>" required><span class="validity"></span>

            <label>Code postal :</label>
            <input type="text" name="cp" minlength="5" value="<?= isset($_POST['cp']) ? $_POST['cp'] : "" ?>" required><span class="validity"></span>

            <label>Ville :</label>
            <input type="text" name="ville" value="<?= isset($_POST['ville']) ? $_POST['ville'] : "" ?>" required><span class="validity"></span>

            <label>Téléphone :</label>
            <input type="tel" id="tel" name="tel" maxlength="14" pattern="[0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2}" value="<?= isset($_POST['tel']) ? $_POST['tel'] : "" ?>" required><span class="validity"></span>

            <label>E-mail :</label>
            <input type="email" name="email" value="<?= isset($_POST['email']) ? $_POST['email'] : "" ?>" required><span class="validity"></span>

            <hr>

            <label for="card-number">Numéro de carte bancaire :</label>
            <input type="text" id="card-number" name="card-number" placeholder="1234 5678 9012 3456" maxlength="19" pattern="[0-9]{4} [0-9]{4} [0-9]{4} [0-9]{4}" required><span class="validity"></span>

            <label for="card-name">Nom sur la carte :</label>
            <input type="text" id="card-name" name="card-name" placeholder="Nom du titulaire" value="<?= isset($_POST['card-name']) ? $_POST['card-name'] : "" ?>">

            <label for="expiry-date">Date d'expiration :</label>
            <input type="text" id="expiry-date" name="expiry-date" placeholder="MM/AA" maxlength="5" pattern="[0-12]{2}/[0-9]{2}" required><span class="validity"></span>

            <label for="cvv">CVV :</label>
            <input type="text" id="cvv" name="cvv" placeholder="123" maxlength="3" required><span class="validity"></span>

            <input type="submit" value="Payer">
        </form>
    </div>
</div>

<script>
    // Formatage automatique pour le numéro de téléphone
    document.getElementById('tel').addEventListener('input', function (e) {
        let value = e.target.value.replace(/\D/g, ''); // Supprime tout sauf les chiffres
        value = value.replace(/(\d{2})(?=\d)/g, '$1 '); // Ajoute un espace tous les 2 chiffres
        e.target.value = value.trim();
    });

    // Formatage automatique pour le numéro de carte bancaire
    document.getElementById('card-number').addEventListener('input', function (e) {
        let value = e.target.value.replace(/\D/g, ''); // Supprime tout sauf les chiffres
        value = value.replace(/(\d{4})(?=\d)/g, '$1 '); // Ajoute un espace tous les 4 chiffres
        e.target.value = value.trim();
    });

    // Formatage automatique pour la date d'expiration
    document.getElementById('expiry-date').addEventListener('input', function (e) {
        let value = e.target.value.replace(/\D/g, ''); // Supprime tout sauf les chiffres
        if (value.length > 2) {
            value = value.slice(0, 2) + '/' + value.slice(2); // Ajoute un "/" après les 2 premiers chiffres
        }
        e.target.value = value;
    });
</script>
<?php
include 'footer.php';
?>