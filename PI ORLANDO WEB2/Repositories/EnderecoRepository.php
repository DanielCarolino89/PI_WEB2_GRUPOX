<?php

class EnderecoRepository extends Repository
{

    public function __construct(Database $db)
    {
        parent::__construct($db); 
    }

    public function cadastrarEndereco(Endereco $endereco)
    {
        $sql = "INSERT INTO ENDERECO VALUES (
            NULL,
            '{$endereco->getLogradouro()}',
            {$endereco->getNumero()},      
            '{$endereco->getBairro()}',
            '{$endereco->getCidade()}',
            '{$endereco->getUF()}',
            '{$endereco->getComplemento()}');";

        $this->db->executeCommand($sql);
    }
}
?>