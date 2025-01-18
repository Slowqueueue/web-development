<?php
// Проверяем, был ли запрос от объекта XMLHttpRequest
if (isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && $_SERVER["HTTP_X_REQUESTED_WITH"] == "XMLHttpRequest") {
    // Устанавливаем заголовок для ответа в формате JSON
    header('Content-Type: application/json; charset=utf-8');

    // Получаем значение выбранной трапезы
    $value = $_GET['priem'];

    // Если выбор не сделан, выводим сообщение
    if (!$value) {
        echo json_encode(array("0" => 'Здесь появятся варианты'));
        exit;
    }

    // В зависимости от значения выбранного элемента формируем массив блюд
    $food = array();
    switch ($value) {
        case 1:
            $food = array(
                "1" => array("name" => 'Яичница'),
                "2" => array("name" => 'Оладьи'),
                "3" => array("name" => 'Овсянка')
            );
            break;
        case 2:
            $food = array(
                "4" => array("name" => 'Борщ'),
                "5" => array("name" => 'Пельмени'),
                "6" => array("name" => 'Котлетки с пюрешкой'),
                "7" => array("name" => 'Пирожки')
            );
            break;
        case 3:
            $food = array(
                "8" => array("name" => 'Плов'),
                "9" => array("name" => 'Мясо по-французки'),
                "10" => array("name" => 'Тефтели'),
                "11" => array("name" => 'Паста Карбонара')
            );
            break;
    }


    echo json_encode($food);
    exit;
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $priem = $_POST['priem'];
    $food = $_POST['food'];


    $message = "Данные успешно получены! Вы выбрали прием пищи $priem, $food";
    
    echo json_encode(array("message" => $message));
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<center>
    <title>Ajax(Лаб4.3)</title>
    <script type="text/javascript" src="lib/jquery-1.8.3.js"></script>
    <script src="lib/jquery.js"></script>
    <script src="dist/jquery.validate.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function(){
            jQuery('#priem').change(function(){
                var value = $("#priem option:selected").val();
                $('select[name=food] option').remove();
                if (!value) {
                    $('select[name=food]').append('<option value="0">Выберите еду</option>');
                } else {
                    $.getJSON("ajax.php?priem="+value, function(data){
                        for (var i in data) {
                            $('select[name=food]').append('<option value="'+i+'">'+data[i].name+'</option>');
                        }
                    });
                }
            });

            $('#submit_button').click(function(){
                var priemValue = $("#priem option:selected").val();
                var foodValue = $("#food option:selected").val();
                $.post("ajax.php", { priem: priemValue, food: foodValue })
                    .done(function(data) {
                    if(priemValue != "")
                        alert("Курьер уже в пути!");
                    else alert("Трапеза не выбрана!");
                    })
                    .fail(function() {
                        alert("Ошибка при отправке данных!");
                    });
            });
        });
    </script>
</head>
<body>
<br><br><br><br><br>
<h1>Сделайте заказ</h1>
    <select id="priem">
        <option value="">Выберите трапезу</option>
        <option value="1">Завтрак</option>
        <option value="2">Обед</option>
        <option value="3">Ужин</option>
    </select>
    <select name="food" id="food">
        <option value="0">Выберите блюдо</option>
    </select>
    <button id="submit_button">Выбрать</button>
     <a href="http://217.71.139.74/~user220/">
        <input type="button" value="Назад" /></a>
</center>
</body>
</html>
