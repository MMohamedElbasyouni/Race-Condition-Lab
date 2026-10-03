<?php
function get_db() {
    $mysqli = new mysqli('db', 'root', 'root');

    $mysqli->query("CREATE DATABASE IF NOT EXISTS racedb");
    $mysqli->select_db('racedb');

    $mysqli->query("CREATE TABLE IF NOT EXISTS users (
        id INT PRIMARY KEY,
        balance INT NOT NULL,
        purchases INT NOT NULL DEFAULT 0
    )");

    try {
        $mysqli->query("ALTER TABLE users ADD COLUMN purchases INT NOT NULL DEFAULT 0");
    } catch (mysqli_sql_exception $e) {
    }

    $res = $mysqli->query("SELECT * FROM users WHERE id=1");
    if ($res->num_rows === 0) {
        $mysqli->query("INSERT INTO users (id, balance, purchases) VALUES (1, 100, 0)");
    }

    return $mysqli;
}
