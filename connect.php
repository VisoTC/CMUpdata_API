<?php
/**
 * API Version D1(V 0.1)
 * 数据库配置及连接
 */
$server = "localhost";
$user = "root";
$password = "";
$db = "CMUpdata";
$dbh = new PDO("mysql:host={$server};dbname={$db}", $user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$dbh->exec('set names utf8');
?>