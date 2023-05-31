function validarCampos()
{
    //Dados pessoais
    if(document.getElementById('nome').value == '') 
    {
        alert('Por favor, informe seu nome');
        nome.focus();
    }

    if(!validarCRM(document.getElementById('crm').value))
    {
        alert('Por favor, informe um CRM válido!');
        nome.focus();
    }
    
    if(document.getElementById('rg').value == '') 
    {
        alert('Por favor, informe seu RG');
        nome.focus();
    }

    if(!validarCPF(document.getElementById('cpf').value))
    {
        alert('Por favor, informe um CPF válido');
        nome.focus();
    }

    var nascimento = document.getElementById('nascimento');
  
    //Endereço
    var cep = document.getElementById('cep');
    var log = document.getElementById('log');
    var numero = document.getElementById('numero');
    var complemento = document.getElementById('complemento');
    var bairro = document.getElementById('bairro');
    var cidade = document.getElementById('cidade');
    var UF = document.getElementById('UF');

    //Sobre o médico
    var sobre = document.getElementById('sobre');
    var especialidade = document.getElementById('especialidade');

    //login
    var login = document.getElementById('login');
    var senha = document.getElementById('senha');
    var resenha = document.getElementById('resenha');

}

function validarContatos()
{
    var principal = document.getElementById('principal');
    var whatsapp = document.getElementById('whatsapp');
    var email = document.getElementById('email');
  
    if(principal)

}

function validarCRM(crm)
{
    // Remover caracteres não numéricos
    crm = crm.replace(/[^\d]+/g, ''); 

    // Verificar se o CRM tem 6 dígitos
    if (crm.length !== 6) return false;

    // Verificar se todos os dígitos são iguais (CPF inválido)
    var digits = cpf.split('').map(Number);
    if (digits.every(digit => digit === digits[0])) return false;

    return true;
}

function validarCPF(cpf) {

    // Remover caracteres não numéricos
    cpf = cpf.replace(/[^\d]+/g, ''); 
  
    // Verificar se o CPF tem 11 dígitos
    if (cpf.length !== 11) return false;
  
    // Verificar se todos os dígitos são iguais (CPF inválido)
    var digits = cpf.split('').map(Number);
    if (digits.every(digit => digit === digits[0])) return false;
  
    // Verificar o primeiro dígito verificador
    var sum = 0;
    for (var i = 0; i < 9; i++) {
      sum += digits[i] * (10 - i);
    }
    var remainder = sum % 11;
    var digit1 = (remainder < 2) ? 0 : 11 - remainder;
    if (digit1 !== digits[9]) {
      return false;
    }
  
    // Verificar o segundo dígito verificador
    sum = 0;
    for (var j = 0; j < 10; j++) {
      sum += digits[j] * (11 - j);
    }
    remainder = sum % 11;
    var digit2 = (remainder < 2) ? 0 : 11 - remainder;
    if (digit2 !== digits[10]) {
      return false;
    }
  
    return true;
  }
  