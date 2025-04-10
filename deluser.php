<?php

include "testadmin.php";

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $sql = 'DELETE FROM utilisateurs WHERE EMAIL = :email';
    $stmt = $db->prepare($sql);
    $stmt->execute([':email' => $_GET['id']]);

    header('Location: panel.php');
}

?>