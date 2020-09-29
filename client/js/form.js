$(function(){
  $('#formulario').submit(function(event){
    event.preventDefault();
    checkContrasena();
  })
})

function checkContrasena(){
  var contrasena = $('#contrasena').val();
  var repContrasena = $('#contrasena_repetida').val();

  if (contrasena===repContrasena) {
    getDatos();

  }else {
    alert('Las contraseñas no coinciden')
  }
}

function getDatos(){
  var form_data = new FormData();
  form_data.append('nombre', $('#nombre').val());
  form_data.append('fechaNacimiento', $('#fecha_nacimiento').val());
  form_data.append('email', $('#email_usuario').val());
  form_data.append('contrasena', $('#contrasena').val());
  sendForm(form_data);
}

function sendForm(formData){
  $.ajax({
    url: '../server/create_user.php',
    dataType: "json",
    cache: false,
    processData: false,
    contentType: false,
    data: formData,
    type: 'POST',
    success: (data) =>{
      if (data.msg == "exito en la inserción") {
        window.location.href = 'main.html';
      }else {
        alert(data.msg);
      }
    },
    error: function(){
      alert("error en la comunicación con el servidor");
    }
  })
}
