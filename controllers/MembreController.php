<?php
class MembreController {
    public function devenirMembre() {
        if(isset($_POST['submit'])){
            // Traitement du formulaire
            $data = [
                'id_utilisateur' => $_SESSION['user_id'], // ID de l'utilisateur connecté
                'nom' => $_POST['nom'],
                'prenom' => $_POST['prenom'],
                'id_type' => $_POST['id_type'],
                'piece_identite' => file_get_contents($_FILES['piece_identite']['tmp_name']), // Convertir le fichier en BLOB
                'recu_paiment' => file_get_contents($_FILES['recu_paiment']['tmp_name']), 
                'status' => 'enAttente',
                'date_inscription' => date('Y-m-d H:i:s')
            ];

            $result = Membre::devenirMembre($data);
            if($result === 'ok'){
                $_SESSION['type_user'] = 'membre';
                $_SESSION['status'] === 'enAttente';
                User::setType($_SESSION['user_id'], 'membre');
                
                Session::set('info','Demande envoyée avec succès !');
                Redirect::to('home');
            }else{
                echo $result;
            }
        } else {
            // Récupérer les types de carte
            $types = TypeCarte::getAllTypes();
            return $types;
        }
    }
    public function renouvler() {
        if(isset($_POST['submit'])){
            // Traitement du formulaire
            $data = [
                'id_utilisateur' => $_SESSION['user_id'], // ID de l'utilisateur connecté
                'id_type' => $_POST['id_type'],
                'recu_paiment' => file_get_contents($_FILES['recu_paiment']['tmp_name']), 
                'status' => 'enAttente',
                'date_inscription' => date('Y-m-d H:i:s')
            ];

            $result = Membre::devenirMembre($data);
            if($result === 'ok'){
                Session::set('info','Demande envoyée avec succès !');
                Redirect::to('home');
            }else{
                echo $result;
            }
        }
    }

    public function carteMembre() {
        // Récupérer l'ID de l'utilisateur connecté
        $utilisateur_id = $_SESSION['user_id'];

        // Récupérer les informations du membre
        $membre = Membre::getMembreByUserId($utilisateur_id);

        if ($membre) {
            if ($membre['status'] === 'valide') {
                // Récupérer le logo de l'association
                $logo = Logo::getLogo();

                // Calculer la date d'expiration (1 an après la date d'inscription)
                $date_inscription = new DateTime($membre['date_inscription']);
                $date_expiration = $date_inscription->modify('+1 year')->format('Y-m-d');

                // Chemin du code QR statique
                $qrCodePath = BASE_URL . 'images/codeQR.png';

                // Afficher la vue de la carte
                include 'views/carteMembre.php';
            } else if ($membre['status'] === 'enAttente') {
                // Afficher un message si le statut est 'enAttente'
                Session::set('error', 'Votre inscription n\'est pas encore acceptée.');
                Redirect::to('home');
            }
            else if ($membre['status'] === 'expire') {
                // Afficher un message si le statut est 'suspendu'
                Session::set('error', 'Votre inscription est expire , veulliez la renouvlez .');
                Redirect::to('home');
            }
        } else {
            // Afficher un message si le membre n'existe pas
            Session::set('error', 'Membre non trouvé.');
            Redirect::to('home');
        }
    }
}
?>