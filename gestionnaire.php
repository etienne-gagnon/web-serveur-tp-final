<?php
    interface OperationsEtudiantes{   
        public function ajouterEtudiant($etudiant); 
        //public function modifierEtudiant($etudiant); 
        //public function supprimerEtudiant($etudiant); 
        public function afficherEtudiants();
    }

    abstract class GestionnaireDesEtudiants implements OperationsEtudiantes {
        abstract public function ajouterEtudiant($etudiant);
        abstract public function afficherEtudiants();
    }

    class Etudiant{
        private $prenom;
        private $nom;
        private $date;
        private $email;

        // CONSTRUCTEUR
        public function __construct($prenom, $nom, $date, $email){
            $this->prenom = $prenom;
            $this->nom = $nom;
            $this->date = $date;
            $this->email = $email;
        }

        // SET 
        public function setPrenom($prenom){
            $this->prenom = $prenom;
        }

        public function setNom($nom){
            $this->nom = $nom;
        }

        public function setDate($date){
            $this->date = $date;
        }

        public function setEmail($email){
            $this->email = $email;
        }

        // GET 
        public function getPrenom(){
            return $this->prenom;
        }

        public function getNom(){
            return $this->nom;
        }

        public function getDate(){
            return $this->date;
        }

        public function getEmail(){
            return $this->email;
        }
    }

    class GestionnaireFichiersEtudiants extends GestionnaireDesEtudiants{
    
        public function ajouterEtudiant($etudiant){
            $file = fopen("liste-etudiants.txt", "a+");          
            fwrite($file, $etudiant->getPrenom() . ";" . $etudiant->getNom() . ";" . $etudiant->getDate() . ";" . $etudiant->getEmail(). "\n" );
            fclose($file);
        }
        

        public function afficherEtudiants(){
            $file = fopen("liste-etudiants.txt", "r");       
        
            echo "        
            <table id='tableau'>
            <thead>
                <tr>
                    <th>Prénom</th>
                    <th>Nom de famille</th>
                    <th>Date de naissance</th>
                    <th>E-mail</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>";

            while(!feof($file)){
                $ligne = fgets($file);
                $donnees = explode(";", $ligne);

                echo "<tr>";
                foreach($donnees as $donnee){
                    echo "<td>" . $donnee . "</td>";
                }

                echo "
                <td class='action'>
                    <a href='#'>Modifier</a> | <a href='#'>Supprimer</a>
                </td>
                </tr>";
            }

            echo "
            </tbody>
            </table>";

            fclose($file);
        }
    }
?>