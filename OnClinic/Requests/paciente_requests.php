<?php

require_once('../Controller/PacienteController.php');
$pacienteControlador = new PacienteController();


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $action = $_POST['action'];
    if ($action == 'Cadastrar')
    {
        include("../views/cadastro_paciente.php");
        $pacienteControlador->cadastrarNovoPaciente($_POST);
    }
    else if ($action == 'Editar')
    {

    }
    else if ($action == 'Excluir')
    {

    }
    else
    {

    }
}

function carregarPaciente(int $id)
{
    require_once '../Controller/PessoaController.php';
    $pacienteControlador = new PacienteController();
    return $pacienteControlador->consultarPaciente($id);
}

?>