<?php

class EnderecoRepository
{

    public function __construct(dbUtils $db)
    {
        parent::__construct($db); 
    }

    public function CadastrarEndereco(Endereco $endereco)
    {
        $sql = "INSERT INTO ENDERECO VALUES (
            NULL,
            '{$endereco->getLogradouro()}',
            {$endereco->getNumero()},      
            '{$endereco->getBairro()}',
            '{$endereco->getCidade()}',
            '{$endereco->getUF()}',
            '{$endereco->getComplemento()}');";

        $db->DbCommandExec($sql);
        $endereco->setId($this->GetLastInsertId());
    }
}
?>