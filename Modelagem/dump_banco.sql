CREATE TABLE Medico (
    Id Integer PRIMARY KEY auto_increment,
    NOME VARCHAR(80),
    CRM VARCHAR(6),
    CPF VARCHAR(11),
    RG VARCHAR(25),
    Nascimento DATE,
    Remoto BOOLEAN,
    Sobre VARCHAR(500),
    Especialidade Integer,
    Contato Integer,
    Endereco Integer,
    Login VARCHAR(30)
);

CREATE TABLE Login (
    Usuario VARCHAR(30) PRIMARY KEY,
    Senha VARCHAR(30)
);

CREATE TABLE Endereco (
    Id Integer PRIMARY KEY auto_increment,
    Logradouro VARCHAR(100),
    Numero VARCHAR(10),
    Bairro VARCHAR(100),
    Cidade VARCHAR(100),
    UF CHAR(2),
    Complemento VARCHAR(50)
);

CREATE TABLE Contato (
    Id Integer PRIMARY KEY auto_increment,
    Tipo VARCHAR(20),
    Descricao VARCHAR(100)
);

CREATE TABLE Especialidade (
    Id Integer PRIMARY KEY auto_increment,
    Descricao VARCHAR(100)
);

CREATE TABLE Paciente (
    Id Integer PRIMARY KEY auto_increment,
    Nome VARCHAR(80),
    CPF VARCHAR(11),
    RG VARCHAR(25),
    Nascimento DATE,
    Contato Integer,
    Endereco Integer,
    Login VARCHAR(30)
);
 
ALTER TABLE Medico ADD CONSTRAINT FK_Medico_2
    FOREIGN KEY (Especialidade)
    REFERENCES Especialidade (Id);
 
ALTER TABLE Medico ADD CONSTRAINT FK_Medico_3
    FOREIGN KEY (Contato)
    REFERENCES Contato (Id);
 
ALTER TABLE Medico ADD CONSTRAINT FK_Medico_4
    FOREIGN KEY (Endereco)
    REFERENCES Endereco (Id);
 
ALTER TABLE Medico ADD CONSTRAINT FK_Medico_5
    FOREIGN KEY (Login)
    REFERENCES Login (Usuario);
 
ALTER TABLE Paciente ADD CONSTRAINT FK_Paciente_2
    FOREIGN KEY (Contato)
    REFERENCES Contato (Id);
 
ALTER TABLE Paciente ADD CONSTRAINT FK_Paciente_3
    FOREIGN KEY (Endereco)
    REFERENCES Endereco (Id);
 
ALTER TABLE Paciente ADD CONSTRAINT FK_Paciente_4
    FOREIGN KEY (Login)
    REFERENCES Login (Usuario);