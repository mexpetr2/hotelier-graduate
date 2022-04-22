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

    <div class="container-fluid">
    <?php
        if(isset($_GET['reg_err']))
        {
            $err = htmlspecialchars($_GET['reg_err']);

            switch($err)
            {

                case'success':
                    ?>
                    <div class="alert alert-sucess">
                        <strong>Succès</strong> Inscription réussis !
                    </div>
                    <?php
                    break;


                case'password':
                    ?>
                    <div class="alert alert-danger">
                        <strong>Erreur</strong> Mot de passe incorrect
                    </div>
                    <?php
                    break;

                case'email':
                        ?>
                        <div class="alert alert-danger">
                            <strong>Erreur</strong> email incorrect
                        </div>
                        <?php
                        break;

                case'email_lenght':
                        ?>
                        <div class="alert alert-danger">
                            <strong>Erreur</strong> email trop long
                        </div>
                        <?php
                        break;

                    case'pseudo_lenght':
                        ?>
                        <div class="alert alert-danger">
                            <strong>Erreur</strong> pseudo trop long
                        </div>
                        <?php
                        break;

                case'already':
                        ?>
                        <div class="alert alert-danger">
                            <strong>Erreur</strong> compte existant
                        </div>
                        <?php
                        break;
            }
        }
        ?>
    <form action="inscription_traitement.php" class='form-style' method="post">

        <div class="form-group form-group-style">
            <label>Entrer votre prénom</label>
            <input type="text" name='prenom' class="form-control" placeholder="prenom" required autofocus>
        </div>

        <div class="form-group form-group-style">
            <label>Entrer votre nom</label>
            <input type="text" name='nom' class="form-control" placeholder="nom" required>
        </div>

        <div class="form-group form-group-style">
            <label>Entrer votre adresse mail</label>
            <input type="email" name='email' class="form-control" placeholder="E-mail" required>
        </div>

        <div class="form-group form-group-style">
            <label>Entrer votre mot de passe</label>
            <input type="password" name='password' class="form-control" placeholder="mot de passe" required>
        </div>
            <input type='hidden' name='type' value='user'>
        <div class="form-group form-group-style">
            <label>Entrer votre mot de passe</label>
            <input type="password" name='password_retype' class="form-control" placeholder="Retaper votre mot de passe" required>
        </div>

        <button type="submit" class="btn btn-primary button">Envoyé</button>
    </form>
    </div>
</body>
</html>