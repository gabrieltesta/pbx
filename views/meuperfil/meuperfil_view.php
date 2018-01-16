<!--
    View da página de display de meu perfil (meuperfil.php)
-->
<?php
    session_start();
    //Verifica se o usuário efetuou o login
    if(isset($_SESSION['status_login']))
    {
        if($_SESSION['status_login'] == false)
        {
            header('location: index.php?perm');
        }
        else
        {
            //Efetua os SELECTS no banco de dados
            require_once("controllers/RamalController.php");
            $ramal = new RamalController;
            $rowsSIP = $ramal->selectSIPByRamal();
            $rowsUser = $ramal->selectUserByRamal();
            $rowsDevice = $ramal->selectDeviceByRamal();
        }
    }
    else
    {
        header('location: index.php?perm');
    }
 ?>
<div class="container">
    <div class="card">
        <div class="card-body">
            <!-- Cabeçalho -->
            <div class="row">
                <div class="col-md-12 col-lg-12 bg-success">
                    <h2 class="text-white float-left">Ramal <?php echo($rowsSIP[0]['data']); ?></h3>
                    <p class="h2 text-white">
                        <a href="router.php?controller=logout" class="float-right"><i class="fas fa-sign-out-alt"></i></a>
                    </p>
                </div>
            </div>
            <!-- Menu -->
            <div class="row">
                <div class="container padding-top-10">
                    <div class="row">
                        <div class="col-md-9 col-lg-9">
                            <h3>Informações do ramal</h3>
                        </div>
                        <div class="col-md-3 col-lg-3">
                            <button type="button" class="btn btn-danger float-right" data-toggle="modal" data-target="#confirmarExclusao"><i class="fas fa-trash-alt"></i> Excluir</button>
                            <button type="button" class="btn btn-warning text-white float-right margin-right-4" data-toggle="modal" data-target="#formularioEdicao"><i class="fas fa-pencil-alt"></i> Editar</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Tabela de dados -->
            <div class="row">
                <div class="container">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Número do ramal</th>
                                <td><?php echo($rowsSIP[0]['data']); ?></td>
                            </tr>
                            <tr>
                                <th>Nome do usuário</th>
                                <td><?php echo ($rowsDevice[0]['description']) ?></td>
                            </tr>
                            <tr>
                                <th>Senha</th>
                                <td><?php echo($rowsSIP[22]['data']) ?></td>
                            </tr>
                            <?php
                                $cont = 0;
                                while($cont < count($rowsSIP))
                                {
                                    ?>
                                    <tr>
                                        <th><?php echo ($rowsSIP[$cont]['keyword']); ?></th>
                                        <td><?php echo ($rowsSIP[$cont]['data']) ?></td>
                                    </tr>
                                    <?php
                                    $cont++;
                                }
                             ?>
                             <tr>
                                 <th>extension</th>
                                 <td><?php echo ($rowsUser[0]['extension']) ?></td>
                             </tr>
                             <tr>
                                 <th>password</th>
                                 <td><?php echo ($rowsUser[0]['password']) ?></td>
                             </tr>
                             <tr>
                                 <th>name</th>
                                 <td><?php echo ($rowsUser[0]['name']) ?></td>
                             </tr>
                             <tr>
                                 <th>voicemail</th>
                                 <td><?php echo ($rowsUser[0]['voicemail']) ?></td>
                             </tr>
                             <tr>
                                 <th>ringtimer</th>
                                 <td><?php echo ($rowsUser[0]['ringtimer']) ?></td>
                             </tr>
                             <tr>
                                 <th>noanswer</th>
                                 <td><?php echo ($rowsUser[0]['noanswer']) ?></td>
                             </tr>
                             <tr>
                                 <th>recording</th>
                                 <td><?php echo ($rowsUser[0]['recording']) ?></td>
                             </tr>
                             <tr>
                                 <th>outboundcid</th>
                                 <td><?php echo ($rowsUser[0]['outboundcid']) ?></td>
                             </tr>
                             <tr>
                                 <th>sipname</th>
                                 <td><?php echo ($rowsUser[0]['sipname']) ?></td>
                             </tr>
                             <tr>
                                 <th>mohclass</th>
                                 <td><?php echo ($rowsUser[0]['mohclass']) ?></td>
                             </tr>
                             <tr>
                                 <th>noanswer_cid</th>
                                 <td><?php echo ($rowsUser[0]['noanswer_cid']) ?></td>
                             </tr>
                             <tr>
                                 <th>busy_cid</th>
                                 <td><?php echo ($rowsUser[0]['busy_cid']) ?></td>
                             </tr>
                             <tr>
                                 <th>chanunavail_cid</th>
                                 <td><?php echo ($rowsUser[0]['chanunavail_cid']) ?></td>
                             </tr>
                             <tr>
                                 <th>noanswer_dest</th>
                                 <td><?php echo ($rowsUser[0]['noanswer_dest']) ?></td>
                             </tr>
                             <tr>
                                 <th>busy_dest</th>
                                 <td><?php echo ($rowsUser[0]['busy_dest']) ?></td>
                             </tr>
                             <tr>
                                 <th>chanunavail_dest</th>
                                 <td><?php echo ($rowsUser[0]['chanunavail_dest']) ?></td>
                             </tr>
                             <tr>
                                 <th>id</th>
                                 <td><?php echo ($rowsDevice[0]['id']) ?></td>
                             </tr>
                             <tr>
                                 <th>tech</th>
                                 <td><?php echo ($rowsDevice[0]['tech']) ?></td>
                             </tr>
                             <tr>
                                 <th>dial</th>
                                 <td><?php echo ($rowsDevice[0]['dial']) ?></td>
                             </tr>
                             <tr>
                                 <th>devicetype</th>
                                 <td><?php echo ($rowsDevice[0]['devicetype']) ?></td>
                             </tr>
                             <tr>
                                 <th>user</th>
                                 <td><?php echo ($rowsDevice[0]['user']) ?></td>
                             </tr>
                             <tr>
                                 <th>description</th>
                                 <td><?php echo ($rowsDevice[0]['description']) ?></td>
                             </tr>
                             <tr>
                                 <th>emergency_cid</th>
                                 <td><?php echo ($rowsDevice[0]['emergency_cid']) ?></td>
                             </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmação de exclusão -->
