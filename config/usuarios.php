<?php

class Usuarios
{
    private $conn;
    public $msgErro = "";
    public $id_user = "";


    public function conectar($db_nome, $db_host, $db_usuario, $db_senha)
    {
        global $conn, $msgErro;

        try {
            $conn = new PDO("mysql:host=$db_host;dbname=$db_nome", $db_usuario, $db_senha);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $msgErro = $e->getMessage();
        }
    }

    // public function logar()
    public function logar($usuario, $senha)
    {
        global $conn;

        $stmt = $conn->prepare("SELECT id FROM usuario WHERE userLogin =:userLogin AND senha =:senhaLogin");
        $stmt->bindParam(":userLogin", $usuario);
        $stmt->bindParam(":senhaLogin", $senha);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $dado = $stmt->fetch();
            session_start();
            $_SESSION['id'] = $dado['id'];
            return true; //cadastrado no sistema
        } else {
            return false;
        }
    }

    public function validacao_user($id_user)
    {
        global $conn, $id_user;

        // $this->conectar();

        $stmt = $conn->prepare("SELECT `nivel_user` FROM `usuario` WHERE id=:id_user;");
        $stmt->bindParam(":id_user", $id_user);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $dado = $stmt->fetch();
            // var_dump($dado);
            if ($dado['nivel_user'] == 1) {
                header("location: nivelMaster.php");
            } else if ($dado['nivel_user'] == 2) {
                header("location: nivelMedio.php");
            } else {
                header("location: nivelBasico.php");
            }
        }
    }

    public function validacao_nivel_user($id_user)
    {
        global $conn, $id_user;

        // $this->conectar();
        try {
            $stmt = $conn->prepare("SELECT `nivel_user` FROM `usuario` WHERE id=:id_user;");
            $stmt->bindParam(":id_user", $id_user);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $dado = $stmt->fetch();
                // var_dump($dado);
                if ($dado['nivel_user'] == 1) {
                    echo "
                        <li class='nav-item me-lg-3'>
                            <a class='nav-link' href='consultaInformacao.php'>Consultar Informações</a>
                        </li>

                        <li class='nav-item me-lg-3'>
                            <a class='nav-link' href='novoUser.php'>Novo Usuario</a>
                        </li>

                        <li class='nav-item me-lg-3'>
                            <a class='nav-link' href='novaInformacao.php'>Nova Informação</a>
                        </li>

                        <li class='nav-item' >
                            <a class='nav-link' href='../index.php'>Sair</a>
                        </li>
                    ";
                } else if ($dado['nivel_user'] == 2) {
                    echo "
                    <li class='nav-item me-lg-3'>
                            <a class='nav-link' href='consultaInformacao.php'>Consultar Informações</a>
                        </li>

                        <li class='nav-item me-lg-3'>
                            <a class='nav-link' href='novaInformacao.php'>Nova Informação</a>
                        </li>

                        <li class='nav-item' >
                            <a class='nav-link' href='../index.php'>Sair</a>
                        </li>
                    ";
                } else {
                    echo "
                        <li class='nav-item me-lg-3'>
                            <a class='nav-link' href='novaInformacao.php'>Nova Informação</a>
                        </li>

                        <li class='nav-item' >
                            <a class='nav-link' href='../index.php'>Sair</a>
                        </li>
                    ";
                }
            }
        } catch (PDOException $e) {
            $msgErro = $e->getMessage();
            echo ($msgErro);
        };
    }

    public function novo_usuario($Newusuario, $Newsenha, $Nvl_usuario)
    {
        global $conn;
        try {
            $stmt = $conn->prepare("INSERT INTO `usuario`(`userLogin`, `senha`, `nivel_user`) VALUES (:Newusuario, :Newsenha, :Nvl_usuario);");
            $stmt->bindParam(":Newusuario", $Newusuario);
            $stmt->bindParam(":Newsenha", $Newsenha);
            $stmt->bindParam(":Nvl_usuario", $Nvl_usuario);
            $stmt->execute();
        } catch (PDOException $e) {
            $msgErro = $e->getMessage();
            echo ($msgErro);
        };
    }

    public function nova_informacao($nomeCriadorNoticia, $horaCriadorNoticia, $dataCriadorNoticia, $descricaoCriadorNoticia)
    {
        global $conn;
        $stmt = $conn->prepare("INSERT INTO `informacoes`(`descricao`, `hora`, `data`, `usuario`) VALUES (:descricaoCriadorNoticia, :horaCriadorNoticia, :dataCriadorNoticia, :nomeCriadorNoticia);");
        $stmt->bindParam(":nomeCriadorNoticia", $nomeCriadorNoticia);
        $stmt->bindParam(":horaCriadorNoticia", $horaCriadorNoticia);
        $stmt->bindParam(":dataCriadorNoticia", $dataCriadorNoticia);
        $stmt->bindParam(":descricaoCriadorNoticia", $descricaoCriadorNoticia);
        $stmt->execute();
        try {
        } catch (PDOException $e) {
            $msgErro = $e->getMessage();
            echo ($msgErro);
        };
    }

    public function consultar_informacao()
    {
        global $conn;

        $stmt = $conn->prepare("SELECT * FROM `informacoes` ORDER BY `id`;");
        $stmt->execute();

        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $newData = str_replace('-"', '/', $data['data']);
            $newDateFormat = date("d/m/y", strtotime($newData));

            echo "
                <div class='col-12 col-md-6 col-lg-4 mb-4'>
                    <div class='card'>
                        <div class='card-body'>
                            <p class='card-text'>
                                {$data['descricao']}
                            </p>
                        </div>
                        <div class='card-footer text-muted d-inline-flex'>
                            <span class='col-4'>{$newDateFormat}</span>
                            <span class='col-4'>{$data['hora']}</span>
                            <span class='col-4'>{$data['usuario']}</span>
                        </div>
                    </div>
                </div>
            ";
        };
    }
}
