<?php
require_once("../config/usuarios.php");
$u = new Usuarios;

$u->conectar("db_sistema_ambiental", "localhost", "root", "");
session_start();

$id_user = $_SESSION['id'];

$u->validacao_user($id_user);
