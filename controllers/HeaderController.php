<?php


class HeaderController {


    /*public function index($page){
		include('views/includes/header.php');
	}*/


    public function getLogo() {
        $logo = Logo::getLogo();
    
        if ($logo) {
            return [
                'logo_image' => base64_encode($logo['logo_image']),
                'logo_mime_type' => $logo['logo_mime_type']
            ];
        } else {
            return [
                'error' => 'No logo found'
            ];
        }
    }
    
    
    public function getReseauxSociaux() {
        
        $reseauxSociaux = ReseauxSociaux::getAll();
        return $reseauxSociaux;
    }
}

// Example usage
//$controller = new HeaderController();
//$controller->displayLogo();
//$controller->displayReseauxSociaux();//
?>