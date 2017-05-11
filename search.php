
<!DOCTYPE HTML> 

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>PHP</title>
    <style type="text/css">
       
        #first_box{
            border:2px solid #E8E8E8;
            margin:10px 400px 30px 400px;
            padding: 2px;
            background-color: #F6F6F8;
                
                }
        #fb_text{
            text-align: center;
            font-size: 25px;
            margin: 0px;
        }
        
        #select_box{
            margin-left: 25px;
            
        }
        
        #submit_box{
            margin-left: 65px;
        }
        
        #type_box{
            
            margin-top: -13px;
        }
        
        #location_box{
            display: none;
            
            <?php  if (isset($_GET["select"]) && $_GET["select"]=="place") echo "display:block;" ;?>
            
            margin-top: -13px;
        }
        
        #input_location{
            margin-left: 4px;
            margin-right: 10px;
        }
        
        table, th, td {
            border: 2px solid #E8E8E8;
            border-collapse: collapse;          
            
         }
        
        th{
            background-color:#F6F6F8; 
        }
        
        table{
            margin: 0px auto;
            border: 3px solid #E8E8E8;
        }
        
        #album_table{
           
            margin: 5px auto;
        }
        
        #post_table{
            
            margin: 5px auto;
        }
           
        
        span{
            color: blue;
            text-decoration: underline;
            
        }
        
        #div_posts{
            text-align: center;
            background-color: #E8E8E8;
            width:52%;
            margin: 20px auto;           
        
        }
        
        #div_albums{
            text-align: center;
            background-color:#E8E8E8;
            width:52%;
            margin: 20px auto;
            
        }
        
        .hidePics{
            margin: 1px;
        }
        
        .highResATag{
            margin: 0px 3px;

        }      
        

</style>
    
    <script type="text/javascript">
        
        //hideshow location box
        function showLocation(element){
            if(element.value==='place'){
                document.getElementById("location_box").style.display='block';
            }else{
                document.getElementById("location_box").style.display='none';
            }
            
            
        }
        
        //clearAll
        function clearAll(element){
          var  tags = element.getElementsByTagName('input');
         for(i = 0; i < tags.length; i++) {
             switch(tags[i].type) {
           
            case 'text':
                tags[i].value = '';
                break;
           
             }
         }

            tags_sel = element.getElementsByTagName('select');
           
            for(i = 0; i < tags_sel.length; i++) {
                if(tags_sel[i].type == 'select-one') {
                    tags_sel[i].selectedIndex = 0;
                }
                else {
                    for(j = 0; j < tags_sel[i].options.length; j++) {
                        if(tags_sel[i].options[j].value==user){
                            tags_sel[i].options[j].selected = true;
                        }else{
                            tags_sel[i].options[j].selected = false;
                        }
                    }
                }
            }
            
            
            document.getElementById("location_box").style.display='none';
            document.getElementById("mainDiv").style.display='none';
            
            
        
        }
    
         
        //showhide albums
         function showhide_Albums(){
            if(document.getElementById("album_table").style.display==='none'){
                
                document.getElementById("album_table").style.display='block';
                
                if(document.getElementById("post_table")){
                document.getElementById("post_table").style.display='none';
                }
                
                var hidePicsArr= document.getElementsByClassName("hidePics");
                for(var i=0;i<hidePicsArr.length;i++){
                    hidePicsArr[i].style.display='none';
                }
                
            }else{
                
                document.getElementById("album_table").style.display='none';
            }
            
            
        }
        
        //showhide posts
        function showhide_Posts(){
            if(document.getElementById("post_table").style.display==='none'){
                
                document.getElementById("post_table").style.display='block';
                
                if(document.getElementById("album_table")){
                document.getElementById("album_table").style.display='none';
                }
                
            }else{
                
                document.getElementById("post_table").style.display='none';
            }
            
            
        }
        
        //showhide album image elements
        function showhide_AlbumImages(element){
              
              //element is span , so we need to move 2 parent up to get the row id
              var indexString=element.parentNode.parentNode.id;
            
              //row id has 'row'+'id number' , get the id number
              var index=indexString.substring(3);
            
              //conver the id number to int 
              var indexInt=parseInt(index);
            
              var nextIndex="row"+(indexInt+1);
             
              
            if(document.getElementById(nextIndex).style.display==='none'){
                
                document.getElementById(nextIndex).style.display='block';
                
            }else{
                document.getElementById(nextIndex).style.display='none';
            }
            
            
        }
    
        //open image in a new tab
        function openImage(url) {
                
                var imageWindow = window.open("", "_blank");
               
                if (imageWindow !== null) {
                    var htmlStr = "";
                    htmlStr += "<!DOCTYPE HTML> <html><head></head><body><img src = " + url + " style='width:550px; height:550px;' /></body></html>";
                    imageWindow.document.write(htmlStr);   
                    imageWindow.focus();
                }
                
            }

         function openHighResImage(url) {
                
                var imageWindow = window.open("", "_blank");
               
                if (imageWindow !== null) {
                    var htmlStr = "";
                    htmlStr += "<!DOCTYPE HTML> <html><head></head><body><img src = " + url + "  /></body></html>";
                    imageWindow.document.write(htmlStr);   
                    imageWindow.focus();
                }
                
            }
        
    
    
    </script>
    
    
