<?php

require '..\Requests\Sessao.php';
ValidaAcesso("medico");

require '..\Requests\medico_requests.php';
$medico = carregarMedico($_SESSION['id']);
$endereco = $medico->getEndereco();
$contatos = $medico->getContatos();
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
                <h2>Edição de cadastro de Médico</h2>
                <a href="perfil_medico.php"><button class="btn btn-outline-success">Voltar</button></a>
            </div>
        </div>      
    </nav><br>
    <!-- fim navbar -->

    <!-- inicio -->
    <div class="div1">
        <center>
            <div class="cadastro bg-light">
                <h2>Dados para editar:</h2><br>
                <!--Inicio Dados do médico -->
                <form action="../Requests/medico_requests.php" method="post" class="row g-3 needs-validation" novalidate>
                    <div class="col-md-8">
                        <input type="hidden" name="action" value="Cadastrar">
                        <label for="nome" class="form-label">Nome:</label>
                        <input name="nome" type="text" class="form-control" id="nome" value="<?php echo $medico->getNome(); ?>" required>
                    </div>
                    <div class="col-md-4">
                        <label for="crm" class="form-label">CRM:</label>
                        <input name="crm" type="text" class="form-control" id="crm" value="<?php echo $medico->getCRM(); ?>" required>
                    </div>
                    <div class="col-md-4">
                        <label for="rg" class="form-label">RG:</label>
                        <input name="rg" type="text" class="form-control" id="rg" value="<?php echo $medico->getRG(); ?>" required>
                    </div>
                    <div class="col-md-4">
                        <label for="cpf" class="form-label">CPF:</label>
                        <input name="cpf" type="text" class="form-control" id="cpf" value="<?php echo $medico->getCPF(); ?>" required>
                    </div>

                    <div class="col-md-4">
                        <label for="nascimento" class="form-label">Data de Nascimento:</label>
                        <input name="nascimento" type="date" class="form-control" id="nascimento" value="<?php echo $medico->getDataNascimento()->format("yyyy/MM/dd"); ?>"  required>
                    </div>
                    <div class="col-md-4">
                        <label for="principal" class="form-label">Telefone Principal:</label>
                        <input name="contato[telefone]" type="numb" class="form-control" id="principal" value="<?php echo isset($contatos[0]) ? $contatos[0]?->getDescricao() : ''; ?>" required>
                    </div>
                    <div class="col-md-4">
                        <label for="whatsapp" class="form-label">Whatsapp:</label>
                        <input name="contato[whatsapp]" type="numb" class="form-control" id="whatsapp" value="<?php echo isset($contatos[1]) ? $contatos[1]?->getDescricao() : ''; ?>" required>
                    </div>
                    <div class="col-md-4">
                        <label for="email" class="form-label">E-mail:</label>
                        <input name="contato[email]" type="e-mail" class="form-control" id="email" value="<?php echo isset($contatos[2]) ? $contatos[2]?->getDescricao() : ''; ?>"  autocomplete="on" required>
                    </div>
                    <!-- Fim dados do médico --><br>
                    <h2>Endereço:</h2><br>
                    <!-- Endereço médico -->
                    <div class="col-md-2">
                        <label for="cep" class="form-label">CEP:</label>
                        <input name="cep" type="text" class="form-control" id="cep" required>
                    </div>
                    <div class="col-md-6">
                        <label for="log" class="form-label">Logradouro:</label>
                        <input name="logradouro" type="text" class="form-control" id="log" value="<?php echo $endereco->getLogradouro(); ?>" required>
                    </div>
                    <div class="col-md-1">
                        <label for="numero" class="form-label">Nº:</label>
                        <input name="numero" type="number" class="form-control" id="numero" value="<?php echo $endereco->getNumero(); ?>" required>
                    </div>
                    <div class="col-md-3">
                        <label for="complemento" class="form-label">Complemento:</label>
                        <input name="complemento" type="text" class="form-control" id="complemento" value="<?php echo $endereco->getComplemento(); ?>" required>
                    </div>
                    <div class="col-md-5">
                        <label for="bairro" class="form-label">Bairro:</label>
                        <input name="bairro" type="text" class="form-control" id="bairro" value="<?php echo $endereco->getLogradouro(); ?>" required>
                    </div>
                    <div class="col-md-5">
                        <label for="cidade" class="form-label">Cidade:</label>
                        <input name="cidade" type="text" class="form-control" id="cidade" value="<?php echo $endereco->getCidade(); ?>" required>
                    </div>
                    <div class="col-md-2">
                        <label for="UF" class="form-label">UF:</label>
                        <input name="uf" type="text" class="form-control" id="UF" value="<?php echo $endereco->getUF(); ?>" required>
                    </div>

                    <!-- Fim endereço médico -->
                    <!-- inicio sobre médico -->

                    <div class="col-md-6">
                        <label for="sobre" class="form-label">Sobre:</label>
                        <textarea name="sobre" class="form-control" rows="9" cols="50" id="sobre"
                            required><?php echo $medico->getSobre(); ?></textarea>
                    </div>

                    <div class="col-md-6">
                        <label for="especialidade" class="form-label">Especialidades:</label>
                        <table>
                            <tr>
                                <th><input name="especialidade" type="text" class="form-control"
                                        id="especialidade" style="width:246px" required> </th>
                                <th><select class="form-select" id="subespecialidade" aria-label="Default select example" style="margin-left:10px">
                                        <option value="Geral" selected>Geral</option>
                                        <option value="Pediátrico">Pediátrico</option>
                                        <option value="Geriátrico">Geriátrico</option>
                                    </select>
                                </th>
                                <th><a class="btn btn-success" id="inserir" style="margin-left:15px"><b>Inserir</b></a>
                                </th>
                            </tr>
                        </table><br> <textarea name="especialidades" readonly rows="6" cols="60" id="especialidades">
                            <?php
                                foreach($medico->getEspecialidades() as $especialidade)
                                {
                                    echo $especialidade->getDescricao() . "\t\t" . $especialidade->getFaixaEtaria();
                                }
                            ?>
                        </textarea></td>
                        <button class="btn btn-success" onclick="limparEspecialidades()">Limpar Especialidades</button>
                        <script>

                            function limparEspecialidades()
                            {
                                event.preventDefault();
                                document.getElementById('especialidades').value = '';
                            }
                        </script>
                    </div>

                    ''
                    <!-- inicio sobre médico -->
                    <div class="Loginsenha row g-3">
                        <h2>Acesso ao sistema:</h2>
                        <input name="usuario" type="hidden" class="form-control" id="usuario" value="<?php $medico->getLogin()->getUsuario(); ?>" required>
                        <div class="col-md-4">
                            <label for="senha" class="form-label">Insira uma senha:</label>
                            <input name="senha" type="password" class="form-control" id="senha" value="<?php $medico->getLogin()->getSenha(); ?>" required>

                        </div>
                        <div class="col-md-4">
                            <label for="resenha" class="form-label">Confirmação de Senha:</label>
                            <input name="senha" type="password" class="form-control" id="resenha" value="<?php $medico->getLogin()->getSenha(); ?>" required>

                        </div>
                    </div><br>
                    <div class="col-12">
                        <input type="submit" value="EDITAR" class="btn btn-success" id="cadastrar">
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
    <script src="../js/medico.js"></script>
</body>

</html>