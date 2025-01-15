<?php
class Admin {
    public static function login($username, $password) {
        $db = DB::connect();
        $query = "SELECT * FROM admin WHERE nom = :username AND password = :password";
        
        $stmt = $db->prepare($query);
        $stmt->execute([
            ':username' => $username,
            ':password' => $password 
        ]);
        
        if($user = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return [
                'id' => $user['id'],
                'nom' => $user['nom']
            ];
        }
        return false;
    }
}