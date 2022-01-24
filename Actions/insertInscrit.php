<?php
//Il faudrait faire un token de securite, mais flemmeeeeeeeeeeeeeeee
//TODO antiforgerytoken
$prenom = filter_input(INPUT_POST, "first_name");
$nom = filter_input(INPUT_POST, "last_name");
$civilite = filter_input(INPUT_POST, "civilite");
$portable = filter_input(INPUT_POST, "phone");
$mail = filter_input(INPUT_POST, "email");
$statut = filter_input(INPUT_POST, "statut");
$entreprise = filter_input(INPUT_POST, "entreprise");

$secteurActivite = filter_input(INPUT_POST, "secteurActivite");

$nombrePeronne = filter_input(INPUT_POST, "nombrePersonne");
$rgpd_checkbox = filter_input(INPUT_POST, "rgpd");
$newsletter_checkbox = filter_input(INPUT_POST, "newsletter");
$id_formulaire = filter_input(INPUT_POST, "id_formulaire");

if ($rgpd_checkbox == "on"){
    $rgpd = True;
}else{
    $rgpd = False;
}
if ($newsletter_checkbox == "on"){
    $newsletter = True;
}else{
    $newsletter = False;
}


include_once "../Files/config.php";
$pdo = new PDO("mysql:host=" . Config::SERVEUR . ";dbname=" . Config::BDD, Config::UTILIATEUR, Config::MOTDEPASSE);


$requete = $pdo->prepare("insert into inscription(nom, prenom, civilite, statut, nom_entreprise, portable, mail, nombre_place, rgpd, newletter, id_secteur_activite) values(:nom, :prenom, :civilite, :statut, :entreprise, :portable, :mail, :nombrePersonne, :rgpd, :newsletter, :id_secteur_activite)");

$requete->bindParam(":nom", $nom);
$requete->bindParam(":prenom", $prenom);
$requete->bindParam(":civilite", $civilite);
$requete->bindParam(":statut", $statut);
$requete->bindParam(":entreprise", $entreprise);
$requete->bindParam(":portable", $portable);
$requete->bindParam(":mail", $mail);
$requete->bindParam(":nombrePersonne", $nombrePeronne);
$requete->bindParam(":rgpd", $rgpd);
$requete->bindParam(":newsletter", $newsletter);
$requete->bindParam(":id_secteur_activite", $secteurActivite);

$requete->execute();


echo $secteurActivite;
$redirection = "location: ../Files/Formulaire.php?id_formulaire=".$id_formulaire;
header($redirection);