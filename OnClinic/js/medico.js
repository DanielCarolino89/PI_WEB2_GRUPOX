btn_Cadastrar = document.getElementById('cadastrar');

btn_Cadastrar.addEventListener('click', function(event)
{    
    if(!validarCampos())
    {
      event.preventDefault();
    }
});

function validarCampos()
{
    
    if(document.getElementById('nome').value == '') 
    {
        swal("Campo obrigatório!", "Por favor, informe seu nome.", "warning");
        nome.focus();

        return false;
    }

    validarCRM(document.getElementById('crm').value);
    
    if(document.getElementById('rg').value == '') 
    {
        swal("Campo obrigatório!", "Por favor, informe seu RG.", "warning");
        rg.focus();
        return false;
    }

    validarCPF(document.getElementById('cpf').value);    

    if(document.getElementById('nascimento').value == '')
    {
      swal("Campo obrigatório!", "Por favor, informe sua data de nascimento.", "warning");
      nascimento.focus();
      return false;
    }
    
    validarEndereco();    

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
  
    //if(principal)

}

function validarCRM(crm)
{
    // Remover caracteres não numéricos
    crm = crm.replace(/[^\d]+/g, ''); 

    // Verificar se o CRM tem 6 dígitos
    if (crm.length !== 6) 
    {
      swal("Campo Inválido!", "Por favor, um CRM válido", "warning");
      return false;
    }
    

    // Verificar se todos os dígitos são iguais (CPF inválido)
    var digits = cpf.split('').map(Number);
    if (digits.every(digit => digit === digits[0])) 
    {
      swal("Campo Inválido!", "Por favor, um CRM válido", "warning");
      return false;
    }
}

function validarCPF(cpf) 
{
    // Remover caracteres não numéricos
    cpf = cpf.replace(/[^\d]+/g, ''); 
  
    // Verificar se o CPF tem 11 dígitos
    if (cpf.length !== 11) 
    {
      swal("Campo Inválido!", "Por favor, informe um CPF válido.", "warning");
      return false;
    }

    // Verificar se todos os dígitos são iguais (CPF inválido)
    var digits = cpf.split('').map(Number);
    if (digits.every(digit => digit === digits[0])) 
    {
      swal("Campo Inválido!", "Por favor, informe um CPF válido.", "warning");
      return false;
    }

    // Verificar o primeiro dígito verificador
    var sum = 0;
    for (var i = 0; i < 9; i++) 
    {
      sum += digits[i] * (10 - i);
    }

    var remainder = sum % 11;
    var digit1 = (remainder < 2) ? 0 : 11 - remainder;
    if (digit1 !== digits[9]) 
    {
      swal("Campo Inválido!", "Por favor, informe um CPF válido.", "warning");
      return false;
    }
  
    // Verificar o segundo dígito verificador
    sum = 0;
    for (var j = 0; j < 10; j++) 
    {
      sum += digits[j] * (11 - j);
    }

    remainder = sum % 11;
    var digit2 = (remainder < 2) ? 0 : 11 - remainder;
    if (digit2 !== digits[10]) 
    {
      swal("Campo Inválido!", "Por favor, informe um CPF válido.", "warning");
      return false;
    }
  
    return true;
}

function validarEndereco()
{  
  var cidade = document.getElementById('cidade');
  var UF = document.getElementById('UF');

  var cep = document.getElementById('cep').value;
  // Remover caracteres não numéricos
  cep = cep.replace(/[^\d]+/g, ''); 
  if(cep.length == 8)
  {
      swal("Campo Inválido!", "Por favor, informe um CEP válido", "warning");
      cep.focus();
      return false;
  }

  if(document.getElementById('log').value =='')
  {
      swal("Campo Obrigatório!", "Por favor, informe um logradouro", "warning");
      log.focus();
      return false;
  }
 
  //Verifica se possui apenas numeros
  if(!/^\d+$/.test(document.getElementById('numero').value))
  {
      swal("Campo Inválido!", "Por favor, informe um número válido", "warning");
      numero.focus();
      return false;
  }

  if(document.getElementById('bairro').value == '')
  {
      swal("Campo Obrigatório!", "Por favor, informe um bairro", "warning");
      bairro.focus();
      return false;
  }

  if(document.getElementById('cidade').value == '')
  {
      swal("Campo Obrigatório!", "Por favor, informe um cidade", "warning");
      cidade.focus();
      return false;
  }

  if(!document.getElementById('UF').value.length == 2)
  {
    swal("Campo Inválido!", "Por favor, informe um UF válido", "warning");
    UF.focus();
    return false;
  }

  if(/[0-9]/.test(document.getElementById('UF').value))
  {
    swal("Campo Inválido!", "Por favor, informe um UF válido", "warning");
    UF.focus();
    return false;
  }


}