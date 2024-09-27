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

        public function modifierEtudiant($etudiant, $ligneId) {
            $file = file("liste-etudiants.txt");

            $file[$ligneId] = implode(";", $etudiant) . "\n";
            
            file_put_contents("liste-etudiants.txt", implode("", $file));
            echo "Étudiant mis à jour avec succès.";
        }

        public function afficherEtudiants(){
            $file = fopen("liste-etudiants.txt", "r");       
            $ligneId = 0;

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
                    if(!$donnee == ""){
                        echo "<td>" . $donnee . "</td>";
                    }
                }

                if(! $ligne == ""){
                    echo "
                    <td class='action'>
                        <a href='?modifier=$ligneId'>Modifier</a> |
                        <a href='?supprimer=$ligneId'>Supprimer</a>
                    </td>
                    </tr>";
                }
                
                $ligneId++;
            }

            echo "
            </tbody>
            </table>";

            fclose($file);
        }

        // Fonction pour pré-remplir le formulaire si modification
        public function getEtudiantByLigneId($ligneId) {
            $file = file("liste-etudiants.txt");

            if (isset($file[$ligneId])) {
                return explode(";", $file[$ligneId]);
            }

            return null;
        }


        public function supprimerEtudiant(){

        }









}


// Initialisation de l'objet Gestionnaire
$gestionnaire = new GestionnaireFichiersEtudiants();

// Initialisation des variables
$prenom = $nom = $dateNaissance = $email = "";
$ligneId = null;

// Vérifier si l'utilisateur clique sur "Modifier" pour pré-remplir le formulaire
if (isset($_GET['modifier'])) {
    $ligneId = $_GET['modifier'];
    $etudiant = $gestionnaire->getEtudiantByLigneId($ligneId);

    // Remplir le formulaire avec les données de l'étudiant
    if ($etudiant) {
        $prenom = trim($etudiant[0]);
        $nom = trim($etudiant[1]);
        $dateNaissance = trim($etudiant[2]);
        $email = trim($etudiant[3]);
    }
}

// Si le formulaire est soumis pour modification
if (isset($_POST['sauvegarder'])) {
    $ligneId = $_POST['ligneId'];
    
    $etudiant = [
        $_POST['prenom'],
        $_POST['nom'],
        $_POST['date_naissance'],
        $_POST['email']
    ];

    // Sauvegarder les modifications
    $gestionnaire->modifierEtudiant($etudiant, $ligneId);
}

?>