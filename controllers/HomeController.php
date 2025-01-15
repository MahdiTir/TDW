<?php 


class HomeController{

    public function index($page, $action = 'index'){
            
        if($page === 'profil') {
            $profilController = new ProfilController();
            if ($action === 'update') {
                $profilController->update();
            } else {
                $profilController->index();
            }
        }

        if($page === 'favoris') {
            $favorisController = new FavorisController();
            if ($action === 'defavoriser') {
                $favorisController->removeFavorite();
            } else {
                $favorisController->index();
            }
        }

		if($page === 'home') {
            //get evenements
            $evenementController = new EvenementController();
            $evenements = $evenementController->afficherEvenements();
            $data['evenements'] = $evenements;

            //get avantages
            $avantages = AvantageController::getAvantages();
            $data['avantages'] = $avantages;

            //get news
            $news = News::getNews();
            $data['news'] = $news;

            //get partenaires
            $partenaires = PartenaireController::getAll();
            $data['partenaires'] = $partenaires;

            $view = new home();
            $view->render($data);
        }

		if($page === 'catalogue') {
            //get partenaires
            $catalogue = new PartenaireController();
            $catalogue->afficherCatalogue();

        }
        if($page === 'historique') {
            //get partenaires
            $historique = new HistoriqueController();
            if (isset($_SESSION['user_id']) ) {
                $historique->afficherHistorique($_SESSION['user_id']);
            } else {
                Session::set('error', 'Vous devez être connecté pour accéder à cette page');
                Redirect::to('home');
            }

        }
        if($page === 'remises') {
            //page remises
            AvantageController::index();
        }

        if($page === 'login' || $page === 'register' || $page === 'logout' || $page === 'devenirMembre' || $page === 'renouvlerCarte' ) {
            include('views/'.$page.'.php'); 
        }
        if ($page === 'carteMembre') {
            $membreController = new MembreController();
            $membreController->carteMembre();
        }

        if ($page === 'dons') {
            $donsController = new DonsController();

            if ($action === 'traiter') {
                $donsController->traiterFormulaire();
            } else {
                // Afficher le formulaire de don
                $donsController->afficherFormulaire();
            }
        }

        if ($page === 'aide') {
            $aideController = new DemandeAideController();
            $aideController->handlerequest();
        }

        if ($page === 'benevolat') {
            $benevolatController = new BenevolatController();

            if ($action === 'traiter') {  
                $id_evenement = $_GET['id_evenement'] ?? null;
                $benevolatController->traiterFormulaire();
            } else {
                // Afficher le formulaire d'inscription
                $id_evenement = $_GET['id_evenement'] ?? null;
                if ($id_evenement) {
                    $benevolatController->afficherFormulaire($id_evenement);
                } else {
                    Session::set('error', 'Événement non spécifié');
                    Redirect::to('home');
                }
            }
        }
        if ($page === 'partenaire' || $page === 'loginPartenaire') {
            $partenaireController = new PartenaireController();

            if (isset($_SESSION['partenaire_logged']) && $_SESSION['partenaire_logged'] === true) {
                $partenaireController->index();
            } else {
                $partenaireController->handlerequest();
            }
        }

	}

}

?>