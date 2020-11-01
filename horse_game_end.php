<?php 
require_once 'inherit.php';

?>


   <style type="text/css">
       .horse_race{
           height: 200px;
           width: 100%;
           border-width: 1px; 
     border-color: white;
    border-style: solid;
       }
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
             #img3 {
  position: relative;
  top: 0px;
  left: 0px;
  width: 200px;
  height: 200px;

}
   #img4 {
  position: relative;
  top: 0px;
  left: 800px;
  width: 200px;
  height: 200px;
   
}          #img5 {
  position: relative;
  top: 0px;
  left: 0px;
  width: 200px;
  height: 200px;

}
   #img6 {
  position: relative;
  top: 0px;
  left: 800px;
  width: 200px;
  height: 200px;
   
}
  </style>
          
  





<div class="bod">
    <div class="horse_race">
    <p><img id="img1" src="static/pl1ff.gif">  <img id="img2" src="static/pl2final.gif">         </p>
    
    <script type="text/javascript">
    
 r1 = 0;
 r2 = 0;
 r3 = 0;
 
var curPosX = 0;
 
var curPosX2 = 800;
 



var interval;
var n = 10; // На сколько двигать за раз
var width = document.documentElement.clientWidth; // Ширина экрана
var height = document.documentElement.clientHeight; // Высота экрана
var imgWidth = 200; // Ширина картинки
var imgHeight = 200; // Высота картинки
var img1 = document.getElementById("img1");
var img2 = document.getElementById("img2");



function move() {
    
     
    
    
    if (curPosX <= 980 ){
  img1.style.left = (curPosX += n) + "px";
 // clearInterval(interval);
}
}

function move2() {
    
    
    
    
    if ( curPosX2 >=-225){
  
  img2.style.left = (curPosX2 -= n) + "px";
 // clearInterval(interval2);
             
 
  




}
  
 
if((curPosX2 - curPosX <= -180) ||((curPosX - curPosX2)*(-1) <= -180) ){
   
        
        
        <?php if ( $_SESSION['win1'] == true){ ?>
                    r1 = 1;
        clearInterval(interval2);
      img2.src = "static/pl2_death.png";
      document.getElementById("retorn").style.display = 'flex';
        <?php } else if ( $_SESSION['win2'] == true) { ?>
           r1 = 2;
            clearInterval(interval); 
            img1.src = "static/pl1_death.png";
          <?php } else if ( $_SESSION['draw'] == true) {?>
              r1=1;
              r1=2;
              clearInterval(interval2);
              clearInterval(interval);
              img2.src = "static/pl2_death.png"; img1.src = "static/pl1_death.png";
              <?php }?>
    }
}


     
     
interval = setInterval(move, <?=$_SESSION['speed1']?>);
interval2 = setInterval(move2, <?=$_SESSION['speed2']?>);



 
</script>
 
    
    </div>
     <div class="horse_race">
    <p><img id="img3" src="static/pl1ff.gif">  <img id="img4" src="static/pl2final.gif">         </p>
    
    <script type="text/javascript">
    
 
var curPosX3 = 0;
 
var curPosX4 = 800;
 


 

var n = 10; // На сколько двигать за раз
var width = document.documentElement.clientWidth; // Ширина экрана
var height = document.documentElement.clientHeight; // Высота экрана
var imgWidth = 200; // Ширина картинки
var imgHeight = 200; // Высота картинки
var img3 = document.getElementById("img3");
var img4 = document.getElementById("img4");



function move3() {
    
     
    
    
    if (curPosX3 <= 980 ){
  img3.style.left = (curPosX3 += n) + "px";
 // clearInterval(interval);
}
}

