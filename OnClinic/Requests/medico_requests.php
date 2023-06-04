<?php

print_r($_POST);

require_once('../Controller/MedicoController.php');
$medicoControlador = new MedicoController();

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $action = $_POST['action'];
    if ($action == 'Cadastrar')
    {
        $medicoControlador->cadastrarNovoMedico($_POST);
        header("Location: ../views/index.html");
        Uteis::ShowAlert('CPF já cadastrado', 'Caso esqueceu a senha, clique em Esqueci senha');
        
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
        $medicoControlador->consultarMedicos($conteudo, $filtro);
    }
    else if ($action == 'Detalhar')
    {

    }
}

//header("Location: ../views/index.html");
//exit();




//redirecionar


?>