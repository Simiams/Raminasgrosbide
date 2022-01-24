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


$secteurSupr = filter_input(INPUT_POST, "secteurSupr"); #filtre les info entrée dans la requete

echo $secteurSupr;
$requete = $pdo->prepare("delete from secteur where id = '$secteurSupr'");
$requete->execute();
$secteur = $requete->fetchAll();


//je retourne à affichage du dossier
header("location: ../Files/ajouterFormulaire.php");
?>