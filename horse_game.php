<?php
require_once 'inherit.php';

$ready1 = false;
 
//sleep(2);
$player1 = 0;
 $stmt = $pdo->query('SELECT  user_id, op_id FROM horse_quoe WHERE user_id ='.$_SESSION['user_id']);
$row = $stmt->fetch(PDO::FETCH_ASSOC);



 if ($row === false){
     
     
     
     
     
     $stmt = $pdo->query('SELECT  user_id, op_id FROM horse_quoe WHERE op_id ='.$_SESSION['user_id']);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
 if ($row === false){
     exit("SDSD");
 }
 if($row['op_id'] !== $_GET['user2']){
   exit("SDSD3"); 
}
 }
 else{
if($row['user_id'] !== $_GET['user1']){
   exit("SDSD2"); 
}
 
 }
 
 $_SESSION['position'] ="horse_game.php?user1=".$row['user_id']."&user2=".$row['op_id'];
 
 $_SESSION['op_id']= $_GET['user2'];
 if ($_SESSION['user_id'] == $_GET['user2']){
     $_SESSION['op_id']= $_GET['user1'];
 }
 
 

?>

<div class="bod">

       <style type="text/css">
              #img1 {
  position: relative;
  top: 0px;
  left: 0px;
  width: 200px;
  height: 200px;

}
   #img2 {
  position: relative;
  top: 0px;
  left: 800px;
  width: 200px;
  height: 200px;
   
}

  </style>
          
  
<p><img id="img1" src="static/pl1ff.gif">  <img id="img2" src="static/pl2final.gif">         </p>





 

      
      
  <?php if ($rowEnd['ready1'] == 0 || $rowEnd['ready2'] == 0){ ?>    
<div class="betting" id="bet123">
          
          <form method="POST">
              
              <input type="number" name="bet" placeholder="Bet" />
              
              EACH BET INCREASES CHANCE ON GOOD SPEED. COST OF 1 BET - 1000 BALANCE POINTS.
              <?php if (isset($_SESSION['balance_error'])){
              echo $_SESSION['balance_error'];
              
              
              
              }
              ?>
              <input type="submit" name="ready" value="READY" />
          </form>
          
    </div >
      
     
  <?php }
 
  unset($_SESSION['balance_error']);
  ?>  
    
 
      
      
      
      
      
      
      
      
       <?php if (($rowEnd['ready1'] != 1 && $rowEnd['ready2'] == 1) || ($rowEnd['ready1'] == 1 && $rowEnd['ready2'] != 1)){ ?>  
    
<script type="text/javascript">
function waiting() {
  window.console && console.log('Requesting JSON'); 
  $.getJSON('horse_end.php', function(rowz){
      window.console && console.log('JSON Received'); 
      window.console && console.log(rowz);
      
           if(rowz['ready1'] == 1 && rowz['ready2'] == 1){
               
                window.console && console.log("sdsdasdasdasd");
                
                window.location = "horse_game.php?user1="+ <?= $_GET['user1'] ?>+"&user2="+<?= $_GET['user2'] ?>;
                
             
             
           }
       
       
       
      setTimeout('waiting()', 1000);
  });
}

waiting();


$(document).ready(function() {
  $.ajaxSetup({ cache: false });
   
});


</script>
      
      
     <?php }
     
      
     ?> 
      
      
      
      
      
      
      
            </div>
 </div>
    </body>


</html>