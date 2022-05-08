<?php
    //creating connection
    $conn = mysqli_connect('localhost','root','','stdinfo');
    // //checking connection
    // if($conn){
    //     echo "Connection Established";
    // }

    //if click on button take filed value & insert to db
    if(isset($_POST['btn'])){
        //finding input filed value into variable
        $stdname = $_POST['stdname'];
        $stdreg = $_POST['stdreg'];

        //if stdname & stdreg field not empty perform insert operation
        if(!empty($stdname) && !empty($stdreg)){
            //sql query // stdname string that's why keeping like string/text
            $query = "INSERT INTO student(stdname,stdreg) VALUE('$stdname',$stdreg)";

            //sending data to database
            $createQuery = mysqli_query($conn, $query);
            if($createQuery){
              echo "Data successfully inserted.";
            }
        }
        else{
            echo "Field Should not be empty";
        }
    }
?>

<!-- code for delete  -->
<?php
  //if click on delete
  if(isset($_GET['delete'])){
    $stdid = $_GET['delete']; //keeping the delete id in stdid
    $query = "DELETE FROM student WHERE id={$stdid}";
    $deleteQuery = mysqli_query($conn, $query);
    if($deleteQuery){
      echo "Data successfully deleted";
    }
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>PHP CRUD!</title>
  </head>
  <body>
    <div class="container shadow m-5 p-4 mx-auto rounded">
        <form method="post" class="d-flex justify-content-around">
            <input class="form-control me-3" type="text" name="stdname" placeholder="Enter Name">
            <input class="form-control me-3" type="number" name="stdreg" placeholder="Enter Reg Number">
            <input class="btn btn-success" type="submit" value="Submit" name="btn">
        </form>
    </div>

    <div class="container  m-5 p-3 mx-auto">
        <form method="post" class="d-flex justify-content-around">
            <?php
              if(isset($_GET['update'])){ //if click on update button
                $stdid = $_GET['update']; //geting update id from search query
                $query = "SELECT * FROM student WHERE id={$stdid}";
                $getData = mysqli_query($conn, $query); //getting data based on query

                while($rx=mysqli_fetch_assoc($getData)){ //keep data rx variable afte fetch
                  $stdid = $rx['id'];
                  $stdname = $rx['stdname'];
                  $stdreg = $rx['stdreg'];
               
            ?>
            <input class="form-control me-3" type="text" name="stdname" value="<?php echo $stdname ?>" >
            <input class="form-control me-3" type="number" name="stdreg" value="<?php echo $stdreg ?>">
            <input class="btn btn-primary" type="submit" value="Update" name="update-btn">
            <?php 
                } //closing previous php while/if backet
              } ?>

              <?php
                if(isset($_POST['update-btn'])){
                  $stdname = $_POST['stdname'];
                  $stdreg = $_POST['stdreg'];

                 if(!empty($stdname) && !empty($stdreg)){
                  $query = "UPDATE student SET stdname='$stdname', stdreg=$stdreg WHERE id=$stdid";
                  $updateQuery = mysqli_query($conn, $query);
                  // if($updateQuery){
                  //   echo "Data Updated successful";
                  // }
                 }

                }
              ?>
        </form>
    </div>

    <div class="container">
      <table class="table table-bordered">
       <tr>
         <th>STD ID</th>
         <th>STD NAME</th>
         <th>Reg No</th>
         <th></th>
         <th></th>
       </tr>
       
       <?php
       //select all query
        $query = "SELECT * FROM student";
        //reading data from databse
        $readQuery = mysqli_query($conn, $query);
        // if table has more than 0 row then it will read data
        if($readQuery->num_rows >0){
          // if tables row > 0 read data from db and store the data into rd variable
          while($rd=mysqli_fetch_assoc($readQuery)){
            //'id' is the table column name which col will be read
            $stdid = $rd['id']; // keeping data from db table to variable
            $stdname = $rd['stdname'];
            $stdreg = $rd['stdreg'];
          
       ?>
       <tr>
         <td><?php echo"$stdid" ?></td>
         <td><?php echo"$stdname" ?></td>
         <td><?php echo"$stdreg" ?></td>
         <td><a href="index.php?update=<?php echo"$stdid" ?>" class="btn btn-info">Update</a></td>
         <!-- passing query parameter id for perform delete while click on delete btn -->
         <td><a href="index.php?delete=<?php echo"$stdid" ?>" class="btn btn-danger">Delete</a></td>
       </tr>
       <?php
          }
        }
        else{
          echo "No data to show";
        }
       
       ?>
        <!-- closing whitle & if php backet after using html -->
      </table>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>