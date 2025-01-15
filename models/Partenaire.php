<?php
class Partenaire {
    public static function getAll() {
        $db = DB::connect();
        $query = "SELECT * FROM partenaire";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public static function getAllPartenairesWithAvantages($ville = null, $categorie = null) {
        $db = DB::connect();
        $query = "
            SELECT 
                p.*, 
                GROUP_CONCAT(
                    CONCAT_WS('|', a.pourcentage, t.nom, a.date_expiration) 
                    SEPARATOR '||'
                ) AS avantages
            FROM partenaire p
            LEFT JOIN avantage a ON p.id = a.id_partenaire
            LEFT JOIN type_carte t ON a.id_type = t.id
        ";
        $params = [];

        // Ajout des filtres si nécessaires
        if ($ville || $categorie) {
            $query .= " WHERE ";
            $conditions = [];
            if ($ville) {
                $conditions[] = "p.ville = :ville";
                $params[':ville'] = $ville;
            }
            if ($categorie) {
                $conditions[] = "p.categorie = :categorie";
                $params[':categorie'] = $categorie;
            }
            $query .= implode(" AND ", $conditions);
        }

        $query .= " GROUP BY p.id ORDER BY p.categorie, p.nom";

        $stmt = $db->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getVilles() {
        $db = DB::connect();
        $stmt = $db->query("SELECT DISTINCT ville FROM partenaire");
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    static public function login($data){
		$nom = $data['nom'];
		try{
			$query = 'SELECT * FROM partenaire WHERE nom=:nom';
			$stmt = DB::connect()->prepare($query);
			$stmt->execute(array(":nom" => $nom));
			$user = $stmt->fetch(PDO::FETCH_OBJ);
			return $user;
		}catch(PDOException $ex){
			echo 'erreur' . $ex->getMessage();
		}
	}
     
    static public function getPartenaireById($id) {
        $db = DB::connect();
        $stmt = $db->prepare("SELECT * FROM partenaire WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    static public function getAvantagesByPartenaireId($id) {
        $db = DB::connect();
        $stmt = $db->prepare("
            SELECT a.pourcentage, t.nom AS type, a.date_expiration
            FROM avantage a
            INNER JOIN type_carte t ON a.id_type = t.id
            WHERE a.id_partenaire = :id
        ");
        $stmt->execute([':id' => $id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

   

    public static function updatePartenaire($id, $nom, $password, $description, $adresse, $ville, $categorie, $mime_type, $logo) {
        $db = DB::connect();
        $query = "UPDATE partenaire SET nom = :nom, password = :password, description = :description, adresse = :adresse, ville = :ville, categorie = :categorie, mime_type = :mime_type";
        
        if ($logo !== null) {
            $query .= ", logo = :logo";
        }
        
        $query .= " WHERE id = :id";
        
        $stmt = $db->prepare($query);
        $params = [
            ':id' => $id,
            ':nom' => $nom,
            ':password' => $password,
            ':description' => $description,
            ':adresse' => $adresse,
            ':ville' => $ville,
            ':categorie' => $categorie,
            ':mime_type' => $mime_type
        ];
        
        if ($logo !== null) {
            $params[':logo'] = $logo;
        }
        
        return $stmt->execute($params);
    }

    public static function deletePartenaire($id) {
        $db = DB::connect();
        $query = "DELETE FROM partenaire WHERE id = :id";
        $stmt = $db->prepare($query);
        return $stmt->execute([':id' => $id]);
    }
    
}

?>
<?php
