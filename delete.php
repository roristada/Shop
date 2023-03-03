<?php include "db.php" ?>
<?php
$stmt = $pdo->prepare("DELETE FROM product WHERE productid=? AND size = ?");
$stmt->bindParam(1, $_GET["productid"]);
$stmt->bindParam(2, $_GET["size"]);
if ($stmt->execute())
header("location: udt.php");
?>