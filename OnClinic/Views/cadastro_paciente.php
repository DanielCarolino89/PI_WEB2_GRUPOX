<?php

require '..\Requests\medico_requests.php';

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
                <h2>Cadastro de Paciente</h2>
                <a href="index.html"><button class="btn btn-outline-success">Voltar</button></a>
            </div>
        </div>
        </div>
        </div>
    </nav><br>
    <!-- fim navbar -->

    <!-- inicio -->
    <div class="div1">
        <center>
            <div class="cadastro bg-light">
                <h2>Insira seus dados para realizar o cadastro:</h2><br>
                <form method="post" class="row g-3 needs-validation" novalidate>
                    <div class="col-md-8">
                        <input type="hidden" name="action" value="Cadastrar">
                        <label for="nome" class="form-label">Nome:</label>
                        <input name="nome" type="text" class="form-control" id="nome" required>
                    </div>
                    <div class="col-md-4">
                        <label for="nascimento" class="form-label">Data de Nascimento:</label>
                        <input name="nascimento" type="date" class="form-control" id="nascimento" required>
                    </div>
                    <div class="col-md-4">
                        <label for="rg" class="form-label">RG:</label>
                        <input name="rg" type="text" class="form-control" id="rg" required>
                    </div>
                    <div class="col-md-4">
                        <label for="cpf" class="form-label">CPF:</label>
                        <input name="cpf" type="text" class="form-control" id="cpf" required>
                    </div>
                    <div class="col-md-4">
                        <label for="principal" class="form-label">Telefone Principal:</label>
                        <input name="contato[telefone]" type="numb" class="form-control" id="principal" required>
                    </div>
                    <div class="col-md-4">
                        <label for="whatsapp" class="form-label">Whatsapp:</label>
                        <input name="contato[whatsapp]" type="numb" class="form-control" id="whatsapp" required>
                    </div>
                    <div class="col-md-4">
                        <label for="email" class="form-label">E-mail:</label>
                        <input name="contato[email]" type="mail" class="form-control" id="email"  autocomplete="on" required>
                    </div>
                    <h2>Endereço:</h2><br>
                    <!-- Endereço paciente -->
                    <div class="col-md-2">
                        <label for="cep" class="form-label">CEP:</label>
                        <input name="cep" type="text" class="form-control" id="cep" required>
                    </div>
                    <div class="col-md-6">
                        <label for="logradouro" class="form-label">Logradouro:</label>
                        <input name="logradouro" type="text" class="form-control" id="log" required>
                    </div>
                    <div class="col-md-1">
                        <label for="numero" class="form-label">Nº:</label>
                        <input name="numero" type="number" class="form-control" id="numero" required>
                    </div>
                    <div class="col-md-3">
                        <label for="complemento" class="form-label">Complemento:</label>
                        <input name="complemento" type="text" class="form-control" id="complemento" required>
                    </div>
                    <div class="col-md-5">
                        <label for="bairro" class="form-label">Bairro:</label>
                        <input name="bairro" type="text" class="form-control" id="bairro" required>
                    </div>
                    <div class="col-md-5">
                        <label for="cidade" class="form-label">Cidade:</label>
                        <input name="cidade" type="text" class="form-control" id="cidade" required>
                    </div>
                    <div class="col-md-2">
                        <label for="uf" class="form-label">UF:</label>
                        <input name="uf" type="text" class="form-control" id="UF" required>
                    </div>

                    <!-- Fim endereço paciente -->
                    <div class="Loginsenha row g-3">
                        <h2>Acesso ao sistema:</h2>
                        <div class="col-md-4">
                            <label for="usuario" class="form-label">Login:</label>
                            <input name="usuario" type="text" class="form-control" id="usuario" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="senha" class="form-label">Senha:</label>
                            <input name="senha" type="password" class="form-control" id="senha" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="resenha" class="form-label">Confirmação de Senha:</label>
                            <input name="resenha" type="password" class="form-control" id="resenha" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                    </div><br>
                    <div class="col-12">
                        <input type="submit" class="btn btn-success" id="cadastrar" value="CADASTRAR"></input>
                    </div>
                </form>
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
    <script src="../js/validacao.js"></script>
</body>

</html>