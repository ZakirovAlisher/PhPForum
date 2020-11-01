<?php
require_once 'inherit.php';
$_SESSION['position'] ="forum.php";
?> 
   <div class="bod">
       
       <?php if(isset($_SESSION['user_id'])) {
     echo '<div class="addtopic">';
 echo '<a href="#" onclick="';
 echo "show_topic('block')";
 echo '">';
 echo '+CREATE TOPIC+</a></div>';      
       }
       else{echo '<div class="addtopic">';
 echo '<a href="#" onclick="';
 echo "show_log('block')";
 echo '">';
 echo '+CREATE TOPIC+</a></div>'; 
       }
           ?>
       
      
      
       
      <?php
      
       $stmt = $pdo->query('SELECT u.avatar, u.name, u.surname, t.topic_id, t.topic_name, t.count, t.topic_date
FROM
  topics t
  JOIN
  users u
    ON t.user_id = u.user_id ORDER BY t.topic_id desc');
 
 
       while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
           echo '<div class="topic" >';
            echo '<div class="topic_ava">';
             echo "<img src=".$row['avatar'].">";
            echo '</div>';
            echo '<div class="topic_desc">';
            echo '<div class="topic_name">';
           
            echo '<a href="';
            echo "topic.php?topic_id=".htmlentities($row['topic_id'])."";
            echo '">' ;
            echo htmlentities($row['topic_name']);
            echo '</a>';
            echo '</div>';
            echo'<div class="topic_author">Author: ';
            echo htmlentities($row['name']." ".$row['surname']);
            echo'</div>';
              echo'<div class="topic_author">Posted: ';
            echo htmlentities($row['topic_date']);
            echo'</div>';
            
             echo'</div>';
             
             echo'<div class="count">';
             echo $row['count']." posts";
                 echo'</div>';
             
             echo'</div>';
    
}

  
  

?> 
<!--       <div class="topic" >
           <div class="topic_ava">
               <img src="1x.gif" >
           </div>
           <div class="topic_desc">
               <div class="topic_name"><a href="topic.php?topic_id=1">а как к ?sssssssssssssssssssssss</a></div>
                  <div class="topic_author">Author: Alisher</div>
                  <div class="topic_date"></div>
           </div>
           <div class="count">10 posts</div>
           
       </div>-->
     
       
       
       
       
            </div>




 <div onclick="show_topic('none')" id="gray_topic"></div>
   <div id="window_topic">
    
         <img class="close" src="static/close.png" alt=""  onclick="show_topic('none')">
    <div class="form">
        <h1>TOPIC</h1>
        <form name="f3" method="POST">
            
            <input type="text" placeholder="Topic name" name="topic_name" class="input">
            <h1> TOPIC CONTENT</h1>
            
            <textarea name="topic_content"></textarea>
   
                
             
      
            <input type="submit" value="CREATE" name="create_topic" class="input3"> 
            
            
            
          
           
           
        </form>
        
        
           <div class="img_wrap" id="myForm">
                    
               <input type="text" name="img_src" id="img_src" class="input6" placeholder="img URL here...">
               <input type="button" class="input5" onclick="pasteImg()" value="Add"></input>
               <input  type="button" class="input5" onclick="closeForm()" value="Close"></input>
                    
                  </div>
            
            
            
            
            
            
               <p class="img_post"> 
                  
                  
                  
              <input type="button" class="input4"  onclick="openForm()"  name ="image" value="img"></input>
               
              
 
    
              </p>
        
    </div>
        
        
        
        
    </div>
 
    <script>        
        function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
        function pasteImg(){
    
    var author = document.getElementById("img_src").value;
          console.log(author);
         //[IMG SOURCE-URL:"google.kzaasd/ada"]
        document.getElementById("post_text").value += '[IMG SOURCE-URL:" '+ author +'"]' + '\n';
    
    }
//Функция показа
	function show_topic(state)
	{
	document.getElementById('window_topic').style.display = state;	
	document.getElementById('gray_topic').style.display = state; 
        
	}
        
 
</script> 

 </div>
    </body>


</html>
