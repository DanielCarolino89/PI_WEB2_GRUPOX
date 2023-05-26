<?php
class PacienteController extends PessoaController
{
    private PacienteRepository $pacienteRepository;

    public function CadastrarNovoPaciente($dados)
    {
        $db = new dbUtils();
        $this->pacienteRepository = new PacienteRepository($db);
        $this->$loginRepository = new LoginRepository($db);

        $validationResult = ValidarCadastroDoPaciente($dados)

        if (!$validationResult['success'])
            //to do: Error View
        }

        $peciente = new Paciente($dados);

        $db->BeginTransaction();

        try{
            $this->RegistrarDadosPessoais($paciente);            
            $pacienteRepository->RegistrarPaciente($paciente);

            $db->Commit();
        }
        catch(Exception ex)
        {
            $db->Rollback();
        }
    }

    private function ValidarDadosDoPaciente($dados)
    {
        $errors = $this->ValidarDadosPessoais($dados, "Paciente");

        if (!isset($errors['cpf']) && $this->pacienteRepository->ConsultaSeCPFJaExiste($dados['cpf']){}
            $errors['cpf'] = "CPF do Paciente já cadastrado!";
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