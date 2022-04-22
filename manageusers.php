<?php
session_start();
require_once 'config.php';

$stmt =$bdd->prepare('SELECT id,email FROM utilisateurs WHERE type="user" or type="gerant"');
$stmt->execute();
$data1=$stmt->fetchAll(PDO::FETCH_ASSOC);


$req = $bdd->prepare('SELECT * FROM utilisateurs WHERE token = ?');
$req->execute(array($_SESSION['user']));
$data = $req->fetch();

$nom_user=$data['nom'];
$prenom_user=$data['prenom'];
$email_user=$data['email'];
$type_user=$data['type'];


foreach($data1 as $values){

    $id[] = $values['id'];
    $email[] = $values['email'];

}

$type = ['user','admin','gerant'];
$countid=count($id);

//On récupère les données des établissement
$donnee =$bdd->prepare("SELECT nom FROM etablissement");
$donnee->execute();
$bref=$donnee->fetchAll(PDO::FETCH_ASSOC);

foreach($bref as $values){
  $etablissement[]=$values['nom'];
}

if(isset($_POST['new']) && $_POST['new']==1){
    $email = $_POST['email'];
    $type =  $_POST['type'];
    $etablissement = $_POST['etablissement'];

    //On récupère les données de l'utilisateur
    $stmt =$bdd->prepare("SELECT type FROM utilisateurs WHERE email='$email'");
    $stmt->execute();
    $data=$stmt->fetchAll(PDO::FETCH_ASSOC);



    //On regarde si l'utilisateur est deja un gérant
    $stmt1 =$bdd->prepare("SELECT email,etablissement FROM gerant WHERE email='$email'");
    $stmt1->execute();
    $data1=$stmt1->fetchAll(PDO::FETCH_ASSOC);

    foreach($data1 as $values){
        $etablissementuser = $values['etablissement'];
    }


    $update=$bdd->prepare("UPDATE utilisateurs SET type='".$type."' WHERE email='$email'");
    $update->execute();
    header('Location: page_utilisateurs.php');

if($type=='gerant' AND empty($data1)){
    $insert = $bdd->prepare('INSERT INTO gerant(email, etablissement) VALUES("'.$email.'", "'.$etablissement.'")');
    $insert->execute();
    header('Location: page_utilisateurs.php');
}

if($type!='gerant' AND !empty($data1)){
    $delete=$bdd->prepare("DELETE FROM gerant WHERE email ='$email'");
    $delete->execute();
    header('Location: page_utilisateurs.php');
}

if($type=='gerant' AND $etablissement!=$etablissementuser){
    $update=$bdd->prepare("UPDATE gerant SET etablissement='".$etablissement."' WHERE email='$email'");
    $update->execute();
    header('Location: page_utilisateurs.php');
}
}
?>

<!DOCTYPE html>
    <html>
    <head>
    <meta charset="utf-8">
    <title>Update Record</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="C:\Users\clem8\Desktop\Studi\bootstrap-5.1.3-dist\css\bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <script src="C:\Users\clem8\Desktop\Studi\Dossier de projet\Hotelier\script.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </head>
    <body>

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

        <?php

        echo '<form method="post" action="" class="form-style">';

        echo '<input name="new" type="hidden" value=1>' ;

        echo "<label for='email-select'>Choisissez l'utilisateur</label>";
        echo '<select class="form-select form-select-style" name="email" id="email-select">';
        for($i=0; $i<count($email); $i++){
        echo '<option value='.$email[$i].'>'.$email[$i].'</option>';
        }
        echo '</select>';

        echo "<label for='type-select'>Choisissez son rôle</label>";
        echo '<select class="form-select form-select-style" name="type" id="type-select">';
        for($i=0; $i<count($type); $i++){
        echo '<option value='.$type[$i].'>'.$type[$i].'</option>';
        }
        echo '</select>';
        ?>
        <div id="content">


        </div>

        <?php    
        
        echo "<label for='etablissement'>Dans le cas d'un gérant, choisissez l'établissement qu'il gère</label>";
        echo '<select class="form-select form-select-style" name="etablissement" id="etablissement">';
        for($i=0; $i<count($etablissement); $i++){
        echo '<option value="'.$etablissement[$i].'">'.$etablissement[$i].'</option>';
        }
        echo '</select>';

        

        echo '<input type="submit" class="btn btn-success button" value="Envoyé">';
        echo '</form>';
;

?>
</body>
    </html>