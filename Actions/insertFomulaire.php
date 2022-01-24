<?php
//Il faudrait faire un token de securite, mais flemmeeeeeeeeeeeeeeee
//TODO antiforgerytoken
$titre = filter_input(INPUT_POST, "title");
$description = filter_input(INPUT_POST, "description");
$couleur = filter_input(INPUT_POST, "color");
$couleur1 = filter_input(INPUT_POST, "color1");
$date_debut = filter_input(INPUT_POST, "ddb");
$date_fin = filter_input(INPUT_POST, "ddf");
$id_user = filter_input(INPUT_POST, "id_user");

//Image
$cheminDuFichierDeDestination = "../Images/" . basename($_FILES["image"]["name"]);
move_uploaded_file($_FILES["image"]["tmp_name"], $cheminDuFichierDeDestination);
$image = $_FILES["image"]["name"];

include_once "../Files/config.php";
$pdo = new PDO("mysql:host=" . Config::SERVEUR . ";dbname=" . Config::BDD, Config::UTILIATEUR, Config::MOTDEPASSE);


$requete = $pdo->prepare("insert into form(titre, image, description, date_debut, date_fin, couleur, couleur1, id_login) values(:titre, :image, :description, :date_debut, :date_fin, :couleur, :couleur1, :id_user)");
$requete->bindParam(":titre", $titre);
$requete->bindParam(":image", $image);
$requete->bindParam(":description", $description);
$requete->bindParam(":couleur", $couleur);
$requete->bindParam(":couleur1", $couleur1);
$requete->bindParam(":date_debut", $date_debut);
$requete->bindParam(":date_fin", $date_fin);
$requete->bindParam(":id_user", $id_user);
$requete->execute();

//On ajoute a la table association

//Lister les categories qui sont dans la table categories
$requete = $pdo->prepare("select * from form");
$requete->execute();
$form = $requete->fetchAll();

$requete = $pdo->prepare("select * from secteur");
$requete->execute();
$secteur = $requete->fetchAll();

//On stocke l'id du formulaire actuelle (le dernier)
$dernier_form_id = 0;
foreach ($form as $f) {
    if ($dernier_form_id < $f["id"]) {
        $dernier_form_id = $f["id"];
    }
}
echo $dernier_form_id;

//On prepare la requete pour qui ajoute a association
$requete = $pdo->prepare("insert into association(id_form, id_secteur_activite) values(:id_form, :id_secteur_activite)");

if (isset($_POST['gout'])) {
    foreach ($_POST['gout'] as $valeur) {
        echo $valeur;
        $requete->bindParam(":id_form", $dernier_form_id);
        $requete->bindParam(":id_secteur_activite", $valeur);
        $requete->execute();
    }
}


header("location: ../Files/Administrateur.php");