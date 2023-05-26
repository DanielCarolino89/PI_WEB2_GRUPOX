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
        $this->contato->set_Tipo($dados['tipoContato']);
        $this->contato->set_Descricao($dados['descricaoContato']);

        $this->endereco = new Endereco();
        $this->endereco->set_Logradouro($dados['logradouro']);
        $this->endereco->set_Numero($dados['numero']);
        $this->endereco->set_Bairro($dados['bairro']);
        $this->endereco->set_Cidade($dados['cidade']);
        $this->endereco->set_UF($dados['uf']);
        $this->endereco->set_Complemento($dados['complemento']);

        $this->login = new Login();
        $this->login->set_Usuario($dados['usuario']);
        $this->login->set_Senha($dados['senha']);
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