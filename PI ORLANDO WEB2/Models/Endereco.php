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

     public function getId(): int {
        return $this->id;
    }

    public function setId(int $id) {
        $this->id = $id;
    }

    public function getLogradouro(): string {
        return $this->logradouro;
    }

    public function setLogradouro(string $logradouro) {
        $this->logradouro = $logradouro;
    }

    public function getNumero(): int {
        return $this->numero;
    }

    public function setNumero(int $numero): void {
        $this->numero = $numero;
    }

    public function getBairro(): string {
        return $this->bairro;
    }

    public function setBairro(string $bairro) {
        $this->bairro = $bairro;
    }

    public function getCidade(): string {
        return $this->cidade;
    }

    public function setCidade(string $cidade) {
        $this->cidade = $cidade;
    }

    public function getUF(): string {
        return $this->UF;
    }

    public function setUF(string $UF) {
        $this->UF = $UF;
    }

    public function getComplemento(): string {
        return $this->complemento;
    }

    public function setComplemento(string $complemento) {
        $this->complemento = $complemento;
    }
}
?>