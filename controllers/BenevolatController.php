<?php
class BenevolatController {

    public function afficherFormulaire($id_evenement) {
        
        $evenement = Evenement::getEvenementById($id_evenement);

        if (!$evenement) {
            Session::set('error', 'Événement non spécifié');
            Redirect::to('home');
        }

        $user = null;
        if (isset($_SESSION['user_id'])) {
            $user = User::getUserById($_SESSION['user_id']);
        }

        // Afficher le formulaire d'inscription
        $benevolatView = new BenevolatView();
        $benevolatView->afficherFormulaire($evenement, $user);
    }

    public function traiterFormulaire() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_evenement = $_POST['id_evenement'] ?? null;
            $nom = $_POST['nom'] ?? '';
            $telephone = $_POST['telephone'] ?? '';

    

            // Inscrire le bénévole
            $resultat = Benevolat::insererBenevolat(isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null,$id_evenement, $nom, $telephone);

            if ($resultat) {
                // incrementer place reserver
                Evenement::incrementPlacesReserve($id_evenement) ;
                Session::set('info', 'Merci pour votre générosité ! Votre don a été enregistré avec succès et fera une grande différence.');
                Redirect::to('home');
            } else {
                Session::set('info', 'Merci pour votre engagement ! Votre inscription a été enregistrée avec succès.');
                Redirect::to('home');
            }
        }
    }
}
?>