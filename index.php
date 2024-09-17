<?php

    require "gestionnaire.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $prenom = $_POST["prenom"];
        $nom = $_POST["nom"];
        $date = $_POST["date"];
        $email = $_POST["email"];

        $etudiant = new Etudiant($prenom, $nom, $date, $email);
        $gestionnaire = new GestionnaireFichiersEtudiants();
        $gestionnaire->ajouterEtudiant($etudiant);
        $gestionnaire->afficherEtudiants($etudiant);


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
    <form method="post" action="">
        <h1>Gestion des étudiants</h1>
        <label for="prenom">Prénom:</label>
        <input type="text" name="prenom">
        <label for="nom">Nom de famille:</label>
        <input type="text" name="nom">
        <label for="date">Date de naissance:</label>
        <input type="date" name="date">
        <label for="email">E-mail</label>
        <input type="text" name="email">

        <button>Ajouter un étudiant</button>

        <h1>Liste des étudiants</h1>
        <table>
        <thead>
            <tr>
                <th>Prénom</th>
                <th>Nom de famille</th>
                <th>Date de naissance</th>
                <th>E-mail</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tbody>
        </table>
    </form>
</body>
</html>