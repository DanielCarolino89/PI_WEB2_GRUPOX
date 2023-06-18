<?php

class Endereco
{
    private int $id;
    private string $logradouro;
    private string $numero;
    private string $bairro;
    private string $cidade;
    private string $cep;
    private string $UF;
    private string $complemento;
    private ?int $medicoId = null;
    private ?int $pacienteId = null;

     public function getId(): int {
        return $this->id;
    }

    public function setId(int $id) {
        $this->id = $id;
    }

    public function getMedicoId() : ?int {
        return $this->medicoId;
    }

    public function setMedicoId(int $id) {
        $this->medicoId = $id;
    }

    public function getPacienteId() : ?int {
        return $this->pacienteId;
    }

    public function setPacienteId(int $id) {
        $this->pacienteId = $id;
    }

    public function getLogradouro(): string {
        return $this->logradouro;
    }

    public function setLogradouro(string $logradouro) {
        $this->logradouro = $logradouro;
    }

    public function getNumero(): string {
        return $this->numero;
    }

    public function setNumero(string $numero): void {
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

    public function getCep() : string {
        return $this->cep;
    }

    public function setCep(string $cep) {
        $this->cep = $cep;
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