<?php
$title = "Ajouter Secteur Activite";
$admin_login = true;
include "header.php";
#LISTER TOUT LES SECTEUR D'ACTIVITE
?>
    <div class="container">
        <?php
        //Lister les categories qui sont dans la table categories
        //crer un objet pdo pour se conectr a la bdd
        include_once "../Files/config.php";
        $pdo = new PDO("mysql:host=" . Config::SERVEUR . ";dbname=" . Config::BDD, Config::UTILIATEUR, Config::MOTDEPASSE);
        //creation de la requete
        $requete = $pdo->prepare("select * from secteur");
        //executer la requete
        $requete->execute();
        $ligne = $requete->fetchAll();
        ?>

        <p>Tout le secteur d'activité disponnible, selectionner ceux que vous voulez</p>
        <p>Tout cocher bouton</p>
        <table class="table table-striped">
            <tr>
                <th>Secteur</th>
                <th></th>
            </tr>
            <?php
            foreach ($ligne as $l) {
                ?>
                <tr>
                    <td>
                        <form action="../Actions/selectionnerSecteurActivite.php" method="post">
                            <input type="checkbox" id="<?php echo $l["id"]?>" name="<?php echo $l["id"]?>" class="btn btn-outline-secondary">
                            <label for="<?php echo $l["id"]?>"><?php echo $l["nom"]?></label>
                        </form>
                    </td>
                    <td>
                        <form action="../Actions/suprimerSecteurActivite.php" method="post" style="float: right; padding-right: 20px">
                            <input type="hidden" name="secteurSupr" value="<?php echo $l["id"]?>">
                            <input type="submit" name="ok" value="Suprimer" class="btn btn-sm btn-danger">
                        </form>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>

    <div class="container">
        <h1>Ajouter un secteur d'activité</h1>
        <form action="../Actions/insertSecteurActivite.php" method="POST">
            <div class="form-group">
                <label for="secteur">Nom du secteur d'activité </label>
                <input type="text" name="secteur" class="from-control">
            </div>
            <input type="submit" value="OK" class="mt-2 btn btn-success">
        </form>
        <a href="../Files/ajouterFormulaire.php" class="btn btn-success">Revenir a la creation de son formulaire</a>
    </div>

<?php
include "footer.php";