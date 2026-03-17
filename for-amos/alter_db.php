<?php
include "db_conn.php";
$sql = "ALTER TABLE `menuproducts` ADD `DateUpdated` DATETIME NULL DEFAULT NULL;";
if (mysqli_query($conn, $sql)) {
  echo "Success";
} else {
  echo "Error: " . mysqli_error($conn);
}
?>
