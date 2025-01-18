const form = document.getElementById('form')
const errorElement = document.getElementById('error')
const string = document.getElementById('str')

const greet = document.getElementsByName("ch")
var greetLength = greet.length;
const style = document.getElementsByName("style")
var styleLength = style.length;

form.addEventListener('submit', (e) => {
  let mes = []
  if (string.value === '' || string.value == null) 
    mes.push('Вы не оставили след в истории')
  
  var c = 0
  for (i = 0; i < greetLength; i++) {
    if(greet[i].checked == true) {
        c++
        break
      }
  }

  if (c == 0)
    mes.push('Вы не выбрали тотемное животное')
  c = 0
  for (i = 0; i < styleLength; i++) 
    if(style[i].checked == true) 
        c++

  if (c == 0)
    mes.push('Вы не выбрали шрифт')
  else if (c > 1)    
    mes.push('Вы выбрали слишком много шрифтов (нужен только 1)')   
    

  if (mes.length > 0) {
    e.preventDefault()
    errorElement.innerText = mes.join('\n')
  }
})