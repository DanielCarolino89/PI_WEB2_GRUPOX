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
            Notificator::Alert('CPF já cadastrado', 'Não é permitido ter mais de um cadastro por CPF');
            return;
        }

        if ($this->consultaSeUsuarioJaExiste($dados['usuario'], $db)){
            Notificator::Alert('Usuário já cadastrado!', 'Por favor informe outro usuário para cadastrar-se');
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
            Notificator::Inform('Usuário cadastrado com sucesso!', '');
        }
        catch(Exception $ex)
        {
            $db->Rollback();
            Notificator::Error("Erro", "Falha ao cadastrar paciente!");
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
            Notificator::Error("Erro", "Falha ao consultar dados do paciente!");
        }
    }

    public function editarPaciente(int $id, $dados)
    {
        $db = new Database();
        $pacienteRepository = new PacienteRepository($db);

        if ($pacienteRepository->consultaSeCPFJaExiste($dados['cpf']) 
        && $id !== $pacienteRepository->consultaIdPorCPF($dados['cpf'])){
            Notificator::Alert('CPF já cadastrado', 'Não é permitido ter mais de um cadastro por CPF');
            return;
        }

        $paciente = new Paciente($dados);
        $paciente->setId($id);

        $this->setarIdDoEndereco($paciente, $dados);
        $this->setarIdDosContatos($paciente, $dados);

        $db->beginTransaction();

        try{
            $this->alterarSenha($paciente, $db);
            $this->alterarContatos($paciente, $db);
            $this->alterarEndereco($paciente, $db);
            
            $pacienteRepository->alterarPaciente($paciente);

            $db->commit();
            Notificator::Inform('Cadastro alterado com sucesso!','');
            
        }
        catch(Exception $ex){
            $db->rollback();
            Notificator::Error("Erro", "Falha ao alterar dados do paciente!");
        }
    }

    public function apagarPaciente(int $id)
    {
        $db = new Database();
        $pacienteRepository = new PacienteRepository($db);

        $db->beginTransaction();
        
        try
        {
            $usuario = $pacienteRepository->consultarUsuarioDoPaciente($id);
            $pacienteRepository->removerAssociacaoLogin($id);

            require_once('../Repositories/LoginRepository.php');
            $loginRepository = new LoginRepository($db);
            $loginRepository->deletarUsuario($usuario);

            require_once('../Repositories/EnderecoRepository.php');
            $enderecoRepository = new EnderecoRepository($db);
            $enderecoRepository->excluirEnderecoDoPaciente($id);

            require_once('../Repositories/ContatoRepository.php');
            $contatoRepository = new ContatoRepository($db);
            $contatoRepository->excluirContatosDoPaciente($id);

            $pacienteRepository->excluirPaciente($id);
            Notificator::Inform('Paciente excluído com sucesso!' ,'');
            
            $db->commit();
            
        }
        catch(Exception $ex)
        {
            $db->rollback();
            Notificator::Error("Erro", "Falha ao excluir paciente!");
            
        }
    }
}