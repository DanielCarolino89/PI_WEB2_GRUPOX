<?php

require('PessoaController.php');
require('../Models/Paciente.php');
require('../Repositories/PacienteRepository.php');
require_once('../Models/Uteis.php');
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
            Uteis::ShowAlert('CPF já cadastrado', 'Não é permitido ter mais de um cadastro por CPF');
            return;
        }

        if ($this->consultaSeUsuarioJaExiste($dados['usuario'], $db)){
            Uteis::ShowAlert('Usuário já cadastrado!', 'Por favor informe outro usuário para cadastrar-se');
            return;
        }
        
        $paciente = new Paciente($dados);

        $db->beginTransaction();

        try{
            $this->registrarLogin($paciente, $db);            
            $pacienteRepository->registrarPaciente($paciente);
            $this->registrarEndereco($paciente, $db);
            $this->registrarContatos($paciente, $db);

            $db->Commit();
            Uteis::ShowAlert('Usuário cadastrado com sucesso!', '');
        }
        catch(Exception $ex)
        {
            $db->Rollback();
            echo $ex->getMessage();
        }
    }

    /**
     * Inicia conexão com banco de dados e consulta o paciente detalhadamente incluindo endereço, contato e usuário através do repositório
     * @param int $id Id do paciente.
     * @return Paciente dados completos do paciente
     */
    public function consultarPaciente(int $id)
    {

        $db = new Database();
        $pacienteRepository = new PacienteRepository($db);

        $db->beginTransaction();

        try{
            $dadosPaciente = $pacienteRepository->consultaPaciente($id);
            
            $paciente = new Paciente($dadosPaciente);
            $paciente->setId($dadosPaciente['id']);

            $this->carregarContatos($paciente, $db);
            $this->carregarEnderecoPrincipal($paciente, $db);

            return $paciente;
            
        }
        catch(Exception $ex)
        {
            $db->Rollback();
            echo $ex->getMessage();
        }
    }
}