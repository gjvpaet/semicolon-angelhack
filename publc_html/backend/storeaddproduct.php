<!DOCTYPE html>
<?php
 include 'db.php';
 session_start();  
        $user = $_SESSION['user'];
        if( !isset($_SESSION['user']) ){
        die( "Login required." );
        }
        
   $sqlstore = "SELECT * FROM store where manage_by='$user'";
    $resultstore = $conn->query($sqlstore);
     $storeid;
    while($rowstore = $resultstore->fetch_assoc()) {
                           $storeid = $rowstore['store_id'];   
                                }            
  if(isset($_POST['add'])){
    
    if($_POST["name"] != '' and $_POST["desc"] !=''  and $_POST["price"] != ''){
    $namee=mysqli_real_escape_string($conn, $_POST["name"]);
    $desc =mysqli_real_escape_string($conn,$_POST["desc"]);
   
    $price= mysqli_real_escape_string($conn,$_POST["price"]);
   
    
    $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
    
    
    $sql = "INSERT INTO food (food_name,food_description,food_price,img, store_id) VALUES ('$namee' , '$desc' , $price, '{$image}' ,$storeid);";
    $result = $conn->query($sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);
    echo "<script>
        alert('New Product Added Successfully!');
        window.location.href='storeaddproduct.php';
        </script>";
    }
    else{
        
         echo "<script>
        alert('Fill out all the required field first!');
        window.location.href='storeaddproduct.php';
        </script>";  
    }
 
   
    
}

  
  
  

   
?>
<html>
    <head>
       
        <link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
<meta charset=utf-8 />

        
        
        
        <title>FoodBytes - Store</title>
          <link rel="stylesheet" type="text/css" href="css/backendDashboardCss.css">
        <link rel="stylesheet" type="text/css" href="css/tablecss.css">
       
    </head>
    <body>
         <div id="container">
            <div id="headlayout">
            <div   id = 'header'  >
                <img src="img/shopperlogo.PNG" alt="Mountain View" style="width:100px;height:50px;border-radius: 10px;"><label style="margin-top:15px;margin-left:20px;font-size: 20px;position:absolute">FoodBytes- Store Maintenance</label>
                
                
                <form method='post' action='backend/logout.php'>
                    <input type ='submit' value='Logout' style='position: absolute;width: 150px;height: 40px;margin-left: 1173px;margin-top:-48px;' id='btnall'>
                </form>
              
            </div>
            <div align='left'>
            <div id='headBar'>
            Welcome to FoodBytes!
            </div>  
            </div>
              
                <div id='navigation'>
                    <div style='border-bottom:thin solid gray ;padding:13px;font-weight: bold;'>MAINTENANCE STORE:
                    
                        <input type="text" name="storeid" value='<?php echo $storeid; ?>' style="width:50px;" disabled/>
                            
                     
                    </div><br>
                    
                    
                    <h3 style='font-size:13px'>&nbsp;&nbsp;STORE PROFILE
                    <div id="mainOption">
                        <ul>
                          
                            
                            <li><a href='storeform.php'>&nbsp;&nbsp;Manage Store&nbsp;&nbsp;</a></li>  
                            
                        </ul>        
                    </div>
                  
                      <h3 style='font-size:13px'>&nbsp;&nbsp;PRODUCTS
                    <div id="mainOption" >
                       
                        <ul >
                         
                            
                             <li><a href='storeproducts.php'>&nbsp;&nbsp;Manage Products&nbsp;&nbsp;</a></li>  
                              <li><a href='storeaddproduct.php'>&nbsp;&nbsp;Add Products&nbsp;&nbsp;</a></li>  
                        </ul> 
                         
                    </div>
                    <h3 style='font-size:13px'>&nbsp;&nbsp;SECURITY
                    <div id="mainOption" >
                  
                        <ul >
                         
                            
                            <li><a href='storechangepass.php'>&nbsp;&nbsp;Change Password&nbsp;&nbsp;</a></li>  
                        </ul> 
                 
                    </div>
                    
                            
                   
                </div> 
           
         
            </div>
      
             <div id="mainContent">
              
                 <fieldset style="width:1050px;height: 500px;border-radius: 10px;position:absolute;margin-top:20px;">
                     <legend>Product Information</legend>
                     <form method="post" action="storeaddproduct.php" enctype="multipart/form-data">
                    <label style="font-size: 15px;font-weight: bold">Name:</label> 
                    <input type="text" style ="width:610px;margin-left:34px; "   name="name" maxlength="200" value='' placeholder="Product Name" required/>
                     <br><br>
                     <label style="font-size: 15px;font-weight: bold">Description:</label><br> 
                     <textarea  maxlength="1000" name="desc" cols='84' rows="5" style="margin-left:75px;border-radius:5px;" placeholder="Describe your product" required></textarea>
                     <br><br/>
                     
                     <label style="font-size: 15px;font-weight: bold">Price:</label>
                     <input type="number" name="price" maxlength="50" value=''  style ="width:213px;margin-left: 40px; " required/>
                     <br>
                     <br>
                   
                    
                     <fieldset style="position: absolute;width:320px;height: 400px;border-radius: 7px;top:13px;left:710px;">
                         <legend>Upload Image</legend> 
                          Select image to upload:
                        <input type="file" name="image" id="image"   onchange="readURL(this);"/><br><br>
                         <img id="blah" src="#" alt="No Image" style="width:320px;height:280px;"/>
                     </fieldset>
                     
                     <input type ="submit" value="Add Product" name="add" id="btnall" style="width: 213px;height: 40px;margin-left:75px;">
                    
                     </fieldset>
                      </form>
                     
                     
                       
                      
				
                                
                                
                                
                          
                                               
             </div>
         </div>
        
    </body>
    
    
</html>

<script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result)
                        .width(320)
                        .height(280);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>