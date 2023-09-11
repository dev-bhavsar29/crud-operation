<?php
include('db.php');
?>

<?php
   
    
    if(isset($_POST['update']))
    {
        $id = $_GET['updateid'];
        $name = $_POST['name'];
        $phoneno = $_POST['phoneno'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $country = $_POST['country'];
        $state = $_POST['state'];
        $city = $_POST['city'];

        $sql = "update formdata set name='$name', phoneno='$phoneno', email='$email' , address='$address' , country='$country' , state='$state' , city='$city' where id=$id";
        $result=mysqli_query($con,$sql);
        if($result)
        {
            header('location:listing.php');
        }
        else
        {
            echo "data cannot updated successfully";
        }
    }

    $data = "select * from formdata where id=".$_GET['updateid']."";
        // FETCHING DATA FROM DATABASE
        $result = $con->query($data);
        $row = $result->fetch_row();

        // echo '<pre>';
        // print_r($row);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<center>
    <form action="" method="post">
        <div class="mb-3">
            <label class="form-label mt-5">Name:</label>
            <input type="text" class="form-control" style="width:250px;" name="name" id="name" value="<?php echo $row[1]; ?>">
            
        </div>
        <div class="mb-3">
            <label class="form-label">Phone No:</label>
            <input type="number" class="form-control" style="width:250px;" name="phoneno" id="phoneno" value="<?php echo $row[2]; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Email:</label>
            <input type="email" class="form-control" style="width:250px;" name="email" id="email" value="<?php echo $row[3]; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Address:</label><br>
            <textarea name="address" cols="30" rows="1" id ="address"><?php echo $row[4]; ?></textarea>
        </div>
        <?php
        $datacounty = "select * from country";
        // FETCHING DATA FROM DATABASE
        $result_county = $con->query($datacounty);
        ?>
        <div class="mb-3">
            <label class="form-label">Select Country:</label>
            <select  name="country" id="country" onchange="check_state(this);">
           <?php  while($row2 = $result_county->fetch_assoc()){ ?>
                <option <?php if($row[5] == $row2['name']){ ?> selected <?php } ?> value="<?php echo $row2['id']; ?>"><?php echo $row2['name']; ?>
                </option>
                <?php } ?>
                
              </select>
            
        </div>

        <?php
        $datastate = "select * from state";
        // FETCHING DATA FROM DATABASE
        $result_state = $con->query($datastate);
        ?>
        <div class="mb-3">
            <label class="form-label">Select State:</label>
            <select name="state" id="state" onchange="check_city(this);">
            <?php while($row3 = $result_state->fetch_assoc()){ ?>
                <option <?php if($row[6] == $row3['name']){ ?> selected <?php } ?> value="<?php echo $row3['id']; ?>"><?php echo $row3['name'];?></option>
                <?php } ?>
                
              </select>
            
        </div>

        <?php
        $datacity = "select * from city";
        // FETCHING DATA FROM DATABASE
        $result_city = $con->query($datacity);
        ?>
        <div class="mb-3">
            <label class="form-label">Select City:</label>
            <select name="city" id="city">
            <?php while($row4 = $result_city->fetch_assoc()){ ?>
                <option <?php if($row[7] == $row4['name']){ ?> selected <?php } ?> value="<?php echo $row4['name']; ?>"><?php echo $row4['name']; ?></option>
                <?php } ?>
                
              </select>
            
        </div>
        
      
                
        <button type="submit" name="update" class="btn btn-primary">Update</button>
    </form>
</center>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<script>
    function check_state(id){
        var value = id.value;
        $.ajax({
            url: "state.php",
            type: 'POST',
            data: { state_id: value} ,
            success: function (response) {
                $('#state').html(response);
            },
            error: function () {
                alert("error");
            }
        }); 
    }

    function check_city(ss){
        var value = ss.value;
        $.ajax({
            url: "city.php",
            type:"POST",
            data:{ city_id: value},
            success: function (response) {
                $('#city').html(response);
            },
            error: function(){
                alert("error");
            }
        });
    }
</script>

</body>
</html>