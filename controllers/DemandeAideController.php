<?php
class DemandeAideController {
    public function afficherFormulaire() {
        
        $typeAide = TypeAide::getTypeAides();

        $user = null;
        if (isset($_SESSION['user_id'])) {
            $user = User::getUserById($_SESSION['user_id']);
        }

        $aideView = new Aide();
        $aideView->afficherPage($typeAide,$user);
    }

    public function traiterFormulaire() {
        
            $nom = $_POST['nom'] ;
            $prenom = $_POST['prenom'] ;
            $telephone = $_POST['telephone'] ;
            $id_type_aide = $_POST['id_type_aide'] ;
            $description = $_POST['description'] ;
            $fichier_zip = file_get_contents($_FILES['dossier']['tmp_name']); 


            $resultat = DemandeAide::insererDemandeAide(isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null, $nom, $prenom, $telephone, $id_type_aide, $description, $fichier_zip);
            if ($resultat) {
                Session::set('success', 'Votre demande d\'aide a été enregistrée avec succès.');
                Redirect::to('home');
            } else {
                Session::set('error', 'Une erreur est survenue lors de l\'enregistrement de votre demande. Veuillez réessayer plus tard.');
                Redirect::to('home');
            }
    }
    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->traiterFormulaire();
        } else {
            $this->afficherFormulaire();
        }
    }
}
?>