<?php

class PartenaireFavoris {

    public static function getPartenaireFavoris($id_utilisateur)
    {
        $db = DB::connect();

        $sql = "SELECT pf.*, p.nom, p.description, p.adresse, p.ville, p.categorie, p.logo, p.mime_type 
                FROM partenaires_favoris pf 
                INNER JOIN partenaire p ON pf.id_partenaire = p.id 
                WHERE pf.id_utilisateur = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$id_utilisateur]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function insererFavori($id_utilisateur, $id_partenaire)
    {
        $db = DB::connect();

        $sql = "INSERT INTO partenaires_favoris (id_utilisateur, id_partenaire) VALUES (?, ?)";
        $stmt = $db->prepare($sql);
        return $stmt->execute([$id_utilisateur, $id_partenaire]);
    }

    public static function supprimerFavori($id_utilisateur, $id_partenaire)
    {
        $db = DB::connect();

        $sql = "DELETE FROM partenaires_favoris WHERE id_utilisateur = ? AND id_partenaire = ?";
        $stmt = $db->prepare($sql);
        return $stmt->execute([$id_utilisateur, $id_partenaire]);
    }
}

?>