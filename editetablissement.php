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
$data = $req->fetch();

$nom=$data['nom'];
$prenom=$data['prenom'];
$email=$data['email'];
$type=$data['type'];

$input=$_POST['name'];
$name=(int)$input;

//On récupère les données de la chambre
$donnee =$bdd->prepare("SELECT * FROM etablissement WHERE id =$name");
$donnee->execute();
$bref=$donnee->fetchAll(PDO::FETCH_ASSOC);


foreach($bref as $values){
  $titre = $values['nom'];
  $adresse = $values['adresse'];
  $ville = $values['ville'];
  $description =  $values['description'];
  $source_image = $values['source_image'];}

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
    <body>
      <div class="form">
      <?php

      if(isset($_POST['new']) && $_POST['new']==1){
        //$id=$_REQUEST['id'];
        //$prenom = htmlspecialchars($_POST['prenom']);
        //$nom = htmlspecialchars($_POST['nom']);
        //$submittedby = $_SESSION["user"];
        $titre = $_POST['titre'];
        $adresse = $_POST['adresse'];
        $ville = $_POST['ville'];
        $description =  $_POST['description'];
        $source_image = $_POST['source_image'];
        $idstr=$_POST['id'];
        $id=(int)$idstr;
      
      

        $update=$bdd->prepare("UPDATE etablissement SET nom='".$titre."',description='".$description."',adresse='".$adresse."',ville='".$ville."',source_image='".$source_image."' WHERE id=$id");
        $update->execute();

        header('Location: landing.php');
      }
      /*$status = "Record Updated Successfully. </br></br>
      <a href='view.php'>View Updated Record</a>";
      echo '<p style="color:#FF0000;">'.$status.'</p>';*/

      else {
        ?>
        <div>
        <form name="form" method="post" class="form-style" action="">
        <input type="hidden" name="new" value="1" />


        <div class="form-group form-group-style">
            <label>Entrer le titre de l'etablissement</label>
            <input type="text" name="titre" class="form-control" placeholder="Entrer le titre de l'etablissement" required value="<?php echo $titre;?>" />
        </div>
        
        <div class="form-group form-group-style">
        <label>Entrer la description</label>
          <input type="text" name="description" class="form-control" placeholder="Entrer la description" required value="<?php echo $description;?>" />
        </div>

        <div class="form-group form-group-style">
        <label>Entrer l'adresse</label>
          <input type="text" name="adresse" class="form-control" placeholder="Entrer l'adresse" required value="<?php echo $adresse;?>" />
        </div>

        <div class="form-group form-group-style">
        <label>Entrer la ville</label>
          <input type="text" name="ville" class="form-control" placeholder="Entrer la ville" required value="<?php echo $ville;?>" />
        </div>

        <div class="form-group form-group-style">
          <input type="file" class="form-control" name="source_image" value="<?php echo $source_image;?>" />
        </div>

        <input type="hidden" name="id" value="<?php echo $name;?>" />

        <input name="submit" class="btn btn-primary button" type="submit" value="Update" />
        </form>
        <?php }?>
      </div>
      </div>
    </body>
  </html>