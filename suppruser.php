<script>
Swal.fire({
  title: "Are you sure?",
  text: "You won't be able to revert this!",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Yes, delete it!"
}).then((result) => {
  if (result.isConfirmed) {
    Swal.fire({
      title: "Deleted!",
      text: "Your file has been deleted.",
      icon: "success"
    });
    <?php

    include 'config/bdd.php';

    $sql = 'DELETE FROM utilisateurs WHERE EMAIL = :email';
    $stmt = $db->prepare($sql);
    $stmt->execute([':email' => $_SESSION['user']['utilisateur']]);

    header('Location: connexion.php');

    ?>
  }
});
</script>