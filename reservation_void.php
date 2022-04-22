<?php
session_start();
    require_once 'config.php';



    // On récupere les données des etablissements
    $donnee =$bdd->prepare("SELECT nom FROM etablissement");
    $donnee->execute();
    $bref=$donnee->fetchAll(PDO::FETCH_ASSOC);

    foreach($bref as $values){
      $etablissement[]=$values['nom'];
    }

        // On récupere les données des suites
    $donnee1 =$bdd->prepare("SELECT titre FROM chambre");
    $donnee1->execute();
    $data1=$donnee1->fetchAll(PDO::FETCH_ASSOC);


    foreach($data1 as $values){
        $suite[]=$values['titre'];
      }





      if(isset($etablissement) AND isset($titre)){
      // On récupere les données des reservation par rapport au chambre qu'on veut reserver 
      $stmt =$bdd->prepare("SELECT date_debut,date_fin FROM reservation WHERE etablissement='$etablissement' AND chambre='$titre'");
      $stmt->execute();
      $data=$stmt->fetchAll();
      

      foreach($data as $values){
        $date_debut[] = $values['date_debut'];
        $date_fin[] =  $values['date_fin'];}
      }
        
        if(empty($date_debut)){
            $count=0;
            $test = NULL;
            
        }
        else{
        $count =count($date_debut);
        for ($i = 0; $i < $count; $i++) {
            $strdatedebut[]= strtotime($date_debut[$i]);
            $strdatefin[]= strtotime($date_fin[$i]);
            for($j = $strdatedebut[$i]; $j <= $strdatefin[$i]; $j+=86400){
            $test[]= date("j-n-Y",$j);}
            }}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <script src="C:\Users\clem8\Desktop\Studi\Dossier de projet\Hotelier\script.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <title>Document</title>
</head>

<body>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- Extension DATEPICKER -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <!-- Noyau JavaScript de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>

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
        


    <div class="container-fluid">
    <form action="reservation_traitement.php" method="post" class ="form-style">

        <input type="hidden" name='prix' value="<?php echo $prix ?>">

        <label for="etablissement">Entrer l'etablissement</label>
        <?php echo '<select class="form-select form-select-style" name="etablissement" id="etablissement">';
        for($i=0; $i<count($etablissement); $i++){
        echo '<option value='.$etablissement[$i].'>'.$etablissement[$i].'</option>';
        }
        echo '</select>';
        ?>

        <label for="suite">Entrer le nom de la suite</label>   
        <?php echo '<select class="form-select form-select-style" name="suite" id="suite">';
        for($i=0; $i<count($suite); $i++){
        echo '<option value='.$suite[$i].'>'.$suite[$i].'</option>';
        }
        echo '</select>';
        ?>
        <!--
        <div class="form-group form-group-style">
            <label>Entrer l'etablissement</label>
            <input type="text" name='etablissement' class="form-control" placeholder="date de départ" value="<?php if(isset($etablissement)){echo $etablissement;} ?>" required>
        </div>-->



        <div class="form-group form-group-style">
            <label>Veuillez choisir la date de départ</label>
            <div class="datepicker date input-group">
            <input type="text" autocomplete="false" name='date_debut' placeholder="Choisir la date de départ" class="form-control" id="reservationDate" required>

            <div class="input-group-append"><!--<span class="input-group-text px-4"><i class="fa fa-calendar"></i></span>--></div>
            </div>
        </div>


        <div class="form-group form-group-style">
            <label>Veuillez choisir la date de fin</label>
            <div class="datepicker date input-group">
            <input type="text" name='date_fin' placeholder="Choisir la date de fin" class="form-control" id="reservationDate" required>
            <div class="input-group-append"><!--<span class="input-group-text px-4"><i class="fa fa-calendar"></i></span>--></div>
            </div>
        </div>
        <?php
        if(isset($name)){
        $count1=count($test);
        for($i = 0; $i < $count1; $i++){
        echo "<input type='hidden' name='datereserved[]' value='".$test[$i]."'>";
        }
    }
        ?>
        <button type="submit" class="btn btn-primary button">Envoyé</button>
    </form>
    </div>
    <script>


var etab = document.getElementById("etablissement");
var suite = document.getElementById("suite")

function show(){
    var etab = document.getElementById("etablissement");
    var suite = document.getElementById("suite")

    var strUser = etab.options[etab.selectedIndex].text;
    var suite = suite.options[suite.selectedIndex].text;

    console.log(strUser);
    console.log(suite);
    
}

etab.onchange=show;
suite.onchange=show;

show();





var test =<?php echo json_encode($test);?>;
console.log(test)

var active_dates = test

//il faut faire une boucle pour le faire




$(".datepicker").datepicker({
     format: "dd/mm/yyyy",
     autoclose: true,
     todayHighlight: true,
     beforeShowDay: function(date){
         var d = date;
         var curr_date = d.getDate();
         var curr_month = d.getMonth() + 1; //Months are zero based
         var curr_year = d.getFullYear();
         var formattedDate = curr_date + "-" + curr_month + "-" + curr_year

           if ($.inArray(formattedDate, active_dates) != -1){
               return {
                  classes: 'activeClass'
               };
           }
          return;
      }
  });




//var e = document.getElementById("ddlViewBy");
//var strUser = e.options[e.selectedIndex].text;
//console.log(strUser);


 
</script>
</body>
</html>