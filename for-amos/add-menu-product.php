<?php
include "db_conn.php";

if (isset($_POST["submit"])) {
   $menu_id = $_POST['menu_id'];
   $product_id = $_POST['product_id'];

   // 1. Backend Validation
   if (empty($menu_id) || empty($product_id)) {
       header("Location: add-menu-product.php?msg=Menu and Product are required");
       exit();
   }

   // 2. Insert into Database
   $sql = "INSERT INTO `menuproducts`(`ID`, `menuID`, `productID`) 
           VALUES (NULL, '$menu_id', '$product_id')";

   if (mysqli_query($conn, $sql)) {
       header("Location: index.php?msg=Menu Product added successfully");
       exit();
   } else {
       header("Location: add-menu-product.php?msg=Failed to add menu product: " . mysqli_error($conn));
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
   <title>Potato CRUD | Add Menu Product</title>
</head>
<body style="background-color: lightgreen;">
   <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #004d00; color: whitesmoke">
      <h3>Potato CRUD</h3>
   </nav>

   <div class="container">
      <?php if (isset($_GET["msg"])): ?>
         <div class="alert alert-danger text-center"><?php echo htmlspecialchars($_GET["msg"]); ?></div>
      <?php endif; ?>

      <div class="container d-flex justify-content-center">
         <form action="" method="post" style="width:50vw; min-width:300px;">
            <div class="mb-3">
               <label class="form-label">Menu:</label>
               <select name="menu_id" class="form-select" required>
                 <option value="" disabled selected>Select a Menu</option>
                 <?php
                 $menus = mysqli_query($conn, "SELECT * FROM `menus`");
                 while ($menu = mysqli_fetch_assoc($menus)) {
                     echo "<option value='".$menu['ID']."'>".htmlspecialchars($menu['name'])."</option>";
                 }
                 ?>
               </select>
            </div>

            <div class="mb-3">
               <label class="form-label">Product:</label>
               <select name="product_id" class="form-select" required>
                 <option value="" disabled selected>Select a Product</option>
                 <?php
                 $products = mysqli_query($conn, "SELECT * FROM `products`");
                 while ($product = mysqli_fetch_assoc($products)) {
                     echo "<option value='".$product['ID']."'>".htmlspecialchars($product['name'])."</option>";
                 }
                 ?>
               </select>
            </div>

            <div class="d-flex justify-content-center gap-2">
               <button type="submit" class="btn btn-success" name="submit">Save Menu Product</button>
               <a href="index.php" class="btn btn-danger">Cancel</a>
            </div>
         </form>
      </div>
   </div>
</body>
</html>
