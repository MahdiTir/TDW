<?php

class CouleursController {
        public function getColors() {
            $colors = Couleurs::getAllColors();
            return $colors;
        }
    
}
?>