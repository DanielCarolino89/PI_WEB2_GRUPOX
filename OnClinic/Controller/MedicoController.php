<?php

require('PessoaController.php');
require('../Models/Medico.php');
require('../Repositories/MedicoRepository.php');
require_once('../Models/Uteis.php');
require_once('../Models/Database.php');

class MedicoController extends PessoaController
{
    private MedicoRepository $medicoRepository;

    public function cadastrarNovoMedico($dados)
    {     
        $db = new Database();
        $this->medicoRepository = new MedicoRepository($db);

        if ($this->medicoRepository->consultaSeCPFJaExiste($dados['cpf'])){
            Uteis::ShowAlert('CPF já cadastrado', 'Caso esqueceu a senha, clique em Esqueci senha');
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }

        $medico = new Medico($dados);

        $db->BeginTransaction();

        try
        {
            $this->registrarLogin($medico, $db);
            $this->medicoRepository->CadastrarMedico($medico);
            $this->registrarEspecialidades($medico, $db);
            $this->registrarEndereco($medico, $db);
            $this->registrarContatos($medico, $db);
           
            $db->Commit();
            Uteis::ShowInfo('Sucesso', 'Medico cadastrado com sucesso');
            
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