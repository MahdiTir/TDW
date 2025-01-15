<?php
class PartenaireController {
    public static function getAll() {
        $partenaires = Partenaire::getAll();
        return $partenaires;
        }

    public function afficherCatalogue() {

        $ville = isset($_GET['ville']) ? $_GET['ville'] : null;
        $categorie = isset($_GET['categorie']) ? $_GET['categorie'] : null;


        // Récupérer les données nécessaires
        $villes = Partenaire::getVilles();
        $partenaires = Partenaire::getAllPartenairesWithAvantages($ville, $categorie);


        // Inclure la vue
        include 'views/catalogue.php';
    }

    public function auth(){
		if(isset($_POST['submit'])){
			$data['nom'] = $_POST['nom'];
			$result = Partenaire::login($data);
			if($result->nom === $_POST['nom'] && password_verify($_POST['password'],$result->password)){

				$_SESSION['partenaire_logged'] = true;
				$_SESSION['partenaire_id'] = $result->id;
						
				Redirect::to('partenaire');

			}else{
				Session::set('error','Pseudo ou mot de passe est incorrect');
				Redirect::to('loginPartenaire');
			}
		}
	}
    public function afficherPartenaire() {
        $id_partenaire = $_SESSION['partenaire_id'];

        $partenaire = Partenaire::getPartenaireById($id_partenaire);

        // Récupérer les avantages du partenaire
        $avantages = Partenaire::getAvantagesByPartenaireId($id_partenaire);

        
        $view = new partenaireView();
        $view->render($partenaire, $avantages);

    }
    public function verifierMembre($member_id) {
            // Vérifier si le membre existe
            $membre = Membre::getMembreByUserId($member_id);

            if ($membre) {
                // Récupérer le type de carte du membre
                $type_carte = Membre::getTypeCarteById($membre['id_type']);
    
                // Vérifier le statut du membre
                if ($membre['status'] === 'valide') {
                    $message = 'Le membre ' . htmlspecialchars($membre['nom']) . htmlspecialchars($membre['prenom']) . ' est valide et bénéficie des offres. Type de carte: ' . htmlspecialchars($type_carte['nom']);
                    Session::set('success', $message);
                } else {
                    $message = 'Le membre ' . htmlspecialchars($membre['nom']) . ' n\'est pas valide. Type de carte: ' . htmlspecialchars($type_carte['nom']);
                    Session::set('error', $message);
                }
            } else {
                Session::set('error', 'Membre non trouvé.');
            }

            Redirect::to('partenaire');
        }
    
    public function authenticate($nom ,$password) {
        
            // Vérifier les informations de connexion
            $partenaire = Partenaire::login(['nom' => $nom]);

            if ($partenaire ) {
                $_SESSION['partenaire_logged'] = true;
                $_SESSION['partenaire_id'] = $partenaire->id;
                Redirect::to('partenaire');
            } else {
                Session::set('error', 'Pseudo ou mot de passe est incorrect');
                $loginView = new LoginPartenaire();
                $loginView->showLoginForm();
            }
    }
    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'];
            $password = $_POST['password'];
            $this->authenticate($nom ,$password);
        } else {
            $loginView = new LoginPartenaire();
            $loginView->showLoginForm();
        }
    }

    public function index() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $member_id = $_POST['member_id'];
            $this->verifierMembre($member_id);
        } else {
            $this->afficherPartenaire();
        }
    }


    public function logout() {
        session_destroy();
        Redirect::to('loginPartenaire');
    }
}