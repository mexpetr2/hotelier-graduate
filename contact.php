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
    $data = $req->fetchAll(PDO::FETCH_ASSOC);  

    foreach($data as $values){
        $nom=$values['nom'];
        $prenom=$values['prenom'];
        $email=$values['email'];
    }



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
    

        
        $insert=$bdd->prepare("INSERT INTO messagerie (`nom`, `prenom`, `email`, `subject`, `message`) VALUES ('$nom','$prenom','$email','$subject','$message')");
        $insert->execute();
        header('Location: page_utilisateurs.php');
        }
?>

<!DOCTYPE html>
    <html>
    <head>
    <meta charset="utf-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="style_reservation.php?v=<?php echo time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body>
        <form action="" method="post">

        

                <input type="hidden" name="new" value="1" />
                <div class="form-group">
                    <label>Nom</label>
                    <input type="text" name='nom' class="form-control" placeholder="nom" value="<?php echo $nom?>" required autofocus>
                </div>

                <div class="form-group">
                    <label>Prénom</label>
                    <input type="text" name='prenom' class="form-control" placeholder="prenom" value="<?php echo $prenom?>" required>
                </div>


                <div class="form-group">
                    <label>email</label>
                    <input type="text" name='email' class="form-control" placeholder="email" value="<?php echo $email?>" required>
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
                    <input type="text" name='message' class="form-control" placeholder="message" required autofocus>
                </div>

                <input type="submit" class="btn btn-success" value="Envoyé le message">
    </body>
</html>
