<?php
class FavorisController {
    public function index() {
        // Récupérer l'ID de l'utilisateur connecté
        $id_utilisateur = $_SESSION['user_id'];

        $partenaires = PartenaireFavoris::getPartenaireFavoris($id_utilisateur);

        // Charger la vue
        $view = new favoris();
        $view->render($partenaires);
    }


    public function removeFavorite() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_partenaire'])) {
        $id_utilisateur = $_SESSION['user_id'];
        $id_partenaire = $_POST['id_partenaire'];
        
        if (PartenaireFavoris::supprimerFavori($id_utilisateur, $id_partenaire)) {
            Session::set('success', 'Le partenaire a été retiré de vos favoris.');
        } else {
            Session::set('error', 'Une erreur est survenue.');
        }
        
        Redirect::to('favoris');
    }
}
    
}
?>