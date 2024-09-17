<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
    <form id="form" action="">
        <h1>Gestion des étudiants</h1>
        <label for="prenom">Prénom:</label>
        <input type="text" name="prenom">
        <label for="nom">Nom de famille:</label>
        <input type="text" name="nom">
        <label for="date">Date de naissance:</label>
        <input type="date" name="date">
        <label for="email">E-mail</label>
        <input type="text" name="email">
        <button type="submit">Ajouter un étudiant</button>

        <h1>Liste des étudiants</h1>
        <table>
        <thead>
            <tr>
                <th>Prénom</th>
                <th>Nom de famille</th>
                <th>Date de naissance</th>
                <th>E-mail</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class="actions">
                    <a href="#">Modifier</a> | <a href="#">Supprimer</a>
            </td>
        </tbody>
        </table>
    </form>
</body>
</html>