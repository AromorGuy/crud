<?php
include "db_conn.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <title>Potato CRUD</title>

  <style>
    .product-img {
      width: 80px;         /* Fixed width */
      height: 80px;        /* Fixed height */
      object-fit: cover;   /* Crops the image to fill the box without distortion */
      border-radius: 5px;  /* Optional: gives it a nice rounded look */
      border: 1px solid #ddd;
    }
  </style>
</head>

<body style="background-color: lightgreen;">
  <nav class="navbar navbar-light mb-5 px-3" style="background-color: #004d00; color: whitesmoke">
    <div class="container-fluid">
      <div class="fs-3" style="font-weight: bold;">
        Potato CRUD
      </div>
    </div>
  </nav>

  <div class="container">
    <?php
    if (isset($_GET["msg"])) {
      $msg = $_GET["msg"];
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      ' . $msg . '
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    ?>
    <div class="mb-3 d-flex justify-content-start gap-2">
      <a href="add-new.php" class="btn btn-dark">Add New Product</a>
      <a href="add-menu.php" class="btn btn-dark">Add New Menu</a>
      <a href="add-menu-product.php" class="btn btn-dark">Add Menu Product</a>
    </div>

    <h3>Products</h3>
    <table class="table table-hover text-center mb-5">
      <thead class="table-dark">
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Name</th>
          <th scope="col">Price</th>
          <th scope="col">imagePath</th>
          <th scope="col">DateCreated</th>
          <th scope="col">DateUpdated</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT * FROM `products`";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
          <tr>
            <td><?php echo $row["ID"] ?></td>
            <td><?php echo $row["name"] ?></td>
            <td><?php echo $row["price"] ?></td>
            <td>
              <img src="<?php echo $row['imagePath']; ?>" class="product-img">
            </td>
            <td><?php echo $row["DateCreated"] ?></td>
            <td><?php echo $row["DateUpdated"] ?></td>

            <td>
              <a href="edit.php?id=<?php echo $row["ID"] ?>" class="link-dark"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
              <a href="delete.php?id=<?php echo $row["ID"] ?>" class="link-dark"><i class="fa-solid fa-trash fs-5"></i></a>
            </td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>

    <h3>Menus</h3>
    <table class="table table-hover text-center mb-5">
      <thead class="table-dark">
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Name</th>
          <th scope="col">DateCreated</th>
          <th scope="col">DateUpdated</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql_menu = "SELECT * FROM `menus`";
        $result_menu = mysqli_query($conn, $sql_menu);
        if ($result_menu) {
          while ($row = mysqli_fetch_assoc($result_menu)) {
          ?>
            <tr>
              <td><?php echo $row["ID"] ?></td>
              <td><?php echo $row["name"] ?></td>
              <td><?php echo $row["DateCreated"] ?></td>
              <td><?php echo $row["DateUpdated"] ?></td>
              <td>
                <a href="edit-menu.php?id=<?php echo $row["ID"] ?>" class="link-dark"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
                <a href="delete-menu.php?id=<?php echo $row["ID"] ?>" class="link-dark"><i class="fa-solid fa-trash fs-5"></i></a>
              </td>
            </tr>
          <?php
          }
        }
        ?>
      </tbody>
    </table>

    <h3>Menu Products</h3>
    <table class="table table-hover text-center mb-5">
      <thead class="table-dark">
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Menu</th>
          <th scope="col">Product</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql_mp = "SELECT mp.ID, m.name AS menu_name, p.name AS product_name 
                   FROM menuproducts mp 
                   LEFT JOIN menus m ON mp.menuID = m.ID 
                   LEFT JOIN products p ON mp.productID = p.ID";
        
        $result_mp = mysqli_query($conn, $sql_mp);
        if ($result_mp) {
          while ($row = mysqli_fetch_assoc($result_mp)) {
          ?>
            <tr>
              <td><?php echo $row["ID"] ?></td>
              <td><?php echo $row["menu_name"] ?></td>
              <td><?php echo $row["product_name"] ?></td>
              <td>
                <a href="edit-menu-product.php?id=<?php echo $row["ID"] ?>" class="link-dark"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
                <a href="delete-menu-product.php?id=<?php echo $row["ID"] ?>" class="link-dark"><i class="fa-solid fa-trash fs-5"></i></a>
              </td>
            </tr>
          <?php
          }
        }
        ?>
      </tbody>
    </table>
  </div>

  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>