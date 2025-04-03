<?php
include 'header.php';

// Vérifier si l'utilisateur est administrateur
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    header('Location: index.php');
    exit;
}

// Récupérer les produits
$produits = $db->query('SELECT * FROM produits')->fetchAll();

// Récupérer les utilisateurs
$utilisateurs = $db->query('SELECT * FROM utilisateurs')->fetchAll();
?>

<h1>Panneau d'administration</h1>

<div class="admin-panel">
    <form method="get" action="panel.php">
        <input type="text" name="search" placeholder="Rechercher un produit ou un utilisateur">
        <button type="submit">Rechercher</button>
    </form>

    <!-- Section Statistiques -->
    <h2>Statistiques</h2>
    <div class="stats">
        <p>Nombre total de produits : <?= $db->query('SELECT COUNT(*) FROM produits')->fetchColumn() ?></p>
        <p>Nombre total d'utilisateurs : <?= $db->query('SELECT COUNT(*) FROM utilisateurs')->fetchColumn() ?></p>
    </div>

    <!-- Section Catégories -->
    <h2>Gestion des Catégories</h2>
    <a href="addcategories.php" class="ajouter"><i class="bi bi-plus-circle"></i> Ajouter une catégorie</a>
    <table class="admin-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $categories = $db->query('SELECT * FROM categorie')->fetchAll();
            foreach ($categories as $categorie) : ?>
                <tr>
                    <td><?= $categorie['ID'] ?></td>
                    <td><?= htmlspecialchars($categorie['LIBELLE']) ?></td>
                    <td>
                        <a href="editcategories?id=<?= $categorie['ID'] ?>" class="modifier"><i class="bi bi-pencil"></i> Modifier</a>
                        <a href="delcategories?id=<?= $categorie['ID'] ?>" class="supprimer"><i class="bi bi-trash"></i> Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Section Produits -->
    <h2>Gestion des Produits</h2>
    <table class="admin-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Marque</th>
                <th>Modèle</th>
                <th>Prix</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produits as $produit) : ?>
                <tr>
                    <td><?= $produit['ID'] ?></td>
                    <td><?= htmlspecialchars($produit['MARQUE']) ?></td>
                    <td><?= htmlspecialchars($produit['MODEL']) ?></td>
                    <td><?= $produit['PRIX'] ?>€</td>
                    <td>
                    <a href="editproduits?id=<?= $produit['ID'] ?>" class="modifier"><i class="bi bi-pencil"></i> Modifier</a>
                    <a href="delproduits?id=<?= $produit['ID'] ?>" class="supprimer"><i class="bi bi-trash"></i> Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Section Utilisateurs -->
    <h2>Gestion des Utilisateurs</h2>
    <table class="admin-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($utilisateurs as $utilisateur) : ?>
                <tr>
                    <td><?= $utilisateur['ID'] ?></td>
                    <td><?= htmlspecialchars($utilisateur['NOM']) ?></td>
                    <td><?= htmlspecialchars($utilisateur['PRENOM']) ?></td>
                    <td><?= htmlspecialchars($utilisateur['EMAIL']) ?></td>
                    <td><?= $utilisateur['ADMIN'] == 1 ? 'Administrateur' : 'Utilisateur' ?></td>
                    <td>
                        <a href="edituser?id=<?= $utilisateur['ID'] ?>" class="modifier">Modifier</a>
                        <a href="deluser?id=<?= $utilisateur['ID'] ?>" class="supprimer">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php
include 'footer.php';
?>