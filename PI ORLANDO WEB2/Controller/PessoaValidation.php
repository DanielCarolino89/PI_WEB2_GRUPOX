<?php

class PessoaController
{
    protected 

    protected function ValidarDadosPessoais([] $dados, $tipoUsuario)
    {
        $errors = [];

        if (empty(trim($dados['nome'])) || strlen($dados['nome']) <= 3){
            $errors['nome'] = "O Nome do {$tipoUsuario} não pode ser vazio ou em branco!";
        }

        if (empty(trim($dados['cpf'])) || strlen($dados['cpf'] != 11)){
            $errors['cpf'] = "CPF do {$tipoUsuario} é inválido!";
        }

        if (empty(trim($dados['rg'])) || strlen($dados['rg'] != 9)){
            $errors['rg'] = "RG do {$tipoUsuario} é inválido!";
        }

        if (empty(trim($dados['usuario'])) || strlen($dados['usuario']) <= 4){
            $errors['usuario'] = "O Usuário não pode ser vazio ou em branco. Mínimo de caracteres: 4"
        }

        if (empty(trim($dados['senha'])) || strlen($dados['senha']) <= 4){
            $errors['senha'] = "A Senha não pode ser vazio ou em branco. Mínimo de caracteres: 4"
        }

        return $errors;
    }
}

?>