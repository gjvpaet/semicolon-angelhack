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
        
        if(isset($_POST['update']) ){
         if($_POST['name'] != '' and $_POST['desc'] != ''  and $_POST['price'] != '' ) {
            $name = mysqli_real_escape_string($conn,$_POST['name']);
            $desc = mysqli_real_escape_string($conn,$_POST['desc']);
            $cate =mysqli_real_escape_string($conn,$_POST['cate']);
            $price =mysqli_real_escape_string($conn, $_POST['price']);
            $stat = mysqli_real_escape_string($conn,$_POST['stat']);
            $id = mysqli_real_escape_string($conn,$_POST['idselect']);
            
    
            
            if($_FILES['imagenew']['tmp_name'] != ''){
              $image2 = addslashes(file_get_contents($_FILES['imagenew']['tmp_name']));
             $sql = "update  prod_tbl set prod_name = '$name',prod_desc='$desc',prod_category = '$cate',prod_price= '$price',prod_status= '$stat',img='{$image2}' where prod_id ='$id'";
                        $result = $conn->query($sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);
            } 
            else{
             // $image2 = addslashes(file_get_contents($_FILES['imagenew']['tmp_name']));
             $sql = "update  prod_tbl set prod_name = '$name',prod_desc='$desc',prod_category = '$cate',prod_price= '$price',prod_status= '$stat' where prod_id ='$id'";
                        $result = $conn->query($sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);
            }    
                        echo "<script>
                        alert('Update Successfully!');
                        window.location.href='storeproducts.php';
                        </script>";
                    
                          }
                          else{
                         echo "<script>
                        alert('Please fill out all the required fields!');
                        window.location.href='storeproducts.php';
                        </script>"; 
                          }
               
      
  }
  if(isset($_POST['remove'])){
    $pid=$_POST['remove'];
     $sql = "Delete from food where food_id= '$pid'";
     $result = $conn->query($sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);
        echo "<script>
                        alert('Product Successfully Removed!');
                        window.location.href='storeproducts.php';
                        </script>";  
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
                <img src="img/shopperlogo.PNG" alt="Mountain View" style="width:100px;height:50px;border-radius: 10px;"><label style="margin-top:15px;margin-left:20px;font-size: 20px;position:absolute">FoodBytes - Store Maintenance</label>
                
               
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
                   
                    
                        <input type="text" name="storeid" value='<?php echo $storeid; ?>' style="width:50px;height:30px;padding:5px;" disabled/>
                            
                     
                    
                    </div>
                    
                    <br>
                    
                    
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
      
            <div id ="mainContent">
                <form method="Post" action="#" enctype="multipart/form-data">
                
                  <fieldset style="position:absolute;border:2px solid black;width:1000px;margin-left:0px;margin-top:20px;border-radius: 10px;">
                      <label id='plist' style="font-size:15px;">Product List</label><br>
                    <label>Search Product : </label>
                    <input type="text" name="txtsrch" maxlength="200" style="width:200px;height:30px;">
                    
                    <input type="submit" name="srch" value="Search" id="btnall" style="height: 30px;">
                    
                    
                        <div style=" overflow-y: scroll;margin-top:10px;" id ='printtable'>
                                                <table class="table table-bordered"  >
                                                <thead>
                                                <tr>
				  		<th style="width: 60px">ID</th>
                                                <th style="width: 100px">IMAGE</th>
                                               
				  		<th style="width: 280px">NAME</th>
				  		<th style="width: 380px">DESCRIPTION</th>
				  		
                                                				  	
				  		<th style="width: 60px">PRICE</th>
				  		
				  		
                                                </tr>
				  		</thead>
                                                <?php
                                                
				$sql2 = "SELECT * FROM food where store_id = '$storeid' ";
                                                
                                $result2 = $conn->query($sql2);
				while($row = $result2->fetch_assoc()) {
				echo "<tr><td>".$row['food_id']."</td>";
                                echo '<td><img src="data:image/jpeg;base64,'.base64_encode( $row['img'] ).'" style="height:100px;width:100px;"/></td>';
                                
                                echo "<td>".$row['food_name']."</td><td>".$row['food_description']."</td><td>".$row['food_price']."</td>"
                                        . "<td><input type='image'  value='".$row['food_id']."' name='remove' src= 'img/remove.png'  style='height:20px;width:20px'/></td>"
                                        . "</tr>";
				
                                }
				
                                $conn->close();

			?>
                                                
                                                </table>
                    
						</div>
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
                        .width(235)
                        .height(125);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>