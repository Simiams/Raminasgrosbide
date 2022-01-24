<?php
// Initialiser la session
session_start();
// Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
if (!isset($_SESSION["nom"])) {
    header("Location: /Projet_transversal/Files/Login/login.php");
    exit();
}
$id_user = $_SESSION["id"];
?>
    <!doctype html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">


        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
              crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
                crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/da7397688c.js" crossorigin="anonymous"></script>
        <!--permet d'avoir plein d'icone gratuitement-->
        <title><?php echo $title ?></title>
    </head>
<body>
<?php
if ($admin_login) {
    ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="Administrateur.php"><i class="fad fa-cat-space fa-3x"></i></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <?php
                    //Lister les categories qui sont dans la table categories
                    //crer un objet pdo pour se conectr a la bdd
                    include_once "config.php";
                    $pdo = new PDO("mysql:host=" . Config::SERVEUR . ";dbname=" . Config::BDD, Config::UTILIATEUR, Config::MOTDEPASSE);
                    //creation de la requete
                    $requete = $pdo->prepare("select * from form");
                    //executer la requete
                    $requete->execute();
                    $ligne = $requete->fetchAll();

                    foreach ($ligne as $l) {
                        ?>

                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" target="_blank"
                               href="../Files/Formulaire.php?id_formulaire=<?php echo $l["id"] ?>"><?php echo $l["titre"] ?></a>
                        </li>

                        <?php

                    }
                    ?>
                </ul>
            </div>
        </div>

        <a class="btn btn-sm btn-warning" aria-current="page" href="/Projet_transversal/Files/Login/logout.php">Déconnexion</a>

    </nav>
    <?php
}
?>