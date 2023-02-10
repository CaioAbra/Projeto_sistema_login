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

    <title>Nivel Master</title>

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

        </div>
    </section>

    <script src="../src/lib/bootstrap-5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="../src/lib/jquery-3.6.2.min.js"></script>
    <script src="../src/lib/popper/popper.min.js"></script>
    <script src="../src/js/index.js"></script>

</body>

</html>