<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
<?php
require('Config-login.php');
session_start();

if (isset($_POST['nom'])){
    $username = stripslashes($_REQUEST['nom']);
    $username = mysqli_real_escape_string($conn, $username);
    $password = stripslashes($_REQUEST['mdp']);
    $password = mysqli_real_escape_string($conn, $password);
    $query = "SELECT * FROM `login` WHERE nom='$username' and mdp='".hash('sha256', $password)."'";
    $result = mysqli_query($conn,$query) or die(mysql_error());
    $rows = mysqli_num_rows($result);

    //On cherche l'id de l'user
    $pdo = new PDO("mysql:host=" . Config::SERVEUR . ";dbname=" . Config::BDD, Config::UTILIATEUR, Config::MOTDEPASSE);
    //creation de la requete
    $requete = $pdo->prepare("SELECT * FROM `login` WHERE nom='$username' and mdp='".hash('sha256', $password)."'");
    //executer la requete
    $requete->execute();
    $user = $requete->fetchAll();
    foreach ($user as $u) {
        $id_user = $u["id"];
    }

    if($rows==1){
        $_SESSION['nom'] = $username;
        $_SESSION['id'] = $id_user;
        header("Location: ../Administrateur.php");
    }else{
        $message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
    }
}
?>
<form class="box" action="" method="post" name="login">
    <h1 class="box-logo box-title"><a href="https://waytolearnx.com/">WayToLearnX.com</a></h1>
    <h1 class="box-title">Connexion</h1>
    <input type="text" class="box-input" name="nom" placeholder="Nom d'utilisateur">
    <input type="password" class="box-input" name="mdp" placeholder="Mot de passe">

    <input type="submit" value="Connexion " name="submit" class="box-button">
    <p class="box-register">Vous êtes nouveau ici? <a href="register.php">S'inscrire</a></p>
    <?php if (! empty($message)) { ?>
        <p class="errorMessage"><?php echo $message; ?></p>
    <?php } ?>
</form>
</body>
</html>