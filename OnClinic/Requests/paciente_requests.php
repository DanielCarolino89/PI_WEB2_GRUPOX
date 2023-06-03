<?php

print_r($_POST);

require_once('../Controller/PacienteController.php');

$pacienteControlador = new PacienteController();
$pacienteControlador->cadastrarNovoPaciente($_POST);

?>