<!--
    View da página de display de senha (displaysenha.php)
-->
<?php
    session_start();
    //Verifica se o usuário não veio da página de registro
    if(!isset($_SESSION['senha']))
    {
        header('location:'.$_SERVER['HTTP_REFERER']);
    }
?>
<div class="container">
    <div class="col-md-6 col-lg-6 offset-md-3 offset-lg-3">
        <!-- Alerts de erro -->
        <div class="alerts">
        </div>
        <!-- Formulário de login -->
        <div class="card">
            <div class="card-body">
                <h3>Sua senha é:</h3>
                <h1 class="text-center" id="senha-gerada"><?php echo($_SESSION['senha']); session_destroy(); ?></h1>
                <div class="alert alert-info text-justify">
                    <i class="fas fa-info-circle"></i> Você pode clicar na senha para copiar.
                </div>
                <div class="alert alert-warning text-justify">
                    <i class="fas fa-exclamation-triangle"></i> Grave esta senha. Não é possível recuperá-la.
                </div>
                <a href="router.php?controller=index" class="btn btn-secondary float-right btn-lg"><i class="fas fa-undo"></i> Voltar</a>
            </div>
        </div>
    </div>
</div>
