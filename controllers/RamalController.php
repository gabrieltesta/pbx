<?php
    /*
        Controller efetua operações ligadas ao ramal.
    */
    class RamalController
    {
        public function __construct()
        {
            //Importação das models e controller de páginas
            require_once("models/sip.php");
            require_once("models/device.php");
            require_once("models/user.php");
            require_once("models/ramal.php");
            require_once("PaginasController.php");
        }

        //Função realiza o INSERT no banco de dados
        public function insert()
        {
            $ramal = new Ramal;
            $ramal->numeroRamal = $_POST['txtNumeroRamal'];
            $ramal->nomeUsuario = $_POST['txtNomeUsuario'];

            //Verifica se o ramal inserido já existe
            $status = $ramal->checkIfRamalExists();
            if($status == 0)
            {
                //Cria a senha aleatória
                $ramal->criarSenha();

                $sip = new SIP;
                $sip->insert($ramal);

                $device = new Device;
                $device->insert($ramal);

                $user = new User;
                $user->insert($ramal);
            }
            else
            {
                return "erro";
            }

            return $ramal->senha;
        }

        //Função realiza o UPDATE no banco de dados
        public function update()
        {
            $ramal = new Ramal;
            $ramal->numeroRamal = $_POST['txtNumeroRamal'];
            $ramal->nomeUsuario = $_POST['txtNomeUsuario'];
            $ramal->oldRamal = $_GET['id'];

            //Verifica se o ramal inserido já existe e não é o ramal anterior
            $status = $ramal->checkIfNewRamalExists();
            if($status == 0)
            {
                $sip = new SIP;
                $sip->update($ramal);

                $device = new Device;
                $device->update($ramal);

                $user = new User;
                $user->update($ramal);
            }
            else
            {
                return "erro_ramal";
            }

            return $ramal->numeroRamal;
        }

        //Função faz a autenticação de login
        public function authenticate()
        {
            $ramal = new Ramal;
            $ramal->numeroRamal = $_POST['txtRamal'];
            $ramal->senha = $_POST['txtSenhaRamal'];

            $status_auth = $ramal->authenticate();
            $paginas_controller = new PaginasController;

            if($status_auth == "sucesso")
            {
                //Cria a sessão e armazena o ramal que efetuou o login
                session_start();
                $_SESSION['status_login'] = true;
                $_SESSION['numeroRamal'] = $ramal->numeroRamal;
                $paginas_controller->perfil();
            }
            else
            {
                $paginas_controller->errologin();
            }
        }

        //Função faz o SELECT no banco de dados na tabela SIP
        public function selectSIPByRamal()
        {
            $ramal = new Ramal;
            $ramal->numeroRamal = $_SESSION['numeroRamal'];

            $sip = new SIP;
            return $sip->selectByRamal($ramal);
        }

        //Função faz o SELECT no banco de dados na tabela USERS
        public function selectUserByRamal()
        {
            $ramal = new Ramal;
            $ramal->numeroRamal = $_SESSION['numeroRamal'];

            $user = new User;
            return $user->selectByRamal($ramal);
        }

        //Função faz o SELECT no banco de dados na tabela DEVICES
        public function selectDeviceByRamal()
        {
            $ramal = new Ramal;
            $ramal->numeroRamal = $_SESSION['numeroRamal'];

            $device = new Device;
            return $device->selectByRamal($ramal);
        }

        //Função faz o DELETE no banco de dados
        public function delete()
        {
            $ramal = new Ramal;
            $ramal->numeroRamal = $_GET['id'];

            $sip = new SIP;
            $sip->delete($ramal);

            $device = new Device;
            $device->delete($ramal);

            $user = new User;
            $user->delete($ramal);
        }
    }
 ?>
