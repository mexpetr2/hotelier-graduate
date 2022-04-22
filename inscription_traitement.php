<?php 
    require_once 'config.php'; // On inclu la connexion à la bdd

    // Si les variables existent et qu'elles ne sont pas vides
    if(!empty($_POST['prenom']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password_retype']))
    {
        // Patch XSS
        $prenom = htmlspecialchars($_POST['prenom']);
        $nom = htmlspecialchars($_POST['nom']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $password_retype = htmlspecialchars($_POST['password_retype']);
        $type = htmlspecialchars("user");
        var_dump($prenom);
        var_dump($type);

        // On vérifie si l'utilisateur existe
        $check = $bdd->prepare('SELECT prenom, nom, email, password,token FROM utilisateurs WHERE email = ?');
        $check->execute(array($email));
        $data = $check->fetch();
        $row = $check->rowCount();


        //On récupère les données des utilisateurs
        $check1 = $bdd->prepare('SELECT prenom, nom, email, password,token FROM utilisateurs');
        $check1->execute();
        $data1 = $check1->fetchAll(PDO::FETCH_ASSOC);

        $token=rand(1,99999999999);

        foreach($data1 as $values){
            $tokenuser[]=$values['token'];
        }

        for($i=0; $i<count($tokenuser);$i++){
            if($token=$tokenuser[$i]){
            $token=rand(1,99999999999);
        }
    }



        $email = strtolower($email); // on transforme toute les lettres majuscule en minuscule pour éviter que Foo@gmail.com et foo@gmail.com soient deux compte différents ..
        
        // Si la requete renvoie un 0 alors l'utilisateur n'existe pas 
        if($row == 0){ 
            if(strlen($prenom) <= 100){ // On verifie que la longueur du pseudo <= 100
                if(strlen($email) <= 100){ // On verifie que la longueur du mail <= 100
                    if(filter_var($email, FILTER_VALIDATE_EMAIL)){ // Si l'email est de la bonne forme
                        if($password === $password_retype){ // si les deux mdp saisis sont bon

                            // On hash le mot de passe avec Bcrypt, via un coût de 12
                            $cost = ['cost' => 12];
                            $password = password_hash($password, PASSWORD_BCRYPT, $cost);
                            $token = 
                            
                            // On stock l'adresse IP
                            //$ip = $_SERVER['REMOTE_ADDR']; 
                             /*
                              ATTENTION
                              Verifiez bien que le champs token est présent dans votre table utilisateurs, il a été rajouté APRÈS la vidéo
                              le .sql est dispo pensez à l'importer ! 
                              ATTENTION
                            */
                            // On insère dans la base de données
                            $insert = $bdd->prepare('INSERT INTO utilisateurs(prenom, nom, email, password, token,type) VALUES("'.$prenom.'", "'.$nom.'", "'.$email.'", "'.$password.'", "'.$token.'","'.$type.'")');
                            $insert->execute();
                            // On redirige avec le message de succès
                            header('Location:inscription.php?reg_err=success');die();
                        }else{ header('Location: inscription.php?reg_err=password'); die();}
                    }else{ header('Location: inscription.php?reg_err=email'); die();}
                }else{ header('Location: inscription.php?reg_err=email_length'); die();}
            }else{ header('Location: inscription.php?reg_err=pseudo_length'); die();}
        }else{ header('Location: inscription.php?reg_err=already'); die();}
    }
