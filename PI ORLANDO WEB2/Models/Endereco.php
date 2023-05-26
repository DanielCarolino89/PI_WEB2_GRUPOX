<?php
class Endereco
{
    private int $id;
    private string $logradouro;
    private int $numero;
    private string $bairro;
    private string $cidade;
    private string $UF;
    private string $complemento;

     public function get_Id(): int {
        return $this->id;
    }

    public function set_Id(int $id) {
        $this->id = $id;
    }

    public function get_Logradouro(): string {
        return $this->logradouro;
    }

    public function set_Logradouro(string $logradouro) {
        $this->logradouro = $logradouro;
    }

    public function get_Numero(): int {
        return $this->numero;
    }

    public function set_Numero(int $numero): void {
        $this->numero = $numero;
    }

    public function get_Bairro(): string {
        return $this->bairro;
    }

    public function set_Bairro(string $bairro) {
        $this->bairro = $bairro;
    }

    public function get_Cidade(): string {
        return $this->cidade;
    }

    public function set_Cidade(string $cidade) {
        $this->cidade = $cidade;
    }

    public function get_UF(): string {
        return $this->UF;
    }

    public function set_UF(string $UF) {
        $this->UF = $UF;
    }

    public function get_Complemento(): string {
        return $this->complemento;
    }

    public function set_Complemento(string $complemento) {
        $this->complemento = $complemento;
    }
}
?>