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

    $token=$data['token'];
    $type=$data['type'];

    $nomuser=$data['nom'];
    $prenomuser=$data['prenom'];
    $emailuser=$data['email'];
    $type=$data['type'];

    // Donnée réservation 
    $donnee =$bdd->prepare('SELECT etablissement,chambre,date_debut,date_fin,prix FROM utilisateurs INNER JOIN reservation ON reservation.token = "'.$token.'" GROUP BY date_debut;');
    $donnee->execute();
    $bref=$donnee->fetchAll(PDO::FETCH_ASSOC);

    
    foreach($bref as $values){
        $etablissement[] =$values['etablissement'];
        $chambre[] =$values['chambre'];
        $prix[] = $values['prix'];
        $old_date_debut = $values['date_debut'];
        $old_date_fin =  $values['date_fin'];
        $date_debut[] = date("d-m-Y",strtotime($old_date_debut));
        $date_fin[] = date("d-m-Y",strtotime($old_date_fin));
    }
    

    if($type=='admin'){
      $stmt =$bdd->prepare('SELECT nom,adresse,ville,description,id FROM etablissement;');
      $stmt->execute();
      $data1=$stmt->fetchAll(PDO::FETCH_ASSOC); 

      foreach($data1 as $values){
         $nom[] =$values['nom'];
         $adresse[] =$values['adresse'];
         $ville[] = $values['ville'];
         $description[] = $values['description'];
         $idetablissement[] = $values['id'];
    }
   }


    if(empty($date_debut)){
       $count=0;
    }
    else{
    $count = count($date_debut);}

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
      header('Location: page_utilisateurs.php');
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

    </header>

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

            <li class="nav-item">
                <a href="#" class="nav-link px-3" data-toggle="modal" data-target="#ModalContact">CONTACT</a>
            </li>

            </ul class="nav navbar-nav">
            <ul class="nav navbar-nav justify-content-end">
            <li class="nav-item"><a href="page_utilisateurs.php"><i class="bi bi-person-circle"></i></a></li>
            </ul>
        </div>
        </nav>
        <a href="deconnexion.php" class="deco btn btn-danger">Déconnexion</a>


    <div class='text center'>
       <div class="userpage">
        <h1 class="p-5">Bonjour <?php echo $data['prenom']; ?> !</h1>
        <?php
        if($type=='admin'){
         echo "<a href='manageusers.php'><button type='button' class='btn btn-success adminbutton'>Gérer les utilisateurs</button></a>";
         echo "<a href='messagerie.php'><button type='button' class='btn btn-success adminbutton' style='margin-left:20px;'>Acceder à vote messagerie</button></a>";
        }
?>    
        <p>Voici vos réservation</p>
    </div>

<?php
$NbrCol = 6 ;



$tableau_col =['Etablissement','Chambre','Date de début','Date de fin','Prix','Annuler'];


// -------------- Nombre de nuit entre deux dates
if(!empty($date_debut) OR !empty($date_fin)){
   $truc1=new DateTime($date_debut[0]);
   $truc2=new DateTime($date_fin[0]);
   $interval = $truc1->diff($truc2);
   $daysbetween = $interval->days;}


//--------------------------------------

// -------------------------------------------------------
if(!empty($etablissement)){
$NbrData = sizeof($etablissement);}
else{
   $NbrData=0;
}

// -------------------------------------------------------
// calcul du nombre de lignes
if (round($NbrData/$NbrCol)!=($NbrData/$NbrCol)) {
   $NbrLigne = round(($NbrData/$NbrCol)+0.5);

} else {
   $NbrLigne = $NbrData/$NbrCol;

}


