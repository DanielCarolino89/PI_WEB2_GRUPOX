<?php

class MedicoController extends PessoaController
{
    private MedicoRepository $medicoRepository;

    public function cadastrarNovoMedico($dados)
    {
        $db = new Database();
        $this->medicoRepository = new MedicoRepository($db);
        parent::$loginRepository = new LoginRepository($db);

        $validationResult = $this->validarDadosDoMedico($dados);

        if(!$validationResult['success']){
            //to do: Error view
        }

        $medico = new Medico($dados);

        $db->BeginTransaction();

        try
        {
            $this->registrarDadosPessoais($medico, $db);
            $this->registrarEspecialidades($medico, $db);
           
            $this->medicoRepository->CadastrarMedico($medico);

            $db->Commit();
        }
        catch(Exception $ex)
        {
            $db->Rollback();
        }
    }

    private function validarDadosDoMedico($dados)
    {
        $errors = $this->validarDadosPessoais($dados, "Medico");

        if (empty(trim($dados['crm'])) || strlen($dados['crm']) != 7){
            $errors['crm'] = "O CRM do Médico é inválido";
        }

        if (empty(trim($dados['especialidade'])) || strlen($dados['especialidade']) <= 4){
            $errors['especialidade'] = "A especialidade do Médico não pode ser vazia ou em branco!";
        }

        if (!isset($errors['cpf']) && $this->medicoRepository->ConsultaSeCPFJaExiste($dados['cpf'])){
            $errors['cpf'] = "CPF do Médico já cadastrado!";
        }

        if (!empty($errors)){
            return [
                'success' => false,
                'errors' => $errors
            ];
        }
        return ['success' => true];
    }

    private function registrarEspecialidades($medico, $db)
    {
        $especialidadeRepository = new EspecialidadeRepository($db);
        foreach($medico->getEspecialidades as $especialidade)
        {
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