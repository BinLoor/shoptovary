<?php
session_start();
unset($_SESSION['token']); // или $_SESSION = array() для очистки всех данных сессии
session_destroy();
header('Location: login.html');

