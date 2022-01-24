<?php
include_once "../Files/config.php";
$pdo = new PDO("mysql:host=" . Config::SERVEUR . ";dbname=" . Config::BDD, Config::UTILIATEUR, Config::MOTDEPASSE);

$id_formulaire_post = filter_input(INPUT_POST, "id_formulaire");
$id_formulaire_get = filter_input(INPUT_GET, "id_formulaire");

//Recupere le formualeir
$requete = $pdo->prepare("select * from form where id = '$id_formulaire_post' OR id='$id_formulaire_get'");
$requete->execute();
$form = $requete->fetchAll();

//Recupere les secteur d'activité du formulaire (table association)
$requete_association = $pdo->prepare("select * from association where id_form = '$id_formulaire_post' OR id_form='$id_formulaire_get'");
$requete_association->execute();
$association = $requete_association->fetchAll();

//Si l'utilisateur accede au formulaire par le post, c'est un admni, on affiche le header, sinon c'est un inscrit et pas de header
foreach ($form as $f) {
    $title = $f["titre"];
}
if ($id_formulaire_post != "") {
    $admin_login = true;
} else {
    $admin_login = false;
}
include "header.php";
?>
    <div class="container">
        <?php
        foreach ($form as $f) {
            ?>
            <img src="<?php echo "../Images/" . $f["image"] ?>" width="1300" height="300">
            <h2><?php echo $f["titre"] ?></h2>
            <p><?php echo $f["description"] ?></p>
            <p>Du <?php echo $f["date_debut"] ?> au <?php echo $f["date_fin"] ?></p>
            <?php
            $couleur_primaire = $f["couleur"];
            $couleur_secondaire = $f["couleur1"];
        }
        ?>


        <form method="POST" action="../Actions/insertInscrit.php">
            <p>
                <label for="first_name" class="required">Prénom</label>
                <input type="text" id="first_name" name="first_name" class="form-control"
                       style="
                               background-color: <?php echo $couleur_primaire ?>;
                               border: 2px solid <?php echo $couleur_secondaire ?>;
                               ">
            </p>
            <p>
                <label for="last_name" class="required">Nom</label>
                <input type="text" id="last_name" name="last_name" class="form-control"
                       style="
                               background-color: <?php echo $couleur_primaire ?>;
                               border: 2px solid <?php echo $couleur_secondaire ?>;
                               ">
            </p>
            <p>
                <label for="civilite">Civilité</label>
                <select id="civilite" name="civilite" class="form-control"
                        style="
                                background-color: <?php echo $couleur_primaire ?>;
                                border: 2px solid <?php echo $couleur_secondaire ?>;
                                ">
                    <option>Mr.</option>
                    <option>Mme.</option>
                    <option>Abrosexuel</option>
                    <option>Agenre</option>
                    <option>Allié·e hétérosexuel·e</option>
                    <option>Allosexuel</option>
                    <option>Androgyne</option>
                    <option>Apogenre</option>
                    <option>Aporagenre</option>
                    <option>Aromantique</option>
                    <option>Asexuel</option>
                    <option>Auto-identifié</option>
                    <option>Bear</option>
                    <option>Bicurieux</option>
                    <option>Binaire</option>
                    <option>Bisexuel</option>
                    <option>Bispirituel</option>
                    <option>Cisgenre</option>
                    <option>Coming out</option>
                    <option>Cuir</option>
                    <option>Demifille</option>
                    <option>Demigarçon</option>
                    <option>Demi-non-binaire</option>
                    <option>Demisexuel</option>
                    <option>Détransition</option>
                    <option>Dysphorasexuel</option>
                    <option>Dysphorie de genre</option>
                    <option>Famille homoparentale</option>
                    <option>Fat fetish</option>
                    <option>Fluide</option>
                    <option>Gai</option>
                    <option>Genderfluid</option>
                    <option>Genderqueer</option>
                    <option>Genre neutre</option>
                    <option>Genre variant</option>
                    <option>Graysexuel</option>
                    <option>Hétérosexisme</option>
                    <option>Hétérosexuel</option>
                    <option>Homoflexible</option>
                    <option>Homoparentalité</option>
                    <option>Homosexuel</option>
                    <option>Hypersexuel</option>
                    <option>Hyposexuel</option>
                    <option>Identité de genre</option>
                    <option>Identité sexuelle</option>
                    <option>Intersexe</option>
                    <option>Lesbienne</option>
                    <option>LGBT</option>
                    <option>LGBTQ+</option>
                    <option>LGBTQI+</option>
                    <option>LGBTQIA+</option>
                    <option>LGBTQQI2SAA</option>
                    <option>LGBTphobe</option>
                    <option>Maverique</option>
                    <option>Multisexuel</option>
                    <option>Non-binaire</option>
                    <option>Non-identifié</option>
                    <option>Omnisexuel</option>
                    <option>Orientation sexuelle</option>
                    <option>Outing</option>
                    <option>Pansexuel</option>
                    <option>Polyamour</option>
                    <option>Polyandrie</option>
                    <option>Polygamie</option>
                    <option>Polygynie</option>
                    <option>Polysexuel</option>
                    <option>Queer</option>
                    <option>Questionnement</option>
                    <option>Quoigenre</option>
                    <option>Saphisme</option>
                    <option>Trans</option>
                    <option>Transgenre</option>
                    <option>Transexuel</option>
                    <option>Transition</option>
                    <option>Autre ?(+)</option>
                </select>
            </p>
            <p>
                <label for="phone" class="required">N° de téléphone</label>
                <input type="text" id="phone" name="phone" class="form-control"
                       style="
                               background-color: <?php echo $couleur_primaire ?>;
                               border: 2px solid <?php echo $couleur_secondaire ?>;
                               ">
            </p>
            <p>
                <label for="email" class="required">Email</label>
                <input type="email" id="email" name="email" class="form-control"
                       style="
                               background-color: <?php echo $couleur_primaire ?>;
                               border: 2px solid <?php echo $couleur_secondaire ?>;
                               ">
            </p>
            <p>
                <label for="statut" class="required">Statut</label>
                <input type="text" id="subject" name="statut" class="form-control"
                       style="
                               background-color: <?php echo $couleur_primaire ?>;
                               border: 2px solid <?php echo $couleur_secondaire ?>;
                               ">
            </p>
            <p>
                <label for="entreprise" class="required">Nom de l'entreprise</label>
                <input name="entreprise" id="textarea" rows="5" class="form-control"
                       style="
                               background-color: <?php echo $couleur_primaire ?>;
                               border: 2px solid <?php echo $couleur_secondaire ?>;
                               ">
            </p>
            <p>

                <label for="secteurActivite" class="required">Secteur d'activité</label>
                <select id="civilite" name="secteurActivite" class="form-control"
                        style="
                                background-color: <?php echo $couleur_primaire ?>;
                                border: 2px solid <?php echo $couleur_secondaire ?>;
                                ">
                    <?php
                    //Recupere les secteur d'activité qui coresponde au form
                    foreach ($association as $a) {
                        $id_secteur_activite = $a["id_secteur_activite"];
                        $requete_secteur = $pdo->prepare("select * from secteur where id = '$id_secteur_activite'");
                        $requete_secteur->execute();
                        $secteur = $requete_secteur->fetchAll();
                        foreach ($secteur as $s){
                            ?>
                            <option value="<?php echo $s["id"] ?>"><?php echo $s["nom"] ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </p>
            <p>
                <label for="nombrePersonne" class="required">Nombre de personne</label>
                <input type="number" id="nombrePersonne" name="nombrePersonne" min="0" max="10" class="form-control"
                       style="
                               background-color: <?php echo $couleur_primaire ?>;
                               border: 2px solid <?php echo $couleur_secondaire ?>;
                               ">
            </p>
            <p>
                <input type="checkbox" id="rgpd" name="rgpd">
                <label for="rgpd">RGPD</label>
            </p>
            <p>
                <input type="checkbox" id="newsletter" name="newsletter">
                <label for="newsletter">NEWSLETTER</label>
            </p>

            <p>
                <?php
                if ($id_formulaire_get != "") {
                    ?>
                    <input type="hidden" name="id_formulaire" value="<?php echo $id_formulaire_get ?>"
                           class="btn btn-primary">
                    <?php
                } else {
                    ?>
                    <input type="hidden" name="id_formulaire" value="<?php echo $id_formulaire_post ?>"
                           class="btn btn-primary">
                    <?php
                }
                ?>
            </p>

            <button class="btn btn-primary" type="submit">Envoyer</button>
        </form>
    </div>
<?php
include "footer.php";
