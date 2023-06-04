<?php

require_once('../Controller/MedicoController.php');
$medicoControlador = new MedicoController();

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $action = $_POST['action'];
    if ($action == 'Cadastrar')
    {
        include("../views/cadastro_medico.html");
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
    $action = $_GET['action'];
    if ($action == 'Pesquisar')
    {
        $conteudo = $_GET['conteudo'];
        $filtro = $_GET['filtro'];
        $medicos = $medicoControlador->consultarMedicos($conteudo, $filtro);
        
        include('../views/buscar.php');

    }
    else if ($action == 'Detalhar')
    {

    }
}

//header("Location: ../views/index.html");
//exit();




//redirecionar


?>