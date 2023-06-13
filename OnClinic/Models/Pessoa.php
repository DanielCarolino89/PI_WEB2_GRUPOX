<?php

abstract class Pessoa
{
    protected int $id;
    protected string $nome;
    protected string $cpf;
    protected string $rg;
    protected DateTime $nascimento;
    protected Endereco $endereco;
    protected Login $login;
    protected $contatos = [];

    protected function atribuirDados($dados)
    {
        $this->nome = $dados['nome'];
        $this->cpf = $dados['cpf'] ?? "";
        $this->rg = $dados['rg'] ?? "";
        $this->nascimento = new DateTime($dados['nascimento']);
        
        $this->atribuirContatos($dados);
        $this->atribuirEndereco($dados);
        $this->atribuirLogin($dados);
    }

    private function atribuirContatos($dados)
    {
        if (!isset($dados['contato'])){
            return;
        }

        $dadosContatos = $dados['contato'];
        foreach($dadosContatos as $tipoContato => $conteudo)
        {
            if (empty($conteudo)){
                continue;
            }

            require_once('Contato.php');
            $contato = new Contato();
            $contato->setTipo($tipoContato);
            $contato->setDescricao($conteudo);

            $this->addContato($contato);
        }
    }

    public function atribuirEndereco($dados)
    {
        if (!isset($dados['logradouro'])){
            return;
        }

        require_once('Endereco.php');
        $this->endereco = new Endereco();
        $this->endereco->setLogradouro($dados['logradouro']);
        $this->endereco->setNumero($dados['numero']);
        $this->endereco->setBairro($dados['bairro']);
        $this->endereco->setCidade($dados['cidade']);
        $this->endereco->setUF($dados['uf']);
        $this->endereco->setComplemento($dados['complemento']);
    }

    public function atribuirLogin($dados)
    {
        if (!isset($dados['usuario'])){
            return;
        }

        require_once('Login.php');
        $this->login = new Login();
        $this->login->setUsuario($dados['usuario']);
        $this->login->setSenha($dados['senha']);
    }


    public function getId(){
        return $this->id;
    }

    public function setId(int $id){
        $this->id = $id;
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

    public function getEndereco(){
        return $this->endereco;
    }
    
    public function getLogin(){
        return $this->login;
    }  

    public function addContato(Contato $contato){
        $this->contatos[] = $contato;
    }

    public function getContatos(){
        return $this->contatos;
    }
}

?>