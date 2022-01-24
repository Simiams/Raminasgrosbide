<?php
$title = "Raminogrosporcs";
$admin_login = true;
include "Header.php";
?>
<table class="from">
        <tr><td class="btn btn-sm btn-danger">Faire un truc en mode "Vous ete inscrit" (un affichage dans insertinscrit qui ure peu de temp???)</td></tr>
        <tr><td class="btn btn-sm btn-danger">En cliquant sur le bouton "lien", ca copie le lien</td></tr>
        <tr><td class="btn btn-sm btn-danger">Changer le header (logo, style)</td></tr>
        <tr><td class="btn btn-sm btn-danger">Ahouterun footer</td></tr>
        <tr><td class="btn btn-sm btn-danger">Tableau des inscrit qui est triable en mode parnom/par num...</td></tr>
        <tr><td class="btn btn-sm btn-danger">Tout commenter</td></tr>
        <tr><td class="btn btn-sm btn-danger">Token de securité</td></tr>
        <tr><td class="btn btn-sm btn-danger">Quand suprime formulaire, suprime image</td></tr>
        <tr><td class="btn btn-sm btn-danger">Stylisé login et regiter</td></tr>
        <tr><td class="btn btn-sm btn-danger">stylisé login</td></tr>
</table>

    <div class="container">
        <h1>Gestion des Formulaires</h1>
        <?php
        include_once "config.php";
        $pdo = new PDO("mysql:host=" . Config::SERVEUR . ";dbname=" . Config::BDD, Config::UTILIATEUR, Config::MOTDEPASSE);
        $requete = $pdo->prepare("select * from form where id_login = '$id_user'");
        $requete->execute();
        $ligne = $requete->fetchAll();
        ?>


        <a href="ajouterFormulaire.php" class="btn btn-success">Ajouter un formulaire</a>
        <a href="Inscription.php" class="btn btn-success">Toute les insciprtion</a>

        <table class="table table-striped">
            <tr>
                <th>Formulaire</th>
                <th>Date debut</th>
                <th>Date fin</th>
                <th>Lien</th>
                <th></th>
                <th></th>
            </tr>
            <?php
            foreach ($ligne as $l) {
                ?>
                <tr>
                    <td>
                        <form action="../Files/Formulaire.php" method="post">
                            <input type="hidden" name="id_formulaire" value="<?php echo $l["id"] ?>">
                            <input type="submit" name="ok" value="<?php echo $l["titre"] ?>" class="btn btn-primary">
                        </form>
                    </td>

                    <td><?php echo $l["date_debut"] ?></td>
                    <td><?php echo $l["date_fin"] ?></td>

                    <td>
                        <a class="btn btn-primary" aria-current="page" target="_blank"
                           href="../Files/Formulaire.php?id_formulaire=<?php echo $l["id"] ?>">lien</a></td>
                    <td>
                        Faire en POST
                        <a href="modifierFormulaire.php?id_formulaire=<?php echo $l["id"] ?>" class="btn btn-sm btn-warning">Modifier</a>
                    </td>

                    <td>
                        <form action="../Actions/suprimerFormulaire.php" method="post">
                            <input type="hidden" name="formulaireSupr" value="<?php echo $l["id"] ?>">
                            <input type="submit" name="ok" value="Suprimer" class="btn btn-sm btn-danger">
                        </form>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
<?php
include "Footer.php";
?>