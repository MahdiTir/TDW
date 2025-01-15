<?php
class AvantageController
{
    public static function index() {
        $avantages = Avantage::getAvantages();
        $view = new remises($avantages);
        $view->render();
    }
    public static function getAvantages() {
        $avantages = Avantage::getAvantages();
        return $avantages;
    }
}
?>
