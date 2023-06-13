btn_Cadastrar = document.getElementById('cadastrar');

btn_Cadastrar.addEventListener('click', function(event)
{    
    validarCampos();
});

function validarCampos()
{
    
    if(document.getElementById('nome').value == '') 
    {
        swal("Campo obrigatório!", "Por favor, informe seu nome.", "warning");
        nome.focus();
        event.preventDefault();
    }   
    
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
      event.preventDefault();
    }

    validarContatos();
    
    validarEndereco();     

    //login
    if(document.getElementById('usuario').value == '')
    {
        swal("Campo obrigatório!", "Por favor, informe um usuário para login", "warning");
        login.focus();
        event.preventDefault();
    }
    
    var senha = document.getElementById('senha').value;
    var resenha = document.getElementById('resenha').value;

    if(senha == '' || resenha == '')
    {
        swal("Campo obrigatório!", "Por favor, informe uma senha, e depois confirme-a!", "warning");
        senha.focus();
        event.preventDefault();
    }
    else
    {
      if(senha !== resenha)
      {
        swal("Campo Inválido!", "As senhas não são iguais", "warning");
        senha.focus();
        event.preventDefault();
      }
    }
}

function validarContatos()
{
    var principal = document.getElementById('principal').value;
    var whatsapp = document.getElementById('whatsapp').value;
    var email = document.getElementById('email').value;
  
    if(principal == '' && whatsapp == '' && email =='')
    {
        swal("Campo obrigatório!", "Por favor, informe ao menos um contato.", "warning");
        event.preventDefault();
        document.getElementById('principal').focus();
    }
    else
    {
      principal = principal.replace(/[^\d]+/g, ''); 

      if(principal != '')
      {
         if(principal.length != 10 && principal.length != 11)
         {
            swal("Campo Inválido!", "Por favor, informe um número de telefone válido", "warning");
            event.preventDefault();
            document.getElementById('principal').focus();
         }       
      }

      if(whatsapp != '')
      {
         if(whatsapp.length != 11)
         {
            swal("Campo Inválido!", "Por favor, informe um número de whatsapp válido", "warning");
            event.preventDefault();
            document.getElementById('whatsapp').focus();
         }       
      }

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
      event.preventDefault();
    }

    // Verificar se todos os dígitos são iguais (CPF inválido)
    var digits = cpf.split('').map(Number);
    if (digits.every(digit => digit === digits[0])) 
    {
      swal("Campo Inválido!", "Por favor, informe um CPF válido.", "warning");
      event.preventDefault();
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
      event.preventDefault();
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
      event.preventDefault();
    }
}

function validarEndereco()
{  
  var cep = document.getElementById('cep').value.replace(/[^\d]+/g, '');
 
  if(cep.length !== 8)
  {
      swal("Campo Inválido!", "Por favor, informe um CEP válido", "warning");
      event.preventDefault();
  }
  
  if(document.getElementById('log').value =='')
  {
      swal("Campo Obrigatório!", "Por favor, informe um logradouro", "warning");
      log.focus();
      event.preventDefault();
  }
 
  //Verifica se possui apenas numeros
  if(!/^\d+$/.test(document.getElementById('numero').value))
  {
      swal("Campo Inválido!", "Por favor, informe um número válido", "warning");
      numero.focus();
      event.preventDefault();
  }

  if(document.getElementById('bairro').value == '')
  {
      swal("Campo Obrigatório!", "Por favor, informe um bairro", "warning");
      bairro.focus();
      event.preventDefault();
  }

  if(document.getElementById('cidade').value == '')
  {
      swal("Campo Obrigatório!", "Por favor, informe um cidade", "warning");
      cidade.focus();
      event.preventDefault();
  }

  if(document.getElementById('UF').value.length !== 2)
  {
    swal("Campo Inválido!", "Por favor, informe um UF válido", "warning");
    UF.focus();
    event.preventDefault();
  }

  if(/[0-9]/.test(document.getElementById('UF').value))
  {
    swal("Campo Inválido!", "Por favor, informe um UF válido", "warning");
    UF.focus();
    event.preventDefault();
  }
}