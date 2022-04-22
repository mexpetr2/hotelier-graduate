<?php
session_start();
require_once 'config.php'; // ajout connexion bdd 
// si la session existe pas soit si l'on est pas connecté on redirige
if(!isset($_SESSION['user'])){
    header('Location:index.php');
    die();
}

// On récupere les données de l'utilisateur
$req = $bdd->prepare('SELECT * FROM utilisateurs WHERE token = ?');
$req->execute(array($_SESSION['user']));
$row = $req->fetch();


$donnee =$bdd->prepare("SELECT * FROM chambre WHERE id =2");
$donnee->execute();
$bref=$donnee->fetchAll();

$update=$bdd->prepare("DELETE FROM chambre WHERE `chambre`.`id` = 2");
$update->execute();


?>
<form action='landing.php' method='POST'>
<input type='hidden' name='name' value='supprimer'>
</form>
<?php header('Location: landing.php'); ?>
