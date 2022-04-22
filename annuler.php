<?php
require_once 'config.php';

$etablissement = $_POST['etablissement'];
$chambre = $_POST['chambre'];
$date_debut = $_POST['date_debut'];
$date_fin = $_POST['date_fin'];
$prix = $_POST['prix'];

$Currentdate = date('d-m-Y', time()); 

$datedebut= date('Y-m-d',strtotime($date_debut));
$datefin= date('Y-m-d',strtotime($date_fin));


$origin = new DateTime($date_debut);
$target = new DateTime($Currentdate);
$interval = $origin->diff($target);

$intervaldays=($interval->days);


if ($intervaldays>=3){
$delete=$bdd->prepare("DELETE FROM reservation WHERE `reservation`.`chambre` ='$chambre' AND etablissement='$etablissement' AND date_debut='$datedebut' AND date_fin='$datefin'");
$delete->execute();
header('Location: page_utilisateurs.php');
}

else{
    echo '<div class=bg>Désoler vous avez dépasser le delai vous ne pouvez pas annuler cet réservation </div>';
}



?>