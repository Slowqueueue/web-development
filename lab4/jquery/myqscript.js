$(function(){
  $("#form").validate({
      rules: {
          str: {
              required: true,  
              maxlength: 250 
          },
          ch: {
              required: true,
              
          },
          style: {
              required: true,
              maxlength: 1
          }
      },
      messages: {
        str: {
          required: 'Вы не оставили след в истории<br><br>',
          maxlength: ' Вы оставили слишком большой след в истории (введите строку с менее чем 250 символами)<br><br>'   
        },
        ch: {
            required: 'Вы не выбрали тотемное животное<br><br>',
        },
        style: {
            required: 'Вы не выбрали шрифт<br><br>',
            maxlength: 'Вы выбрали слишком много шрифтов<br><br>'
        }
      },
      errorPlacement: function(error, element) {
        var er = element.attr("name");
        er = '#e' + er;
        error.appendTo(er);
      }
  });
});