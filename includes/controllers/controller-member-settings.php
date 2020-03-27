<?php require 'includes/controllers/controller-member-general.php'; ?>
<?php $pass_update = null; ?>

<?php if ( isset($_POST['pass']) ): ?>
  <?php require 'includes/db/connectdb-imarisha.php'; ?>
  <?php 
    $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
    $sql_update_pass = "
      UPDATE clients_auth
      SET client_pass='$pass'
      WHERE client_id=". $client['client_id'];

    $pass_update = mysqli_query($conn, $sql_update_pass);
    mysqli_close($conn);
  ?>
<?php endif ?>