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

    <title>Nova Informação</title>

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
                <h3 class="mt-3">Vamos Adicionar uma Nova Noticia?</h3>
            </div>

            <div class="row">
                <div class="col-12 col-md-8 col-lg-6 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <form method="post">
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label for="nomeCriadorNoticia">Nome do Usuario</label>
                                        <input type="text" class="form-control" id="nomeCriadorNoticia" name="nomeCriadorNoticia" required>
                                    </div>
                                    <div class="col-12 col-md-6 mb-3">
                                        <labelz for="horaCriadorNoticia">Hora</labelz>
                                        <input type="time" class="form-control" id="horaCriadorNoticia" name="horaCriadorNoticia" required>
                                    </div>
                                    <div class="col-12 col-md-6 mb-3">
                                        <labelz for="dataCriadorNoticia">Data</labelz>
                                        <input type="date" class="form-control" id="dataCria5dorNoticia" name="dataCriadorNoticia" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <label for="descricaoCriadorNoticia">Descrição</label>
                                            <textarea class="form-control" id="descricaoCriadorNoticia" name="descricaoCriadorNoticia" required></textarea>
                                        </div>
                                    </div>
                                </div>

                                <button type="reset" class="btn btn-warning px-5 py-2 float-start">Limpar!</button>
                                <button type="submit" class="btn btn-success px-5 py-2 float-end">Adicionar!</button>
                            </form>

                            <?php
                            if (isset($_POST['descricaoCriadorNoticia'])) {
                                $nomeCriadorNoticia = $_POST['nomeCriadorNoticia'];
                                $horaCriadorNoticia = $_POST['horaCriadorNoticia'];
                                $dataCriadorNoticia = $_POST['dataCriadorNoticia'];
                                $descricaoCriadorNoticia = $_POST['descricaoCriadorNoticia'];


                                if (!empty($nomeCriadorNoticia) && !empty($horaCriadorNoticia) && !empty($dataCriadorNoticia) && !empty($descricaoCriadorNoticia)) {
                                    $u->conectar("db_sistema_ambiental", "localhost", "root", "");
                                    if ($msgErro == "") {
                                        $u->nova_informacao($nomeCriadorNoticia, $horaCriadorNoticia, $dataCriadorNoticia, $descricaoCriadorNoticia);
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