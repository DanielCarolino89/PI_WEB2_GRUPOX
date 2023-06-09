<?php

require '..\Requests\Sessao.php';
ValidaAcesso("paciente");

require '..\Requests\paciente_requests.php';
$paciente = carregarPaciente($_SESSION['id']);

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
    <nav class="navbar" style="background-color: rgb(225, 225, 225);">
        <div id="navlogo">
            <img src="../img/Logo.png" alt="Bootstrap" width="250px">
        </div>
        <div id="navform">
            <div class="navbar d-flex">
                <h2>Perfil Paciente</h2>
                <form method="post">
                    <input type="hidden" name="action" value="logout">
                    <button class="btn btn-outline-success">Logout</button></a>
                </form>
            </div>
        </div>       
    </nav><br>
    <!-- fim navbar -->

    <!-- inicio -->
    <div class="div1">
        <center>
            <div class="perfil">
                <div>
                    <hr>
                    <table style="width:100%;">
                        <tr>
                            <th class="dropdown">
                                <img src="../img/pperfil.png" width="350px" style="margin-right: 20px;"><br>

                            </th>
                            <th class="dropdown">
                                <h1>Bem Vindo</h1>
                                <h1><?php echo $paciente->getNome(); ?></h1>
                                <br><br><br>
                                <!-- inicio dropdown's -->
                                <div class="btn-group">
                                    <a href="edit_paciente.php" class="btn btn-warning btn-lg"><b>EDITAR PERFIL</b></a>
                                    <form method="post" id="formExcluir" >
                                    <button type="submit" name="action" value="Excluir" class="btn btn-danger btn-lg" id="excluir"
                                        style="margin-left: 30px;"><b>EXCLUIR PERFIL</b></button>
                                    </form>
                                    <a href="buscar.php" class="btn btn-success btn-lg"
                                        style="margin-left: 30px;"><b>PROCURAR MÉDICO</b></a>
                                </div>

                                <!--  dropdown's -->
                            </th>
                        </tr>

                        <tr>
                            <th class="dropdown" colspan="2" style="padding-top:30px">
                                <h2>Dados do paciente:</h2>
                                <div style="border-style:outset;border-color:lightgreen;width:100%;">
                                    <?php
                                        echo 'CPF: ';
                                        echo $paciente->getCPF();
                                        echo '<br>';
                                        echo 'RG: ';
                                        echo $paciente->getRG();
                                        echo '<br>';
                                    ?>
                                </div>
                            </th>
                        </tr>
                    </table>
                </div>
                <hr>

            </div>
        </center>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
    <script src="../js/perfil.js"></script>
</body>

</html>