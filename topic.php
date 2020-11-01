<?php
require_once 'inherit.php';

if(!isset($_GET['topic_id'])){
     exit("INVALID TOPIC ID");
    return;
}
  $stmt = $pdo->prepare('SELECT u.avatar, u.name, u.surname, u.count_post, u.status, t.topic_id, t.topic_name, t.topic_content, t.topic_date
FROM
  topics t
  JOIN
  users u
    ON t.user_id = u.user_id WHERE t.topic_id = :keki ORDER BY t.topic_id desc');
 
 
       
$stmt->execute(array(
  ':keki' => $_GET['topic_id'],
  )
);
   
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ($row == false){
    
    exit("INVALID TOPIC ID");
     return;
}
  
$_SESSION['position'] ="topic.php?topic_id=".$_GET['topic_id'];

if(isset($_SESSION['user_id'])){
                    $stmt1 = $pdo->prepare('SELECT * FROM users WHERE user_id = :lel');

                    $stmt1->execute(array(
                        ':lel' => $_SESSION['user_id']
                    ));

                    $rowUser = $stmt1->fetch(PDO::FETCH_ASSOC);
                    
                    
                    
                 
                    }
                    
                    
                    
                    
   $stmt3 = $pdo->prepare('SELECT * FROM posts p JOIN users u ON p.user_id = u.user_id  WHERE p.topic_id = :lel ORDER BY p.post_id ASC');

                    $stmt3->execute(array(
                        ':lel' => $_GET['topic_id']
                    ));

                                    
                    
                    
                    
                    
   //     |>citata<(=author=Dimash=)>zzzzzzz<||          
//||&gt;citata&lt;(=author=Dimash=)&gt;ssss&lt;||
//||&gt;citata&lt;(=author=Dimash=)&gt;zzz&lt;||

$cont = htmlentities($row['topic_content']);
 

    function str_replace_once($search, $replace, $text) 
{ 
   $pos = strpos($text, $search); 
   return $pos!==false ? substr_replace($text, $replace, $pos, strlen($search)) : $text; 
}

//var_dump(strpos($cont, htmlentities("|>citata<(=author=")  ) > 0);

while(strpos($cont,htmlentities("|>citata<(=author=")  ) > 0 && strpos($cont, htmlentities('=)>'))   > 0 &&  strpos($cont, htmlentities('<||')) > 0 )
  {
     
$start  = strpos($cont, htmlentities('<(=author='));

$end    = strpos($cont, htmlentities('=)>'), $start + 1);

$length = $end - $start;

$author = substr($cont, $start + 13, $length - 13);
var_dump($author);

 
 
 
$cont2 = str_replace_once(htmlentities("|>citata<(=author=$author=)>"), '<div class="citata"> <div class="citata_aut"> '.$author.' said:</div><div class="citata_cont">', $cont);

 
 
$cont = str_replace_once( htmlentities("<||"), '</div>  </div>', $cont2);
 }
 // [IMG SOURCE-URL:"google.kzaasd/ada"]
 while(strpos($cont,htmlentities(' [IMG SOURCE-URL:"')  ) >= 0 && strpos($cont, htmlentities('"]'))   >0  )
  {
     

 
 
 
$cont2 = str_replace_once(htmlentities('[IMG SOURCE-URL:"'), '<img src="', $cont);

 
 
$cont = str_replace_once( htmlentities('"]'), '"/>', $cont2);
 }
 
?>








<div class="bod">
    
    <div class="post_topic"><?= htmlentities($row['topic_name']) ?></div> 

    
     <?php if ($row['status'] ==='Admin') {?> 
       <div class="post">
        <div class="post_user">
           <div class="post_username_ADM" id="auth1"> <?= htmlentities($row['name']." ".$row['surname'])?> </div>
            <div class="post_ava_ADM"> <img src="<?= htmlentities($row['avatar'])?>">    </div>
            
             <div class="post_status_ADM"><?= htmlentities($row['status'])?></div>
             
             
             <div class="post_userposts_ADM"><?= htmlentities($row['count_post']).' posts'?></div>
        </div> 

        <div class="post_desc_ADM">
            <div class="post_content_ADM" id ="1"> <?= $cont ?>    </div>
            <div class="post_date_ADM">Posted: <?= htmlentities($row['topic_date'])?> </div>
            
        </div>
           
              <?php if (isset($_SESSION['user_id'])) {?> 
               <input type="submit" class="quote_ADM" value="quote" onclick="test('1');" />
              <?php } ?>
    </div>
    
    
     <?php } else{ ?>
    
       <div class="post">
        <div class="post_user">
           <div class="post_username" id="auth1"> <?= htmlentities($row['name']." ".$row['surname'])?> </div>
            <div class="post_ava"> <img src="<?= htmlentities($row['avatar'])?>">    </div>
            
             <div class="post_status"><?= htmlentities($row['status'])?></div>
             
             
             <div class="post_userposts"><?= htmlentities($row['count_post']).' posts'?></div>
        </div> 

        <div class="post_desc">
            <div class="post_content" id ="1"> <?= $cont ?>    </div>
            <div class="post_date">Posted: <?= htmlentities($row['topic_date'])?> </div>
            
        </div>
           
              <?php if (isset($_SESSION['user_id'])) {?> 
               <input type="submit" class="quote" value="quote" onclick="test('1');" />
              <?php } ?>
    </div>
    
    
    <?php }  ?>
    
    
   <?php 
    $caunt = 2;
   while($rowPosts = $stmt3->fetch(PDO::FETCH_ASSOC)) {
       
       $cont = htmlentities($rowPosts['post_content']);
       
       while(strpos($cont,htmlentities("|>citata<(=author=")  ) > 0 && strpos($cont, htmlentities('=)>'))   > 0 &&  strpos($cont, htmlentities('<||')) >0 )
  {
    
$start  = strpos($cont, htmlentities('<(=author='));

$end    = strpos($cont, htmlentities('=)>'), $start + 1);

$length = $end - $start;

$author = substr($cont, $start + 13, $length - 13);


 
$cont2 = str_replace_once(htmlentities("|>citata<(=author=$author=)>"), '<div class="citata"> <div class="citata_aut"> '.$author.' said:</div> <div class="citata_cont">', $cont);

 
 
$cont = str_replace_once( htmlentities("<||"), '</div>  </div>', $cont2);

 }
// [IMG SOURCE-URL:"google.kzaasd/ada"]

    
 while(strpos($cont,htmlentities('[IMG SOURCE-URL:"')  ) >= 0 && strpos($cont, htmlentities('"]'))   > 0  )
  {
     

 
 
 
$cont2 = str_replace_once(htmlentities('[IMG SOURCE-URL:"'), '<img src="', $cont);

 
 
$cont = str_replace_once( htmlentities('"]'), '"/>', $cont2);
 }
 
           
$cont = str_replace(':radost:', '<img src="https://vk.com/sticker/1-21565-128">', $cont);
$cont = str_replace(':ok:', '<img src="https://vk.com/sticker/1-21603-128">', $cont);
$cont = str_replace(':hello:', '<img src=" https://vk.com/sticker/1-21560-128 ">', $cont);
$cont = str_replace(':raduga:', '<img src="https://vk.com/sticker/1-21561-128">', $cont);
$cont = str_replace(':kruto:', '<img src="https://vk.com/sticker/1-21586-128">', $cont);
$cont = str_replace(':dengi:', '<img src="https://vk.com/sticker/1-21585-128">', $cont);
$cont = str_replace(':poka:', '<img src=" https://vk.com/sticker/1-21597-128">', $cont);
$cont = str_replace(':xz:', '<img src=" https://vk.com/sticker/1-21580-128">', $cont);
$cont = str_replace(':flex:', '<img src=" https://vk.com/sticker/1-21604-128">', $cont);
$cont = str_replace(':sra4:', '<img src="https://vk.com/sticker/1-21605-128 ">', $cont);






 
       ?>   
    
  
    
     <?php if ($rowPosts['status'] ==='Admin') {?> 
           <div class="post">
        <div class="post_user">
           <div class="post_username_ADM" id="<?='auth'.$caunt ?>"> <?= htmlentities($rowPosts['name']." ".$rowPosts['surname'])?> </div>
            <div class="post_ava_ADM"> <img src="<?= htmlentities($rowPosts['avatar'])?>">    </div>
            
             <div class="post_status_ADM"><?= htmlentities($rowPosts['status'])?></div>
             
             
             <div class="post_userposts_ADM"><?= htmlentities($rowPosts['count_post']).' posts'?></div>
        </div> 

        <div class="post_desc_ADM">
            <div class="post_content_ADM" id ="<?= $caunt ?>"> <?= $cont ?>    </div>
            <div class="post_date_ADM">Posted: <?= htmlentities($rowPosts['post_date'])?> </div>
            
        </div>
         <?php if (isset($_SESSION['user_id'])) {?> 
               <input type="submit" class="quote_ADM" value="quote" onclick="test('<?= $caunt ?>');" /><?php } ?>
        
    </div>
    
     <?php } else{?> 
    
    
     <div class="post">
        <div class="post_user">
           <div class="post_username" id="<?='auth'.$caunt ?>"> <?= htmlentities($rowPosts['name']." ".$rowPosts['surname'])?> </div>
            <div class="post_ava"> <img src="<?= htmlentities($rowPosts['avatar'])?>">    </div>
            
             <div class="post_status"><?= htmlentities($rowPosts['status'])?></div>
             
             
             <div class="post_userposts"><?= htmlentities($rowPosts['count_post']).' posts'?></div>
        </div> 

        <div class="post_desc">
            <div class="post_content" id ="<?= $caunt ?>"> <?= $cont ?>    </div>
            <div class="post_date">Posted: <?= htmlentities($rowPosts['post_date'])?> </div>
            
        </div>
         <?php if (isset($_SESSION['user_id'])) {?> 
               <input type="submit" class="quote" value="quote" onclick="test('<?= $caunt ?>');" /><?php } ?>
        
    </div>
    
    
    
     <?php }?> 
    
    
    
    
     <?php 
     $caunt++;
     
  } ?>
    
    
    
    
 
    
    
    
    
    <?php if (isset($_SESSION['user_id'])) {?>
     <div class="post">
        <div class="post_user">
           <div class="post_username"> <?= htmlentities($rowUser['name']." ".$rowUser['surname'])?> </div>
            <div class="post_ava"> <img src="<?= htmlentities($rowUser['avatar'])?>">    </div>
             <div class="post_status"><?= htmlentities($rowUser['status'])?></div>
             <div class="post_userposts"><?= htmlentities($rowUser['count_post']).' posts'?></div>
        </div> 

        <div class="post_desc_post">
            
        
            
            
             <form class="lel" method="POST">
                 <input type="hidden" name="scroll" value="">
                <input type="hidden" name ="topic_id" value="<?= $_GET['topic_id'] ?>">
                <div class="post_content2"><textarea name="post_content" oninput="getCountPost()" id="post_text" placeholder="Comment on the topic....."></textarea>
                
                    
                    
                    <div class="img_wrap3"  id="sticks">
                        <div class="stik"> <img  id="radost" src="https://vk.com/sticker/1-21565-128"></div>    <div class="stik"><img id="ok" src="https://vk.com/sticker/1-21603-128"></div>   <div class="stik"><img  id="hello"src=" https://vk.com/sticker/1-21560-128 "> </div>  
                        <div class="stik"><img id="raduga" src="https://vk.com/sticker/1-21561-128"> </div>       <div class="stik"><img id="kruto"src="https://vk.com/sticker/1-21586-128"></div>     <div class="stik"><img id="dengi"src="https://vk.com/sticker/1-21585-128"></div>    
                        <div class="stik"><img id="poka"src=" https://vk.com/sticker/1-21597-128"> </div>   <div class="stik"><img id="sra4"src="https://vk.com/sticker/1-21605-128 "> </div>   <div class="stik"><img id="xz"src=" https://vk.com/sticker/1-21580-128"> </div>  
                   <div class="stik"><img id="flex"src=" https://vk.com/sticker/1-21604-128"> </div> 
                  </div>
                    
                    
                <div class="img_wrap" id="myForm">
                    
               <input type="text" name="img_src" id="img_src" class="input6" placeholder="img URL here...">
               <input type="button" class="input5" onclick="pasteImg(); closeForm();" value="Add"></input>
               <input  type="button" class="input5" onclick="closeForm()" value="Close"></input>
                    
                  </div>
                    
                  
                  
                  
              
              
                </div>
                <div class="post_noty" ><p  class="inform-text3"> You have <span id="count3">2000</span> letters </p></div>
              <p class="img_post"> 
                  
                  <input class="input4" type="submit" id="submit-button_post" name ="post_post" value="POST" onclick="rtyrn()"></input>
                  
              <input type="button" class="input4"  onclick="openForm()"  name ="image" value="img"></input>
               
              
 
    
              </p>
              
              
              
              
              
              
              <script>
$(window).on("scroll", function(){
	$('input[name="scroll"]').val($(window).scrollTop());
});
 

</script>

              <script>
                  function openForm() {
  document.getElementById("myForm").style.display = "block";
  document.getElementById("sticks").style.display = "none";
}

function closeForm() {
    document.getElementById("sticks").style.display = "flex";
  document.getElementById("myForm").style.display = "none";
}
              </script>
                
              
              
        </form>
               
        </div>
       
        
    </div>
    
    <?php } ?>
    
    
    
    
</div>




<script>
   

function getRangeObject(win) { //Gets the first range object
  win = win || window;
  if (win.getSelection) { // Firefox/Chrome/Safari/Opera/IE9
    try {
      return win.getSelection().getRangeAt(0); //W3C DOM Range Object
    } catch (e) { /*If no text is selected an exception might be thrown*/ }
  }  
  
  return null;
}

    </script>

    <div id="q_hidden" style="display: none;"></div>
        
   

<script>
    function escapeRegExp(str) {
  return str.replace(/[.*+?^${}()|[\]\\]/g, "\\$&");
}

    String.prototype.replaceAll = function(search, replacement) {
    search = escapeRegExp(search);
    var target = this;
    return target.replace(new RegExp(search, 'g'), replacement);
};

    function test(id) {
    try {    
if(window.getSelection().baseNode.parentNode.id !== id) {
     alert('You cant quote this');
            return;}  }
        catch (e) { alert('Select text please'); }
   
      var imgs = getRangeObject().cloneContents();
       
      $('#q_hidden').append(imgs).html();
     var q = document.getElementById("q_hidden").innerHTML;
     q = q.toString();
     document.getElementById("q_hidden").innerHTML ='';
    console.log(q);

     
q = q.replaceAll('<img src="https://vk.com/sticker/1-21565-128">', " :radost: ");
q = q.replaceAll('<img src=" https://vk.com/sticker/1-21604-128">', " :flex: ");
q = q.replaceAll('<img src="https://vk.com/sticker/1-21605-128 ">', " :sra4: ");
q = q.replaceAll('<img src=" https://vk.com/sticker/1-21580-128">', " :xz: ");
q = q.replaceAll('<img src=" https://vk.com/sticker/1-21597-128">', " :poka: ");
q = q.replaceAll('<img src="https://vk.com/sticker/1-21585-128">', " :dengi: ");
q = q.replaceAll('<img src="https://vk.com/sticker/1-21586-128">', " :kruto: ");
q = q.replaceAll('<img src="https://vk.com/sticker/1-21561-128">', " :raduga: ");
q = q.replaceAll('<img src=" https://vk.com/sticker/1-21560-128 ">', " :hello: ");
q = q.replaceAll('<img src="https://vk.com/sticker/1-21603-128">', " :ok: ");
    
while(q.indexOf('<img src="') !== -1 && q.indexOf('">') !== -1 ){
    q= q.replace('<img src="', '[IMG SOURCE-URL:" ' );
    q=q.replace('">', '"]');
    
}
 
while(q.indexOf('<div class="citata"> <div class="citata_aut">') !== -1 && q.indexOf('said:</div> <div class="citata_cont">') !== -1 
        && q.indexOf('</div>  </div>') !== -1)
        {
    q= q.replace('<div class="citata"> <div class="citata_aut">', '|>citata<(=author=' );
    q=q.replace('said:</div> <div class="citata_cont">', '=)>');
     q=q.replace('</div>  </div>', '<||');
}
 
 
      if (imgs) {
         var author = document.getElementById("auth"+id).innerHTML;

         console.log("auth"+id);
         $(window).scrollTop($(document).height());
        document.getElementById("post_text").value += ' |>citata<(=author='+ author +'=)>'+q+'<||' + '\n';
        return imgs;
         
      } 
    }
    
    function pasteImg(){
    
    var author = document.getElementById("img_src").value;
          console.log(author);
         //[IMG SOURCE-URL:"google.kzaasd/ada"]
        document.getElementById("post_text").value += '[IMG SOURCE-URL:" '+ author +'"]' + '\n';
    
    }
    
    function rtyrn(){
        $( document ).ready(function() {
    $(window).scrollTop($(document).height());
});
         
         
    }
    
  </script>



      <script> 
                 $('#radost').click(
                        function(){
             document.getElementById("post_text").value += ' :radost: ';
         return 0;
    } );
               
     
            
                            
                   $('#ok').click(
                        function(){
             document.getElementById("post_text").value += ' :ok: ';}
            );
                
                        $('#hello').click(
                        function(){
             document.getElementById("post_text").value += ' :hello: ';}
            );
                
                        $('#raduga').click(
                        function(){
             document.getElementById("post_text").value += ' :raduga: ';}
            );
                
                        $('#kruto').click(
                        function(){
             document.getElementById("post_text").value += ' :kruto: ';}
            );
                
                        $('#dengi').click(
                        function(){
             document.getElementById("post_text").value += ' :dengi: ';}
            );
                        $('#poka').click(
                        function(){
             document.getElementById("post_text").value += ' :poka: ';}
            );
                        $('#sra4').click(
                        function(){
             document.getElementById("post_text").value += ' :sra4: ';}
            );
                        $('#flex').click(
                        function(){
             document.getElementById("post_text").value += ' :flex: ';}
            );
                        $('#xz').click(
                        function(){
             document.getElementById("post_text").value += ' :xz: ';}
            );
                
                </script>



 </div>
 
   
    </body>

  
</html>
