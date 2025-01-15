<?php
class PartenaireAdminController
{
    public  function index() {

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            //$partenaire = $this->getPartenaireById($id);

            $partenaire = Partenaire::getPartenaireById($id);
            $avantages = Avantage::getAvantagesByPartenaireId($id);
            $types = TypeCarte::getAllTypes();
            $view = new partenaireAdminView();
            $view->render($partenaire ,$avantages ,$types);
          } else {
            Session::set('error','Partenaire id not provided');
			Redirect::to('administrateur');
            
        }
    }
    public function updatePartenaire($id, $nom, $password, $description, $adresse, $ville, $categorie, $mime_type, $logo) {
        Partenaire::updatePartenaire($id, $nom, $password, $description, $adresse, $ville, $categorie, $mime_type, $logo);
        Session::set('success','Modifications enregistres avec succes');
        Redirect::to('administrateur/partenaire?id=' . $id);
    }

    public function deletePartenaire($id) {
        Partenaire::deletePartenaire($id);
        Session::set('success','Partenaire supprime avec succes');
        Redirect::to('administrateur/partenaires');
    }

    public function updateAvantage($id, $pourcentage, $type, $date_expiration) {
        Avantage::updateAvantage($id, $pourcentage, $type, $date_expiration);
        Session::set('success','Modifications enregistres avec succes');
        Redirect::to('administrateur/partenaire?id=' . $id);
    }

    public function deleteAvantage($id) {
        Avantage::deleteAvantage($id);
        Session::set('success','Partenaire supprime avec succes');
        Redirect::to('administrateur/partenaire?id=' . $_GET['id']);
    }

    

}