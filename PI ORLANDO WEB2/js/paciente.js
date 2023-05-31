btn_confirmar = document.getElementById('confirmar');

btn_confirmar.addEventListener('click', function(event){

    
    formulario = document.getElementsByTagName('form')[0];
    var camposText = formulario.querySelectorAll('input[type="text"]');
    var ok = true;

    camposText.forEach(element => {
        if(element.value == '')
        {
            console.log('vazio');
        }        
    });

    if(!ok)
    {
        alert('Por favor preencha todos os campos');
    }

});

