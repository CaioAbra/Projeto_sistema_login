<?php
require_once("config/usuarios.php");
$u = new Usuarios;
?>

<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login</title>

    <link rel="stylesheet" href="src/lib/bootstrap-5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="src/css/index.css">
</head>

<body>
    <section class="fixed-top">
        <div class="glass-top"></div>
    </section>

    <section id="login-form">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1>Login</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-md-8 col-lg-6 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <form method="post">
                                <div class="mb-3">
                                    <label for="login-user" class="form-label">Login</label>
                                    <input type="text" class="form-control" name="usuario" id="usuario">
                                </div>

                                <div class="mb-3">
                                    <label for="senha-user" class="form-label">Senha</label>
                                    <input type="text" class="form-control" name="senha" id="senha">
                                </div>

                                <button class="btn btn-primary px-5 py-2 float-end" id="SendLogin" name="SendLogin">Entrar</button>
                            </form>

                            <?php if (isset($_POST['usuario'])) {
                                $usuario = addslashes($_POST['usuario']);
                                $senha = addslashes($_POST['senha']);

                                if (!empty($usuario) && !empty($senha)) {
                                    $u->conectar("db_sistema_ambiental", "localhost", "root", "");

                                    if ($msgErro == "") {
                                        if ($u->logar($usuario, $senha)) {
                                            header("location: pages/index.php");
                                        } else { ?>

                                            <div class="card mt-3">
                                                <div class="card-body">
                                                    <p class="p-0 m-0">Usuario ou senha estão incorretos!!</p>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                    }

                                    if ($msgErro != "") { ?>

                                        <div class="card mt-3">
                                            <div class="card-body">
                                                <p class="p-0">não foi possivel conectar ao banco!</p>
                                                <p class="p-0 m-0">Tente novamente em Instantes!</p>
                                            </div>
                                        </div>

                                    <?php }
                                }

                                if (empty($usuario) || empty($senha)) { ?>

                                    <div class="card mt-3">
                                        <div class="card-body">
                                            <p class="p-0 m-0">Preencha todos os campos!!</p>
                                        </div>
                                    </div>

                            <?php }
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <section class="fixed-bottom">
        <div class="glass-bottom"></div>
    </section>


    <script src="src/lib/bootstrap-5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="src/lib/jquery-3.6.2.min.js"></script>
    <script src="src/lib/popper/popper.min.js"></script>
    <script src="src/js/index.js"></script>


</body>

</html>