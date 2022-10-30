<?php
$token = '';
session_start();
if(!isset($_SESSION['token'])) { 
    header('Location: login.html');
}


$token = $_SESSION['token'];

echo 'Вы вошли, ваш токен: '. $token;


echo "<p><a href='register.html'>Зарегестрировать нового юзера</a></p>";
echo "<p><a href='shop.html'>Добавить товар в корзину</a></p>";
echo "<p><a href='pokupki.html'>Список товаров в корзине</a></p>";
echo "<p><a href='tovar.html'>Список всех товаров</a></p>";
echo "<p><a href='logout.php'>Выйти</a></p>";
