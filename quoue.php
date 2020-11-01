<?php
    session_start();
     
    header('Content-Type: application/json; charset=utf-8');
    require_once 'pdo.php';
 
  $stmt = $pdo->query('SELECT  user_id, op_id FROM horse_quoe ');

  $search = array();
  
  
while ( $row = $stmt->fetch(PDO::FETCH_NUM) ) {
    $search[] = $row;
    
}


    echo(json_encode($search, JSON_PRETTY_PRINT));
    