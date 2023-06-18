<?php
require_once('../Models/Notificator.php');

require_once('../Controller/PacienteController.php');
$pacienteControlador = new PacienteController();


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $action = $_POST['action'];
    if ($action == 'Cadastrar')
    {
        $pacienteControlador->cadastrarNovoPaciente($_POST);
    }
    else if ($action == 'Editar')
    {
        $pacienteControlador->editarPaciente($_SESSION['id'], $_POST);
    }
    else if ($action == 'Excluir')
    {
        $pacienteControlador->apagarPaciente($_SESSION['id']);
        Logout();
    }

}

function carregarPaciente(int $id)
{
    require_once '../Controller/PessoaController.php';
    $pacienteControlador = new PacienteController();
    return $pacienteControlador->consultarPaciente($id);
}

?>