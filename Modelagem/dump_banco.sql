/* LOGICO: */

CREATE TABLE Medico (
    Id Integer PRIMARY KEY,
    NOME VARCHAR(80),
    CRM VARCHAR(6),
    CPF VARCHAR(11),
    RG VARCHAR(25),
    Nascimento DATE,
    Remoto BOOLEAN,
    Sobre VARCHAR(500),
    Contato Integer,
    Endereco Integer,
    Login VARCHAR(30)
);

CREATE TABLE Login (
    Usuario VARCHAR(30) PRIMARY KEY,
    Senha VARCHAR(30)
);

CREATE TABLE Endereco (
    Id Integer PRIMARY KEY,
    Logradouro VARCHAR(100),
    Numero VARCHAR(10),
    Bairro VARCHAR(100),
    Cidade VARCHAR(100),
    UF CHAR(2),
    Complemento VARCHAR(50)
);

CREATE TABLE Contato (
    Id Integer PRIMARY KEY,
    Tipo VARCHAR(20),
    Descricao VARCHAR(100)
);

CREATE TABLE Especialidade (
    Id Integer PRIMARY KEY,
    Descricao VARCHAR(100),
    Complemento VARCHAR(20),
    Medico Integer
);

CREATE TABLE Paciente (
    Id Integer PRIMARY KEY,
    Nome VARCHAR(80),
    CPF VARCHAR(11),
    RG VARCHAR(25),
    Nascimento DATE,
    Contato Integer,
    Endereco Integer,
    Login VARCHAR(30)
);
 
ALTER TABLE Medico ADD CONSTRAINT FK_Medico_2
    FOREIGN KEY (Contato)
    REFERENCES Contato (Id);
 
ALTER TABLE Medico ADD CONSTRAINT FK_Medico_3
    FOREIGN KEY (Endereco)
    REFERENCES Endereco (Id);
 
ALTER TABLE Medico ADD CONSTRAINT FK_Medico_4
    FOREIGN KEY (Login)
    REFERENCES Login (Usuario);
 
ALTER TABLE Especialidade ADD CONSTRAINT FK_Especialidade_2
    FOREIGN KEY (Medico)
    REFERENCES Medico (Id);
 
ALTER TABLE Paciente ADD CONSTRAINT FK_Paciente_2
    FOREIGN KEY (Contato)
    REFERENCES Contato (Id);
 
ALTER TABLE Paciente ADD CONSTRAINT FK_Paciente_3
    FOREIGN KEY (Endereco)
    REFERENCES Endereco (Id);
 
ALTER TABLE Paciente ADD CONSTRAINT FK_Paciente_4
    FOREIGN KEY (Login)
    REFERENCES Login (Usuario);/* LOGICO: */

CREATE TABLE Medico (
    Id Integer PRIMARY KEY,
    NOME VARCHAR(80),
    CRM VARCHAR(6),
    CPF VARCHAR(11),
    RG VARCHAR(25),
    Nascimento DATE,
    Remoto BOOLEAN,
    Sobre VARCHAR(500),
    Contato Integer,
    Login VARCHAR(30)
);

CREATE TABLE Login (
    Usuario VARCHAR(30) PRIMARY KEY,
    Senha VARCHAR(30)
);

CREATE TABLE Endereco (
    Id Integer PRIMARY KEY,
    Logradouro VARCHAR(100),
    Numero VARCHAR(10),
    Bairro VARCHAR(100),
    Cidade VARCHAR(100),
    UF CHAR(2),
    Complemento VARCHAR(50),
    Medico Integer,
    Campo Integer
);

CREATE TABLE Contato (
    Id Integer PRIMARY KEY,
    Tipo VARCHAR(20),
    Descricao VARCHAR(100),
    Medico Integer,
    Paciente Integer
);

CREATE TABLE Especialidade (
    Id Integer PRIMARY KEY,
    Descricao VARCHAR(100),
    Complemento VARCHAR(20),
    Medico Integer
);

CREATE TABLE Paciente (
    Id Integer PRIMARY KEY,
    Nome VARCHAR(80),
    CPF VARCHAR(11),
    RG VARCHAR(25),
    Nascimento DATE,
    Login VARCHAR(30)
);
 
ALTER TABLE Medico ADD CONSTRAINT FK_Medico_2
    FOREIGN KEY (Login)
    REFERENCES Login (Usuario);
 
ALTER TABLE Endereco ADD CONSTRAINT FK_Endereco_2
    FOREIGN KEY (Medico)
    REFERENCES Medico (Id);
 
ALTER TABLE Endereco ADD CONSTRAINT FK_Endereco_3
    FOREIGN KEY (Campo)
    REFERENCES Paciente (Id);
 
ALTER TABLE Contato ADD CONSTRAINT FK_Contato_2
    FOREIGN KEY (Medico)
    REFERENCES Medico (Id);
 
ALTER TABLE Contato ADD CONSTRAINT FK_Contato_3
    FOREIGN KEY (Paciente)
    REFERENCES Paciente (Id);
 
ALTER TABLE Especialidade ADD CONSTRAINT FK_Especialidade_2
    FOREIGN KEY (Medico)
    REFERENCES Medico (Id);
 
ALTER TABLE Paciente ADD CONSTRAINT FK_Paciente_2
    FOREIGN KEY (Login)
    REFERENCES Login (Usuario);