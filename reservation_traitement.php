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


        $Currentdate = date('d-m-Y', time()); 
        $datereserver =$_POST['datereserved'];





        if(isset ($_POST['date_debut']) and ($_POST['date_fin'])){

            $date1 = strtr($_POST['date_debut'], '/', '-');
            $date_debut = date('Y-m-d', strtotime($date1));
            $date2 = strtr($_POST['date_fin'], '/', '-');
            $date_fin = date('Y-m-d', strtotime($date2));

  
                $strdatedebut= strtotime($date_debut);
                $strdatefin= strtotime($date_fin);
                for($j = $strdatedebut; $j <= $strdatefin; $j+=86400){
                $interval[]= date("j-n-Y",$j);}
                

                //var_dump($datereserver);
                //print_r('Autre date');
                //var_dump($interval);
                $countintersect=count(array_intersect($datereserver,$interval));           
                
 
        if($countintersect==0){
           if(strtotime($date_debut) < strtotime($date_fin)){
               if(strtotime($date_debut) >= strtotime($Currentdate)){


        $prixnight = $_POST['prix'];
        $etablissement= $_POST['etablissement'];
        $chambre= $_POST['chambre'];

        $token=$data['token'];


        //Calcul du nombre de nuit passer dans la chambre
        $truc1=new DateTime($date_debut);
        $truc2=new DateTime($date_fin);
        $interval = $truc1->diff($truc2);
        $daysbetween = $interval->days;

        $prix = $prixnight*$daysbetween;


        $sql = "INSERT INTO reservation(etablissement,chambre,date_debut,date_fin,prix,token) VALUES (:etablissement,:chambre,:date_debut,:date_fin,:prix,:token)";
        $stmt = $bdd->prepare($sql);

        $stmt->execute(['etablissement'=>$etablissement,'chambre'=>$chambre,'date_debut'=>$date_debut,'date_fin' => $date_fin,'prix'=>$prix,'token'=>$token]);
        header('Location:landing.php'); 
            }else{
                echo '<div class="bg"> Veuillez une date de debut valable</div>';
            }

        }else{
            echo '<div class="bg"> Veuillez une date de debut superieur à la date de fin</div>';
        }
    }else{
        echo '<div class="bg"> Ces dates sont deja réservé</div>';
    }
}
