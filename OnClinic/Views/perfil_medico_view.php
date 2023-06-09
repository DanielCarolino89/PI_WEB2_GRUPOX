<?php

require '..\Requests\Sessao.php';
ValidaAcesso("paciente");

if (!isset($_GET['id']))
{
    header("Location: buscar.php");
}

require '..\Requests\medico_requests.php';
$medico = carregarMedico($_GET['id']);


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style.css">
    <title>ON CLINIC</title>

</head>

<body>

    <!-- inicio navbar -->
    <nav class="navbar" style="background-color: rgb(225, 225, 225);">
        <div id="navlogo">
            <img src="../img/Logo.png" alt="Bootstrap" width="250px" alt="Logotipo di site onClinic">
        </div>
        <div id="navform">
            <div class="navbar d-flex">
                <h2>Perfil Médico</h2>

                <a href="buscar.php"><button class="btn btn-outline-success">Voltar</button></a>
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
                                <img src="../img/mperfil.png" width="350px" style="margin-right: 20px;" alt="Imagem de perfil do médico"><br>
                            </th>
                            <th class="dropdown">
                                <h1><?php echo $medico->getNome(); ?></h1>
                                <h3>CRM: <?php echo $medico->getCRM(); ?></h3>
                                <h4>Especialidades</h4>
                                <?php foreach($medico->getEspecialidades() as $esp){
                                    echo $esp->getDescricao();
                                    echo ' (' . $esp->getFaixaEtaria() . ') ';
                                    echo '<br>';
                                } ?>
                                <br><br><br>
                                <!-- inicio dropdown's -->
                                <div class="btn-group">
                                    <button type="button" class="btn btn-success btn-lg dropdown-toggle"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <span>&#x260F;</span> Contatos
                                    </button>
                                    <ul class="dropdown-menu">
                                        <?php foreach ($medico->getContatos() as $contato): ?>
                                            <li><a class="dropdown-item" href="#"><?php echo $contato->getDescricao() ?></a></li>
                                        <?php endforeach ?>
                                    </ul>
                                </div>
                                <!--  dropdown's -->
                            </th>
                        </tr>
                      
                        <tr>
                            <th class="dropdown" colspan="2" style="padding-top:30px">
                                <h2>Mais detalhes</h2>
                                <?php echo $medico->getSobre(); ?>
                            </th>
                        </tr>
                    </table>
                </div>
                <hr>
                <h2>Locais de atendimento</h2>
                <div style="border-style:outset;border-color:lightgreen;width:100%;">
                    <div class="block" >
                    <h3><?php 
                    $endereco = $medico->getEndereco();
                    echo '<br><div style="text-align:left;margin-left:30px"><i>Rua: ';
                    echo $endereco->getLogradouro();
                    echo '<i>, ';
                    echo '<i>nº ';
                    echo $endereco->getNumero();
                    echo '<br>';
                    echo '<i>Bairro: ';
                    echo $endereco->getBairro();
                    echo '<br>';
                    echo '<i>Complemento: ';
                    echo $endereco->getComplemento();
                    echo '<br>';                          
                    ?></h3>
                </div>
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>