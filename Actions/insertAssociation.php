<?php
//Il faudrait faire un token de securite, mais flemmeeeeeeeeeeeeeeee
//TODO antiforgerytoken
$titre=filter_input(INPUT_POST, "title");
$description=filter_input(INPUT_POST, "description");
$couleur=filter_input(INPUT_POST, "color");
$couleur1=filter_input(INPUT_POST, "color1");
$date_debut=filter_input(INPUT_POST, "ddb");
$date_fin=filter_input(INPUT_POST, "ddf");

//Image
$cheminDuFichierDeDestination = "../Images/".basename($_FILES["image"]["name"]);
move_uploaded_file($_FILES["image"]["tmp_name"], $cheminDuFichierDeDestination);
$image = $_FILES["image"]["name"];

include_once "../Files/config.php";
$pdo = new PDO("mysql:host=".Config::SERVEUR.";dbname=".Config::BDD, Config::UTILIATEUR, Config::MOTDEPASSE);


$requete=$pdo->prepare("insert into form(titre, image, description, date_debut, date_fin, couleur, couleur1) values(:titre, :image, :description, :date_debut, :date_fin, :couleur, :couleur1)");
$requete->bindParam(":titre", $titre);
$requete->bindParam(":image", $image);
$requete->bindParam(":description", $description);
$requete->bindParam(":couleur", $couleur);
$requete->bindParam(":couleur1", $couleur1);
$requete->bindParam(":date_debut", $date_debut);
$requete->bindParam(":date_fin", $date_fin);
$requete->execute();

header("location: ../Files/Administrateur.php");