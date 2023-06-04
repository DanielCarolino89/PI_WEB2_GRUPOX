<?php

require('PessoaController.php');
require('../Models/Medico.php');
require('../Repositories/MedicoRepository.php');
require_once('../Models/Uteis.php');
require_once('../Models/Database.php');

/**
 * Classe responsável por todas as operações relacionadas ao Médico
 */
class MedicoController extends PessoaController
{
    private MedicoRepository $medicoRepository;

    public function cadastrarNovoMedico($dados)
    {     
        $db = new Database();
        $this->medicoRepository = new MedicoRepository($db);

        if ($this->medicoRepository->consultaSeCPFJaExiste($dados['cpf'])){
            //Uteis::ShowAlert('CPF já cadastrado', 'Caso esqueceu a senha, clique em Esqueci senha');
           return false; //header('Location: ' . $_SERVER['HTTP_REFERER']);
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

    public function consultarMedicos(string $nome, string $filtro)
    {       
        $db = new Database();
        $medicoRepository = new MedicoRepository($db);
        echo 'here';
        try{
            $medicosEncontrados = $medicoRepository->buscarMedico($nome, $filtro);
            print_r($medicosEncontrados);
    
            $medicos = [];
            foreach($medicosEncontrados as $medicoDados)
            {
                echo '<br><br>';
                echo $medicoDados['Especialidades'];
                echo '<br><br>';
                echo $medicoDados['EnderecoContato'];
               // print_r($medicoDados['Especialidades']);
               // print_r($medicoDados['EnderecoContato']);
                
            }
    
            return $medicos;
        }
        catch (Exception $ex)
        {
            echo $ex->getMessage();
        }
    }

    public function consultarDetalhesMedico(int $idMedico){
        $db = new Database();
        $medicoRepository = new MedicoRepository($db);

        $dadosMedico = $medicoRepository->consultarDetalhesMedico($idMedico);
    }
}

?>