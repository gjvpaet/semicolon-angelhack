<!DOCTYPE html>
<?php
 include 'db.php';
 session_start();  
        $user = $_SESSION['user'];
        if( !isset($_SESSION['user']) ){
        die( "Login required." );
        }
  if(isset($_POST['update'])){
         if($_POST['name'] != '' and $_POST['desc'] != '' and $_POST['address'] != '' and $_POST['open'] != '' and $_POST['closed'] != '') {
            $name = mysqli_real_escape_string($conn,$_POST['name']);
            $desc = mysqli_real_escape_string($conn,$_POST['desc']);
            $address = mysqli_real_escape_string($conn,$_POST['address']);
            $open =  mysqli_real_escape_string($conn,$_POST['open']);
            $closed =  mysqli_real_escape_string($conn,$_POST['closed']);
             
             $sql = "update  store_tbl set store_name = '$name',store_desc='$desc',address = '$address',TimeOpen= '$open',TimeClosed= '$closed' where manage_by ='$user'";
                        $result = $conn->query($sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);
                          echo "<script>
                        alert('Update Successfully!');
                        window.location.href='storeform.php';
                        </script>";
                        
                         }
                         else{
                              echo "<script>
                        alert('Please fill out all the required fields!');
                        window.location.href='storeform.php';
                        </script>";
                         }
                       
      
  }    
   
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>FoodBytes</title>
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
            Welcome to UTRAQ! Maximize Your Shopping Plan With Us!
            </div>  
            </div>
              
                <div id='navigation'>
                    <div style='border-bottom:thin solid gray ;padding:13px;font-weight: bold;'>MAINTENANCE :</div><br>
                    
                    
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
                <?php
                                $sql2 = "select * from store where manage_by ='".$user."'";
                                $result2 = $conn->query($sql2) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);;
				while($row = $result2->fetch_assoc()) {
        
                                ?>
                 <fieldset style="width:1050px;height: 500px;border-radius: 10px;position:absolute;margin-top:20px;">
                     <legend>Store Information</legend>
                      <form method="post" action="storeform.php">
                     <label style="font-size: 15px;font-weight: bold">Store ID : <?php echo $row['store_id']; ?></label><br><br>
                     <label style="font-size: 15px;font-weight: bold">Name:</label> <input type="text" style ="width:900px;margin-left:34px; "   name="name" maxlength="200" value='<?php  echo  htmlspecialchars($row['store_name'],ENT_QUOTES) ; ?>'/>
                     <br><br>
                     <label style="font-size: 15px;font-weight: bold">Description:</label><br> <textarea  maxlength="1000" name="desc"  style="margin-left:75px;border-radius:5px;width:895px;height:80px;"><?php echo $row['store_desc']; ?></textarea>
                     <br>
                     <label style="font-size: 15px;font-weight: bold">Address:</label><br> <textarea  maxlength="1000" name="address"  style="margin-left:75px;border-radius:5px;width:895px;height:80px;"><?php echo $row['store_location']; ?></textarea>
                     <br><br>
                     <label style="font-size: 15px;font-weight: bold">Open:</label><input type="text" name="open" maxlength="50" value='<?php echo $row['store_open']; ?>'  style ="width:200px;margin-left: 38px; " />
                     <br>
                     <br>
                     <label style="font-size: 15px;font-weight: bold">Closed:</label><input type="text" name="closed" maxlength="50" value='<?php echo $row['store_closed']; ?>' style ="width:200px;margin-left: 28px; " />
                     
                     <br><br>
                    
                     <input type ="submit" value="Update Store" name="update" id ="btnall" style="width: 200px;height: 40px;margin-left:73px;">
                     </form>
                     </fieldset>
				
                                
                                
                                
                                <?php
                               }
				
    
                                $conn->close();

			?>
                                               
             </div>
         </div>
        
    </body>
    
    
</html>