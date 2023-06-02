<?php

abstract class PessoaController
{
    

    protected function registrarDadosPessoais(Pessoa $pessoa, Database $db)
    {
        

        $this->registrarEndereco($pessoa, $db);
        $this->registrarContatos($pessoa, $db);
        
    }
    
    protected function registrarLogin(Pessoa $pessoa, Database $db)
    {
        require_once('../Repositories/LoginRepository.php');
        $loginRepository = new LoginRepository($db);
        $loginRepository->cadastrarLogin($pessoa->getLogin());
    }

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

}

?>