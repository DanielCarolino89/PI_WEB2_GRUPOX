<?php

require('PessoaController.php');
require('../Models/Paciente.php');
require('../Repositories/PacienteRepository.php');
require_once('../Models/Database.php');

class PacienteController extends PessoaController
{
    public function cadastrarNovoPaciente($dados)
    {
        $db = new Database();
        $pacienteRepository = new PacienteRepository($db);
        if ($pacienteRepository->consultaSeCPFJaExiste($dados['cpf'])){

        }
        
        $paciente = new Paciente($dados);

        $db->beginTransaction();

        try{
            $this->registrarLogin($paciente, $db);            
            $pacienteRepository->registrarPaciente($paciente);
            $this->registrarEndereco($paciente, $db);
            $this->registrarContatos($paciente, $db);

            $db->Commit();
        }
        catch(Exception $ex)
        {
            $db->Rollback();
            echo $ex->getMessage();
        }
    }
}