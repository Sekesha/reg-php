<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reg</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>
<div class="wrapper">
    <div class="header">
        <div class="header_content">
            <div>
                <a href="/">Новости</a>
                <a href="#">Блог</a>
            </div>
            <div>
                <? echo $header_for_user; ?> <!--//в зависимости от user изменение рег_вход/привет_выход-->
            </div>
        </div>
    </div>
    <div class="content">
        <div class="block">
