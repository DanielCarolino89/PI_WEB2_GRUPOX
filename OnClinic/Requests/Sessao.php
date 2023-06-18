<?php

require_once('../Repositories/LoginRepository.php');

$loginFalhou = false;
    
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    
    if (!isset($_POST['action'])){
        return;
    }

    $action = $_POST['action'];
    if ($action == "logar")
    {
        session_start();

        require_once('../Models/Database.php');
        $db = new Database();
        $loginRepository = new LoginRepository($db);
        $login = $loginRepository->Autenticar($_POST['login'],$_POST['senha']);

        if(empty($login))
        {
            $_SESSION['loggedin'] = FALSE;
            $loginFalhou = true;
        }
        else
        {
            if(isset($login['Medico']))
            {
                $_SESSION["loggedin"] = TRUE;
                $_SESSION["id"] = $login['Medico'];
                $_SESSION["tipo"] = 'medico';
                header("Location: ..\Views\perfil_medico.php");
                exit;
            }
            else
            {
                $_SESSION["loggedin"] = TRUE;
                $_SESSION["id"] = $login['Paciente'];
                $_SESSION["tipo"] = 'paciente';
                header("Location: ..\Views\perfil_paciente.php");
                exit;
            }
        }
    }
    else if ($action == "logout")
    {
        session_start();
        Logout();

    }
}

function ValidaAcesso(string $tipoUsuario){
    session_start();
    
    if(!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] || $tipoUsuario != $_SESSION['tipo']){
        header("location: index.php");
        exit;
    }
}

function VerificaSeJaEstaLogado()
{
    if (session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }

    if (!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"]){
        return;
    }

    if ($_SESSION["tipo"] == "medico"){
        header("location: perfil_medico.php");
    }
    else if ($_SESSION["tipo"] == "paciente"){
        header("location: perfil_paciente.php");
    }
}

function Logout(){
    $_SESSION["loggedin"] = false;
    
    unset($_SESSION["loggedin"]);
    unset($_SESSION["id"]);
    unset($_SESSION["tipo"]);

    header("Location: ..\Views\index.php");
}

?>
