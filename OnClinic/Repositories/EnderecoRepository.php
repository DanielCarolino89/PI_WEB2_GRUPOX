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
            '{$endereco->getCep()}',
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
     * Cadastra o Endereço no banco de dados.
     * @param Endereco $endereco Modelo que contém os dados do endereço.
     * @throws PDOException caso ocorrer erro de sql.
     */
    public function alterarEndereco(Endereco $endereco)
    {
        $sql = "UPDATE ENDERECO SET
            LOGRADOURO = '{$endereco->getLogradouro()}',
            NUMERO = '{$endereco->getNumero()}',      
            BAIRRO = '{$endereco->getBairro()}',
            CIDADE = '{$endereco->getCidade()}',
            CEP = '{$endereco->getCep()}',
            UF = '{$endereco->getUF()}',
            COMPLEMENTO = '{$endereco->getComplemento()}',
            MEDICO = " . ($endereco->getMedicoId() ? $endereco->getMedicoId() : "NULL") . ",
            PACIENTE = " . ($endereco->getPacienteId() ?  $endereco->getPacienteId() : "NULL") . "
            WHERE ID = {$endereco->getId()}";

        try{
            $this->db->executeCommand($sql);
        } catch(PDOException $ex){
            echo 'Ocorreu um erro ao alterar endereço.';
            echo "<br><br> SQL Executada: {$sql}<br>";
            throw $ex;
        }
    }

    /**
     * Exclui o Endereço no banco de dados.
     * @param int $id id do endereço.
     * @throws PDOException caso ocorrer erro de sql.
     */
    public function excluirEndereco(int $id)
    {
        $sql = "DELETE FROM ENDERECO WHERE ID = {$id}";

        try{
            $this->db->executeCommand($sql);
        } catch(PDOException $ex){
            echo 'Ocorreu um erro ao alterar endereço.';
            echo "<br><br> SQL Executada: {$sql}<br>";
            throw $ex;
        }
    }

    public function excluirEnderecoDoMedico(int $id)
    {
        $sql = "DELETE FROM ENDERECO WHERE MEDICO = {$id}";

        try{
            $this->db->executeCommand($sql);
        } catch(PDOException $ex){
            echo 'Ocorreu um erro ao alterar endereço.';
            echo "<br><br> SQL Executada: {$sql}<br>";
            throw $ex;
        }
    }

    public function excluirEnderecoDoPaciente(int $id)
    {
        $sql = "DELETE FROM ENDERECO WHERE PACIENTE = {$id}";

        try{
            $this->db->executeCommand($sql);
        } catch(PDOException $ex){
            echo 'Ocorreu um erro ao alterar endereço.';
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
        $sql = "SELECT id as enderecoId, logradouro, numero, bairro, cidade, cep, uf, complemento
        FROM ENDERECO
        WHERE {$pessoa} = {$id}";

        return $this->db->executeQuery($sql)->fetch();
    }
}
?>