<div class="modal fade" id="confirmarExclusao" tabindex="-1" role="dialog" aria-labelledby="confirmarExclusao" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="fas fa-exclamation-triangle"></i> Excluir ramal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Tem certeza que deseja excluir o ramal?<br>Esta operação não pode ser desfeita.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Fechar</button>
        <a href="router.php?controller=delete&id=<?php echo($_SESSION['numeroRamal']) ?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Excluir</a>
      </div>
    </div>
  </div>
</div>

<!-- Modal de formulário de edição -->
<div class="modal fade" id="formularioEdicao" tabindex="-1" role="dialog" aria-labelledby="formularioEdicao" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="fas fa-pencil-alt"></i> Editar ramal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form action="router.php?controller=update&id=<?php echo($_SESSION['numeroRamal']) ?>" method="post" id="form-edit" autocomplete="off">
              <div class="alerts">

              </div>
              <div class="form-group">
                  <label for="txtNumeroRamal">
                      Número do Ramal*
                      <!-- Badge com informações -->
                      <span class="badge badge-secondary" data-toggle="tooltip" data-placement="right" title="Número do ramal a ser utilizado"><i class="fas fa-question"></i></span>
                  </label>
                  <input type="text" name="txtNumeroRamal" id="txtNumeroRamal" class="form-control" maxlength="20" value="<?php echo($_SESSION['numeroRamal']) ?>"/>
                  <small class="form-text text-danger" id="verificarRamal"></small>
                  <small class="form-text text-muted">O ramal só pode conter números maiores que 0.</small>
              </div>
              <div class="form-group">
                  <label for="txtNomeUsuario">
                      Nome do Usuário*
                      <!-- Badge com informações -->
                      <span class="badge badge-secondary" data-toggle="tooltip" data-placement="right" title="Nome completo do usuário do ramal"><i class="fas fa-question"></i></span>
                  </label>
                  <input type="text" name="txtNomeUsuario" id="txtNomeUsuario" class="form-control"  maxlength="50" value="<?php echo($rowsDevice[0]['description']) ?>"/>
              </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Fechar</button>
        <button type="button" class="btn btn-warning text-white" id="btnEditar"><i class="fas fa-pencil-alt"></i> Editar</a></button>
      </div>
    </div>
  </div>
</div>
