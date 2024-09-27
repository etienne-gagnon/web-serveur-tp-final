<?php

    require "gestionnaire.php";

    $gestionnaire = new GestionnaireFichiersEtudiants();

    $erreurPrenom = "";
    $erreurNom = "";
    $erreurDate = "";
    $erreurEmail = "";
    $erreurSubmit = "";

    $prenomValide = false;
    $nomValide = false;
    $dateValide = false;
    $emailValide = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $prenom = $_POST["prenom"];
        $nom = $_POST["nom"];
        $date = $_POST["date"];
        $email = $_POST["email"];



        
        // VALIDATION DES CHAMPS

        if(empty($prenom)){
            $erreurPrenom = "Vous devez mettre un prénom.";
        }else if(!ctype_alpha($prenom)){
            $erreurPrenom = "Votre prénom n'est pas valide.";
        }else{
            $prenomValide = true;
        }

        if(empty($nom)){
            $erreurNom = "Vous devez mettre un nom.";
        }else if(!ctype_alpha($nom)){
            $erreurNom = "Votre nom n'est pas valide.";
        }else{
            $nomValide = true;
        }

        if(empty($date)){
            $erreurDate = "Vous devez mettre une date de naissance.";
        }else{
            $annee = substr($date,0,4);
            $mois = substr($date,5,2);
            $jour = substr($date,8,2);

            if($annee <= 0 || $annee > date("Y")){
                $erreurDate = "L'année n'est pas valide.";
            }else if($mois <= 0 || $mois > date("m")){
                $erreurDate = "Le mois n'est pas valide.";
            }else if($jour <= 0 || $jour > date("j")){
                $erreurDate = "Le mois n'est pas valide.";
            }else{     
                $dateValide = true;
            }      
        }
        

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailValide = true;
          } else {
            $erreurEmail = "L'email n'est pas valide.";
          }



        if($prenom && $nom && $date && $email ){
            $etudiant = new Etudiant($prenom, $nom, $date, $email);
            $gestionnaire->ajouterEtudiant($etudiant);

            $prenom = "";
            $nom = "";
            $date = "";
            $email = "";
            

        }else{
            $erreurSubmit = "Vous devez corriger les erreurs dans le formulaire avant d'ajouter l'étudiant.e";
        }
    

        
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
    <form id="form" method="post" action="">
        <h1>Gestion des étudiants</h1>

        <label for="prenom">Prénom:</label>
        <input type="text" name="prenom" value="<?php echo htmlspecialchars($prenom) ?>">
        
        <label for="nom">Nom de famille:</label>
        <input type="text" name="nom" value="<?php echo htmlspecialchars($nom) ?>">
        <?php echo "<label class='erreur'>" . $erreurNom . "</label>" ?>

        <label for="date">Date de naissance:</label>
        <input type="date" name="date" value="<?php echo htmlspecialchars($date) ?>">
        <?php echo "<label class='erreur'>" . $erreurDate . "</label>" ?>

        <label for="email">E-mail</label>
        <input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
        <?php echo "<label class='erreur'>" . $erreurEmail . "</label>" ?>

        <button type="submit">Ajouter un étudiant</button>
        <?php echo "<label class='erreur'>" . $erreurSubmit . "</label>" ?>

        <h1>Liste des étudiants</h1>
        <?php $gestionnaire->afficherEtudiants(); ?>
    </form>
</body>
</html>