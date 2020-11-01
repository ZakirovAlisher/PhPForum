<?php
session_start();
require_once 'pdo.php';
$salt = 'XyZzy12*_';
 
// Check to see if we have some POST data, if we do process it
 if (isset($_POST['email_log']) && isset($_POST['pass_log'])  && $_POST['log']){
     
     
      unset($_SESSION['name']);
      unset($_SESSION['user_id']);
       
      
  if ( strlen($_POST['email_log']) < 1 || strlen($_POST['pass_log']) < 1 ) {
        
        $_SESSION['fail_log'] = "Email and password are required";
         header("Location:".$_SESSION['position']);
  return;}
  
  
  if(strpos($_POST['email_log'],'@') <= 0) {
      
      $_SESSION['fail_log'] = "Email must have an at-sign (@)";
         header("Location:".$_SESSION['position']);
  return;}
      
      
 
    
      
$check = hash('md5', $salt.$_POST['pass_log']);

$stmt = $pdo->prepare('SELECT user_id, name FROM users

WHERE email = :em AND password = :pw');

$stmt->execute(array( ':em' => $_POST['email_log'], ':pw' => $check));

$row = $stmt->fetch(PDO::FETCH_ASSOC);


if ( $row !== false ) {

$_SESSION['name'] = $row['name'];

$_SESSION['user_id'] = $row['user_id'];
$_SESSION['success'] = 'SUCCESSFUL LOGIN ' ;

// Redirect the browser to index.php

header("Location:".$_SESSION['position']);

return;}
else{
   $_SESSION['fail_log'] = 'Incorrect password' ;
   header("Location:".$_SESSION['position']);

return; 
    
}





 }

 
 
 
 if ( isset($_POST['sab'])   ) {
     
     
if(strlen($_POST['name1']) < 1 || strlen($_POST['name2']) < 1  || strlen($_POST['email']) < 1 || strlen($_POST['pass1']) < 1 || strlen($_POST['pass2']) < 1){
    $_SESSION['fail_reg'] = "All fields are required";
    header("Location:".$_SESSION['position']);
    return;
    
}

 if(strpos($_POST['email'],'@') <= 0) {
      
      $_SESSION['fail_reg'] = "Email must have an at-sign (@)";
         header("Location:".$_SESSION['position']);
        return;
  
 }
  
  
if($_POST['pass1'] !== $_POST['pass2']) {
      
      $_SESSION['fail_reg'] = "Passwords are different";
         header("Location:".$_SESSION['position']);
         return;
  
}
 $stmt1 = $pdo->prepare('SELECT * FROM users WHERE email = :lel');
 
$stmt1->execute(array(
    
  ':lel' => $_POST['email']
        
        ));

$row = $stmt1->fetch(PDO::FETCH_ASSOC);

if($row == true){
     $_SESSION['fail_reg'] = "This email already exists";
         header("Location:".$_SESSION['position']);
         return;
    
}



if(!empty($_FILES['avatar']['tmp_name'])){
    $img_type = substr($_FILES['avatar']['type'], 0, 5);
    if(!empty($_FILES['avatar']['tmp_name']) && $img_type === 'image'){
//        $ava = addslashes(file_get_contents($_FILES['avatar']['tmp_name']));
        $tmp_name = $_FILES['avatar']['tmp_name'];
        $ava = hash('md5', $salt.$_POST['email']);
        
         move_uploaded_file($tmp_name, "avatars/".$ava);
         $ava = "avatars/".$ava;
    }
    else{
        
         $_SESSION['fail_reg'] = "You should upload image file";
         header("Location:".$_SESSION['position']);
         return;
    }
    
}
else{
    $ava = 'static/def.jpg';
    
}

$password = hash('md5', $salt.$_POST['pass1']);
  

    $stmt = $pdo->prepare('INSERT INTO users
  ( name, surname, email, avatar, password)
  VALUES ( :name, :surname, :email, :avatar, :password)');

$stmt->execute(array(
  ':name' => $_POST['name1'],
  ':surname' => $_POST['name2'],
  ':email' => $_POST['email'],
  ':avatar' => $ava,
  ':password' => $password)
);
  

$_SESSION['user_id'] = $pdo->lastInsertId();
   
$_SESSION['name'] =    $_POST['name1']; 
  
  

header("Location:".$_SESSION['position']);
         return;


}
 
 
 
 

  if (isset($_POST['create_topic'])){
    
      date_default_timezone_set('Asia/Almaty');  
      
  if ( strlen($_POST['topic_content']) < 1 || strlen($_POST['topic_name']) < 1 ) {
        
        $_SESSION['top'] = "You cant create blank theme";
        
         header("Location: forum.php");
         return;
  
  }
  
//    if ( strlen($_POST['topic_name']) > 40 ) {
//        
//        $_SESSION['top'] = "Topic name cant be more than 40 characters";
//        
//         header("Location: forum.php");
//         return;
//  
//  }
  
     if ( strlen($_POST['topic_content']) > 5000 ) {
        
        $_SESSION['top'] = "Topic content cant be more than 5000 characters";
        
         header("Location: forum.php");
         return;
  
  }
 
     $stmt = $pdo->prepare('INSERT INTO topics
  ( user_id, topic_name, topic_content, count, topic_date)
  VALUES ( :ui, :tn, :tc, :c, :td)');

$stmt->execute(array(
  ':ui' => $_SESSION['user_id'],
  ':tn' => $_POST['topic_name'],
  ':tc' => $_POST['topic_content'],
  ':c' => 0,
  ':td' => date('jS  F Y h:i A'))
);
  

       $stmt = $pdo->prepare('UPDATE users SET count_post = count_post + 1 WHERE user_id = :kek');

$stmt->execute(array(
  ':kek' =>  $_SESSION['user_id'],
 )
);
  

header("Location:forum.php");
         return;
  
  
  


 }
 
 
 if (isset($_POST['post_post'])){
     
     $_SESSION['scrol']= $_POST['scroll'];
     
       if ( strlen($_POST['post_content']) < 1 ) {
        
        $_SESSION['post_error'] = "You cant create blank post";
        
         header("Location: topic.php?topic_id=".$_POST['topic_id']);
         return;
  
  }
     if ( strlen($_POST['post_content']) > 2000 ) {
        
        $_SESSION['post_error'] = "Post content cant be more than 2000 characters";
        
           header("Location: topic.php?topic_id=".$_POST['topic_id']);
         return;
  
  }
  date_default_timezone_set('Asia/Almaty');  
  
  
  
     $stmt = $pdo->prepare('INSERT INTO posts
  ( user_id, topic_id, post_content, post_date)
  VALUES ( :ui, :ti, :pc, :pd)');

$stmt->execute(array(
  ':ui' => $_SESSION['user_id'],
  ':ti' => $_POST['topic_id'],
  ':pc' => $_POST['post_content'],

  ':pd' => date('jS  F Y h:i A'))
);
  
  

          $stmt = $pdo->prepare('UPDATE topics SET count = count + 1 WHERE topic_id = :kek');

$stmt->execute(array(
  ':kek' =>  $_POST['topic_id'],
 )
);
            $stmt = $pdo->prepare('UPDATE users SET count_post = count_post + 1 WHERE user_id = :kek');

$stmt->execute(array(
  ':kek' =>  $_SESSION['user_id'],
 )
);


   header("Location: topic.php?topic_id=".$_POST['topic_id']);
         return;
  
 }
 if (isset($_POST['ready'])){
     $stmt = $pdo->query('SELECT  balance FROM users WHERE user_id ='.$_SESSION['user_id']);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
     if($row['balance'] - $_POST['bet']*1000 < 0){
         $_SESSION['balance_error'] = 'Not enough money';
         header("Location:".$_SESSION['position']);
         
         return;
     }
      if($_POST['bet']*1000 < 0){
         $_SESSION['balance_error'] = 'Отрицательная ставка';
         header("Location:".$_SESSION['position']);
         
         return;
     }
     
     else{
          $stmt = $pdo->prepare('UPDATE  users set balance = :l WHERE user_id ='.$_SESSION['user_id']);
           $stmt->execute(array(
  ':l' =>  $row['balance'] - $_POST['bet']*1000
    
  )
  );
           
           
           
           
     }
     
     
     $sped = 2000;
     for($i= 0; $i < $_POST['bet']; $i++){
     $sped -= 5 *$sped/100;
     }
     
   if($_SESSION['user_id']===$_GET['user1'])  {
     $stmt = $pdo->prepare('UPDATE  horse_quoe set ready1 = :r1, mass1 =:m1, speed1 =:s1, speed3 =:s3,speed5=:s5, mass3=:m3,mass5=:m5,bet1=:b1 WHERE user_id ='.$_SESSION['user_id'].' and op_id='.$_GET['user2']);
           $stmt->execute(array(
  ':r1' =>  1,
  ':m1' =>  random_int(150,500) ,
  ':s1' =>  random_int(10,$sped),
  ':m3' =>  random_int(150,500) ,
  ':s3' =>  random_int(10,$sped),
  ':m5' =>  random_int(150,500) ,
  ':s5' =>  random_int(10,$sped),
  ':b1' =>  $_POST['bet'] *1000,
               
  )
  );
          $_SESSION['ready1']  = true;
   }
   else if($_SESSION['user_id']===$_GET['user2']){
        
       $stmt = $pdo->prepare('UPDATE  horse_quoe set ready2 = :r1, mass2 =:m1, speed2 =:s1,speed6 =:s6,speed4=:s4, mass4=:m4,mass6=:m6, bet2=:b1 WHERE op_id ='.$_SESSION['user_id'].' and user_id='.$_GET['user1']);
           $stmt->execute(array(
  ':r1' =>  1,
  ':m1' =>  random_int(150,500) ,
  ':s1' =>   random_int(10,$sped),
     ':m4' =>  random_int(150,500) ,
  ':s4' =>  random_int(10,$sped),
                ':m6' =>  random_int(150,500) ,
  ':s6' =>  random_int(10,$sped),
  ':b1' =>  $_POST['bet'] *1000,
               
  )
  );
       
      $_SESSION['ready1']  = true;
   }
     
   
   
   header("Location:".$_SESSION['position']);
         return;  
 }
 
 if (isset($_GET['user1']) &&isset($_GET['user1']) ){
 $stmt234 = $pdo->query('SELECT  * FROM horse_quoe WHERE user_id ='.$_GET['user1'].' and op_id='.$_GET['user2']);

   
  
  
$rowEnd = $stmt234->fetch(PDO::FETCH_ASSOC);
 
 $stmt = $pdo->query('SELECT  ready1, ready2 FROM horse_quoe WHERE op_id ='.$_SESSION['user_id']);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ($row !== false){
    $player1 = $row['ready2'];
}
 else{
     $stmt = $pdo->query('SELECT  ready1, ready2 FROM horse_quoe WHERE user_id ='.$_SESSION['user_id']);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
     if ($row !== false){
    $player1 = $row['ready1'];
}
 }
 
 if ($rowEnd['ready1'] == $rowEnd['ready2'] && $rowEnd['ready2'] ==1 ) {
    $_SESSION['win1'] = false;
    $_SESSION['win2'] = false;
    $_SESSION['draw']= false;
    
    $_SESSION['win3'] = false;
    $_SESSION['win4'] = false;
    $_SESSION['draw2']= false;
    
    $_SESSION['win5'] = false;
    $_SESSION['win6'] = false;
    $_SESSION['draw3']= false;
    
    $bet = intval($rowEnd['bet2']) + intval($rowEnd['bet1']);
    $p1 = 0;
    $p2  = 0;
      if ($rowEnd['mass1'] * (2000 - $rowEnd['speed1']) > $rowEnd['mass2'] * (2000 - $rowEnd['speed2']) ){
          $_SESSION['win1'] = true;
          $p1++;
      }
      else if ($rowEnd['mass1'] * (2000 - $rowEnd['speed1']) < $rowEnd['mass2'] * (2000 - $rowEnd['speed2']) ){
           $_SESSION['win2'] = true;
          $p2++;
      }else if ($rowEnd['mass1'] * (2000 - $rowEnd['speed1']) === $rowEnd['mass2'] * (2000 - $rowEnd['speed2']) ){
           $_SESSION['draw'] = true;
         
      }
      
        if ($rowEnd['mass3'] * (2000 - $rowEnd['speed3']) > $rowEnd['mass4'] * (2000 - $rowEnd['speed4']) ){
          $_SESSION['win3'] = true;
          $p1++;
      }
      else if ($rowEnd['mass3'] * (2000 - $rowEnd['speed3']) < $rowEnd['mass4'] * (2000 - $rowEnd['speed4']) ){
           $_SESSION['win4'] = true;
          $p2++;
      }else if ($rowEnd['mass3'] * (2000 - $rowEnd['speed3']) === $rowEnd['mass4'] * (2000 - $rowEnd['speed4']) ){
           $_SESSION['draw2'] = true;
         
      }
      
        if ($rowEnd['mass5'] * (2000 - $rowEnd['speed5']) > $rowEnd['mass6'] * (2000 - $rowEnd['speed6']) ){
          $_SESSION['win5'] = true;
          $p1++;
      }
      else if ($rowEnd['mass5'] * (2000 - $rowEnd['speed5']) < $rowEnd['mass6'] * (2000 - $rowEnd['speed6']) ){
           $_SESSION['win6'] = true;
          $p2++;
      }else if ($rowEnd['mass5'] * (2000 - $rowEnd['speed5']) === $rowEnd['mass6'] * (2000 - $rowEnd['speed6']) ){
           $_SESSION['draw3'] = true;
         
      }
      
        if ($p1 > $p2){
          
          $_SESSION['WON'] = $_GET['user1'];
     
          $_SESSION['BET'] =$bet * $p1;
          
        
          
      }elseif ($p1 < $p2) {
         
          $_SESSION['WON'] =$_GET['user2'];
    
    $_SESSION['BET'] =$bet*$p2;
      
       
        }elseif ($p1==$p2) {
            
            $_SESSION['WON'] ='draw';
      
        }
        
      if ($_SESSION['user_id'] === $_GET['user1']){
      if ($p1 > $p2){
          
          $_SESSION['WON'] = $_GET['user1'];
          $bet = $bet * $p1;
          $_SESSION['BET'] =$bet;
          
           $stmt = $pdo->query('UPDATE users SET balance = balance +'.$bet.' WHERE user_id ='.$_GET['user1']);
          
      }elseif ($p1 < $p2) {
         
          $_SESSION['WON'] =$_GET['user2'];
    $bet = $bet * $p2;
    $_SESSION['BET'] =$bet;
       $stmt = $pdo->query('UPDATE users SET balance = balance +'.$bet.' WHERE user_id ='.$_GET['user2']);
       
        }elseif ($p1==$p2) {
            
            $_SESSION['WON'] ='draw';
       $stmt = $pdo->query('UPDATE users SET balance = balance +'. intval( $rowEnd['bet1']).' WHERE user_id ='.$_GET['user1']);
          $stmt = $pdo->query('UPDATE users SET balance = balance +'.intval($rowEnd['bet2']) .' WHERE user_id ='.$_GET['user2']);
        }
      }
      
      
      
     
          
          
      $_SESSION['speed1']=$rowEnd['speed1'];
       $_SESSION['speed2']=$rowEnd['speed2'];
       $_SESSION['mass1']=$rowEnd['mass1'];
      $_SESSION['mass2']=$rowEnd['mass2'];
      
      
       $_SESSION['speed3']=$rowEnd['speed3'];
       $_SESSION['speed4']=$rowEnd['speed4'];
       $_SESSION['mass3']=$rowEnd['mass3'];
      $_SESSION['mass4']=$rowEnd['mass4'];
      
       $_SESSION['speed5']=$rowEnd['speed5'];
       $_SESSION['speed6']=$rowEnd['speed6'];
       $_SESSION['mass5']=$rowEnd['mass5'];
      $_SESSION['mass6']=$rowEnd['mass6'];
      
      
      
      
      sleep(5);
      $stmt234 = $pdo->query('DELETE FROM horse_quoe WHERE user_id ='.$_GET['user1'].' and op_id='.$_GET['user2']);
      
      header("Location:horse_game_end.php");
         return;  
         
 }
 
 
 
      }
?>


<!DOCTYPE html>
<html>

    <head>
        <title>Website </title>
         <script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>

  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
        <link type="text/css" rel="stylesheet" href="reset.css">
        <link type="text/css" rel="stylesheet" href="flashcss12.css">
       
 
        <meta name="viewport" content="width=device-width">
    </head>

    <body>
    
       
       

        <div class="wrapper">

            <div class="cats"><img class="cat" src="1x.gif"/><img class="cat" src="1x.gif"/><img class="cat" src="1x.gif"/><img class="cat" src="1x.gif"/> <img class="cat" src="1x.gif"/><img class="cat" src="1x.gif"/><img class="cat" src="1x.gif"/><img class="cat" src="1x.gif"/> <img class="cat" src="1x.gif"/><img class="cat" src="1x.gif"/><img class="cat" src="1x.gif"/><img class="cat" src="1x.gif"/> <img class="cat" src="1x.gif"/><img class="cat" src="1x.gif"/><img class="cat" src="1x.gif"/><img class="cat" src="1x.gif"/> <img class="cat" src="1x.gif"/><img class="cat" src="1x.gif"/><img class="cat" src="1x.gif"/>
                <img class="cat" src="1x.gif"/> <img class="cat" src="1x.gif"/><img class="cat" src="1x.gif"/><img class="cat" src="1x.gif"/><img class="cat" src="1x.gif"/> <img class="cat" src="1x.gif"/><img class="cat" src="1x.gif"/><img class="cat" src="1x.gif"/><img class="cat" src="1x.gif"/> <img class="cat" src="1x.gif"/><img class="cat" src="1x.gif"/><img class="cat" src="1x.gif"/><img class="cat" src="1x.gif"/> <img class="cat" src="1x.gif"/><img class="cat" src="1x.gif"/><img class="cat" src="1x.gif"/><img class="cat" src="1x.gif"/> <img class="cat" src="1x.gif"/><img class="cat" src="1x.gif"/><img class="cat" src="1x.gif"/><img class="cat" src="1x.gif"/> <img class="cat" src="1x.gif"/><img class="cat" src="1x.gif"/><img class="cat" src="1x.gif"/>
            </div>
            <header>
                <div  class="name">  <div class="website"><span class="W">W</span><span class="E">e</span><span class="B">b</span><span class="S">s</span><span class="I">i</span><span class="T">t</span><span class="W">e</span> </div> </div>
                <div class="pic">
                    <?php 
                    if(isset($_SESSION['user_id'])){
                    $stmt1 = $pdo->prepare('SELECT * FROM users WHERE user_id = :lel');

                    $stmt1->execute(array(
                        ':lel' => $_SESSION['user_id']
                    ));

                    $row = $stmt1->fetch(PDO::FETCH_ASSOC);
                    
                    echo ' <div class="ava"> <div class="pik4a"> ';
                    $sto =100;
                    echo "<img src=".$row['avatar']." width=".$sto." height=".$sto."> </div> ";
                    echo '<div class="info">';
                    echo "<p>Name: ".htmlentities($row['name'])."</p>";
                    echo "<p>Surname: ".htmlentities($row['surname'])."</p>";
                     echo "<p>Status: ".htmlentities($row['status'])."</p>";
                        echo '</div>';
                    echo '</div>';
                    echo '  <div class="balance">';
                     echo "<p>Balance: ".$row['balance']."</p>";
                    
                    echo '</div>';
                    
                 
                    }
                    
                    else{
                    ?>
                    <div class="ava"> <div class="pik4a"> <img src="static/jojo4.png" /> </div> 
                        <div class="info" style="background-size:cover;background-image: url(static/jojo5.jpg);  " >YOU ARE NOT LOGGED IN</div>
                    
                    </div>
                
                    <div class="balance" style="background-image: url(static/jojo3.gif);background-size:cover;  "></div>
<?php }?>
                </div>
            </header>

            <div class = "log">
<?php 

 

if(isset($_SESSION['name'])){
    
    
                echo '<div class="logout">';
                echo '<a href="logout.php"';
                echo '"> LOGOUT </a></div>';
                echo '<div class="profile">';
                echo '<a href="forum.php" ';
                echo '"> FORUM </a></div>'; 
                echo '<div class="profile">';
                echo '<a href="index.php" ';
                echo '"> GAMES </a></div>';
                } else {echo '<div class="login" >';
                echo '<a href="#" onclick="';
                echo "show_log('block')";
                echo '"> LOGIN </a></div>';
                echo '<div class="profile"> ';
                echo '<a href="forum.php"';
              echo '"> FORUM </a></div>';
              echo '<div class="profile">';
               echo '<a href="index.php" ';
                echo '"> GAMES </a></div>';
              
                }
 
              ?><div class="signup"><a href="#"onclick="show('block');">SIGN UP</a></div><div class="top"><a href="login.php">TOP USERS</a></div>
          </div>

          

        

    <div onclick="show('none')" id="gray"></div>
    <div onclick="show_log('none')" id="gray_log"></div>
<div id="window">
    <!-- Картинка крестика -->
    <img class="close" src="static/close.png" alt=""  onclick="show('none')">
    <div class="form">
        <h2>Registration</h2>
        <form name="f1" method="POST" enctype="multipart/form-data">
            <input type="text" placeholder="Name" name="name1" class="input">
            <input type="text" placeholder="Surname" name="name2" class="input">
            <input type="text" placeholder="Email" name="email" class="input">
            
            <input type="password" placeholder="Password" name="pass1" class="input">
            <input type="password" placeholder="Confirm password" name="pass2" class="input">
           <p>Avatar: <input type="file" name ="avatar" placeholder="Avatar"></p>
             
            <input type="submit" value="Sign up" name="sab" class="input3"> 
           
            
            <?php 
            if ( isset($_SESSION['fail_reg']) ) {
    // Look closely at the use of single and double quotes
    echo('<p style="color: red;">'.htmlentities($_SESSION['fail_reg'])."</p>\n");
    unset($_SESSION['fail_reg']);  
    
     echo "<script>";
     echo "function show(state)
	{
	document.getElementById('window').style.display = state;	
	document.getElementById('gray').style.display = state; 
        
	}
        show('block');";
     echo "</script>";
}
else{
    
    echo " <p>After registration you get 50000 points.</p>";
}



   
   
            
            ?>
            
            
                  
        </form>
    </div>
</div>
    
    <div id="window_log">
    
         <img class="close" src="static/close.png" alt=""  onclick="show_log('none')">
    <div class="form">
        <h2>Log in</h2>
        <form name="f2" method="POST">
            
            <input type="text" placeholder="Email" name="email_log" class="input">
            
            <input type="password" placeholder="Password" name="pass_log" class="input">
             
      
            <input type="submit" value="Log in" name="log" class="input3"> 
            
           
            <?php 
            if ( isset($_SESSION['fail_log']) ) {
    // Look closely at the use of single and double quotes
    echo('<p style="color: red;">'.htmlentities($_SESSION['fail_log'])."</p>\n");
    unset($_SESSION['fail_log']);  
    
     echo "<script>";
     echo "function show_log(state)
	{
	document.getElementById('window_log').style.display = state;	
	document.getElementById('gray_log').style.display = state; 
        
	}
        show_log('block');";
     echo "</script>";
}
else{
    
    echo "<p>Enter your email and password.</p>";
}



   
   
            
            ?>
        </form>
    </div>
        
        
        
        
    </div>
    
    
 <div onclick="show_topic('none')" id="gray_topic"></div>
   <div id="window_topic">
    
         <img class="close" src="static/close.png" alt=""  onclick="show_topic('none')">
    <div class="form">
        <h1>TOPIC</h1>
        <form name="f3" method="POST">
            
            <input id="topname" type="text" placeholder="Topic name" name="topic_name" oninput="getCount()" class="input">
            <p class="inform-text">You have <span id="count">40</span> letters</p>
            <h1> TOPIC CONTENT</h1>
                
            <textarea id="topcont" name="topic_content" oninput="getCount()" ></textarea>
   <p class="inform-text2">You have <span id="count2">5000</span> letters</p>
                
             
      
            <input type="submit" id="submit-button" value="CREATE" name="create_topic" class="input3"> 
                      <?php 
        
 if(isset( $_SESSION['top'])){
    
     
    // Look closely at the use of single and double quotes
    echo('<p style="color: red;">'.$_SESSION['top']."</p>\n");
    
    
     echo "<script>";
     echo "function show_topic(state)
	{
	document.getElementById('window_topic').style.display = state;	
	document.getElementById('gray_topic').style.display = state; 
        
	}
        show_topic('block');";
     echo "</script>";
     
     
     
      
     unset($_SESSION['top']);
     
}
 
            
            ?>
           
           
        </form>
        
        
           <div class="img_wrap2" id="myForm2">
                    
               <input type="text" name="img_src" id="img_src2" class="input62" placeholder="img URL here...">
               <input type="button" class="input52" onclick="pasteImg2();closeForm2(); " value="Add"></input>
               <input  type="button" class="input52" onclick="closeForm2()" value="Close"></input>
                    
                  </div>
            
            
            
            
            
            
               <p class="img_post2"> 
                  
                  
                  
                              <input type="button" class="input42"  onclick="openForm2()"  name ="image" value="img"></input>
               
              
 
    
              </p>
    </div>
        
        
        
        
    </div>
 
    <script>
//Функция показа       
        function openForm2() {
  document.getElementById("myForm2").style.display = "block";
}

function closeForm2() {
  document.getElementById("myForm2").style.display = "none";
}
        function pasteImg2(){
    
    var author = document.getElementById("img_src2").value;
          console.log(author);
         //[IMG SOURCE-URL:"google.kzaasd/ada"]
        document.getElementById("topcont").value += '[IMG SOURCE-URL:" '+ author +'"]' + '\n';
    
    }
	function show_topic(state)
	{
	document.getElementById('window_topic').style.display = state;	
	document.getElementById('gray_topic').style.display = state; 
        
	}
        function getCount() {
            
             var maxim2 = 5000;
            var count2 = $("#topcont").val().length;
             var ostatok2 = maxim2 - count2;
              $("#count2").text(ostatok2);
            
             if (ostatok2 < 0) { $(".inform-text2").css('color','red'); } 
              else if (ostatok2 >= 0 ) {
                  
   $(".inform-text2").css('color','white');
    
    
    }
    
            var maxim = 40;
            var count = $("#topname").val().length;
             var ostatok = maxim - count;
              $("#count").text(ostatok);
              
              if (ostatok < 0) { $(".inform-text").css('color','red'); } 
              else if (ostatok >= 0 ) {
                  
   $(".inform-text").css('color','white');
    
   
    }
       
        if (ostatok < 0 || ostatok2 < 0) { 
            document.getElementById("submit-button").disabled = true;  } 
        else if (ostatok >= 0 && ostatok2 >=0 ) {
     document.getElementById("submit-button").disabled = false; 
     
  }  
    
    
    
    
    
    }
    
    
   function getCountPost() {
            
             var maxim2 = 2000;
            var count2 = $("#post_text").val().length;
             var ostatok2 = maxim2 - count2;
              $("#count3").text(ostatok2);
            
             if (ostatok2 < 0) { 
                 
                 $(".inform-text3").css('color','red'); } 
              else if (ostatok2 >= 0 ) {
                  
   $(".inform-text3").css('color','white');
    
    
    }
    
         
       
        if ( ostatok2 < 0) { 
            document.getElementById("submit-button_post").disabled = true; 
            
            document.getElementById("submit-button_post").value = "AAAAAAAAAAAAAAAAAAAAAAAAA";
        } 
        else if (ostatok2 >=0 ) {
     document.getElementById("submit-button_post").disabled = false; 
      document.getElementById("submit-button_post").value = "POST";
  }  
    
    
    
    
    
    }
    
    
    
    
</script> 
    
    
 <script>
//Функция показа
	function show(state)
	{
	document.getElementById('window').style.display = state;	
	document.getElementById('gray').style.display = state; 
        
	}
        function show_log(state)
	{
	document.getElementById('window_log').style.display = state;	
	document.getElementById('gray_log').style.display = state; 
        
	}
 
</script> 
 
<script>
 var audio = new Audio(); // Создаём новый элемент Audio
  audio.src = 'static/dzin2.wav'; // Указываем путь к звуку "клика"
 $(document).ready(function(){
$( "#name" ).mouseover(function() {
  audio.play();
  console.log("sdasd");
  
});});
</script>
 <script>
$(window).on("scroll", function(){
	$('input[name="scroll"]').val($(window).scrollTop());
});
 
<?php if (!empty($_SESSION['scrol'])): ?>
$(document).ready(function(){
	window.scrollTo(0, <?php echo intval($_SESSION['scrol']); ?>);  
}); 
<?php endif; 
unset($_SESSION['scrol']);

?>
</script>

