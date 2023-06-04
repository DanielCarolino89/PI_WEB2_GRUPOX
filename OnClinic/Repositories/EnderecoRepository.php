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
}
?>