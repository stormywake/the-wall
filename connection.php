<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'root');
define('DB_DATABASE', 'wall');

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);

if (mysqli_connect_errno()) {
    die("Failed to connect to MySQL: (" . mysqli_connect_errno() . ") " . mysqli_connect_errno());
}

function escape_this_string($string) {
    global $connection;

    return mysqli_real_escape_string($connection, $string);
}

function fetch($query) {
    global $connection;

    $result = mysqli_query($connection, $query);
    $rows = array();

    foreach($result as $row) {
        $rows[] = $row;
    }

    return $rows;
}

function run_mysql_query($query) {
    global $connection;

    $result = mysqli_query($connection, $query);

    // Check if query is an 'insert' query
    if (preg_match("/insert/i", $query)) {
        return mysqli_insert_id($connection);
    }

    // Returns true if UPDATE, false if DELETE
    return $result;
}
?>