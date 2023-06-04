<?php

require('PessoaController.php');
require('../Models/Paciente.php');
require('../Repositories/PacienteRepository.php');
require_once('../Models/Database.php');

class PacienteController extends PessoaController
{
    /**
     * Inicia conexão com banco de dados e abre uma transação para cadastrar todas as informações do paciente através dos repositórios.
     * @param array $dados conjunto que deve conter todos os dados do paciente.
     * @description As informações que serão cadastradas são:
     * - Login
     * - Paciente
     * - Endereco
     * - Contato
     * @criteria Os critérios para cadastrar são:
     * - Todos os dados do paciente deverão estar informado no array $dados.
     * - CPF não pode estar associado a outro cadastro.
     * - Login não pode estar associado a outro cadastro.
     */
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