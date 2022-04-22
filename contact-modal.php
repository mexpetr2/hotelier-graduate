<?php

require_once 'config.php';

$req = $bdd->prepare('SELECT * FROM utilisateurs WHERE token = ?');
$req->execute(array($_SESSION['user']));
$data = $req->fetch();

$nomuser=$data['nom'];
$prenomuser=$data['prenom'];
$emailuser=$data['email'];
$type=$data['type'];


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