<?php

/**
 * Classe responsável pela exceução dos comandos SQL da tabela Endereço
 */
class EnderecoRepository extends Repository
{

    public function __construct(Database $db)
    {
        parent::__construct($db); 
    }

    /**
     * Cadastra o Endereço no banco de dados.
     * @param Endereco $endereco Modelo que contém os dados do endereço.
     * @throws PDOException caso ocorrer erro de sql.
     */
    public function cadastrarEndereco(Endereco $endereco)
    {
        $sql = "INSERT INTO ENDERECO VALUES (
            NULL,
            '{$endereco->getLogradouro()}',
            '{$endereco->getNumero()}',      
            '{$endereco->getBairro()}',
            '{$endereco->getCidade()}',
            '{$endereco->getUF()}',
            '{$endereco->getComplemento()}',
            " . ($endereco->getMedicoId() ? $endereco->getMedicoId() : "NULL") . ",
            " . ($endereco->getPacienteId() ? $endereco->getPacienteId() : "NULL") . ");";

        try{
            $this->db->executeCommand($sql);
        } catch(PDOException $ex){
            echo 'Ocorreu um erro ao cadastrar endereço.';
            echo "<br><br> SQL Executada: {$sql}<br>";
            throw $ex;
        }
    }


    /**
     * Consulta endereço do médico no banco de dados.
     * @param int $medicoId Id do médico que será realizada a consulta.
     * @return Endereco dados do endereço
     */
    public function consultarEnderecoDoMedico(int $medicoId)
    {
        return $this->consultarEnderecoPrincipal('MEDICO', $medicoId);
    }

    /**
     * Consulta endereço do paciente no banco de dados.
     * @param int $pacienteId Id do paciente que será realizada a consulta.
     * @return Endereco dados do endereço
     */
    public function consultarEnderecoDoPaciente(int $pacienteId)
    {
        return $this->consultarEnderecoPrincipal('PACIENTE', $pacienteId);
    }


    /**
     * Consulta endereço principal no banco de dados.
     * @param string $pessoa nome do campo que será realizada a consulta (Medico ou Paciente).
     * @param int $id Id da pessoa que será realizada a consulta.
     * @return Endereco dados do endereço.
     */
    private function consultarEnderecoPrincipal(string $pessoa, int $id)
    {
        $sql = "SELECT id, logradouro, numero, bairro, cidade, uf, complemento
        FROM ENDERECO
        WHERE {$pessoa} = {$id}";

        return $this->db->executeQuery($sql)->fetch();
    }
}
?>