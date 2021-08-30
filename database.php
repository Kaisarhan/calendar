<?php
$connection = mysqli_connect('192.168.0.110','root','root','test') or die('Ой Ёй что-то не так с БД');
mysqli_set_charset($connection, 'utf8') or die("Can't set sharset");
?>