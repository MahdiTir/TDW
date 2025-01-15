<?php
class ProfilController {
    public function index() {
        // Récupérer l'ID de l'utilisateur connecté
        $id_utilisateur = $_SESSION['user_id'];

        // Récupérer les informations de l'utilisateur
        $user = User::getUserById($id_utilisateur);

        // Récupérer les informations du membre (si applicable)
        $membre = Membre::getMembreByUserId($id_utilisateur);

        // Charger la vue
        $view = new profil();
        $view->render($user, $membre);
    }


    public function update() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_utilisateur = $_SESSION['user_id'];
            
            // Données de base
            $data = [
                'username' => $_POST['username'],
                'email' => $_POST['email'],
                'telephone' => $_POST['telephone']
            ];

            // Traitement de la photo si une nouvelle est envoyée
            if (!empty($_FILES['photo']['tmp_name'])) {
                // Vérification du type de fichier
                $allowed = ['image/jpeg', 'image/png'];
                if (in_array($_FILES['photo']['type'], $allowed)) {
                    // Vérification de la taille (2MB max)
                    if ($_FILES['photo']['size'] <= 2 * 1024 * 1024) {
                        $data['photo'] = file_get_contents($_FILES['photo']['tmp_name']);
                    } else {
                        Session::set('error', 'La photo ne doit pas dépasser 2MB');
                        Redirect::to('profil');
                        return;
                    }
                } else {
                    Session::set('error', 'Format de photo invalide. Utilisez JPG ou PNG');
                    Redirect::to('profil');
                    return;
                }
            }

            // Mise à jour utilisateur
            User::updateUser($id_utilisateur, $data);

            // Mise à jour membre si applicable
            if (isset($_POST['nom']) && isset($_POST['prenom'])) {
                $membre = Membre::getMembreByUserId($id_utilisateur);
                if ($membre) {
                    Membre::updateMembre($membre['id'], [
                        'nom' => $_POST['nom'],
                        'prenom' => $_POST['prenom']
                    ]);
                }
            }

            if (!empty($_FILES['photo']['tmp_name'])) {
                $updatedUser = User::getUserById($_SESSION['user_id']);
                if ($updatedUser && !empty($updatedUser['photo'])) {
                    $_SESSION['photo'] = $updatedUser['photo'];
                }
            }

            Session::set('success', 'Vos informations ont été mises à jour.');
            Redirect::to('profil');
        }
    }
    
}
?>