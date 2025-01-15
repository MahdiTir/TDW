<?php
class HistoriqueController {

    public function afficherHistorique($id_utilisateur) {
        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['user_id'])) {
            Redirect::to('home'); // Rediriger vers la page d'accueil
            exit();
        }

        // Récupérer les données
        $dons = Dons::getDonsByIdUtilisateur($_SESSION['user_id']);
        $benevolats = Benevolat::getBenevolatByIdUtilisateur($_SESSION['user_id']);
        $remises = RemiseMembre::getRemiseMembreByIdUtilisateur($_SESSION['user_id']);

        // Instancier la vue et afficher l'historique
        $historiqueView = new historique();
        $historiqueView->afficherHistorique($dons, $benevolats, $remises);
    }
}

?>