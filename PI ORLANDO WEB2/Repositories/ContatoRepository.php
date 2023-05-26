<?php

class ContatoRepository extends Repository
{
    public function __construct(dbUtils $db)
    {
        parent::__construct($db); 
    }

    public function CadastrarContato(Contato $contato)
    {
        $sql = "INSERT INTO CONTATO VALUES (
            NULL, 
            '{$contato->getTipo()}',
            '{$contato->getDescricao()}');";

        $db->DbCommandExec($sql);
        $contato->setId($this->GetLastInsertId());
    }
}

?>