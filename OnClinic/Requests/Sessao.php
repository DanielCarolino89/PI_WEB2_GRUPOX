<?php

require_once('../Repositories/LoginRepository.php');

$loginFalhou = false;
    
if($_SERVER["REQUEST_METHOD"] == "POST")
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
            $_SESSION['loggedin'] = TRUE;
            $_SESSION["id"] = $login['Medico'];
            header("Location: ..\Views\home_medico.php");
            exit;
        }
        else
        {
            $_SESSION['loggedin'] = TRUE;
            $_SESSION["id"] = $login['Paciente'];
            header("Location: ..\Views\home_paciente.php");
            exit;
        }
    }
}

function ValidaAcesso(){
    session_start();

    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: index.php");
        exit;
    }
}

?>
