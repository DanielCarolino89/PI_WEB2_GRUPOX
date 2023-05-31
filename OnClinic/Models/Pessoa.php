<?php

abstract class Pessoa
{
    protected int $id;
    protected string $nome;
    protected string $cpf;
    protected string $rg;
    protected DateTime $nascimento;
    protected Contato $contato;
    protected Endereco $endereco;
    protected Login $login;

    protected function AtribuirDados($dados)
    {
        $this->nome = $dados['nome'];
        $this->cpf = $dados['cpf'];
        $this->rg = $dados['rg'];
        $this->nascimento = $dados['nascimento'];
        
        $this->contato = new Contato();
        $this->contato->setTipo($dados['tipoContato']);
        $this->contato->setDescricao($dados['descricaoContato']);

        $this->endereco = new Endereco();
        $this->endereco->setLogradouro($dados['logradouro']);
        $this->endereco->setNumero($dados['numero']);
        $this->endereco->setBairro($dados['bairro']);
        $this->endereco->setCidade($dados['cidade']);
        $this->endereco->setUF($dados['uf']);
        $this->endereco->setComplemento($dados['complemento']);

        $this->login = new Login();
        $this->login->setUsuario($dados['usuario']);
        $this->login->setSenha($dados['senha']);
    }

    public function getId(){
        return $this->id;
    }

    public function getNome(){
        return $this->nome;
    }

    public function getCPF(){
        return $this->cpf;
    }

    public function getRG(){
        return $this->rg;
    }

    public function getDataNascimento(){
        return $this->nascimento;
    }

    public function getContato(){
        return $this->contato;
    }

    public function getEndereco(){
        return $this->endereco;
    }
    
    public function getLogin(){
        return $this->login;
    }  
}

?>