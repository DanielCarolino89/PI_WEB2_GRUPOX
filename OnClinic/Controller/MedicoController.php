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


    /**
     * Inicia conexão com banco de dados e abre uma transação para cadastrar todas as informações do médico através dos repositórios.
     * @param array $dados conjunto que deve conter todos os dados do médico.
     * @return bool True se cadastrado com sucesso.
     * @description As informações que serão cadastradas são:
     * - Login
     * - Medico
     * - Especialidades
     * - Endereco
     * - Contato
     * @criteria Os critérios para cadastrar são:
     * - Todos os dados do médico deverão estar informado no array $dados.
     * - CPF não pode estar associado a outro cadastro.
     * - Login não pode estar associado a outro cadastro.
     */
    public function cadastrarNovoMedico(array $dados)
    {     
        $db = new Database();
        $this->medicoRepository = new MedicoRepository($db);

        if ($this->medicoRepository->consultaSeCPFJaExiste($dados['cpf'])){
            Uteis::ShowAlert('CPF já cadastrado', 'Não é permitido ter mais de um cadastro por CPF');
            return;
        }

        if ($this->consultaSeUsuarioJaExiste($dados['usuario'], $db)){
            Uteis::ShowAlert('Usuário já cadastrado!', 'Por favor informe outro usuário para cadastrar-se');
            return;
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
            Uteis::ShowAlert('Usuário cadastrado com sucesso!' ,'success');
            
        }
        catch(Exception $ex)
        {
            $db->Rollback();
            echo $ex->getMessage();
        }
    }

    /**
     * Cadastra todas as especialidades associadas ao médico através do repositório utilizando uma conexão do banco de dados ativa.
     * @param Medico $medico Modelo que contém as informações das especialidades.
     * @param Database $db Gerenciador de conexões do banco de dados
     */
    private function registrarEspecialidades(Medico $medico, Database $db)
    {
        require_once('../Repositories/EspecialidadeRepository.php');
        $especialidadeRepository = new EspecialidadeRepository($db);

        foreach($medico->getEspecialidades() as $especialidade)
        {
            $especialidade->setMedicoId($medico->getId());
            $especialidadeRepository->registrarEspecialidade($especialidade);
        }
    }

    public function editarMedico(int $id, $dados)
    {
        $db = new Database();
        $this->medicoRepository = new MedicoRepository($db);

        if ($this->medicoRepository->consultaSeCPFJaExiste($dados['cpf']) 
        && $id !== $this->medicoRepository->consultaIdPorCPF($dados['cpf'])){
            Uteis::ShowAlert('CPF já cadastrado', 'Não é permitido ter mais de um cadastro por CPF');
            return;
        }

        $medico = new Medico($dados);
        $medico->setId($id);

        $this->setarIdDoEndereco($medico, $dados);
        $this->setarIdDosContatos($medico, $dados);
        
        $db->BeginTransaction();

        try
        {
            $this->alterarSenha($medico, $db);
            $this->alterarContatos($medico, $db);
            $this->alterarEndereco($medico, $db);
            $this->alterarEspecialidades($dados['especialidadeQtd'], $medico, $db);

            $this->medicoRepository->alterarDadosMedico($medico);

            $db->commit();
            Uteis::ShowAlert('Cadastro alterado com sucesso!', 'success');

        }
        catch(Exception $ex)
        {
            $db->rollback();
            echo $ex->getMessage();
        }
    }

    /**
     * Inicia conexão com banco de dados e realiza busca de médicos conforme filtros aplicados através do repositório
     * @param string $conteudo conteúdo que será aplicado o filtro.
     * @param string $filtro Filtro em que será realizada a busca.
     * @description OBSERVAÇÃO: Os filtros disponíveis são:
     * - Nome
     * - Cidade
     * - Especialidade 
     */
    public function consultarMedicos(string $nome, string $filtro)
    {       
        $db = new Database();
        $medicoRepository = new MedicoRepository($db);
        $medicosEncontrados = $medicoRepository->buscarMedico($nome, $filtro);

        $medicos = [];
        foreach($medicosEncontrados as $medicoDados){
            $medicos[] = $medicoDados;
        }

        return $medicos;
    }

    /**
     * Inicia conexão com banco de dados e consulta o médico detalhadamente incluindo endereço, contato e especialidade através do repositório
     * @param int $id Id do médico.
     * @return Medico dados completos do médico
     */
    public function consultarDetalhesMedico(int $idMedico){
        
        $db = new Database();
        $medicoRepository = new MedicoRepository($db);

        $db->beginTransaction();

        try{
            
            $dadosMedico = $medicoRepository->consultarDetalhesDoMedico($idMedico);
            $medico = new Medico($dadosMedico);
            $medico->setId($dadosMedico['id']);

            $this->carregarEspecialidades($medico, $db);
            $this->carregarContatos($medico, $db);
            $this->carregarEnderecoPrincipal($medico, $db);

            return $medico;
            
            
        }
        catch(Exception $ex)
        {
            $db->Rollback();
            echo $ex->getMessage();
        }
    }

    public function apagarMedico(int $id)
    {
        $db = new Database();
        $this->medicoRepository = new MedicoRepository($db);

        $db->beginTransaction();

        try{
            $usuario = $this->medicoRepository->consultarUsuarioDoMedico($id);
            $this->medicoRepository->removerAssociacaoLogin($id);

            require_once('../Repositories/LoginRepository.php');
            $loginRepository = new LoginRepository($db);
            $loginRepository->deletarUsuario($usuario);

            require_once('../Repositories/EspecialidadeRepository.php');
            $especialidadeRepository = new EspecialidadeRepository($db);
            $especialidadeRepository->excluirEspecialidadesDoMedico($id);

            require_once('../Repositories/EnderecoRepository.php');
            $enderecoRepository = new EnderecoRepository($db);
            $enderecoRepository->excluirEnderecoDoMedico($id);

            require_once('../Repositories/ContatoRepository.php');
            $contatoRepository = new ContatoRepository($db);
            $contatoRepository->excluirContatosDoMedico($id);

            $this->medicoRepository->excluirMedico($id);

            $db->commit();
        }
        catch(Exception $ex)
        {
            $db->Rollback();
            echo $ex->getMessage();
        }
    }

    /**
     * Carrega especialidades do médico através do repositório utilizando uma conexão do banco de dados ativa.
     * @param Medico $medico instancia do médico que será atribuída as especialidades
     * @param Database $db Gerenciador de conexão do banco de dados
     */
    private function carregarEspecialidades(Medico $medico, Database $db)
    {
        require_once('../Repositories/EspecialidadeRepository.php');
        $especialidadeRepository = new EspecialidadeRepository($db);

        $especialidades = $especialidadeRepository->consultarEspecialidadesDoMedico($medico->getId());
        
        foreach ($especialidades as $dados)
        {
            $especialidade = new Especialidade();
            $especialidade->setId($dados['id']);
            $especialidade->setDescricao($dados['descricao']);
            $especialidade->setFaixaEtaria($dados['complemento']);
            $especialidade->setMedicoId($medico->getId());

            $medico->addEspecialidade($especialidade);
        }
    }

    /**
     * Apaga especialidades do médico através do repositório utilizando uma nova conexão do banco de addos
     * @param int $id Id do médico.
     */
    public function apagarEspecialidades(int $id)
    {
        $db = new Database();

        require_once('../Repositories/EspecialidadeRepository.php');
        $especialidadeRepository = new EspecialidadeRepository($db);

        $especialidadeRepository->excluirEspecialidadesDoMedico($id);
    }

    private function alterarEspecialidades(int $especialidadeQtd, Medico $medico, Database $db){
        require_once('../Repositories/EspecialidadeRepository.php');
        $especialidadeRepository = new EspecialidadeRepository($db);
        
        for ($i = $especialidadeQtd; $i < count($medico->getEspecialidades()); $i++){
            $especialidade = $medico->getEspecialidades()[$i];
            $especialidade->setMedicoId($medico->getId());
            $especialidadeRepository->registrarEspecialidade($especialidade);
        }
        
    }
}

?>