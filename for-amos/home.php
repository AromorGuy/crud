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
</head>

<body style="background-color: lightgreen;">
  <nav class="navbar navbar-light mb-5 px-3" style="background-color: #004d00; color: whitesmoke">
    <div class="container-fluid">
      <div class="mx-auto fs-3" style="font-weight: bold;">
        Potato CRUD
      </div>
    </div>
  </nav>

<div class="container mt-5">
  <div class="row row-cols-2 g-4 justify-content-center" style="max-width: 800px; margin: 0 auto;">
    <?php
    $images = [
        ['src' => 'uploads/large.png', 'alt' => 'Item 1'],
        ['src' => 'uploads/chiken.png', 'alt' => 'Item 2'],
        ['src' => 'uploads/chiken1.png', 'alt' => 'Item 3'],
        ['src' => 'uploads/tera.png', 'alt' => 'Item 4']
    ];
    shuffle($images);
    foreach ($images as $img):
    ?>
    <div class="col">
      <div class="ratio ratio-1x1">
        <div class="card shadow-sm border-success overflow-hidden">
           <img src="<?php echo $img['src']; ?>" class="h-100 w-100" style="object-fit: cover;" alt="<?php echo $img['alt']; ?>">
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</div>
</body>
</html>