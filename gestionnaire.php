<?php
    interface OperationsEtudiantes{   
        public function ajouterEtudiant($etudiant); 
        //public function modifierEtudiant($etudiant); 
        //public function supprimerEtudiant($etudiant); 
        public function afficherEtudiants($etudiant);
    }

    abstract class GestionnaireDesEtudiants implements OperationsEtudiantes {
        abstract public function ajouterEtudiant($etudiant);
        abstract public function afficherEtudiants($etudiant);
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
        

        public function afficherEtudiants($etudiant){
            echo "Prénom: " . $etudiant->getPrenom() . "<br>";
            echo "Nom: " . $etudiant->getNom() . "<br>";
            echo "Date de naissance: " . $etudiant->getDate() . "<br>";
            echo "Email: " . $etudiant->getEmail() . "<br>";
        }
    }
?>