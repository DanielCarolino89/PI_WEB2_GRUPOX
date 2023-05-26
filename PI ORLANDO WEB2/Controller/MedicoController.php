<?php
class MedicoController extends PessoaController
{
    private MedicoRepository $medicoRepository;

    public function CadastrarNovoMedico($dados)
    {
        $db = new dbUtils();
        $this->medicoRepository = new MedicoRepository($db);
        $this->$loginRepository = new LoginRepository($db);

        $validationResult = ValidarCadastroDoMedico($dados);

        if(!$validationResult['success']){
            //to do: Error view
        }

        $medico = new Medico($dados);

        $db->BeginTransaction();

        try{
            $this->RegistrarDadosPessoais($medico);
            $pacienteRepository->CadastrarMedico($medico);

            $db->Commit();
        }
        catch(Exception ex)
        {
            $db->Rollback();
        }
    }

    private function ValidarCadastroDoMedico($dados) : bool
    {
        $errors = $this->ValidarDadosPessoais($dados, "Medico");

        if (empty(trim($dados['crm'])) || strlen($dados['crm']) != 7){
            $errors['crm'] = "O CRM do Médico é inválido";
        }

        if (empty(trim($dados['especialidade'])) || strlen($dados['especialidade']) <= 4){
            $errors['especialidade'] = "A especialidade do Médico não pode ser vazia ou em branco!";
        }

        if (!isset($errors['cpf']) && $this->medicoRepository->ConsultaSeCPFJaExiste($dados['cpf']){
            $errors['cpf'] = "CPF do Médico já cadastrado!";
        }

        if (!empty($errors)){
            return [
                'success' => false,
                'errors' => $errors;
            ]
        }
        return ['success' => true];
    }
}
?>