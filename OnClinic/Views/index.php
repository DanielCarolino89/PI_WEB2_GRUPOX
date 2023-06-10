<?php  
    
    require_once('../Repositories/LoginRepository.php');
    
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
            ?> <script>
                swal("Login Inválido", "Por favor, informe um usuário e senha existentes.", "warning");
                nome.focus();
            </script><?php
        }
        else
        {
            if(isset($login['Medico']))
            {
                $_SESSION['loggedin'] = TRUE;
                $_SESSION["id"] = $login['Medico'];
                header("Location: home_medico.php");
                exit;
            }
            else
            {
                $_SESSION['loggedin'] = TRUE;
                $_SESSION["id"] = $login['Paciente'];
                header("Location: home_paciente.php");
                exit;
            }
        }
    }

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <title>ON CLINIC</title>
</head>

<body>

    <!-- inicio navbar -->
    <nav class="nav navbar bg-light">
        <div id="navlogo">
            <img src="../img/Logo.png" alt="Bootstrap" width="250px">
        </div>
        <div id="navform">
            <form class="nav navbar d-flex" action="index.php" method="POST">
                <label class="navcolor"><b>Login:</b></label>
                <input class=" navform form-control me-2" name="login" id="login" style="width: 250px;" type="text" placeholder=""
                    aria-label="">
                <label class="navcolor"><b>Senha:</b></label>
                <input class=" navform form-control me-2" name="senha" id="senha" style="width: 250px;" type="password"
                    placeholder="" aria-label="Search">
                <button class="btn btn-outline-success" type="submit" id="btn_entrar">Entrar</button>
            </form>
        </div>
        </div>
        </div>
    </nav>
    <!-- fim navbar -->
    <br>
    <!-- inicio -->

    <table class="container">
        <tr>
            <th class="block">
                <img class="img1" src="../img/paciente1.png" alt="Bootstrap" width="500px">
            </th>
            <th class="block">
                <center>
                    <div class="texto">
                        <h2 class="h2"><b>Para Pacientes: </b><br>Ter acesso a um profissional de saúde a qualquer
                            momento</h2>
                        <p>Bem-estar para toda sua familia!</p>

                        <div class="d-grid gap-2 col-6 mx-auto">
                            <a href="cadastro_paciente.html" class="btn btn-light btn-lg"><b>CADASTRE-SE</b></a>
                        </div>

                    </div>
                </center>
                </div>
            </th>
        </tr>
    </table>
    <br>
    <hr>
    <br>
    <table class="container">
        <tr>
            <th class="block">
                <center>
                    <div class="texto">
                        <h2 class="h2"><b>Médicos e especialistas: </b>
                            <p>Cadastre-se para atender nossos pacientes!</p>

                            <div class="d-grid gap-2 col-6 mx-auto">
                                <a href="cadastro_medico.html" class="btn btn-light btn-lg"
                                    style="font:green"><b>CADASTRE-SE</b></a>
                            </div>
                    </div>
                </center>
                </div>
            </th>
            <th class="block">
                <img class="img2" src="../img/Medicos2.jpg" alt="Bootstrap" width="500px">
            </th>
        </tr>
    </table>
    <br>
    <hr>
    <br>
    <div class="info" style="background-image:url(../img/bg_info.jpg);">
        <br>
        <h2>Como funciona a consulta online?</h2>
        <p>
        <h3>Receber apoio profissional para sua saúde está mais acessivel do que nunca </h3>
        </p>
        <br>
        <p><i>
                <h5>* Escolha sua modalidade de atendimento, sendo o plantão ou agendamento com o médico da
                    especialidade de
                    sua escolha;</p>
        <p>* Caso opte pelo agendamento, escolha o horário que gostaria de ser atendido;</p>
        <p>* No momento do atendimento, certique-se de que está em um local com bom sinal de wi-fi, microfone e câmera
            funcionando, e inicie a sua sessão.</h4></i></p>
    </div>

    <!-- fim -->
    <br>
    <!-- inicio footer -->
    <footer id="footer" class="bg-light">
        <div>
            <b>Projeto Interdiciplinar - Fatec Araras - ®Grupo X - 2º Semestre 2023</b>
        </div>
    </footer>
    <!-- fim footer --></div>
    <script src="../js/login.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>