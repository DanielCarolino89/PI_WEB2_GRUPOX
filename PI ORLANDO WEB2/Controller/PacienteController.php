<?php
class PacienteController
{
    private PacienteRepository $pacienteRepository;
    private LoginRepository $loginRepository;

    public function CadastrarNovoPaciente($dados)
    {
        $db = new dbUtils();
        $this->pacienteRepository = new PacienteRepository($db);
        $this->$loginRepository = new LoginRepository($db);

        if (!ValidarCadastroDoPaciente($dados)){
            //to do: error
        }

        $peciente = new Paciente($dados);

        $db->BeginTransaction();
        try{
            
            $loginRepository->CadastrarLogin($paciente->get_Login());

            $enderecoRepository = new EnderecoRepository($db);
            $enderecoRepository->CadastrarEndereco($paciente->get_Endereco());

            $contatoRepository = new ContatoRepository($db);
            $contatoRepository->CadastrarContato($paciente->get_Contato());

            $pacienteRepository->RegistrarPaciente($paciente);

            $db->Commit();
        }
        catch(Exception ex)
        {
            $db->Rollback();
        }
    }

    private function ValidarDadosDoPaciente($dados) : bool
    {
        $errors = [];

        if (empty(trim($dados['nome'])) || strlen($dados['nome']) <= 3){
            $errors['nome'] = "O Nome do Paciente não pode ser vazio ou em branco!";
        }

        if (empty(trim($dados['cpf'])) || strlen($dados['cpf'] != 11)){
            $errors['cpf'] = "CPF inválido!";
        }

        if (empty(trim($dados['rg'])) || strlen($dados['rg'] != 9)){
            $errors['rg'] = "RG inválido!";
        }

        if (empty(trim($dados['usuario'])) || strlen($dados['usuario']) <= 4){
            $errors['usuario'] = "O Usuário não pode ser vazio ou em branco. Mínimo de caracteres: 4"
        }

        if (empty(trim($dados['senha'])) || strlen($dados['senha']) <= 4){
            $errors['senha'] = "A Senha não pode ser vazio ou em branco. Mínimo de caracteres: 4"
        }

        if (!isset($erros['cpf']) && $this->pacienteRepository->ConsultaSeCPFJaExiste($dados['cpf']){}
            $errors['cpf'] = "CPF do Paciente já cadastrado!";
        }

        $usuario = $paciente->get_Login()->get_Usuario();
        if (!isset($erros['usuario']) && $this->loginRepository->ConsultaSeUsuarioJaExiste($usuario)){
            $errors['usuario'] = "Este usuário já existe!";
        }

        if (!empty($errors)){
            return [
                'success' = false,
                'errors' => $errors;
            ]
        }
    }
}