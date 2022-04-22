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
$row = $req->fetch();


$id=$_POST['idetablissement'];
$id1 =(int)$id;

$donnee =$bdd->prepare("SELECT * FROM etablissement WHERE id =$id1");
$donnee->execute();
$bref=$donnee->fetchAll(PDO::FETCH_ASSOC);

foreach($bref as $values){
    $nom = $values['nom'];
    $adresse =  $values['adresse'];
    $ville = $values['ville'];
    $description =  $values['description'];
}

if(isset($_POST['new']) && $_POST['new']==1){
    //$id=$_REQUEST['id'];
    //$prenom = htmlspecialchars($_POST['prenom']);
    //$nom = htmlspecialchars($_POST['nom']);
    //$submittedby = $_SESSION["user"];
    $nom = $_POST['nom'];
    $adresse =  $_POST['adresse'];
    $ville = $_POST['ville'];
    $description =  $_POST['description'];
    $idetablissementstr = $_POST['id'];
    $idetablissement=(int)$idetablissementstr;

    var_dump($nom);
    
    $update=$bdd->prepare("UPDATE etablissement SET nom='".$nom."',description='".$description."',adresse='".$adresse."',ville='".$ville."' WHERE id=$idetablissement");
    $update->execute();
    header('Location: page_utilisateurs.php');
    }
    ?>
    <!DOCTYPE html>
    <html>
    <head>
    <meta charset="utf-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="style_reservation.php?v=<?php echo time(); ?>">
    </head>
    <body>
    <div>
    <form name="form" method="post" action="">

    <input type="hidden" name="new" value="1" />

    <input type="text" name="nom" placeholder="Entrer le Titre de la chambre" required value="<?php echo $nom;?>" />
    
    <input type="text" name="adresse" placeholde="Entrer l'adresse" required value="<?php echo $adresse;?>" />

    <input type="text" name="ville" placeholder="Entrer le prix" required value="<?php echo $ville;?>" />

    <input type="text" name="description" placeholder="Entrer la description" required value="<?php echo $description;?>" />

    <input type="hidden" name="id" value="<?php echo $id1;?>" />

    <input type="submit" value="Update" />
    </form>
    </div>
    </div>
    </body>
    </html>
