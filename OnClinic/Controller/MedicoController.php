<?php

require('PessoaController.php');
require('../Models/Medico.php');
require('../Repositories/MedicoRepository.php');
require_once('../Models/Database.php');

class MedicoController extends PessoaController
{
    private MedicoRepository $medicoRepository;

    public function cadastrarNovoMedico($dados)
    {     
        $db = new Database();
        $this->medicoRepository = new MedicoRepository($db);

        $medico = new Medico($dados);

        $db->BeginTransaction();

        try
        {
            var_dump($db);
            echo '<br><br>';
            $this->registrarLogin($medico, $db);
            $this->medicoRepository->CadastrarMedico($medico);
            $this->registrarEspecialidades($medico, $db);
            $this->registrarEndereco($medico, $db);
            $this->registrarContatos($medico, $db);
           

            $db->Commit();
            echo 'comitado';
        }
        catch(Exception $ex)
        {
            $db->Rollback();
            echo $ex->getMessage();
        }
    }

    private function registrarEspecialidades($medico, $db)
    {
        require_once('../Repositories/EspecialidadeRepository.php');
        $especialidadeRepository = new EspecialidadeRepository($db);

        foreach($medico->getEspecialidades() as $especialidade)
        {
            $especialidade->setMedicoId($medico->getId());
            $especialidadeRepository->registrarEspecialidade($especialidade);
        }
    }

    public function consultarMedico(string $nome)
    {
        
        $db = new Database();
        
        $medicoRepository = new MedicoRepository($db, $nome);

        $medicosEncontrados = $medicoRepository->buscarMedico($nome);

        $medicos = [];
        foreach($medicosEncontrados as $medicoDados)
        {
            $medicos[] = new Medico($medicoDados);
        }

        return $medicos;
    }
}

?>