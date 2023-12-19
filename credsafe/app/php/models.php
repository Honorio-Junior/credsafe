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
            $query = 'SELECT * FROM clientes WHERE email = :email LIMIT 1';

            $result = $this->conn->prepare($query);
            $result->bindParam(':email', $email);
            $result->execute();

            $clientes = $result->fetchALL();

            return $clientes;
        }

    }


    class ModelPerfis extends conn
    {
        private $conn;

        public function __construct()
        {
            $this->conn = $this->PDO();
        }

        public function getFuncoes(int $idCliente): array
        {
            $query = 'SELECT DISTINCT funcao FROM perfis WHERE idCliente = :idCliente';

            $result = $this->conn->prepare($query);
            $result->bindParam(':idCliente', $idCliente);
            $result->execute();

            $funcoes = $result->fetchALL();

            return $funcoes;
        }

        public function getAll(int $idCliente): array
        {
            $query = 'SELECT * FROM perfis WHERE idCliente = :idCliente';

            $result = $this->conn->prepare($query);
            $result->bindParam(':idCliente', $idCliente);
            $result->execute();

            $perfis = $result->fetchALL();

            return $perfis;
        }

        public function create(int $idCliente, array $perfil)
        {
            $query = 'INSERT INTO perfis (nome, bio, funcao, idCliente)
                      VALUES (:nome, :bio, :funcao, :idCliente)';

            $result = $this->conn->prepare($query);
            $result->bindParam(':nome', $perfil['nome']);
            $result->bindParam(':bio', $perfil['bio']);
            $result->bindParam(':funcao', $perfil['funcao']);
            $result->bindParam(':idCliente', $idCliente);
            $r = $result->execute();

            return $r;
        }

    }

?>
