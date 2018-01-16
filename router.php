<!--
    Arquivo de roteamento
-->
<?php
    //Verifica se possui o atributo controller na URL
    if(!isset($_GET['controller']))
    {
        header('location:index.php?perm');
    }

    $controller = $_GET['controller'];

    require_once('controllers/PaginasController.php');
    $paginas_controller = new PaginasController;

    if($controller == 'index')
    {
        $paginas_controller->index();
    }
    else if($controller == 'register')
    {
        $paginas_controller->register();
    }
    else if($controller == 'newregister')
    {
        require_once("controllers/RamalController.php");
        $ramal = new RamalController;
        $senha = $ramal -> insert();
        //Verifica se a operação foi bem sucedida
        if ($senha == 'erro')
        {
            $paginas_controller->newregister_erro();
        }
        else
        {
            session_start();
            $_SESSION['senha'] = $senha;
            $paginas_controller->displaysenha();
        }

    }
    else if($controller == 'login')
    {
        require_once("controllers/RamalController.php");
        $ramal = new RamalController;
        $ramal->authenticate();
    }
    else if($controller == 'logout')
    {
        $paginas_controller->logout();
    }
    else if($controller == 'delete')
    {
        require_once("controllers/RamalController.php");
        $ramal = new RamalController;
        $ramal->delete();
        $paginas_controller->delete();
    }
    else if($controller == 'update')
    {
        require_once("controllers/RamalController.php");
        $ramal = new RamalController;
        $status = $ramal->update();
        //Verifica se a operação foi bem sucedida
        if($status == 'erro')
        {
            $paginas_controller->erro_update();
        }
        else
        {
            $paginas_controller->update($status);
        }
    }
?>
