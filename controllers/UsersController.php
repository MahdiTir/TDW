<?php 
class UsersController {
	public function auth(){
		if(isset($_POST['submit'])){
			$data['username'] = $_POST['username'];
			$result = User::login($data);
			if($result->username === $_POST['username'] && password_verify($_POST['password'],$result->password)){

				// Vérification de la date d'expiration de la carte membre
                $membre = Membre::getMembreByUserId($result->id);
                if ($membre) {
                    $date_inscription = new DateTime($membre['date_inscription']);
                    $date_expiration = $date_inscription->modify('+1 year');
                    $current_date = new DateTime();

                    if ($current_date > $date_expiration) {
                        // Mettre à jour le statut de la carte membre à 'expire'
                        Membre::updateStatus($membre['id'], 'expire');
                        Session::set('error', 'Votre carte membre a expiré. Veuillez la renouveler.');
                        Redirect::to('renouvlerCarte');
                        return;
                    }
					$_SESSION['status'] = Membre::getStatus($membre['id']);
                }

				$_SESSION['logged'] = true;
				$_SESSION['username'] = $result->username;
				$_SESSION['user_id'] = $result->id;
				$_SESSION['type_user'] = $result->type; 

				$photo = $result->photo;
				if ($photo && !empty($photo)) {
					$_SESSION['photo'] = $photo;
				}
				
				Redirect::to('home');

			}else{
				Session::set('error','Pseudo ou mot de passe est incorrect');
				Redirect::to('login');
			}
		}
	}

	public function register(){
		if(isset($_POST['submit'])){
			$options = [
				'cost' => 12
			];
			$password = password_hash($_POST['password'],PASSWORD_BCRYPT,$options);
			$data = array(
				'username' => $_POST['username'],
				'email' => $_POST['email'],
				'telephone' => $_POST['telephone'],
				'password' => $password,
			);
			$result = User::createUser($data);
			if($result === 'ok'){
				Session::set('success','Compte crée');
				Redirect::to('login');
				//header('Location: login');
				//exit(); // Arrête l'exécution du script
			}else{
				echo $result;
			}
		}
	}

	static public function logout(){
		session_destroy();
	}


}
