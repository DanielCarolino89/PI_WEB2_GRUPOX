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
            '" . $endereco->get_Logradouro() . "',
            " . $endereco->get_Numero() . ",      
            '" . $endereco->get_Bairro() . "',
            '" . $endereco->get_Cidade() . "',
            '" . $endereco->get_UF() . "',
            '" . $endereco->get_Complemento() . "');";

        $db->DbCommandExec($sql);
        $endereco->set_Id($this->GetLastInsertId());
    }
}
?>