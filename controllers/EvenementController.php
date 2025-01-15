<?php 

class EvenementController {
    public function afficherEvenements() {
        $evenements = Evenement::getLatestsEvents();
        return $evenements;
    }
}

?>