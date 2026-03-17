<?php
include "db_conn.php";

if (isset($_POST["submit"])) {
   $menu_name = mysqli_real_escape_string($conn, $_POST['menu_name']);

   // 1. Backend Validation
   if (empty($menu_name)) {
       header("Location: add-menu.php?msg=Menu name is required");
       exit();
   }

   // 2. Insert into Database
   $sql = "INSERT INTO `menus`(`ID`, `name`, `DateCreated`) 
           VALUES (NULL, '$menu_name', NOW())";

   if (mysqli_query($conn, $sql)) {
       header("Location: index.php?msg=Menu added successfully");
       exit();
   } else {
       header("Location: add-menu.php?msg=Failed to add menu: " . mysqli_error($conn));
       exit();
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
   <title>Potato CRUD | Add Menu</title>
</head>
<body style="background-color: lightgreen;">
   <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #004d00; color: whitesmoke">
      <h3>Potato CRUD</h3>
   </nav>

   <div class="container">
      <?php if (isset($_GET["msg"])): ?>
         <div class="alert alert-danger text-center"><?php echo $_GET["msg"]; ?></div>
      <?php endif; ?>

      <div class="container d-flex justify-content-center">
         <form action="" method="post" style="width:50vw; min-width:300px;">
            <div class="mb-3">
               <label class="form-label">Menu Name:</label>
               <input type="text" class="form-control" name="menu_name" required>
            </div>

            <div class="d-flex justify-content-center gap-2">
               <button type="submit" class="btn btn-success" name="submit">Save Menu</button>
               <a href="index.php" class="btn btn-danger">Cancel</a>
            </div>
         </form>
      </div>
   </div>
</body>
</html>
