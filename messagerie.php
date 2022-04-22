<?php
session_start();

require_once 'config.php'; // ajout connexion bdd 
   // si la session existe pas soit si l'on est pas connecté on redirige
    if(!isset($_SESSION['user'])){
        header('Location:index.php');
        die();
    }

    $req = $bdd->prepare('SELECT * FROM utilisateurs WHERE token = ?');
    $req->execute(array($_SESSION['user']));
    $data = $req->fetch();

    $nom=$data['nom'];
    $prenom=$data['prenom'];
    $email=$data['email'];
    $type=$data['type'];


    // On récupere les données de la messagerie
    $stmt = $bdd->prepare('SELECT * FROM messagerie');
    $stmt->execute();
    $data1 = $stmt->fetchAll(PDO::FETCH_ASSOC);


    foreach($data1 as $values){
      $nom_message[] = $values['nom'];
      $prenom_message[] = $values['prenom'];
      $email_message[] = $values['email'];
      $subject_message[] = $values['subject'];
      $message_message[] = $values['message'];
      $id_message[] = $values['id'];
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
                <a href="#" class="nav-link px-3">A PROPOS</a>
            </li>

            </ul class="nav navbar-nav">
            <ul class="nav navbar-nav justify-content-end">
            <li class="nav-item"><a href="page_utilisateurs.php"><i class="bi bi-person-circle"></i></a></li>
            </ul>
        </div>
        </nav>
        </header>

        <div class="messagerie">
          <p>Votre messagerie</p>
        </div>


<?php
    $NbrCol = 3 ;



$tableau_col =['Nom','Prénom','Sujet'];

// -------------------------------------------------------
if(!empty($nom_message)){
$NbrData = sizeof($nom_message);}
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
   echo '<th>';
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

            echo "<td class='clickable-row' data-href='messagerie.php?id=$id_message[$k]'>";
            echo $nom_message[$k];
            echo "<input type='hidden' name='etablissement' value='$nom_message[$k]'>";
            echo '</td>';

            echo "<td class='clickable-row' data-href='messagerie.php?id=$id_message[$k]'>";
            echo $prenom_message[$k];
            echo "<input type='hidden' name='chambre' value='$prenom_message[$k]'>";
            echo '</td>';

            echo "<td class='clickable-row' data-href='messagerie.php?id=$id_message[$k]'>";
            echo $subject_message[$k];
            echo "<input type='hidden' name='chambre' value='$subject_message[$k]'>";
            echo '</td>';

            $k++;
            if ($k%2!=0){
                echo '</tr>';}

            echo '</form>';
      }else {    //  case vide
         echo '<td> </td>';
      }
   }



   $j=1;
}
echo '</div>';
echo '</table>';
}


?>
 
  <!-- Modal -->
<!--<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Modal body text goes here.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>-->
<?php

if(isset($_GET['id'])){
$iden = htmlspecialchars($_GET['id']);
$count=count($id_message);
for($i=0; $i < $count; $i++){
switch($iden)
            {

                case"$id_message[$i]":
                    ?>
                    <div class="modal fade" id="myModal" role="dialog">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title"><?php echo $subject_message[$i] ?></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                              <h5>De : <?php echo $prenom_message[$i],' ',$nom_message[$i] ?></h5>
                              <h6>Email : <?php echo $email_message[$i]?></h6>
                              
                            <p><?php echo $message_message[$i]?></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php
                    break;
                }
            }
        }
?>

<script>
jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });
});

$("#myModal").modal({ show : true });
</script>

</body>
</html>
