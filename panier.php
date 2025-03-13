<?php
include 'header.php';
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
                <tr>
                    <td class="produit">
                        <div style="display: flex;">
                            <img src="https://picsum.photos/64/64" alt="">
                            <p>PC GAMER | AMD Ryzen 5 5600X 6x3.70GHz | 16Go DDR4 | RX 6750 XT 12Go | 1To M.2 SSD</p>
                        </div>
                    </td>
                    <td class="quantite">
                        <p>1</p>
                    </td>
                    <td class="prix-unitaire">
                        <p>846,05 €</p>
                    </td>
                    <td class="total-intermediaire">
                        <p>846,05 €</p>
                    </td>
                </tr>
                <tr>
                    <td class="produit">
                        <div style="display: flex;">
                            <img src="https://picsum.photos/64/64" alt="">
                            <p>PC Portable</p>
                        </div>
                    </td>
                    <td class="quantite">
                        <p>3</p>
                    </td>
                    <td class="prix-unitaire">
                        <p>1 299,99 €</p>
                    </td>
                    <td class="total-intermediaire">
                        <p>3 899,97 €</p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="resultat">
        <div class="resume">
            <h2>Résumé</h2>
            <div>
                <p>Total intermédiaire</p>
                <p class="prix">886,55 €</p>
            </div>
            <div>
                <p>Frais de livraison</p>
                <p class="prix">24,90 €</p>
            </div>
        </div>
        <div class="total">
            <h2>Total</h2>
            <div>
                <p>Total hors TVA</p>
                <p class="prix">846,05 €</p>
            </div>
            <div>
                <p>20% TVA inclus</p>
                <p class="prix">165,33 €</p>
            </div>
        </div>
        <button class="cart"><span><i class="bi bi-cart"></i></span> Valider mon panier</button>

    </div>
</div>

<?php
include 'footer.php';
?>