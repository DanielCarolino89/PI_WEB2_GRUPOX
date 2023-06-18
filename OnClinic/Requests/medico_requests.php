<?php
require_once('../Controller/MedicoController.php');
$medicoControlador = new MedicoController();

$cadastradoComSucesso = false;
$alteradoComSucesso = false;


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if (!isset($_POST['action'])){
        return;
    }

    $action = $_POST['action'];
    if ($action == 'Cadastrar')
    {
        $medicoControlador->cadastrarNovoMedico($_POST);
    }
    else if ($action == 'Editar')
    {
        $medicoControlador->editarMedico($_SESSION['id'], $_POST);
            
    }
    else if ($action == 'Excluir')
    {
        $medicoControlador->apagarMedico($_SESSION['id']);
        Logout();
    }
    else if ($action == 'ExcluirEspecialidades')
    {
        $medicoControlador->apagarEspecialidades($_SESSION['id']);
    }

}

$medicoDetalhado = null;
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

}

function carregarMedico(int $id){
    require_once('../Controller/MedicoController.php');
    $medicoControlador = new MedicoController();
    return $medicoControlador->consultarDetalhesMedico($id);   
}
?>