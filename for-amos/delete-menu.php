<?php
include "db_conn.php";
$id = $_GET["id"];
$sql = "DELETE FROM `menus` WHERE id = $id";
$result = mysqli_query($conn, $sql);

if ($result) {
  header("Location: index.php?msg=Menu deleted successfully");
} else {
  echo "Failed: " . mysqli_error($conn);
}
?>
