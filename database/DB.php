<?php 



class DB{
	static public function connect() {
		$dsn = "mysql:dbname=".DBNAME.";host=".DBHOST.";port=".DBPORT;
        try {
            $con = new PDO($dsn, DBUSER, DBPASS);
            return $con;
        } catch (PDOException $ex) {
            printf("Erreur de connexion à la base de données : %s", $ex->getMessage());
            exit();
        }
    
	}
}

?>