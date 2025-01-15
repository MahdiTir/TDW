<?php 
class User{
	static public function login($data){
		$username = $data['username'];
		try{
			$query = 'SELECT * FROM utilisateur WHERE username=:username';
			$stmt = DB::connect()->prepare($query);
			$stmt->execute(array(":username" => $username));
			$user = $stmt->fetch(PDO::FETCH_OBJ);
			return $user;
		}catch(PDOException $ex){
			echo 'erreur' . $ex->getMessage();
		}
	}

	static public function createUser($data){
		$stmt = DB::connect()->prepare('INSERT INTO utilisateur (email,username,password,telephone)
			VALUES (:email,:username,:password,:telephone)');
		$stmt->bindParam(':email',$data['email']);
		$stmt->bindParam(':username',$data['username']);
		$stmt->bindParam(':password',$data['password']);
		$stmt->bindParam(':telephone',$data['telephone']);

		if($stmt->execute()){
			return 'ok';
		}else{
			return 'error';
		}
		$stmt->close();
		$stmt = null;
	}

	// Mettre à jour les informations de l'utilisateur

	static public function updateUser($id, $data) {
		$db = DB::connect();
		$sql = "UPDATE utilisateur SET username = :username, email = :email, telephone = :telephone";
		
		if (isset($data['photo'])) {
			$sql .= ", photo = :photo";
		}
		
		$sql .= " WHERE id = :id";
		
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':username', $data['username']);
		$stmt->bindParam(':email', $data['email']);
		$stmt->bindParam(':telephone', $data['telephone']);
		$stmt->bindParam(':id', $id);
		
		if (isset($data['photo'])) {
			$stmt->bindParam(':photo', $data['photo'], PDO::PARAM_LOB);
		}
		
		return $stmt->execute();
	}

	static public function getUserById($id) {
		$stmt = DB::connect()->prepare('SELECT * FROM utilisateur WHERE id = :id');
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	static public function setType($userId, $type) {
        try {
            $query = 'UPDATE utilisateur SET type = :type WHERE id = :id';
            $stmt = DB::connect()->prepare($query);
            $stmt->bindParam(':id', $userId);
            $stmt->bindParam(':type', $type);

            if($stmt->execute()) {
				$_SESSION['type_user'] === $type;
                return true;
            }
            return false;
        } catch(PDOException $ex) {
            error_log('Error updating user type: ' . $ex->getMessage());
            return false;
        } finally {
            if($stmt) {
                $stmt = null;
            }
        }
    }

}

 ?>