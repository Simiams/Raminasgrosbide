<?php
//Il faudrait faire un token de securite, mais flemmeeeeeeeeeeeeeeee
//TODO antiforgerytoken
$nom = filter_input(INPUT_POST, "secteur");

include_once "../Files/config.php";
$pdo = new PDO("mysql:host=" . Config::SERVEUR . ";dbname=" . Config::BDD, Config::UTILIATEUR, Config::MOTDEPASSE);
$requete = $pdo->prepare("insert into secteur(nom) values(:nom)");


$requete->bindParam(":nom", $nom);
$requete->execute();

header("location: ../Files/ajouterSecteurActivite.php");