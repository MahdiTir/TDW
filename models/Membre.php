<?php 
class Membre {
    static public function devenirMembre($data) {
        $stmt = DB::connect()->prepare('INSERT INTO membre (id_utilisateur, nom, prenom, id_type, piece_identite, recu_paiment, status, date_inscription) 
                VALUES (:id_utilisateur, :nom, :prenom,  :id_type, :piece_identite, :recu_paiment, :status, :date_inscription)');
    
        $stmt->bindParam(':id_utilisateur', $data['id_utilisateur']);
        $stmt->bindParam(':nom', $data['nom']);
        $stmt->bindParam(':prenom', $data['prenom']);
        $stmt->bindParam(':id_type', $data['id_type']);
        $stmt->bindParam(':piece_identite', $data['piece_identite']);
        $stmt->bindParam(':recu_paiment', $data['recu_paiment']);
        $stmt->bindParam(':status', $data['status']);
        $stmt->bindParam(':date_inscription', $data['date_inscription']);

        if($stmt->execute()){
            return 'ok';
        }else{
            return 'error';
        }
        $stmt->close();
        $stmt = null;
    }

    static public function getMembreByUserId($id_utilisateur) {
        $stmt = DB::connect()->prepare('SELECT * FROM membre WHERE id_utilisateur = :id_utilisateur');
        $stmt->bindParam(':id_utilisateur', $id_utilisateur);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    static public function updateStatus($id, $status) {
        $stmt = DB::connect()->prepare('UPDATE membre SET status = :status WHERE id = :id');
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    static public function getStatus($id){
        $stmt = DB::connect()->prepare('SELECT status FROM membre WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['status'];
    }

    // Mettre à jour les informations du membre
    static public function updateMembre($id, $data) {
        $stmt = DB::connect()->prepare("UPDATE membre SET nom = :nom, prenom = :prenom WHERE id = :id");
        $stmt->bindParam(':nom', $data['nom']);
        $stmt->bindParam(':prenom', $data['prenom']);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Récupérer les partenaires favoris du membre
    static public function getPartenairesFavoris($id_membre) {
        $stmt = DB::connect()->prepare("SELECT p.* FROM partenaires p
                JOIN partenaires_favoris pf ON p.id = pf.id_partenaire
                WHERE pf.id_membre = :id_membre");
        $stmt->bindParam(':id_membre', $id_membre);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function getTypeCarteById($id_type) {
        $stmt = DB::connect()->prepare('SELECT * FROM type_carte WHERE id = :id_type');
        $stmt->bindParam(':id_type', $id_type);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>