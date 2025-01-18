<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$addtext = $_POST["editor"];
$selectedDate = date("Y-m-d H:i:s");
if (!empty($addtext)) {
        // Открываем файл для записи (или создаем, если не существует)
        $file = fopen("logs.txt", "a");
	flock($file, 2);
        //$formattedText = "<div style=\"font-style: $styleSelect !important; font-weight: $styleSelect !important; font-size: {$fontSize}px !important;\">$selectedNotification $selectedDate</div>";

        fwrite($file, $addtext . PHP_EOL);
	flock($file, 3);
        
        fclose($file);
	echo "$addtext";
    }
}

//header("Location: index.html");
exit;
?>

