<?php
include "header.php";
include "testadmin.php";

if (isset($_GET['id']) && !empty($_GET['id'])) {
    echo "
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Êtes-vous sûr ?',
                text: 'Cette action supprimera définitivement l\'utilisateur.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, supprimer',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'deluser.php?confirm=1&id=" . $_GET['id'] . "';
                } else {
                    window.location.href = 'panel.php';
                }
            });
        });
    </script>
    ";
}

if (isset($_GET['confirm']) && $_GET['confirm'] == 1 && isset($_GET['id']) && !empty($_GET['id'])) {
    $sql = 'DELETE FROM utilisateurs WHERE ID = :id';
    $stmt = $db->prepare($sql);
    $stmt->execute([':id' => $_GET['id']]);

    header('Location: panel.php');
}

?>