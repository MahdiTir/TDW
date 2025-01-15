<?php
class LoginAdminController {
    public function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            
            $result = Admin::login($username, $password);
            
            if ($result) {
                $_SESSION['role'] = 'admin';  
                Redirect::to('administrateur');   
            } else {
                Session::set('error','nom ou mot de passe est incorrect');
				Redirect::to('administrateur/login');
            }
        }
        $view = new loginAdmin();
        return $view->render();
    }
}