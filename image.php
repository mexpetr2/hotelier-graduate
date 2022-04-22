<?php
require_once 'config.php';

$query="SELECT id, source_image FROM chambre WHERE id = ?";
$stmt=$bdd->prepare($query);
$stmt ->bindParam(1, $_GET['id']);

$stmt->execute();
$row=$stmt->fetch(PDO::FETCH_ASSOC);
header("Content-type: image/jpg");
print $row['source_image'];
exit;
