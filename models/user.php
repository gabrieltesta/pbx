<?php
    /*
        Model da tabela USERS, realiza todas as operações do banco de dados
    */
    class User
    {
        public $extension;
        public $password;
        public $name;
        public $voicemail;
        public $ringtimer;
        public $noanswer;
        public $recording;
        public $outboundcid;
        public $sipname;
        public $mohclass;
        public $noanswer_cid;
        public $busy_cid;
        public $chanunavail_cid;
        public $noanswer_dest;
        public $busy_dest;
        public $chanunavail_dest;

        public $db;

        //Função realiza a conexão com o banco de dados
        public function __construct()
        {
           $this->db = new PDO('mysql:host=localhost;dbname=pbx;charset=utf8mb4', 'root', '');
           $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        }

        //Função faz o SELECT no banco de dados
        public function selectByRamal($ramal)
        {
           $query = $this->db->prepare("SELECT * FROM users WHERE extension=?");
           $query->execute(array($ramal->numeroRamal));
           return $query->fetchAll();
        }

        //Função faz o INSERT no banco de dados
        public function insert($ramal)
        {
           try{
               $sth = $this->db->prepare("INSERT INTO users(extension, name, mohclass) VALUES (?, ?, ?)");
               $sth->execute(array($ramal->numeroRamal, $ramal->nomeUsuario, "default"));
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
               $sth = $this->db->prepare("UPDATE users SET extension = ?, name = ? WHERE extension = ?");
               $sth->execute(array($ramal->numeroRamal, $ramal->nomeUsuario, $ramal->oldRamal));
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
               $sth = $this->db->prepare("DELETE FROM users WHERE extension=?");
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
