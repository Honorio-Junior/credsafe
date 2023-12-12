<?php

    require_once '../../credsafe/env.php';

    class Conn
    {
        private string $host;
        private int $port;
        private string $dbname;
        private string $user;
        private string $passw;

        protected function PDO(){

            $this->host = getenv('DB_HOST');
            $this->port = getenv('DB_PORT');
            $this->dbname = getenv('DB_NAME');
            $this->user = getenv('DB_USER');
            $this->passw = getenv('DB_PASSW');

            try{
                $conn = new PDO(
                    'mysql:host=' . $this->host . 
                    ';dbname=' . $this->dbname . 
                    ';port='.$this->port,
                    $this->user, 
                    $this->passw
                );
                
                return $conn;
            }catch(Exception $erro){
                return null;
            }
        }

    }

    class ModelClientes extends Conn
    {

        private $conn;

        public function __construct()
        {
            $this->conn = $this->PDO();
        }

        public function getByEmail($email): array
        {
            $query = 'SELECT id, email, senha FROM clientes WHERE email = :email LIMIT 1';

            $result = $this->conn->prepare($query);
            $result->bindParam(':email', $email);
            $result->execute();

            $clientes = $result->fetchALL();

            return $clientes;
        }

    }

?>
