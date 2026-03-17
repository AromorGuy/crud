<?php
include "db_conn.php";
$id = $_GET["id"];
$sql = "DELETE FROM `menuproducts` WHERE ID = $id";
$result = mysqli_query($conn, $sql);

if ($result) {
  header("Location: index.php?msg=Menu Product deleted successfully");
} else {
  echo "Failed: " . mysqli_error($conn);
}
?>
