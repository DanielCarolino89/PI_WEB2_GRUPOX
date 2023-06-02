<?php

print_r($_POST);

require_once('../Controller/MedicoController.php');


$medicoControlador = new MedicoController();
$medicoControlador->cadastrarNovoMedico($_POST);

//redirecionar
//header("Location: ../views/index.html");
//exit();

?>