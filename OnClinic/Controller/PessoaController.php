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

    private function carregarContatos(Medico $medico, Database $db)
    {
        require_once('../Repositories/ContatoRepository.php');
        $contatoRepository = new ContatoRepository($db);

        $contatos = $contatoRepository->consultarContatosDoMedico($medico->getId());
        foreach($contatos as $dados)
        {
            $contato = new Contato();
            $contato->setId($dados['id']);
            $contato->setMedicoId($dados['medico'] ?? null);
            $contatos->setTipo($dados['tipo'])

        }

        
    }
}

?>