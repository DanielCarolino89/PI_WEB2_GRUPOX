var btn_Excluir = document.getElementById('excluir');

btn_Excluir.addEventListener('click', function(event)
{
    Swal.fire({
      title: 'Está certo disso?',
      text: 'Você está prestes a excluir este perfil. Deseja prosseguir?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Sim, excluir!',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {

        // executar exclusão
        Swal.fire('Excluído!', 'O registro foi excluído com sucesso.', 'success');
      } 
    });
});


  