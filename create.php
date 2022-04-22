<?php
session_start();
require_once 'config.php';

$req = $bdd->prepare('SELECT * FROM utilisateurs WHERE token = ?');
$req->execute(array($_SESSION['user']));
$data = $req->fetch();

$nom=$data['nom'];
$prenom=$data['prenom'];
$email=$data['email'];
$type=$data['type'];


if(isset($_POST['new']) && $_POST['new']==1){

    $nom=$_POST['nom'];
    $adresse=$_POST['adresse'];
    $ville=$_POST['ville'];
    $description=$_POST['description'];

    $sql = "INSERT INTO etablissement(nom,adresse,ville,description) VALUES (:nom,:adresse,:ville,:description)";
    $stmt = $bdd->prepare($sql);

    $stmt->execute(['nom'=>$nom,'adresse'=>$adresse,'ville'=>$ville,'description'=>$description]);
    header('Location:page_utilisateurs.php'); 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="C:\Users\clem8\Desktop\Studi\bootstrap-5.1.3-dist\css\bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <script src="C:\Users\clem8\Desktop\Studi\Dossier de projet\Hotelier\script.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <title>Document</title>

<body>
<header>
<nav class="navbar-expand-lg navbar-light fixed-top">
        <div class="container-fluid container-logo">
          <a href="landing.php"><img class="logo" src="logo1.png"/></a>
                
          <button class="navbar-toggler openbutton" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

        </div>
        
        <div class="collapse navbar-collapse justify-content-between" id="navbarNav">

        <button class="navbar-toggler visible-lg closebutton" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="close"><i class="bi bi-x"></i></span>
        </button>


            <ul class="nav navbar-nav">
            <li class="nav-item">
                <a href="landing.php" class="nav-link px-3">ACCEUIL</a>  
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link px-3">DÉCOUVERTE</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link px-3">A PROPOS</a>
            </li>


            </ul class="nav navbar-nav">
            <ul class="nav navbar-nav justify-content-end">
            <li class="nav-item"><a href="page_utilisateurs.php"><i class="bi bi-person-circle"></i></a></li>
            </ul>
        </div>
        </nav>

</header>


<div class="container-fluid">
    <form action="" method="post" id="form" class="form-style">

        <input type="hidden" name="new" value="1" />

        <div class="form-group form-group-style">
            <label>Nom de l'etablissement</label>
            <input type="text" name='nom' class="form-control" placeholder="Nom de l'etablissement" required>
        </div>

        <div class="form-group form-group-style">
            <label>Adresse de l'etablissement</label>
            <input type="text" name='adresse' class="form-control" placeholder="Adresse de l'etablissement" required>
        </div>


        <div class="form-group form-group-style">
            <label>Ville de l'etablissement</label>
            <input type="text" name='ville' placeholder="Ville de l'etablissement" class="form-control" required>

        </div>


        <div class="form-group form-group-style">
            <label>Description de l'etablissement</label>
            <input type="text" name='description' placeholder="Description de l'etablissement" class="form-control" required>
        </div>

        <input type='submit' class="btn btn-success buttonreservation" value='Submit'>
        </div>

</body>
</html>