<?php
header('content-type: text/css');
ob_start('ob_gzhandler');
header('Cache-Control: max-age=31536000, must-revalidate');

$id_formulaire = 41;
include_once "../Files/config.php";
$pdo = new PDO("mysql:host=".Config::SERVEUR.";dbname=".Config::BDD, Config::UTILIATEUR, Config::MOTDEPASSE);
$requete = $pdo->prepare("select * from form where id = '$id_formulaire'");
$requete->execute();
$form = $requete->fetchAll();

$couleur_primaire= $form["couleur"];
$couleur_secondaire= $form["couleur1"];
echo $couleur_secondaire;

?>

.formulaire_style{
    color: red;
    display: block;
    width: 100%;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    background-color: <?php echo $couleur_primaire?>;
    border: 1px solid <?php echo $couleur_secondaire?>;
    background-clip: padding-box;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: 0.25rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}