<?php

/**
 * Classe abstrata responsável por todas operações em comum a Pessoa
 */
abstract class PessoaController
{
        /**
     * Consulta se já existe cadastro para o usuário informado através do repositório utilizando uma conexão do banco de dados ativa.
     * @param string $usuario usuario informado.
     * @param Database $db Gerenciador de conexão do banco de dados
     */
    protected function consultaSeUsuarioJaExiste(string $usuario, Database $db)
    {
        require_once('../Repositories/LoginRepository.php');
        $loginRepository = new LoginRepository($db);
        return $loginRepository->consultaSeUsuarioJaExiste($usuario);
    }

    /**
     * Cadastra usuário através do repositório utilizando uma conexão do banco de dados ativa.
     * @param Pessoa $pessoa Modelo que contém as informações do login.
     * @param Database $db Gerenciador de conexão do banco de dados
     */
    protected function registrarLogin(Pessoa $pessoa, Database $db)
    {
        require_once('../Repositories/LoginRepository.php');
        $loginRepository = new LoginRepository($db);
        $loginRepository->cadastrarLogin($pessoa->getLogin());
    }

    /**
     * Cadastra endereço através do repositório utilizando uma conexão do banco de dados ativa.
     * @param Pessoa $pessoa Modelo que contém as informações do endereço.
     * @param Database $db Gerenciador de conexão do banco de dados
     */
    protected function registrarEndereco(Pessoa $pessoa, Database $db)
    {
        require_once('../Repositories/EnderecoRepository.php');
        $enderecoRepository = new EnderecoRepository($db);

        $endereco = $pessoa->getEndereco();
        if ($pessoa instanceof Medico){
            $endereco->setMedicoId($pessoa->getId());
        } 
        else {
            $endereco->setPacienteId($pessoa->getId());
        }

        $enderecoRepository->cadastrarEndereco($pessoa->getEndereco());
    }

    /**
     * Carrega endereço princiapl da Pessoa através do repositório utilizando uma conexão do banco de dados ativa.
     * @param Pessoa $pessoa instancia que será atribuído o endereço
     * @param Database $db Gerenciador de conexão do banco de dados
     */
    public function carregarEnderecoPrincipal(Pessoa $pessoa, Database $db)
    {
        require_once('../Repositories/EnderecoRepository.php');
        $enderecoRepository = new EnderecoRepository($db);
        
        $endereco = null;
        if ($pessoa instanceof Medico){
            $endereco = $enderecoRepository->consultarEnderecoDoMedico($pessoa->getId());
        }
        else {
            $endereco = $enderecoRepository->consultarEnderecoDoPaciente($pessoa->getId());
        }

        $pessoa->atribuirEndereco($endereco);
    }

    /**
     * Cadastra contato através do repositório utilizando uma conexão do banco de dados ativa.
     * @param Pessoa $pessoa Modelo que contém as informações do contato.
     * @param Database $db Gerenciador de conexão do banco de dados
     */
    protected function registrarContatos(Pessoa $pessoa, Database $db)
    {
        require_once('../Repositories/ContatoRepository.php');
        $contatoRepository = new ContatoRepository($db);

        $definirIdFunction = null;
        if ($pessoa instanceof Medico){
            $definirIdFunction = function($contato) use ($pessoa){
                $contato->setMedicoId($pessoa->getId());
            };
        } 
        else {
            $definirIdFunction = function($contato) use ($pessoa){
                $contato->setPacienteId($pessoa->getId());
            };
        }

        foreach($pessoa->getContatos() as $contato)
        {
            $definirIdFunction($contato);
            $contatoRepository->cadastrarContato($contato);
        }
    }

    /**
     * Carrega contatos da Pessoa através do repositório utilizando uma conexão do banco de dados ativa.
     * @param Pessoa $pessoa instancia que será atribuído os contatos
     * @param Database $db Gerenciador de conexão do banco de dados
     */
    public function carregarContatos(Pessoa $pessoa, Database $db)
    {
        require_once('../Repositories/ContatoRepository.php');
        $contatoRepository = new ContatoRepository($db);

        $contatos = [];
        if ($pessoa instanceof Medico){
            $contatos = $contatoRepository->consultarContatosDoMedico($pessoa->getId());
        }
        else {
            $contatos = $contatoRepository->consultarContatosDoPaciente($pessoa->getId());
        }

        require_once '../Models/Contato.php';
        foreach($contatos as $dados)
        {

            $contato = new Contato();
            $contato->setId($dados['Id']);
            $contato->setMedicoId($dados['Medico'] ?? null);
            $contato->setPacienteId($dados['Paciente'] ?? null);
            $contato->setTipo($dados['Tipo']);
            $contato->setDescricao($dados['Descricao']);

            $pessoa->addContato($contato);
        }
    }
}

?>