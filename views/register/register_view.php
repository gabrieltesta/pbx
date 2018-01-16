<!--
    View da página de display de registro (register.php)
-->
<div class="container">
    <div class="col-md-6 col-lg-6 offset-md-3 offset-lg-3">
        <!-- Alerts de erro -->
        <div class="alerts">
            <?php
                if(isset($_GET['erro']))
                {
                    echo('<div class="alert alert-danger"><i class="fas fa-exclamation-triangle"></i> Ocorreu um erro no registro do ramal. Tente outro número.</div>');
                }
             ?>
        </div>
        <div class="card">
            <div class="card-body">
                <h3>Novo ramal</h3>
                <form method="POST" action="router.php?controller=newregister&modo=create" id="form-register" autocomplete="off">
                    <div class="form-group">
                        <label for="txtNumeroRamal">
                            Número do Ramal*
                            <!-- Badge com informações -->
                            <span class="badge badge-secondary" data-toggle="tooltip" data-placement="right" title="Número do ramal a ser utilizado"><i class="fas fa-question"></i></span>
                        </label>
                        <input type="text" name="txtNumeroRamal" id="txtNumeroRamal" class="form-control" maxlength="20"/>
                        <small class="form-text text-danger" id="verificarRamal"></small>
                        <small class="form-text text-muted">O ramal só pode conter números maiores que 0.</small>
                    </div>
                    <div class="form-group">
                        <label for="txtNomeUsuario">
                            Nome do Usuário*
                            <!-- Badge com informações -->
                            <span class="badge badge-secondary" data-toggle="tooltip" data-placement="right" title="Nome completo do usuário do ramal"><i class="fas fa-question"></i></span>
                        </label>
                        <input type="text" name="txtNomeUsuario" id="txtNomeUsuario" class="form-control"  maxlength="50"/>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="chkConfirmacao">
                        <label class="form-check-label" for="chkConfirmacao">Tenho certeza que quero criar um ramal.</label>
                    </div>
                    <div class="alert alert-warning text-justify">
                        <i class="fas fa-exclamation-triangle"></i> Sua senha será gerada aleatoriamente.
                    </div>
                </form>
                    <button class="btn btn-lg btn-success float-left" id="btnRegistrar"><i class="fas fa-plus"></i> Criar ramal</button>
                    <a href="router.php?controller=index" class="btn btn-secondary float-right btn-lg"><i class="fas fa-undo"></i> Voltar</a>
            </div>
        </div>
    </div>
</div>
