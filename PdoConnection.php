<?php
class PdoConnection {
    protected $db ,$user ,$password ,$ip;
    public $connection ;
    public function __construct(
        string $db,
        string $ip,
        string $password,
        string $user
    ){
        $this->db = $db;
        $this->ip = $ip;
        $this->password = $password;
        $this->user = $user;
        $this->connection = $this->connect();
    }
    private function connect() : PDO{
        return new PDO(
            "mysql:host=$this->ip;dbname=$this->db",
            $this->user,
            $this->password);
    }


}
