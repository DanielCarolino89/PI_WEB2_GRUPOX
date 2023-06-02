<?php

class PacienteController extends PessoaController
{
    private PacienteRepository $pacienteRepository;

    public function cadastrarNovoPaciente($dados)
    {
        $db = new Database();
        $this->pacienteRepository = new PacienteRepository($db);
        $this->loginRepository = new LoginRepository($db);

        $paciente = new Paciente($dados);

        $db->beginTransaction();

        try{
            $this->registrarDadosPessoais($paciente, $dados);            
            $this->pacienteRepository->registrarPaciente($paciente);

            $db->Commit();
        }
        catch(Exception $ex)
        {
            $db->Rollback();
        }
    }

    private function validarDadosDoPaciente($dados)
    {
        $errors = $this->validarDadosPessoais($dados, "Paciente");

        if (!isset($errors['cpf']) && $this->pacienteRepository->consultaSeCPFJaExiste($dados['cpf'])){
            $errors['cpf'] = "CPF do Paciente já cadastrado!";
        }

        if (!empty($errors)){
            return [
                'success' => false,
                'errors' => $errors
            ];
        }

        return ['success' => true];
    }
}