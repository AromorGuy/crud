<?php
include "db_conn.php";
$id = $_GET["id"];

if (isset($_POST["submit"])) {
   $menu_name = mysqli_real_escape_string($conn, $_POST['menu_name']);

   if (empty($menu_name)) {
       header("Location: edit-menu.php?id=$id&msg=Menu name is required");
       exit();
   }

   $sql = "UPDATE `menus` SET `name`='$menu_name', `DateUpdated`=NOW() WHERE ID = $id";
   $result = mysqli_query($conn, $sql);

   if ($result) {
       header("Location: index.php?msg=Menu updated successfully");
       exit();
   } else {
       echo "Database Error: " . mysqli_error($conn);
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <title>Potato CRUD | Edit Menu</title>
</head>

<body style="background-color: lightgreen;">
  <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #004d00; color: whitesmoke">
    <h3>Potato CRUD</h3>
  </nav>

  <div class="container">
    <div class="text-center mb-4">
      <h3>Edit Menu Information</h3>
      <p class="text-muted">Click update after changing the menu name</p>
    </div>

    <?php
    $sql = "SELECT * FROM `menus` WHERE ID = $id LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    ?>

    <div class="container d-flex justify-content-center">
      <form action="" method="post" style="width:50vw; min-width:300px;">
        <div class="mb-3">
          <label class="form-label">Menu Name:</label>
          <input type="text" class="form-control" name="menu_name" value="<?php echo $row['name'] ?>" required>
        </div>

        <div>
          <button type="submit" class="btn btn-success" name="submit">Update Menu</button>
          <a href="index.php" class="btn btn-danger">Cancel</a>
        </div>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
