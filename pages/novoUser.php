<?php
require_once("../config/usuarios.php");
$u = new Usuarios;

$u->conectar("db_sistema_ambiental", "localhost", "root", "");

session_start();

$id_user = $_SESSION['id'];

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Novo User</title>

    <link rel="stylesheet" href="../src/lib/bootstrap-5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/css/index.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="nivelMaster.php">Home</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <?php
                    $u->validacao_nivel_user($id_user);
                    ?>
                </ul>

            </div>
        </div>
    </nav>


    <section class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h3 class="mt-3">Vamos Adicionar um Novato?</h3>
            </div>

            <div class="row">
                <div class="col-12 col-md-8 col-lg-6 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <form method="post">
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label for="nome">Nome do Usuario</label>
                                        <input type="text" class="form-control" id="nomeNew" name="nomeNew" required>
                                    </div>
                                    <div class="col-12 col-md-6 mb-3">
                                        <labelz for="senhaNew">Senha do Usuario</labelz>
                                        <input type="text" class="form-control" id="senhaNew" name="senhaNew" required>
                                    </div>
                                    <div class="col-12 col-md-6  mb-3">
                                        <label for="nvlNewUser">Nivel do usuario</label>
                                        <select class="form-select" id="nvlNewUser" name="nvlNewUser" required>
                                            <option value="0" selected>Escolha um nivel!</option>
                                            <option value="1">Master</option>
                                            <option value="2">Medio</option>
                                            <option value="3">Base</option>
                                        </select>
                                    </div>
                                </div>

                                <button type="reset" class="btn btn-warning px-5 py-2 float-start">Limpar!</button>
                                <button type="submit" class="btn btn-success px-5 py-2 float-end">Adicionar!</button>
                            </form>

                            <?php
                            if (isset($_POST['nomeNew'])) {
                                $Newusuario = $_POST['nomeNew'];
                                $Newsenha = $_POST['senhaNew'];
                                $Nvl_usuario = $_POST['nvlNewUser'];

                                if (!empty($Newusuario) && !empty($Newsenha) && !empty($Nvl_usuario)) {
                                    $u->conectar("db_sistema_ambiental", "localhost", "root", "");
                                    if ($msgErro == "") {
                                        // echo ($Nvl_usuario);
                                        $u->novo_usuario($Newusuario, $Newsenha, $Nvl_usuario);
                                    };
                                };
                            };
                            ?>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <script src="../src/lib/bootstrap-5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="../src/lib/jquery-3.6.2.min.js"></script>
    <script src="../src/lib/popper/popper.min.js"></script>
    <script src="../src/js/index.js"></script>

</body>

</html>