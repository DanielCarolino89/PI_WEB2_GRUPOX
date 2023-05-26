<?php
class MedicoService
{
    private MedicoRepository $medicoRepository;
    private LoginRepository $loginRepository;

    public function CadastrarNovoMedico(Medico $medico)
    {
        $db = new dbUtils();
        $this->pacienteRepository = new MedicoRepository($db);
        $this->$loginRepository = new LoginRepository($db);
        $db->BeginTransaction();

        try{
            $loginRepository = new LoginRepository($db);
            $loginRepository->CadastrarLogin($medico->get_Login());

            $enderecoRepository = new EnderecoRepository($db);
            $enderecoRepository->CadastrarEndereco($medico->get_Endereco());

            $contatoRepository = new ContatoRepository($db);
            $contatoRepository->CadastrarContato($medico->get_Contato());

            $pacienteRepository = new PacienteRepository($db);
            $pacienteRepository->CadastrarMedico($medico);

            $db->Commit();
        }
    }

    private function ValidarCadastroDoMedico(Medico $medico) : bool
    {
        if ($this->medicoRepository->ConsultaSeCPFJaExiste($medico->get_CPF())
        {
            // to do: retornar aviso de CPF já existente;
            return false;
        }

        $usuario = $medico->get_Login()->get_Usuario();
        if ($this->loginRepository->ConsultaSeUsuarioJaExiste($usuario))
        {
            // to do: retornar aviso de Usuário já existente;
            return false;
        }
    }


}
}
?>