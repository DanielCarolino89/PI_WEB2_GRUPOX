<?php 

require '..\Requests\Sessao.php';
ValidaAcesso();

require '..\Requests\medico_requests.php';

if (count($_GET) == 0){
    $medicos = $medicoControlador->consultarMedicos("", "Nome");
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
    <nav class="navbar bg-light">
        <div id="navlogo">
            <img src="../img/Logo.png" alt="Bootstrap" width="250px">
        </div>
        <div id="navform">
            <div class="navbar d-flex">
                <h2>Buscar Médicos ou especialistas</h2>
                <a href="perfil_paciente.php"><button class="btn btn-outline-success">Voltar</button></a>
            </div>
        </div>       
    </nav><br>
    <!-- fim navbar -->

    <!-- inicio -->
    <div class="div1">
        <center>
            <br>
            <div class="cadastro bg-light">
                <h2>Encontre seu médico:</h2><br>
                <!--Inicio Dados do médico -->
                <form method="get" class="row g-3 needs-validation" novalidate>
                    <center>
                        <input type="hidden" name="action" value="Pesquisar">
                        <input name="conteudo" type="text" style="width:900px;" class="form-control" id="" required><br>
                        <table>
                            <tr>
                                <th class="thb"> <input class="form-check-input" type="radio" name="filtro" value="Nome"
                                        id="flexRadioDefault2" checked>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Nome
                                    </label>
                                </th>
                                <th class="thb">
                                    <input class="form-check-input" type="radio" name="filtro" value="Especialidade"
                                        id="flexRadioDefault2">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Especialidade
                                    </label>
                                </th>
                                <th class="thb">
                                    <input class="form-check-input" type="radio" name="filtro" value="Cidade"
                                        id="flexRadioDefault2">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Cidade
                                    </label>
                                </th>
                                <th class="thb">
                                    <input type="submit" class="btn btn-success btn-sm" value="BUSCAR">
                                </th>
                            </tr>
                        </table>

                    </center>
                </form>
            </div>
        </center>
    </div>
    <br>
    <div class="div1">
        <center>
            <div class="cadastro bg-light">
                <br>
                <?php if (empty($medicos)): ?>
                    <h1>Nenhum médico encontrado!</h1>
                <?php else: ?>
                    <?php foreach($medicos as $medico): ?>
                        <div class="row" style="border:outset;padding:15px ">
                            <table>
                                <tr>
                                    <td style="width:20px">
                                        <h4>Médico:</h4>
                                    </td>
                                    <td>
                                        <h4><?php echo $medico['nome']; ?></h4>
                                    </td>
                                    <td rowspan="4" style="width:125px">
                                        <a class="btn btn-primary" href="<?php echo "perfil_medico_view.php?id={$medico['id']}" ?>">Mais detalhes</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h4>Especialidade(s):</h4>
                                    </td>
                                    <td>
                                        <h4><?php echo $medico['especialidades']; ?></h4>
                                    </td>
                                   
                                </tr>
                                <tr>
                                    <td>
                                        <h4>Cidade(s):</h4>
                                    </td>
                                    <td>
                                        <h4><?php echo $medico['cidades']; ?></h4>
                                    </td>
                                   
                                </tr>
                                <tr>
                                    <td>
                                        <h4>Descrição:</h4>
                                    </td>
                                    <td>
                                        <h4><?php echo $medico['sobre']; ?></h4>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <br>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </center>
    </div>

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
</body>

</html>