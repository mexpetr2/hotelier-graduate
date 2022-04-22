<?php
    session_start();
    require_once 'config.php'; // ajout connexion bdd 
   // si la session existe pas soit si l'on est pas connecté on redirige
    /*if(!isset($_SESSION['user'])){
        header('Location:index.php');
        die();
    }*/

    // On récupere les données de l'utilisateur
    if(isset($_SESSION['user'])){

    
    $req = $bdd->prepare('SELECT * FROM utilisateurs WHERE token = ?');
    $req->execute(array($_SESSION['user']));
    $data = $req->fetch();

    $nomuser=$data['nom'];
    $prenomuser=$data['prenom'];
    $emailuser=$data['email'];
    $type=$data['type'];
    }

    // On récupere les données des chambres
    $donnee =$bdd->prepare('SELECT * FROM chambre WHERE etablissement="Hotel de Montpellier"');
    $donnee->execute();
    $bref=$donnee->fetchAll();

    foreach($bref as $values){
      $titre[] = $values['titre'];
      $description[] =  $values['description'];
      $prix[] =  $values['prix'];
      $idchambre[] = $values['id'];
      $imagechambre[]= $values['source_image'];}


      $stmt1 =$bdd->prepare("SELECT etablissement FROM gerant WHERE email='$emailuser'");
      $stmt1->execute();
      $data1=$stmt1->fetchAll(PDO::FETCH_ASSOC);

      foreach($data1 as $values){
        $etablissement = $values['etablissement'];
      }


      if($type =='gerant' AND $etablissement='Hotel de Montpellier'){
        $admin = 1;
      }

    //Modal SENT
    if(isset($_POST['new']) && $_POST['new']==1){
      //$id=$_REQUEST['id'];
      //$prenom = htmlspecialchars($_POST['prenom']);
      //$nom = htmlspecialchars($_POST['nom']);
      //$submittedby = $_SESSION["user"];
      $nom = $_POST['nom'];
      $prenom =  $_POST['prenom'];
      $email = $_POST['email'];
      $subject =  $_POST['subject'];
      $message =  $_POST['message'];
  

      
      $insert=$bdd->prepare('INSERT INTO messagerie (`nom`, `prenom`, `email`, `subject`, `message`) VALUES ("'.$nom.'","'.$prenom.'","'.$email.'","'.$subject.'","'.$message.'")');
      $insert->execute();
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
</head>
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
                <a href="reservation_void.php" class="nav-link px-3">RÉSERVER</a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link px-3" data-toggle="modal" data-target="#ModalContact">CONTACT</a>
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
    <div class="container-fluid">
    <div class="row justify-content-center">
    <?php 
        if(isset($idchambre[0])){
        ?>
        <form method='POST' action='edit.php' class="card border-0">
            <img class="card-img-top" src="<?php echo $imagechambre[0]?>" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title"><?php echo $titre[0]; ?></h5>
              <p class="card-text"><?php echo $description[0];?></p>
              <input type='hidden' name='name' value=1>
              <input type='submit' class='btn btn-primary' value='Reserver' formaction='reservation.php'>
              <?php if(isset($admin)){
              if($admin==1){
              echo "<a href='edit.php'><input type='submit' class='btn btn-primary' value='Modifier'></a>";
              echo "<a href='supprimer.php'><input type='button' class='btn btn-danger' value='Supprimer'></a>";
              }}?>
            </div>
          </form>
          <?php }?>



        <?php 
        if(isset($idchambre[1])){
        ?>
        <form method='POST' action='edit.php' class="card border-0">
            <img class="card-img-top" src="<?php echo $imagechambre[1]?>" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title"><?php echo $titre[1]; ?></h5>
              <p class="card-text"><?php echo $description[1];?></p>
              <input type='hidden' name='name' value=2>
              <input type='submit' class='btn btn-primary' value='Reserver' formaction='reservation.php'>
              <?php if(isset($admin)){
              if($admin==1){
              echo "<a href='edit.php'><input type='submit' class='btn btn-primary' value='Modifier'></a>";
              echo "<a href='supprimer.php'><input type='button' class='btn btn-danger' value='Supprimer'></a>";
              }?>
            </div>
          </form>
          <?php }}?>
    </div>

    <div class="row justify-content-center">
    <?php 
        if(isset($idchambre[2])){
        ?>
        <form method='POST' action='edit.php' class="card border-0">
            <img class="card-img-top" src="<?php echo $imagechambre[0]?>" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title"><?php echo $titre[2]; ?></h5>
              <p class="card-text"><?php echo $description[2];?></p>
              <input type='hidden' name='name' value=1>
              <input type='submit' class='btn btn-primary' value='Reserver' formaction='reservation.php'>
              <?php if(isset($admin)){
              if($admin==1){
              echo "<a href='edit.php'><input type='submit' class='btn btn-primary' value='Modifier'></a>";
              echo "<a href='supprimer.php'><input type='button' class='btn btn-danger' value='Supprimer'></a>";
              }}?>
            </div>
          </form>
          <?php }?>



        <?php 
        if(isset($idchambre[3])){
        ?>
        <form method='POST' action='edit.php' class="card border-0">
            <img class="card-img-top" src="<?php echo $imagechambre[3]?>" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title"><?php echo $titre[3]; ?></h5>
              <p class="card-text"><?php echo $description[3];?></p>
              <input type='hidden' name='name' value=2>
              <input type='submit' class='btn btn-primary' value='Reserver' formaction='reservation.php'>
              <?php if(isset($admin)){
              if($admin==1){
              echo "<a href='edit.php'><input type='submit' class='btn btn-primary' value='Modifier'></a>";
              echo "<a href='supprimer.php'><input type='button' class='btn btn-danger' value='Supprimer'></a>";
              }?>
            </div>
          </form>
          <?php }}?>
    </div>



<!-- Modal Contact-->
<div class="modal fade" id="ModalContact" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Contactez nous</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="" method="post">

        <input type="hidden" name="new" value="1" />
        <div class="form-group">
            <label>Nom</label>
            <input type="text" name='nom' class="form-control" placeholder="nom" value="<?php if(isset($nomuser)){ echo $nomuser;}?>" required autofocus>
        </div>

        <div class="form-group">
            <label>Prénom</label>
            <input type="text" name='prenom' class="form-control" placeholder="prenom" value="<?php if(isset($prenomuser)){echo $prenomuser;}?>" required>
        </div>


        <div class="form-group">
            <label>email</label>
            <input type="text" name='email' class="form-control" placeholder="email" value="<?php if(isset($prenomuser)){ echo $emailuser;}?>" required>
        </div>


        <div class="form-group">
            <label>Sujet</label>
            <select name="subject" id="inputGroupSelect01" class="form-select">
                <option value='Je souhaite poser une réclamation'>Je souhaite poser une réclamation</option>
                <option value='Je souhaite commander un service supplémentaire'>Je souhaite commander un service supplémentaire</option>
                <option value='Je souhaite en savoir plus sur une suite'>Je souhaite en savoir plus sur une suite</option>
                <option value='J’ai un souci avec cette application'>J’ai un souci avec cette application</option>
            </select>
        </div>


        <div class="form-group">
            <label>Message</label>
            <textarea type="text" name='message' class="form-control" placeholder="Message" required autofocus></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="sumbit" class="btn btn-primary">Envoyé</button>
      </div>
    </div>
  </div>
</div>
</div>
</body>
</html>