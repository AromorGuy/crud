<?php
include "db_conn.php";
$id = $_GET["id"];

if (isset($_POST["submit"])) {
   $menu_id = $_POST['menu_id'];
   $product_id = $_POST['product_id'];

   if (empty($menu_id) || empty($product_id)) {
       header("Location: edit-menu-product.php?id=$id&msg=Menu and Product are required");
       exit();
   }

   $sql = "UPDATE `menuproducts` SET `menuID`='$menu_id', `productID`='$product_id' WHERE ID = $id";
   $result = mysqli_query($conn, $sql);

   if ($result) {
       header("Location: index.php?msg=Menu Product updated successfully");
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

  <title>Potato CRUD | Edit Menu Product</title>
</head>

<body style="background-color: lightgreen;">
  <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #004d00; color: whitesmoke">
    <h3>Potato CRUD</h3>
  </nav>

  <div class="container">
    <div class="text-center mb-4">
      <h3>Edit Menu Product Information</h3>
      <p class="text-muted">Click update after changing the association</p>
    </div>

    <?php if (isset($_GET["msg"])): ?>
       <div class="alert alert-danger text-center"><?php echo htmlspecialchars($_GET["msg"]); ?></div>
    <?php endif; ?>

    <?php
    $sql = "SELECT * FROM `menuproducts` WHERE ID = $id LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    ?>

    <div class="container d-flex justify-content-center">
      <form action="" method="post" style="width:50vw; min-width:300px;">
        <div class="mb-3">
           <label class="form-label">Menu:</label>
           <select name="menu_id" class="form-select" required>
             <?php
             $menus = mysqli_query($conn, "SELECT * FROM `menus`");
             while ($menu = mysqli_fetch_assoc($menus)) {
                 $selected = ($menu['ID'] == $row['menuID']) ? "selected" : "";
                 echo "<option value='".$menu['ID']."' $selected>".htmlspecialchars($menu['name'])."</option>";
             }
             ?>
           </select>
        </div>

        <div class="mb-3">
           <label class="form-label">Product:</label>
           <select name="product_id" class="form-select" required>
             <?php
             $products = mysqli_query($conn, "SELECT * FROM `products`");
             while ($product = mysqli_fetch_assoc($products)) {
                 $selected = ($product['ID'] == $row['productID']) ? "selected" : "";
                 echo "<option value='".$product['ID']."' $selected>".htmlspecialchars($product['name'])."</option>";
             }
             ?>
           </select>
        </div>

        <div>
          <button type="submit" class="btn btn-success" name="submit">Update Menu Product</button>
          <a href="index.php" class="btn btn-danger">Cancel</a>
        </div>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
