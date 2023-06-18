var btn_Excluir = document.getElementById('excluir');
var form_Excluir = document.getElementById('formExcluir');

form_Excluir.addEventListener('submit', function(event) {
  event.preventDefault();

  Swal.fire({
    title: 'Está certo disso?',
    text: 'Você está prestes a excluir este perfil. Deseja prosseguir?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Sim, excluir!',
    cancelButtonText: 'Cancelar'
  }).then((result) => {
    if (result.isConfirmed) {
      const formData = new FormData();
      formData.append("action", "Excluir");

      fetch(window.location.href, {
        method: 'POST',
        body: formData
      }).then(data => {
        window.location.replace("index.php");
      })
      .catch(error => {
        // Handle request errors here
        console.log(error);
      });
    }
   
  });

});


  