<?php
include 'header.php';

// Vérifier si l'utilisateur est administrateur
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    header('Location: index.php');
    exit;
}

// Récupérer la recherche
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

// Récupérer les catégories
if (!empty($search)) {
    $categories = $db->prepare('SELECT * FROM categorie WHERE LIBELLE LIKE :search');
    $categories->execute([':search' => '%' . $search . '%']);
    $totalCategories = $db->prepare('SELECT COUNT(*) FROM categorie WHERE LIBELLE LIKE :search');
    $totalCategories->execute([':search' => '%' . $search . '%']);
    $totalCategories = $totalCategories->fetchColumn();
} else {
    $categories = $db->query('SELECT * FROM categorie')->fetchAll();
    $totalCategories = $db->query('SELECT COUNT(*) FROM categorie')->fetchColumn();
}

// Récupérer les produits
if (!empty($search)) {
    $produits = $db->prepare('SELECT * FROM produits WHERE MARQUE LIKE :search OR MODEL LIKE :search');
    $produits->execute([':search' => '%' . $search . '%']);
    $totalProduits = $db->prepare('SELECT COUNT(*) FROM produits WHERE MARQUE LIKE :search OR MODEL LIKE :search');
    $totalProduits->execute([':search' => '%' . $search . '%']);
    $totalProduits = $totalProduits->fetchColumn();
} else {
    $produits = $db->query('SELECT * FROM produits')->fetchAll();
    $totalProduits = $db->query('SELECT COUNT(*) FROM produits')->fetchColumn();
}

// Récupérer les utilisateurs
if (!empty($search)) {
    $utilisateurs = $db->prepare('SELECT * FROM utilisateurs WHERE NOM LIKE :search OR PRENOM LIKE :search OR EMAIL LIKE :search');
    $utilisateurs->execute([':search' => '%' . $search . '%']);
    $totalUtilisateurs = $db->prepare('SELECT COUNT(*) FROM utilisateurs WHERE NOM LIKE :search OR PRENOM LIKE :search OR EMAIL LIKE :search');
    $totalUtilisateurs->execute([':search' => '%' . $search . '%']);
    $totalUtilisateurs = $totalUtilisateurs->fetchColumn();
} else {
    $utilisateurs = $db->query('SELECT * FROM utilisateurs')->fetchAll();
    $totalUtilisateurs = $db->query('SELECT COUNT(*) FROM utilisateurs')->fetchColumn();
}
?>

<h1>Panneau d'administration</h1>

<div class="admin-panel">
    <form method="get" action="panel.php" class="search-form">
        <input type="text" name="search" placeholder="Rechercher une catégorie, un produit ou un utilisateur">
        <button type="submit">Rechercher</button>
    </form>

    <!-- Section Statistiques -->
    <h2>Statistiques</h2>
    <div class="stats">
        <p>Nombre total de catégories : <?= $totalCategories ?></p>
        <p>Nombre total de produits : <?= $totalProduits ?></p>
        <p>Nombre total d'utilisateurs : <?= $totalUtilisateurs ?></p>
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
    <a href="addproduits.php" class="ajouter"><i class="bi bi-plus-circle"></i> Ajouter un produit</a>
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
    <a href="adduser.php" class="ajouter"><i class="bi bi-plus-circle"></i> Ajouter un utilisateur</a>
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