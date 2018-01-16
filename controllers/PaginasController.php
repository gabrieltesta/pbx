<?php
    /*
        Controller efetua os redirecionamentos de páginas e gerenciamento
        de variáveis de sessão.
    */
    class PaginasController
    {
        public function index()
        {
            header('location: index.php');
        }

        public function register()
        {
            header('location: register.php');
        }

        public function displaysenha()
        {
            header('location: displaysenha.php');
        }

        public function newregister_erro()
        {
            header('location: register.php?erro');
        }

        public function perfil()
        {
            header('location: meuperfil.php');
        }

        public function errologin()
        {
            header('location: index.php?erro');
        }

        public function logout()
        {
            session_start();
            $_SESSION['status_login'] = false;
            $_SESSION['numeroRamal'] = null;
            session_destroy();
            header('location: index.php?logout');
        }

        public function delete()
        {
            session_start();
            $_SESSION['status_login'] = false;
            $_SESSION['numeroRamal'] = null;
            session_destroy();
            header('location: index.php?delete');
        }

        public function erro_update()
        {
            header('location: meuperfil.php?erro_update');
        }

        public function update($numeroRamal)
        {
            session_start();
            $_SESSION['status_login'] = false;
            $_SESSION['numeroRamal'] = null;
            session_destroy();
            header('location: index.php?update');
        }
    }
?>
