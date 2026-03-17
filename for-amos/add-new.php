<?php
include "db_conn.php";

if (isset($_POST["submit"])) {
   $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
   $product_price = mysqli_real_escape_string($conn, $_POST['product_price']);

   // 1. Backend Validation
   if (empty($product_name) || empty($product_price)) {
       header("Location: add-new.php?msg=All fields are required");
       exit();
   }

   if (!is_numeric($product_price) || $product_price <= 0) {
       header("Location: add-new.php?msg=Invalid price amount");
       exit();
   }

   // 2. Advanced File Validation
   if (isset($_FILES["imagePath"]) && $_FILES["imagePath"]["error"] == 0) {
       $filename = $_FILES["imagePath"]["name"];
       $filesize = $_FILES["imagePath"]["size"];
       $tempname = $_FILES["imagePath"]["tmp_name"];
       
       // Get file extension
       $file_ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
       $allowed_ext = array("jpg", "jpeg", "png", "webp");

       // Check extension and limit size to 2MB
       if (in_array($file_ext, $allowed_ext) && $filesize <= 2000000) {
           $new_filename = time() . "_" . $filename; // Unique name to prevent overwriting
           $folder = "./uploads/" . $new_filename;

           if (!is_dir('uploads')) {
               mkdir('uploads', 0777, true);
           }

           if (move_uploaded_file($tempname, $folder)) {
               $sql = "INSERT INTO `products`(`ID`, `name`, `price`, `imagePath`, `DateCreated`) 
                       VALUES (NULL, '$product_name', '$product_price', '$folder', NOW())";

               if (mysqli_query($conn, $sql)) {
                   header("Location: index.php?msg=Product added successfully");
                   exit();
               }
           }
       } else {
           header("Location: add-new.php?msg=Invalid file type or size too large (Max 2MB)");
           exit();
       }
   } else {
       header("Location: add-new.php?msg=Image upload failed or no image selected");
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
   <title>Potato CRUD | Add Product</title>
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
         <form action="" method="post" enctype="multipart/form-data" style="width:50vw; min-width:300px;">
            <div class="row mb-3">
               <div class="col">
                  <label class="form-label">Product Name:</label>
                  <input type="text" class="form-control" name="product_name" required>
               </div>
               <div class="col">
                  <label class="form-label">Price (PHP):</label>
                  <input type="number" step="0.01" class="form-control" name="product_price" required>
               </div>
            </div>

            <div class="mb-3">
               <label class="form-label">Product Image:</label>
               <input type="file" class="form-control" name="imagePath" accept="image/*" required>
            </div>

            <div class="d-flex justify-content-center gap-2">
               <button type="submit" class="btn btn-success" name="submit">Save Product</button>
               <a href="index.php" class="btn btn-danger">Cancel</a>
            </div>
         </form>
      </div>
   </div>
</body>
</html>