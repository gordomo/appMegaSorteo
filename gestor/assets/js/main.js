$('#cambiarPass').click(function(){
    $('.loading').show('fast');
    if($('#email').val() !== ''){
        $.ajax({
            type: "POST",
            url: "../actions.php",
            data: {action: "cambiarPass", email: $('#email').val()},
            success: function(result){
                if(result.result === 'ok'){
                    $('.modificarClave').text('Si el correo ingresado se encuentra registrado en nuestra base de datos, enviaremos una nueva clave al mismo');
                }
                else{
                    $('.modificarClave').text('Hubo un inconveniente - ' + result.mensaje);
                }
                $('.modificarClave').show().delay(15000).fadeOut();
                $('.loading').hide('fast');
            },
            error: function(e){
                $('.loading').hide('fast');
            },
            dataType: 'json'
          });
    }
    else{
        alert("complete el campo Email");
        $('.loading').hide('fast');
    }
    
    
    
});