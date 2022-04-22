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


$id=$_POST['idetablissement'];
$id1 =(int)$id;

$delete=$bdd->prepare("DELETE FROM etablissement WHERE id ='$id1'");
$delete->execute();
header('Location: page_utilisateurs.php');