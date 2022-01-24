<?php

/*
session_start();
//VERIF TOKEN
$token=filter_input(INPUT_POST, "token");
if ($_SESSION["token"] != $token){
    die("tu essaie de me pirate ????");
}*/
//Lister les categories qui sont dans la table categories
//crer un objet pdo pour se conectr a la bdd
include_once "../Files/config.php";
$pdo = new PDO("mysql:host=" . Config::SERVEUR . ";dbname=" . Config::BDD, Config::UTILIATEUR, Config::MOTDEPASSE);


$formulaireSupr = filter_input(INPUT_POST, "formulaireSupr"); #filtre les info entrée dans la requete
echo $formulaireSupr;
$requete = $pdo->prepare("delete from form where id = '$formulaireSupr'");
$requete->execute();
//$secteur = $requete->fetchAll();


//je retourne à affichage du dossier
header("location: ../Files/Administrateur.php");
?>