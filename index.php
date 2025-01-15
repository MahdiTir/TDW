<?php 
ob_start(); 
require_once './autoload.php';

$home = new HomeController();
$pages = ['home','login','register','devenirMembre','catalogue','carteMembre','renouvlerCarte','profil','historique',
'remises','dons','benevolat','aide','partenaire','favoris','loginPartenaire','logout'];

$adminPages = ['login','home','dashboard', 'users', 'members', 'partenaires','partenaire', 'events'];

if (isset($_GET['page']) && $_GET['page'] === 'administrateur') {
    $url = $_SERVER['REQUEST_URI']; 
    $segments = explode('/', trim(parse_url($url, PHP_URL_PATH), '/')); 

		$page = isset($segments[1]) ? $segments[1] : 'home';;
        $adminPage = isset($segments[2]) ? $segments[2] : 'home';  
        $action = isset($segments[3]) ? $segments[3] : 'index'; 

		if(!isset($_SESSION['role']) && $_SESSION['role'] !== 'admin' && $adminPage !== 'login') {
			Redirect::to('administrateur/login');
		}
    
        // Si c'est juste admin/, utiliser AdminController
        if (empty($adminPage) || $adminPage === 'home') {
            $controller = 'AdminController';
        } else {
            $controller = ucfirst($adminPage) . 'AdminController';
        }

        if (in_array($adminPage, $adminPages)) {
            if (class_exists($controller)) {
                $adminController = new $controller();
                if (method_exists($adminController, $action)) {
					require_once './views/includes/sideBar.php';
                    $adminController->$action(); 
                } else {
                    include('views/includes/404.php'); 
                }
            } else {
                include('views/includes/404.php'); 
            }
        } else {
            include('views/includes/404.php');
        }
    
} else {
       require_once './views/includes/header.php';
       if (isset($_GET['page'])) {
            $page = $_GET['page'];
            $action = isset($_GET['action']) ? $_GET['action'] : 'index';
            if (in_array($page, $pages)) { 
                $home->index($page, $action); 
            } else {
                include('views/includes/404.php'); 
            }
        } else {

    $home->index('home');
}
}

require_once './views/includes/footer.php';

ob_end_flush(); 
?>