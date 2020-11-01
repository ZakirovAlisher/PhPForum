<?php
 session_start();
 
    header('Content-Type: application/json; charset=utf-8');
    require_once 'pdo.php';
 
  $stmt = $pdo->query('SELECT  * FROM horse_quoe WHERE user_id ='.$_SESSION['user_id'].' and op_id='.$_SESSION['op_id']);

  $search = array();
  
  
$row = $stmt->fetch(PDO::FETCH_ASSOC);
 
if ($row === false){
    
    $stmt = $pdo->query('SELECT  * FROM horse_quoe WHERE user_id ='.$_SESSION['op_id'].' and op_id='.$_SESSION['user_id']);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}

    echo(json_encode($row, JSON_PRETTY_PRINT));