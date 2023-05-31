btn_entrar = document.getElementById('btn_entrar');

login = document.getElementById('login');
senha = document.getElementById('senha');

btn_entrar.addEventListener('click', function(event)
{
    if(login.value == '' || senha.value == '')
    {
        event.preventDefault();
        swal("Campos obrigatórios!", "Por favor, preencha login e senha", "error");
        login.focus();
    }
});

