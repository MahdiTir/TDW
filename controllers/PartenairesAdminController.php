<?php
class PartenairesAdminController
{
    public  function index() {
        $partenaires = Partenaire::getAll();
        $view = new partenairesAdminView();
        $view->render($partenaires);
    }

}