function move4() {
    
    
    
    
    if ( curPosX4 >=-225){
  
  img4.style.left = (curPosX4 -= n) + "px";
 // clearInterval(interval2);
             
 
  




}
 
 
if((curPosX4 - curPosX3 <= -180) ||((curPosX3 - curPosX4)*(-1) <= -180) ){
   
        
        
        <?php if ( $_SESSION['win3'] == true){ ?>
                    r2=1;
        clearInterval(interval4);
      img4.src = "static/pl2_death.png";
      document.getElementById("retorn").style.display = 'flex';
        <?php } else if ( $_SESSION['win4'] == true) { ?>
           r2=2;
            clearInterval(interval3); 
            img3.src = "static/pl1_death.png";
          <?php } else if ( $_SESSION['draw2'] == true) {?>
               r2=1;
              r2=2;
              clearInterval(interval4);
              clearInterval(interval3);
              img4.src = "static/pl2_death.png"; img3.src = "static/pl1_death.png";
              <?php }?>
    }
}


     
     
interval3 = setInterval(move3, <?=$_SESSION['speed3']?>);
interval4 = setInterval(move4, <?=$_SESSION['speed4']?>);



 
</script>
 
    
    </div>
     <div class="horse_race">
    <p><img id="img5" src="static/pl1ff.gif">  <img id="img6" src="static/pl2final.gif">         </p>
    
    <script type="text/javascript">
    
 
var curPosX5 = 0;
 
var curPosX6 = 800;
 


 

var n = 10; // На сколько двигать за раз
var width = document.documentElement.clientWidth; // Ширина экрана
var height = document.documentElement.clientHeight; // Высота экрана
var imgWidth = 200; // Ширина картинки
var imgHeight = 200; // Высота картинки
var img5 = document.getElementById("img5");
var img6 = document.getElementById("img6");



function move5() {
    
     
    
    
    if (curPosX5 <= 980 ){
  img5.style.left = (curPosX5 += n) + "px";
 // clearInterval(interval);
}
}

function move6() {
    
    
    
    
    if ( curPosX6 >=-225){
  
  img6.style.left = (curPosX6 -= n) + "px";
 // clearInterval(interval2);
             
 
  




}
  
 
if((curPosX6 - curPosX5 <= -180) ||((curPosX5 - curPosX6)*(-1) <= -180) ){
   
        
        
        <?php if ( $_SESSION['win5'] == true){ ?>
        clearInterval(interval6);
          r3=1;
             
      img6.src = "static/pl2_death.png";
      document.getElementById("retorn").style.display = 'flex';
        <?php } else if ( $_SESSION['win6'] == true) { ?>
            r3=2;
            clearInterval(interval5); 
            img5.src = "static/pl1_death.png";
          <?php } else if ( $_SESSION['draw3'] == true) {?>
                r3=1;
              r3=2;
              clearInterval(interval6);
              clearInterval(interval5);
              img6.src = "static/pl2_death.png"; img5.src = "static/pl1_death.png";
              <?php }?>
    }
}


     
     
interval5 = setInterval(move5, <?=$_SESSION['speed5']?>);
interval6 = setInterval(move6, <?=$_SESSION['speed6']?>);



 
</script>
 
    
    </div>
    
    <script>
        
        function fee(){
            if (r1!==0 && r2!==0 && r3!==0){
                clearInterval(interval10);
                
                 <?php if ( $_SESSION['WON'] == $_SESSION['user_id']){ ?>
                alert("YOU WON <?= $_SESSION['BET'] ?>");
                document.getElementById("retorn").style.display = 'flex';
                 <?php }
                 else { ?>
                 
                  
                     document.getElementById("retorn").style.display = 'flex';
                     alert("YOU LOST");
                     
                  
                 <?php }?>
                 
            }
            
        }
    interval10 = setInterval(fee, 100);
    
    </script>
    
    
            </div>
  <div id="retorn" class="retorn" style="display: none;">
      <div class="ret1"> <a href="horse_game_end.php">replay</a>   </div>
     <div class="ret1">  <a href="horse.php">return</a>  </div>
  </div>
  
 </div>
    </body>


</html>
<?php 
//unset($_SESSION['speed1']);
//unset($_SESSION['speed2']);
//unset($_SESSION['mass1']);
//unset($_SESSION['mass2']);
//unset($_SESSION['win1']);
//unset($_SESSION['win2']);
//unset($_SESSION['draw']);
?>