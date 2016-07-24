<?php
    header('Content-Type: application/json');

    require 'connect.php';

    $res = array();

    if($results = $sqli->query("SELECT * FROM pages ORDER BY id")) {
        if($results->num_rows) {
            while($row = $results->fetch_object()){
                $res[] = $row;
            }
            $results->free();
        }
    }

    echo json_encode($res);
