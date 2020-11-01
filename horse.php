<?php
require_once 'inherit.php';
$_SESSION['position'] ="index.php";

if ( isset($_POST['s']) ) {
    
    $_SESSION['searching']=true;
    
    $stmt = $pdo->query('SELECT  user_id FROM horse_quoe WHERE op_id = 0 AND user_id <>'.$_SESSION['user_id']);
    
    if ($row  = $stmt->fetch(PDO::FETCH_ASSOC) ){
        
    $stmt = $pdo->prepare('UPDATE horse_quoe
    set op_id = :pid
    WHERE user_id = :kek' );

  $stmt->execute(array(
  ':pid' => $_SESSION['user_id'],
   ':kek'=> $row['user_id']
  )
  ); 
    }
    
    else{
    
    $stmt = $pdo->prepare('INSERT INTO horse_quoe
    (user_id)
    VALUES ( :pid)');

  $stmt->execute(array(
  ':pid' => $_SESSION['user_id'],
   
  )
  ); 
    }
    
//    header("Location:horse.php");
//    return;
  }


?>
 
  
  <div class="bod">


      
      
      
      <form method="POST">
          <input type="submit" name="s" value="search" onclick=""/>
      </form>
      
      <div id="chatcontent">
          <img src="spinner.gif" alt="Loading..."/>
      </div>
 

<script type="text/javascript">
function updateMsg() {
  window.console && console.log('Requesting JSON'); 
  $.getJSON('quoue.php', function(rowz){
      window.console && console.log('JSON Received'); 
      window.console && console.log(rowz);
      for(var i =0;i<rowz.length;i++){
          console.log(rowz[i][0]) ;
           console.log(rowz[i][1]) ;
       
           if((rowz[i][0] == <?= $_SESSION['user_id'] ?> && rowz[i][1] != 0)||
                   
                   rowz[i][1] == <?= $_SESSION['user_id']?>
            
            
            ){
          console.log("rowz[i][1]") ;
      window.location = "horse_game.php?user1="+ rowz[i][0]+"&user2="+rowz[i][1];
          
      }
       
       }
       
      setTimeout('updateMsg()', 1000);
  });
}

// Make sure JSON requests are not cached
$(document).ready(function() {
  $.ajaxSetup({ cache: false });
   
});


</script>
      
      
      
      
      
     <?php
if(isset($_SESSION['searching'])){
    echo '<script>updateMsg(); </script>';
    unset($_SESSION['searching']);
}

?> 
      
      
      
      
      
      
      
      
      
      
      
      
      
      
            </div>
 </div>
    </body>


</html>
