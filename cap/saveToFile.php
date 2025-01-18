<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedNotification = $_POST["notification-text"];
    $selectedDate = date("Y-m-d H:i:s"); // текущая дата и время
    $styleSelect = isset($_POST["style-select"]) ? $_POST["style-select"] : 'Обычный';
    $fontSize = isset($_POST["font-size"]) ? $_POST["font-size"] : '';

    if (!empty($selectedNotification)) {
        // Открываем файл для записи (или создаем, если не существует)
        $file = fopen("logs.txt", "a");
	flock($file, 2);
        $formattedText = "<div style=\"font-style: $styleSelect !important; font-weight: $styleSelect !important; font-size: {$fontSize}px !important;\">$selectedNotification $selectedDate</div>";

        fwrite($file, $formattedText . PHP_EOL);
	flock($file, 3);
        
        fclose($file);
    }
}
exit;
?>
