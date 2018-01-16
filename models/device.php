<?php
    /*
        Model da tabela DEVICE, efetua todas as operações no banco de dados
    */
    class Device
    {
        public $id;
        public $tech;
        public $dial;
        public $devicetype;
        public $user;
        public $description;
        public $emergency_cid;

        public $db;

        //Função cria a conexão com o banco de dados
        public function __construct()
        {
           $this->db = new PDO('mysql:host=localhost;dbname=pbx;charset=utf8mb4', 'root', '');
           $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        }

       //Função faz o SELECT no banco de dados
       public function selectByRamal($ramal)
       {
           $query = $this->db->prepare("SELECT * FROM devices WHERE id=?");
           $query->execute(array($ramal->numeroRamal));
           return $query->fetchAll();
       }

       //Função faz o INSERT no banco de dados
       public function insert($ramal)
       {
           try{
               $sth = $this->db->prepare("INSERT INTO devices(id, tech, dial, devicetype, user, description) VALUES (?, ?, ?, ?, ?, ?)");
               $sth->execute(array($ramal->numeroRamal, "sip", "SIP/$ramal->numeroRamal", "fixed", $ramal->numeroRamal, $ramal->nomeUsuario));
           }
           catch(PDOException $e)
           {
               echo($e->getMessage());
               return 'erro';
           }
       }

       //Função faz o UPDATE no banco de dados
       public function update($ramal)
       {
           try{
               $sth = $this->db->prepare("UPDATE devices SET id = ?, dial = ?, user = ?, description = ? WHERE id = ?");
               $sth->execute(array($ramal->numeroRamal, "SIP/$ramal->numeroRamal", $ramal->numeroRamal, $ramal->nomeUsuario, $ramal->oldRamal));
           }
           catch(PDOException $e)
           {
               echo($e->getMessage());
               return 'erro';
           }
       }

       //Função faz o DELETE no banco de dados
       public function delete($ramal)
       {
           try{
               $sth = $this->db->prepare("DELETE FROM devices WHERE id=?");
               $sth->execute(array($ramal->numeroRamal));
           }
           catch(PDOException $e)
           {
               echo($e->getMessage());
               return 'erro';
           }
       }
    }
?>
