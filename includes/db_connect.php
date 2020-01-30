<?php

$connect = mysqli_connect('localhost' , 'root','', 'reg') or die('Ошибка подключения'.mysqli_error());

$check_queary = "SELECT * FROM article"; //ORDER BY 'id' DESC
$result = mysqli_fetch_assoc(mysqli_query($connect, $check_queary)); //вывод для первой страници статей

if (!isset($result)){
    echo "не найдено";
}

?>