<?php

require_once('../Controller/MedicoController.php');
$medicoControlador = new MedicoController();

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if (!isset($_GET['action'])){
        return;
    }

    $action = $_POST['action'];
    if ($action == 'Cadastrar')
    {
        $medicoControlador->cadastrarNovoMedico($_POST);
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

if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if (!isset($_GET['action'])){
        return;
    }

    $action = $_GET['action'];
    if ($action == 'Pesquisar')
    {
        $conteudo = $_GET['conteudo'];
        $filtro = $_GET['filtro'];
        $medicos = $medicoControlador->consultarMedicos($conteudo, $filtro);

    }
    else if ($action == 'Detalhar')
    {
        $medico = $medicoControlador->consultarDetalhesMedico($_GET['Id']);   
    }
}

function carregarMedicoDetalhado(int $id){
    $medicoControlador = new MedicoController();
    return $medicoControlador->consultarDetalhesMedico($id);   
}
?>