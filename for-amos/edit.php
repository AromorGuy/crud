<?php
include "db_conn.php";
$id = $_GET["id"];

if (isset($_POST["submit"])) {
   $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
   $product_price = mysqli_real_escape_string($conn, $_POST['product_price']);

   // Check if a file was actually uploaded and has no errors
   if (isset($_FILES["imagePath"]) && $_FILES["imagePath"]["error"] == 0) {
       
       $filename = time() . "_" . $_FILES["imagePath"]["name"];
       $tempname = $_FILES["imagePath"]["tmp_name"];
       $folder = "./uploads/" . $filename;

       if (move_uploaded_file($tempname, $folder)) {
           // Success: Update database WITH the new image path
           $sql = "UPDATE `products` SET 
                   `name`='$product_name', 
                   `price`='$product_price', 
                   `imagePath`='$folder', 
                   `DateUpdated`=NOW() 
                   WHERE ID = $id";
       } else {
           echo "Error: Could not move uploaded file.";
           exit();
       }
   } else {
       // No new file uploaded: Update everything EXCEPT the imagePath
       $sql = "UPDATE `products` SET 
               `name`='$product_name', 
               `price`='$product_price', 
               `DateUpdated`=NOW() 
               WHERE ID = $id";
   }

   $result = mysqli_query($conn, $sql);

   if ($result) {
       header("Location: index.php?msg=Data updated successfully");
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <title>Potato CRUD | Edit Product</title>
</head>

<body style="background-color: lightgreen;">
  <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #004d00; color: whitesmoke">
    <h3>Potato CRUD</h3>
  </nav>

  <div class="container">
    <div class="text-center mb-4">
      <h3>Edit User Information</h3>
      <p class="text-muted">Click update after changing any information</p>
    </div>

    <?php
    $sql = "SELECT * FROM `products` WHERE ID = $id LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    ?>

    <div class="container d-flex justify-content-center">
      <form action="" method="post" enctype="multipart/form-data" style="width:50vw; min-width:300px;">
        <div class="row mb-3">
          <div class="col">
            <label class="form-label">Product Name:</label>
            <input type="text" class="form-control" name="product_name" value="<?php echo $row['name'] ?>">
          </div>

          <div class="col">
            <label class="form-label">Product Price:</label>
            <input type="text" class="form-control" name="product_price" value="<?php echo $row['price'] ?>">
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">Image:</label>
          <input type="file" class="form-control" name="imagePath">
        </div>

        <div>
          <button type="submit" class="btn btn-success" name="submit">Update</button>
          <a href="index.php" class="btn btn-danger">Cancel</a>
        </div>
      </form>
    </div>
  </div>

  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>