<?php
class Usuario {
    private $conn;
    private $table = 'usuarios';
    
    public $id;
    public $username;
    public $password;
    public $tipo;
    public $codigo_tutor;
    
    public function __construct($db) {
        $this->conn = $db;
    }
    
    public function login($username, $password) {
        $query = "SELECT * FROM " . $this->table . " WHERE username = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$username]);
        
        if($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if(password_verify($password, $row['password'])) {
                $this->id = $row['id'];
                $this->username = $row['username'];
                $this->tipo = $row['tipo'];
                $this->codigo_tutor = $row['codigo_tutor'];
                return true;
            }
        }
        return false;
    }
}