// -------------------------------------------------------
// affichage
if ($NbrData != 0) {
$k = 0;
echo '<div id="page-wrap">';
echo '<table class="table table-hover table-responsive table-striped">';

echo '<thead>';
echo '<tr>';
for ($i=0; $i<$NbrCol; $i++) {
   echo '<th class="event">';
         echo $tableau_col[$i];
    echo '</th>';}
echo '</tr>';
echo '</thead>';

for ($l=0; $l<1; $l++) {
   for ($j=0; $j<$NbrData; $j++) {
      if ($k<$NbrData) {
         echo '<form action="annuler.php" method="post">';
         if ($k%2==0){
            echo '<tr>';}

         echo '<td data-label="etablissement">';
          echo $etablissement[$k];
          echo "<input type='hidden' name='etablissement' value='$etablissement[$k]'";
         echo '</td>';  

         echo '<td data-label="chambre">';
         echo $chambre[$k];
         echo "<input type='hidden' name='chambre' value='$chambre[$k]'>";

         echo '</td>';

         echo '<td data-label="date_debut">';
         echo $date_debut[$k];
         echo "<input type='hidden' name='date_debut' value=$date_debut[$k]>";
         echo '</td>';

         echo '<td data-label="date_fin">';
         echo $date_fin[$k];
         echo "<input type='hidden' name='date_fin' value=$date_fin[$k]>";
         echo '</td>';

         echo '<td data-label="prix">';
         echo $prix[$k];
         echo "<input type='hidden' name='prix' value=$prix[$k]>";
         echo '</td>';


         echo '<td data-label="annuler">';
         echo '<input type="submit" class="btn btn-danger" value="Annuler">';
         echo '</td>';


         $k++;
         if ($k%2!=0){
            echo '</tr>';}

         echo '</form>';
      } else {    //  case vide
         echo '<td> </td>';
      }
   }

      echo '<div class=userpage style="margin-bottom:30px;">Les reservations sont faisables seulement 3 jours avant la date de votre réservation</div>';


   $j=1;
}
echo '</table>';
echo '</div>';
} else {
echo 'pas de données à afficher';
}



if($type=='admin'){

   $NbrDataAdmin = sizeof($nom);
   $NbrColAdmin=6;
   $tableau_coladmin =['Etablissement','Adresse','Ville','Description','Editer','Supprimer'];
   $k = 0;

   echo '<a href="create.php"><button type="button" class="btn btn-success createbutton">Créer un nouvel établissement</button></a>';
   
   echo '<div id="page-wrap">';
   echo '<table class="table table-hover table-responsive table-striped">';

  
   echo '<tr>';
   for ($i=0; $i<$NbrColAdmin; $i++) {
      echo '<th>';
            echo $tableau_coladmin[$i];
       echo '</th>';}
   echo '</tr>';
   
   
   for ($l=0; $l<1; $l++) {
      for ($j=0; $j<$NbrDataAdmin; $j++) {
         if ($k<$NbrDataAdmin) {
            echo '<form action="editadmin.php" method="post">';
            if ($k%2==0){
               echo '<tr>';}
   
               echo '<td>';
               echo $nom[$k];
               echo "<input type='hidden' name='nom' value='$nom[$k]'>";
               echo '</td>';  

               echo '<td>';
               echo $adresse[$k];
               echo "<input type='hidden' name='adresse' value='$adresse[$k]'>";
               echo '</td>';  


               echo '<td>';
               echo $ville[$k];
               echo "<input type='hidden' name='ville' value='$ville[$k]'>";
               echo '</td>';  

               echo '<td>';
               echo $description[$k];
               echo "<input type='hidden' name='description' value='$description[$k]'>";
               echo '</td>';  


               echo "<input type='hidden' name='idetablissement' value='$idetablissement[$k]'>";


               echo '<td>';
               echo '<input type="submit" class="btn btn-danger" value="Editer">';
               echo '</td>';
            
               echo '<td>';
               echo '<input formaction="deleteadmin.php" type="submit" class="btn btn-danger" value="Supprimer">';
               echo '</td>';
               
               $k++;
            if ($k%2!=0){
               echo '</tr>';}
   
         echo '</form>';
         } else {    //  case vide
            echo '<td> </td>';
         }
      }
   
   
      $j=1;
   }

   echo '</table>';
   echo '</div>';
}
?>

    </div>


<!-- Modal -->
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
            <input type="text" name='nom' class="form-control" placeholder="nom" value="<?php echo $nomuser?>" required autofocus>
        </div>

        <div class="form-group">
            <label>Prénom</label>
            <input type="text" name='prenom' class="form-control" placeholder="prenom" value="<?php echo $prenomuser?>" required>
        </div>


        <div class="form-group">
            <label>email</label>
            <input type="text" name='email' class="form-control" placeholder="email" value="<?php echo $emailuser?>" required>
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