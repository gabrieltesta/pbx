<?php
    /*
        Model da tabela SIP, efetua todas as operações no banco de dados
    */
    class SIP
    {
        public $id;
        public $keyword;
        public $data;
        public $flags;

        public $db;

        //Função realiza a conexão com o banco de dados
        public function __construct()
        {
            $this->db = new PDO('mysql:host=localhost;dbname=pbx;charset=utf8mb4', 'root', '');
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        }

        //Função realiza o SELECT no banco de dados
        public function selectByRamal($ramal)
        {
           $query = $this->db->prepare("SELECT * FROM sip WHERE id=?");
           $query->execute(array($ramal->numeroRamal));
           return $query->fetchAll();
        }

        //Função faz o INSERT no banco de dados
        public function insert($ramal)
        {
           try{
               $sth = $this->db->prepare("INSERT INTO sip(id, keyword, data) VALUES (?, ?, ?)");
               $sth->execute(array($ramal->numeroRamal, "secret", $ramal->senha));
               $sth->execute(array($ramal->numeroRamal, "dtmfmode", "rfc2833"));
               $sth->execute(array($ramal->numeroRamal, "canreinvite", "no"));
               $sth->execute(array($ramal->numeroRamal, "host", "dynamic"));
               $sth->execute(array($ramal->numeroRamal, "trustrpid", "yes"));
               $sth->execute(array($ramal->numeroRamal, "sendrpid", "no"));
               $sth->execute(array($ramal->numeroRamal, "port", "5060"));
               $sth->execute(array($ramal->numeroRamal, "qualify", "yes"));
               $sth->execute(array($ramal->numeroRamal, "qualifyfreq", "60"));
               $sth->execute(array($ramal->numeroRamal, "transport", "udp"));
               $sth->execute(array($ramal->numeroRamal, "avpf", "no"));
               $sth->execute(array($ramal->numeroRamal, "dtlsenable", "no"));
               $sth->execute(array($ramal->numeroRamal, "dtlsverify", "no"));
               $sth->execute(array($ramal->numeroRamal, "dtlsetup", "actpass"));
               $sth->execute(array($ramal->numeroRamal, "encryption", "no"));
               $sth->execute(array($ramal->numeroRamal, "callgroup", ""));
               $sth->execute(array($ramal->numeroRamal, "pickupgroup", ""));
               $sth->execute(array($ramal->numeroRamal, "disallow", ""));
               $sth->execute(array($ramal->numeroRamal, "allow", ""));
               $sth->execute(array($ramal->numeroRamal, "dial", "SIP/$ramal->numeroRamal"));
               $sth->execute(array($ramal->numeroRamal, "accountcode", ""));
               $sth->execute(array($ramal->numeroRamal, "mailbox", "$ramal->numeroRamal@device"));
               $sth->execute(array($ramal->numeroRamal, "deny", "0.0.0.0/0.0.0.0"));
               $sth->execute(array($ramal->numeroRamal, "permit", "0.0.0.0/0.0.0.0"));
               $sth->execute(array($ramal->numeroRamal, "account", $ramal->numeroRamal));
               $sth->execute(array($ramal->numeroRamal, "callerid", "device <$ramal->numeroRamal>"));
           }
           catch(PDOException $e)
           {
               echo($e->getMessage());
               return 'erro';
           }
           return 'ok';
        }

        //Função realiza o UPDATE no banco de dados
        public function update($ramal)
        {
           try{
               $sth = $this->db->prepare("UPDATE sip SET id = ?, data = ? WHERE id = ? AND keyword = ?");
               $sth->execute(array($ramal->numeroRamal, $ramal->numeroRamal, $ramal->oldRamal, "account"));

               $sth = $this->db->prepare("UPDATE sip SET id = ?, data = ? WHERE id = ? AND keyword = ?");
               $sth->execute(array($ramal->numeroRamal, "device <$ramal->numeroRamal>", $ramal->oldRamal, "callerid"));
               $sth->execute(array($ramal->numeroRamal, "SIP/$ramal->numeroRamal", $ramal->oldRamal, "dial"));
               $sth->execute(array($ramal->numeroRamal, "$ramal->numeroRamal@device", $ramal->oldRamal, "mailbox"));

               $sth = $this->db->prepare("UPDATE sip SET id = ? WHERE id = ?");
               $sth->execute(array($ramal->numeroRamal, $ramal->oldRamal));
           }
           catch(PDOException $e)
           {
               echo($e->getMessage());
               return "erro";
           }
           return 'ok';
        }

        //Função realiza o DELETE no banco de dados
        public function delete($ramal)
        {
           try{
               $sth = $this->db->prepare("DELETE FROM sip WHERE id=?");
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
