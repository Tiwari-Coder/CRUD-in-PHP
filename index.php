<?php
/*Include model.php here*/
include 'model.php';

$obj = new Model();

 /*Insert Record */
if(isset($_POST['submit'])){
    $obj->insertRecord($_POST);
}//if isset close

/*Update Record */
if(isset($_POST['update'])){
    $obj->updateRecord($_POST);
}//if isset close

/*Delete Record*/
if(isset($_GET['deleteid'])){
    $delid=$_GET['deleteid'];
    $obj->deleteRecord($delid);
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>oops project with CRUD operation</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <!-- jQuery library -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script> 
</head>
<body><br>
    <h1 class="text-center text-info">CRUD Operation in PHP Using OOPS </h1><br>
    <div class="container">
        <!--Success message-->
         <?php
        if(isset($_GET['msg']) AND $_GET['msg']=='ins'){
            echo '<div class="alert alert-primary" role="alert">
            Record Inserted Successfully..!!
          </div>';
        }
         
        if(isset($_GET['msg']) AND $_GET['msg']=='ups'){
            echo '<div class="alert alert-primary" role="alert">
            Record Updated Successfully..!!
          </div>';
        }

        if(isset($_GET['msg']) AND $_GET['msg']=='del'){
            echo '<div class="alert alert-primary" role="alert">
            Record Deleted Successfully..!!
          </div>';
        }

        ?>

        <?php
        /*fatch record for updation*/
        if(isset($_GET['editid'])){
          $editid=$_GET['editid'];
          $myrecord=$obj->displayRecordById($editid);
        
        ?>
        <!--Update form-->
          <form action="index.php" method="post">
            <div class="form-group"> 
                <level>Name</level> 
                <input type="text" name="name" value="<?php echo $myrecord['name']; ?>"placeholder="Enter your name" class="form-control">
            </div>
            <div class="form-group"> 
                <level>Email</level> 
                <input type="text" name="email" value="<?php echo $myrecord['email']; ?>"placeholder="Enter your mail id" class="form-control">
            </div>
            <div class="form-group"> 
            <input type="hidden" name="hid" value="<?php echo $myrecord['id']; ?>">       
            <input type="submit" name="update" value="Update" class="btn btn-info">  
            </div>
          </form>
        <?php
           }else{ 
        ?>
       
        <form action="index.php" method="post">
            <div class="form-group"> 
                <level>Name</level> 
                <input type="text" name="name"  placeholder="Enter your name" class="form-control">
            </div>
            <div class="form-group"> 
                <level>Email</level> 
                <input type="text" name="email" placeholder="Enter your mail id" class="form-control">
            </div>
            <div class="form-group">    
            <input type="submit" name="submit" value="submit" class="btn btn-info">  
            </div>
        </form>
        <?php }//else close?>
        <br>
        <h4 class="text-center text-danger">Display Records</h4>
        <table class="table table-bordered">
            <tr class="bg-primary text-center">
                <th>S.No.</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            <?php
            /*Display record */
            $data=$obj->displayRecord();
            $sno=1;
            foreach($data as $value){
             ?>
             <tr class="text-center">
                <td><?php echo $sno++; ?></td>
                <td><?php echo $value['name']; ?></td>
                <td><?php echo $value['email']; ?></td>
                <td>
                    <a href="index.php?editid=<?php echo $value['id']; ?>" class="btn btn-info">Edit</a>
                    <a href="index.php?deleteid=<?php echo $value['id']; ?>" class="btn btn-danger">Delete</a>
                </td>
             </tr>
             
             <?php

            }//foreach close
            
            ?>
        </table>
    </div>
</body>
</html>