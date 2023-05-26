<?php

class ContatoRepository
{
    public function __construct(dbUtils $db)
    {
        parent::__construct($db); 
    }

    public function CadastrarContato(Contato $contato)
    {
        $sql = "INSERT INTO CONTATO VALUES (
            NULL, 
            '" . $contato->get_Tipo() . "',
            '" . $contato->get_Descricao() . "');";

        $db->DbCommandExec($sql);
        $contato->set_Id($this->GetLastInsertId());
    }
}

?>