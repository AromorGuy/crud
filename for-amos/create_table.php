<?php
include "db_conn.php";

$sql = "CREATE TABLE IF NOT EXISTS `menuproducts` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `menuID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
)";

if (mysqli_query($conn, $sql)) {
  echo "Table menuproducts created successfully or already exists.";
} else {
  echo "Error creating table: " . mysqli_error($conn);
}
?>
