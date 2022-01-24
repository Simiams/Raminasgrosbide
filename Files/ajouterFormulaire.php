<?php
$title = "Ajouter un Formulaire";
$admin_login = true;
include "header.php";
?>
    <div class="container">
        <h1>Ajouter un Formulaire</h1>

        <?php
        include_once "../Files/config.php";
        $pdo = new PDO("mysql:host=" . Config::SERVEUR . ";dbname=" . Config::BDD, Config::UTILIATEUR, Config::MOTDEPASSE);
        $requete = $pdo->prepare("select * from secteur");
        $requete->execute();
        $secteur = $requete->fetchAll();
        ?>

        <form action="../Actions/insertFomulaire.php" method="POST" enctype="multipart/form-data">
            <p>
                <label for="title">Changer le titre</label>
                <input type="text" name="title" class="form-control">
            </p>
            <p>
                Ajouter une image 1300x300
                <input type="file" name="image">
            </p>
            <p>
                <label for="description" class="required">Changer la description</label>
                <textarea name="description" class="form-control"></textarea>
            </p>
            <p>
                <label for="color" class="required">Changer la couleur primaire</label>
                <input type="color" name="color" class="form-control">
            </p>
            <p>
                <label for="color1" class="required">Changer la couleur secondaire</label>
                <input type="color" name="color1" class="form-control">
            </p>
            <p>
                <label for="ddb" class="required">Choisissez la date de début</label>
                <input type="date" name="ddb" class="form-control">
            </p>
            <p>
                <label for="ddf" class="required">Choisissez la date de fin</label>
                <input type="date" name="ddf" class="form-control">
            </p>


            <table class="table table-striped">
                    <tr>
                        <th>Selectioner les secteur d'activité</th>
                        <th></th>
                    </tr>
                    <?php
                    foreach ($secteur as $s) {
                        ?>
                            <tr>
                                <td>
                                    <label for="<?php echo $s["id"]?>">
                                            <input type="checkbox" id="<?php echo $s["id"]?>" name="gout[]" value="<?php echo $s["id"]?>"><?php echo $s["nom"]?>
                                    </label>
                                </td>
                                <td>
                                    <form action="../Actions/suprimerSecteurActivite.php" method="post">
                                        <input type="hidden" name="secteurSupr" value="<?php echo $s["id"]?>">
                                        <input type="submit" name="ok" value="Suprimer" class="btn btn-sm btn-danger">
                                    </form>
                                </td>
                            </tr>
                        <?php
                    }
                    ?>
            </table>
            <?php //On envoie l'id de l'utilisateur en cours ?>
            <input type="hidden" name="id_user" value="<?php echo $id_user?>">
            <input type="submit" value="OK" class="mt-2 btn btn-success">
        </form>

        <a href="ajouterSecteurActivite.php" class="btn btn-success">Modifier des secteur d'activité</a>
        <a href="Formulaire.php" class="btn btn-success">Prévisulalisé</a>
    </div>

<?php
include "footer.php";