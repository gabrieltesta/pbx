<!--
    View da página de display de login (index.php)
-->
<div class="container">
    <div class="col-md-6 col-lg-6 offset-md-3 offset-lg-3">
        <!-- Alerts de erro -->
        <div class="alerts">
            <?php
                if(isset($_GET['erro']))
                {
                    echo("<div class='alert alert-danger'><i class='fas fa-exclamation-triangle'></i> Número do ramal e/ou senha incorretos.</div>");
                }
                else if(isset($_GET['perm']))
                {
                    echo("<div class='alert alert-danger'><i class='fas fa-exclamation-triangle'></i> Efetue o login para ter acesso a esta página.</div>");
                }
                else if(isset($_GET['logout']))
                {
                    echo("<div class='alert alert-success'><i class='fas fa-check'></i> Logout efetuado com sucesso.</div>");
                }
                else if(isset($_GET['delete']))
                {
                    echo("<div class='alert alert-success'><i class='fas fa-check'></i> Ramal excluído com sucesso.</div>");
                }
                else if(isset($_GET['update']))
                {
                    echo("<div class='alert alert-success'><i class='fas fa-check'></i> Ramal editado com sucesso. <br />Efetue o login novamente com o número atualizado.</div>");
                }
             ?>
        </div>
        <!-- Formulário de login -->
        <div class="card">
            <div class="card-body">
                <h3>Efetue seu login</h3>
                <form method="POST" action="router.php?controller=login" id="form-login">
                    <div class="form-group">
                        <label for="txtRamal">Número do Ramal*
                            <!-- Badge com informações -->
                            <span class="badge badge-secondary" data-toggle="tooltip" data-placement="right" title="Número do ramal cadastrado"><i class="fas fa-question"></i></span>
                        </label>
                        <input type="text" name="txtRamal" id="txtRamal" class="form-control" placeholder="000" required maxlength="20">
                    </div>
                    <div class="form-group">
                        <label for="txtSenhaRamal">Senha*
                            <!-- Badge com informações -->
                            <span class="badge badge-secondary" data-toggle="tooltip" data-placement="right" title="Senha criada aleatoriamente no cadastro"><i class="fas fa-question"></i></span>
                        </label>
                        <input type="password" name="txtSenhaRamal" id="txtSenhaRamal" class="form-control" placeholder="******" required maxlength="20">
                    </div>
                    <button type="button" class="btn btn-lg btn-success float-left" form="form-login" id="btnLogin"><i class="fas fa-sign-in-alt"></i> Login</button>
                </form>
                <a class="btn btn-lg btn-success float-right" href="router.php?controller=register"><i class="fas fa-plus"></i> Criar ramal</a>
            </div>
        </div>
    </div>
</div>
