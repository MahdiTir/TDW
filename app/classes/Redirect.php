<?php 
class Redirect{
    static public function to($page){
        header('Location: ' . BASE_URL . $page);
        exit(); 
	 }
}
?>