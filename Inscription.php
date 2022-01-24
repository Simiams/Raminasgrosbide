<?php
$title = "Gestion des chachatonton";
$admin_login = true;
include "Header.php";

include_once "config.php";
$pdo = new PDO("mysql:host=" . Config::SERVEUR . ";dbname=" . Config::BDD, Config::UTILIATEUR, Config::MOTDEPASSE);
$requete = $pdo->prepare("select * from inscription");
$requete->execute();
$inscrit = $requete->fetchAll();
?>
<div class="container">
    <table class="table table-striped">
        <tr>
            <th>Prenom</th>
            <th>Nom</th>
            <th>Civilite</th>
            <th>statut</th>
            <th>nom de l'entreprise</th>
            <th>tel</th>
            <th>mail</th>
            <th>nombre place</th>
            <th>rgpd</th>
            <th>newsletter</th>
            <th>secteur activite</th>
        </tr>
        <?php
        foreach ($inscrit as $i) {
            ?>
            <tr>
                <td><?php echo $i["prenom"] ?></td>
                <td><?php echo $i["nom"] ?></td>
                <td><?php echo $i["civilite"] ?></td>
                <td><?php echo $i["statut"] ?></td>
                <td><?php echo $i["nom_entreprise"] ?></td>
                <td><?php echo $i["portable"] ?></td>
                <td><?php echo $i["mail"] ?></td>
                <td><?php echo $i["nombre_place"] ?></td>
                <td><?php echo $i["rgpd"] ?></td>
                <td><?php echo $i["newletter"] ?></td>
                <td><?php echo $i["id_secteur_activite"] ?></td>
            </tr>
            <?php
        }
        ?>
    </table>
</div>
