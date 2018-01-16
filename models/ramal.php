<?php
    /*
        Model de Ramal, contendo os dados inseridos pelo usuário e operações relacionadas
    */
    class Ramal
    {
        public $nomeUsuario;
        public $numeroRamal;
        public $senha;
        public $oldRamal;

        //Função cria uma senha aleatoria de 8 a 20 caracteres
        public function criarSenha()
        {
            //Caracteres aceitos
            $range_caracteres = 'abcdefghijklmnopqrstuvwxyz0123456789';
            $maximo = strlen($range_caracteres) - 1;

            //Range do tamanho da senha (8-19)
            $qtd_caracteres = mt_rand(8,19);

            for($i = 0; $i < $qtd_caracteres; $i++)
            {
                $this->senha .= $range_caracteres[mt_rand(0, $maximo)];
            }

            $this->senha = strtoupper($this->senha);
        }

        //Função realiza a autenticação de login
        public function authenticate()
        {
            $db = new PDO('mysql:host=localhost;dbname=pbx;charset=utf8mb4', 'root', '');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            $query = $db->prepare("SELECT * FROM sip WHERE keyword = 'secret' AND id = :id AND data = :senha ;");
            $query->bindParam(':id', $this->numeroRamal);
            $query->bindParam(':senha', $this->senha);
            $query->execute();

            if($query->rowCount() > 0)
            {
                return "sucesso";
            }
            else
            {
                return "falha";
            }
        }

        //Função verifica se o ramal inserido já existe
        public function checkIfRamalExists()
        {
            $db = new PDO('mysql:host=localhost;dbname=pbx;charset=utf8mb4', 'root', '');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            $query = $db->prepare("SELECT * FROM sip WHERE id = :id");
            $query->bindParam(':id', $this->numeroRamal);
            $query->execute();

            if($query->rowCount() > 0)
            {
                return 1;
            }
            else
            {
                return 0;
            }
        }

        //Função verifica se o ramal isnerido já existe e é diferente do ramal anterior
        public function checkIfNewRamalExists()
        {
            $db = new PDO('mysql:host=localhost;dbname=pbx;charset=utf8mb4', 'root', '');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            $query = $db->prepare("SELECT * FROM sip WHERE id = :id AND id <> :oldid");
            $query->bindParam(':id', $this->numeroRamal);
            $query->bindParam(':oldid', $this->oldRamal);
            $query->execute();

            if($query->rowCount() > 0)
            {
                return 1;
            }
            else
            {
                return 0;
            }
        }
    }
?>
