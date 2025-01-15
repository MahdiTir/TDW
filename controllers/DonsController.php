<?php
class DonsController {

    public function afficherFormulaire() {
        if (!isset($_SESSION['user_id'])) {
            Redirect::to('home'); // Rediriger vers la page d'accueil
            exit();
        }

        // Afficher le formulaire de don
        $donsView = new donsView();
        $donsView->afficherFormulaire();
    }

    public function traiterFormulaire() {
        
        // Valider les données du formulaire
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $type = 'simple' ;
            $montant = $_POST['montant'] ;
            $recu_virement = file_get_contents($_FILES['recu_virement']['tmp_name']); 


            $resultat = Dons::insererDons(isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null, $type, $montant, $recu_virement);
            if ($resultat) {
                Session::set('info', 'Merci pour votre générosité ! Votre don a été enregistré avec succès et fera une grande différence.');
                Redirect::to('home');
            } else {
                Session::set('error', 'Un problème est survenu. Veuillez réessayer plus tard. Merci pour votre patience.');
                Redirect::to('home');
            }
        }
    }
}
?>