</head>
    
<body>
    
    <div id="first_box">
        <p id="fb_text"><b><i>Facebook Search</i></b></p>
        <hr>
      
        
        
    <form id="form_box" method="get" action="">
        <p>Keyword <input id="inputKeywordID" name="input_keyword" type=text required autocomplete="on" value="<?php echo isset($_GET['input_keyword']) ? $_GET['input_keyword'] : '' ?>"></p>
        <p id="type_box"> Type:  <select id="select_box" name="select" size=1 onchange="showLocation(this)">
        
                  <option value="user"   <?php if (isset($_GET["select"]) && $_GET["select"]=="user") echo "selected";?>>Users</option>
                  <option value="page"   <?php if (isset($_GET["select"]) && $_GET["select"]=="page") echo "selected";?>>Pages</option>
                  <option value="event"  <?php if (isset($_GET["select"]) && $_GET["select"]=="event") echo "selected";?>>Events</option>
                  <option value="place"  <?php if (isset($_GET["select"]) && $_GET["select"]=="place") echo "selected";?>>Places</option>
                  <option value="group"  <?php if (isset($_GET["select"]) && $_GET["select"]=="group") echo "selected";?>>Groups</option>
        
               </select>        
        </p>
        
        <p id="location_box">Location <input id="input_location" name="input_location" type=text  autocomplete="on" value="<?php echo isset($_GET['input_location']) ? $_GET['input_location'] : '' ?>">Distance(Meters) <input id="input_distance" name="input_distance" type=text  autocomplete="on" value="<?php echo isset($_GET['input_distance']) ? $_GET['input_distance'] : '' ?>"></p>
        
        <p>
        <input id="submit_box" type="submit" name="submit" value="Search">
        <input type="button" name="reset" value="Clear" onclick="clearAll(this.form)">
        </p>
        
        </form>           
    
     </div>   
    
   <?php
    
    
    
    require_once __DIR__ . '/php-graph-sdk-5.0.0/src/Facebook/autoload.php';
      
    
    $TOKEN="EAACXwtZC6CnEBAHBm00sZC9Mu7GGs4SZCXbYH4ZCO7hiVimFpbpGipyz8mEdA9Ezn9ZACFv3KIja3LdnSCpxBYZBh2z3OoDbuVSakfO773DuKUzifYsSzKl6OT19Vi9uf24epvCLTQLsNj1YfYU5Nnvoa7cPjoYtsZD";
                                             
     $APPID="166863237155441"; 
     $APPSECRET="38e6054240aafdc9701a2ed49d364fba";                                          
                                             
    $fb = new Facebook\Facebook([
        'app_id' => $APPID,
        'app_secret' => $APPSECRET,
        'default_graph_version' => 'v2.8',
        ]);
                                             
    // Sets the default fallback access token so we don't have to pass it to each request
    $fb->setDefaultAccessToken($TOKEN); 
                                             
    
    $URL=$TYPE=$KEYWORD=$TYPE=$OUTPUT=$ID="";
    
    $INDEX=0;
    
    
    
    if(isset($_GET["submit"]) ){ 
        
       
    
        $TYPE=$_GET["select"];
        $KEYWORD=$_GET["input_keyword"];
         //replace the spaces by + in input obtained from user
        $KEYWORD=preg_replace('/\s+/', '+', $KEYWORD);
        
       
    
    //User
    if($TYPE=="user"){
        
       // $URL='https://graph.facebook.com/v2.8/search?q='.$KEYWORD.'&type='.$TYPE.'&fields=id,name,picture.width(700).height(700)&access_token='.$TOKEN;        
       
        
       // $USER_JSON = file_get_contents($URL);
        //$USER_ARRAY = json_decode($USER_JSON,true);
        
        try {
            $response = $fb->get('/search?q='.$KEYWORD.'&type='.$TYPE.'&fields=id,name,picture.width(700).height(700)');
            } catch(Facebook\Exceptions\FacebookSDKException $e) {
            // . . .
            exit;
            }

            $USER_ARRAY = $response->getDecodedBody();
        
        
         if(empty($USER_ARRAY['data']) || empty($USER_ARRAY)){
             
            $OUTPUT="<div id=\"mainDiv\" ><div id=\"list_table\"><table><col width=\"700\" ><tr><td>No records has been found</td></tr>";
        
         }else{
        
            $OUTPUT="<div id=\"mainDiv\" ><div id=\"list_table\"><table><col width=\"200\" ><col width=\"400\" ><col width=\"100\" > <tr><th>Profile Photo</th><th>Name</th><th>Details</th></tr>";        
       
       
            foreach($USER_ARRAY['data'] as $RESULTS){
            
                $URL_PROFILE=$RESULTS['picture']['data']['url'];
         
                $OUTPUT.="<tr><td><img src=\"".$URL_PROFILE."\"style=\"width:40px;height:30px;\" onclick='openImage(\"$URL_PROFILE\")' /></td>";
            
                $OUTPUT.="<td>".$RESULTS['name']."</td>";
             
                $ID=$RESULTS['id'];
            
                $OUTPUT.="<td><a href=search.php?details=true&id=".$ID."&input_keyword=".$KEYWORD."&select=".$TYPE.">Details</a></td></tr>";                
                
            
        }
             
             
     }
        
       
    }
    
    //page
    
    if($TYPE=="page"){
         
       // $URL='https://graph.facebook.com/v2.8/search?q='.$KEYWORD.'&type='.$TYPE.'&fields=id,name,picture.width(700).height(700)&access_token='.$TOKEN;
        
       //  $PAGE_JSON = file_get_contents($URL);
       //  $PAGE_ARRAY = json_decode($PAGE_JSON,true);
        
         try {
            $response = $fb->get('/search?q='.$KEYWORD.'&type='.$TYPE.'&fields=id,name,picture.width(700).height(700)');
            } catch(Facebook\Exceptions\FacebookSDKException $e) {
            // . . .
            exit;
            }

            $PAGE_ARRAY = $response->getDecodedBody();
        
         if(empty($PAGE_ARRAY['data']) || empty($PAGE_ARRAY)){
             
            $OUTPUT="<div id=\"mainDiv\" ><div id=\"list_table\"><table><col width=\"700\" ><tr><td>No records has been found</td></tr>";
        
         }else{
        
            $OUTPUT="<div id=\"mainDiv\" ><div id=\"list_table\"><table><col width=\"200\" ><col width=\"400\" ><col width=\"100\" > <tr><th>Profile Photo</th><th>Name</th><th>Details</th></tr>";        
       
        
            foreach($PAGE_ARRAY['data'] as $RESULTS){
            
                $URL_PROFILE=$RESULTS['picture']['data']['url'];
         
                $OUTPUT.="<tr><td><img src=\"".$URL_PROFILE."\"style=\"width:40px;height:30px;\" onclick='openImage(\"$URL_PROFILE\")' /></td>";
            
                $OUTPUT.="<td>".$RESULTS['name']."</td>";
            
                $ID=$RESULTS['id'];
            
                $OUTPUT.="<td><a href=search.php?details=true&id=".$ID."&input_keyword=".$KEYWORD."&select=".$TYPE.">Details</a></td></tr>";              
                
            }
    
         }
    }
    
    //events
    if($TYPE=="event"){
         
       // $URL='https://graph.facebook.com/v2.8/search?q='.$KEYWORD.'&type='.$TYPE.'&fields=id,name,picture.width(700).height(700),place&access_token='.$TOKEN;
        
       // $EVENT_JSON = file_get_contents($URL);
       //  $EVENT_ARRAY = json_decode($EVENT_JSON,true);
        
         try {
            $response = $fb->get('/search?q='.$KEYWORD.'&type='.$TYPE.'&fields=id,name,picture.width(700).height(700),place');
            } catch(Facebook\Exceptions\FacebookSDKException $e) {
            // . . .
            exit;
            }

            $EVENT_ARRAY = $response->getDecodedBody();
        
         
        
        if(empty($EVENT_ARRAY['data']) || empty($EVENT_ARRAY)){
            
            $OUTPUT="<div id=\"mainDiv\" ><div id=\"list_table\"><table><col width=\"700\" ><tr><td>No records has been found</td></tr>";
        
        }else{
             
         $OUTPUT="<div id=\"mainDiv\" ><div id=\"list_table\"><table><col width=\"200\" ><col width=\"400\" ><col width=\"100\" > <tr><th>Profile Photo</th><th>Name</th><th>Place</th></tr>";        
       
        
            foreach($EVENT_ARRAY['data'] as $RESULTS){
            
                $URL_PROFILE=$RESULTS['picture']['data']['url'];
         
                $OUTPUT.="<tr><td><img src=\"".$URL_PROFILE."\"style=\"width:40px;height:30px;\" onclick='openImage(\"$URL_PROFILE\")' /></td>";
            
                $OUTPUT.="<td>".$RESULTS['name']."</td>";
            
                $OUTPUT.="<td>".$RESULTS['place']['name']."</td></tr>";               
                
            
        }
    }
}
    
    //place
    if($TYPE=="place"){     
            
        $LOCATION=$_GET['input_location'];
        $DISTANCE=$_GET['input_distance'];     
        
        
        if($LOCATION==''|| $DISTANCE==''){
           // $URL='https://graph.facebook.com/v2.8/search?q='.$KEYWORD.'&type='.$TYPE.'&fields=id,name,picture.width(700).height(700)&access_token='.$TOKEN;
            
            $URL='/search?q='.$KEYWORD.'&type='.$TYPE.'&fields=id,name,picture.width(700).height(700)';
        }else{
            
        
        $API_URL='https://maps.googleapis.com/maps/api/geocode/json?address='.$LOCATION.'&key=AIzaSyCH2oV-UseNkX64FArYp40MjeZxTyIvwAY';
        
        $API_JSON=file_get_contents($API_URL);
        $API_ARRAY = json_decode($API_JSON,true);
        
        //echo '<pre>';
        // print_r($API_ARRAY);
        // echo '</pre>';
        
        $CENTER=$API_ARRAY['results'][0]['geometry']['location']['lat'].','.$API_ARRAY['results'][0]['geometry']['location']['lng'];     
       
  
       //$URL='https://graph.facebook.com/v2.8/search?q='.$KEYWORD.'&type='.$TYPE.'&center='.$CENTER.'&distance='.$DISTANCE.'&fields=id,name,picture.width(700).height(700)&access_token='.$TOKEN;
            
        $URL='/search?q='.$KEYWORD.'&type='.$TYPE.'&center='.$CENTER.'&distance='.$DISTANCE.'&fields=id,name,picture.width(700).height(700)';    
        }
        
       //$PLACE_JSON = file_get_contents($URL);
       //$PLACE_ARRAY = json_decode($PLACE_JSON,true);
        
         try {
            $response = $fb->get($URL);
            } catch(Facebook\Exceptions\FacebookSDKException $e) {
            // . . .
            exit;
            }

            $PLACE_ARRAY = $response->getDecodedBody();
        
        
         if(empty($PLACE_ARRAY['data']) || empty($PLACE_ARRAY)){
             
            $OUTPUT="<div id=\"mainDiv\" ><div id=\"list_table\"><table><col width=\"700\" ><tr><td>No records has been found</td></tr>";
        
         }else{
        
          $OUTPUT="<div id=\"mainDiv\" ><div id=\"list_table\"><table><col width=\"200\" ><col width=\"400\" ><col width=\"100\" > <tr><th>Profile Photo</th><th>Name</th><th>Details</th></tr>";      
       
        
            foreach($PLACE_ARRAY['data'] as $RESULTS){
            
                $URL_PROFILE=$RESULTS['picture']['data']['url'];
         
               $OUTPUT.="<tr><td><img src=\"".$URL_PROFILE."\"style=\"width:40px;height:30px;\" onclick='openImage(\"$URL_PROFILE\")' /></td>";
            
                $OUTPUT.="<td>".$RESULTS['name']."</td>";
            
                $ID=$RESULTS['id'];
            
                $OUTPUT.="<td><a href=search.php?details=true&id=".$ID."&input_keyword=".$KEYWORD."&select=".$TYPE."&input_location=".$LOCATION."&input_distance=".$DISTANCE.">Details</a></td></tr>";             
                
            }      
        
         }
    }
    
    //group
    if($TYPE=="group"){
        
       //  $URL='https://graph.facebook.com/v2.8/search?q='.$KEYWORD.'&type='.$TYPE.'&fields=id,name,picture.width(700).height(700)&access_token='.$TOKEN;
        
      //  $GROUP_JSON = file_get_contents($URL);
      //  $GROUP_ARRAY = json_decode($GROUP_JSON,true);
        
         try {
            $response = $fb->get('/search?q='.$KEYWORD.'&type='.$TYPE.'&fields=id,name,picture.width(700).height(700)');
            } catch(Facebook\Exceptions\FacebookSDKException $e) {
            // . . .
            exit;
            }

            $GROUP_ARRAY = $response->getDecodedBody();
        
         if(empty($GROUP_ARRAY['data']) || empty($GROUP_ARRAY)){
            
             $OUTPUT="<div id=\"mainDiv\" ><div id=\"list_table\"><table><col width=\"700\" ><tr><td>No records has been found</td></tr>";
        
         }else{
        
             $OUTPUT="<div id=\"mainDiv\" ><div id=\"list_table\"><table><col width=\"200\" ><col width=\"400\" ><col width=\"100\" > <tr><th>Profile Photo</th><th>Name</th><th>Details</th></tr>";        
       
        
             foreach($GROUP_ARRAY['data'] as $RESULTS){
            
                $URL_PROFILE=$RESULTS['picture']['data']['url'];
         
                $OUTPUT.="<tr><td><img src=\"".$URL_PROFILE."\"style=\"width:40px;height:30px;\" onclick='openImage(\"$URL_PROFILE\")' /></td>";
            
                 $OUTPUT.="<td>".$RESULTS['name']."</td>";
            
                 $ID=$RESULTS['id'];
            
                 $OUTPUT.="<td><a href=search.php?details=true&id=".$ID."&input_keyword=".$KEYWORD."&select=".$TYPE.">Details</a></td></tr>";              
                
            
        }
        
     }
}
    
     $OUTPUT.="</table></div></div>";
        
    
    
    }else{
    
    if(isset($_GET['details'])){
        
       
        
        $PASSED_ID=$_GET['id'];
        $INDEX=0;        
        
       // $URL="https://graph.facebook.com/v2.8/".$PASSED_ID."?fields=id,name,picture.width(700).height(700),albums.limit(5){name,photos.limit(2){name,picture}},posts.limit(5)&access_token=".$TOKEN;
        
       // $DETAILS_JSON = file_get_contents($URL);
       // $DETAILS_ARRAY = json_decode($DETAILS_JSON,true);
        
         try {
            $response = $fb->get("/".$PASSED_ID."?fields=id,name,picture.width(700).height(700),albums.limit(5){name,photos.limit(2){name,picture}},posts.limit(5)");
            } catch(Facebook\Exceptions\FacebookSDKException $e) {
            // . . .
            exit;
            }

            $DETAILS_ARRAY = $response->getDecodedBody();
        
        if(empty($DETAILS_ARRAY['albums']['data']) || empty($DETAILS_ARRAY['albums']) || empty($DETAILS_ARRAY)){
           
            $OUTPUT="<div id=\"mainDiv\" ><div id=\"div_albums\">No Albums has been found</div>";
        }else{
        
            $OUTPUT="<div id=\"mainDiv\" ><div id=\"div_albums\"><span onclick=\"showhide_Albums()\">Albums</span></div>";
        
            //album table 
            $OUTPUT.="<div class=\"detail_table\" id=\"album_table\" style=\"display:none;\"><table><col width=\"700\" >";    
        
        
            foreach($DETAILS_ARRAY['albums']['data'] as $RESULTS){
            
                if(empty($RESULTS['photos']['data']) || empty($RESULTS['photos'])){
                    $INDEX+=1;
                    $OUTPUT.="<tr id=\"row".$INDEX."\"><td>".$RESULTS['name']."</td></tr>";
                 
                }else{
                 
            
                    $INDEX+=1;
                    $OUTPUT.="<tr id=\"row".$INDEX."\"><td><span onclick=\"showhide_AlbumImages(this)\">".$RESULTS['name']."</span></td></tr>";
            
                    $INDEX+=1;
                    $OUTPUT.="<tr id=\"row".$INDEX."\" class=\"hidePics\"><td>";
            
            
                    foreach($RESULTS['photos']['data'] as $PICS){
                
                
                
                        $HIGH_RES_ID=$PICS['id'];
                        $HIGH_RES_URL="https://graph.facebook.com/v2.8/".$HIGH_RES_ID."/picture?access_token=".$TOKEN;
                        
                        
                
                        // $HIGH_RES_JSON = file_get_contents($HIGH_RES_URL);
                        // $HIGH_RES_ARRAY = json_decode($HIGH_RES_JSON,true);               
                        //  $HIGH_RES_IMAGE=$HIGH_RES_ARRAY['data']['url'];
                
                        /* try {
                            $response = $fb->get('/".$HIGH_RES_ID."/picture?');
                            } catch(Facebook\Exceptions\FacebookSDKException $e) {
                                // . . .
                            exit;
                            }

                            $HIGH_RES_ARRAY = $response->getDecodedBody();
                        
                          */
                
                
                        //high resolution img has to be obatained again.. do it later
                        $OUTPUT.="<img class=\"highResATag\" src=\"".$PICS['picture']."\"style=\"width:80px;height:80px;\" onclick='openHighResImage(\"$HIGH_RES_URL\")' />";
                
                     }
            
                     $OUTPUT.="</td></tr>";
            
                }
        
            }
        
        
        $OUTPUT.="</table></div>";
             
     }
        
        //Post section
        
        if(empty($DETAILS_ARRAY['posts']['data']) || empty($DETAILS_ARRAY['posts']) || empty($DETAILS_ARRAY)){
           
            $OUTPUT.="<div id=\"div_posts\">No Posts has been found</div></div>";
        }else{
        
            $OUTPUT.="<div id=\"div_posts\"><span onclick=\"showhide_Posts()\">Posts</span></div>";
            
            //post table
        
            $OUTPUT.="<div class=\"detail_table\" id=\"post_table\" style=\"display:none;\" ><table><col width=\"700\" ><tr><th>Message</th></tr>"; 
        
            foreach($DETAILS_ARRAY['posts']['data'] as $RESULTS){
            
              if(!empty($RESULTS['message'])){
             
                 $OUTPUT.="<tr><td>".$RESULTS['message']."</td></tr>";
                  
              }
        
            
            }
        
            $OUTPUT.="</table></div></div>";
            
        }
        
       
        
         
    }
    }
    
   
    
     echo $OUTPUT;
    
    ?>
    
    
    
</body>

</html>


