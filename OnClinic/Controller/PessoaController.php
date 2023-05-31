<?php

abstract class PessoaController
{
    protected LoginRepository $loginRepository;

    protected function registrarDadosPessoais(Pessoa $pessoa, Database $db)
    {
        $this->loginRepository->cadastrarLogin($pessoa->getLogin());

        $enderecoRepository = new EnderecoRepository($db);
        $enderecoRepository->cadastrarEndereco($pessoa->getEndereco());

        $contatoRepository = new ContatoRepository($db);
        $contatoRepository->cadastrarContato($pessoa->getContato());
    }

    protected function validarDadosPessoais($dados, $tipoUsuario)
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
            $errors['usuario'] = "O Usuário não pode ser vazio ou em branco. Mínimo de caracteres: 4";
        }

        if (empty(trim($dados['senha'])) || strlen($dados['senha']) <= 4){
            $errors['senha'] = "A Senha não pode ser vazio ou em branco. Mínimo de caracteres: 4";
        }

        if (!isset($errors['usuario']) && $this->loginRepository->consultaSeUsuarioJaExiste($dados['usuario'])){
            $errors['usuario'] = "O usuário {$dados['usuario']} já existe!";
        }

        return $errors;
    }
}

?>