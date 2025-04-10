<?php
include 'header.php';

// Vérification si l'ID de la catégorie est passé en GET
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    // Préparation de la requête pour supprimer la catégorie
    $sql = 'DELETE FROM categorie WHERE id = :id';
    $stmt = $db->prepare($sql);

    try {
        $stmt->execute([':id' => $id]);

        // Message de succès avec redirection
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Catégorie supprimée',
                text: 'La catégorie a été supprimée avec succès.'
            }).then(() => {
                window.location.href = 'categories.php';
            });
        </script>";
    } catch (Exception $e) {
        // Gestion des erreurs
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: 'Une erreur est survenue lors de la suppression de la catégorie.'
            });
        </script>";
    }
} else {
    // Redirection si aucun ID n'est fourni
    echo "<script>
        Swal.fire({
            icon: 'warning',
            title: 'Aucune catégorie sélectionnée',
            text: 'Veuillez sélectionner une catégorie à supprimer.'
        }).then(() => {
            window.location.href = 'categories.php';
        });
    </script>";
}

include 'footer.php';
