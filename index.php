<?php
    $servername = "localhost";
    $username ="root";
    $pwd = "";
    $db = "formsubmit";

    $con = mysqli_connect($servername,$username,$pwd,$db);

    if($con){
        //echo "connection successful<br>";
    }
    else
    {
        //echo "connection cannot successful<br>";
    }

    if(isset($_POST['save'])){

        $email = '';
        @$a = $_POST['name'];
        @$b = $_POST['phoneno'];
        @$email = $_POST['email'];
        @$d = $_POST['address'];
        @$e = $_POST['country'];
        @$f = $_POST['state'];
        @$g = $_POST['city'];
    
    

        $ins = "insert into formdata (name,phoneno,email,address,country,state,city) values('$a','$b','$email','$d','$e','$f','$g')";
        
        if(mysqli_query($con,$ins))
        {
            echo "data inserted successfully<br>";
        }
        else
        {
            echo "data cannot inserted successfully<br>";
        }
}

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
            <input type="text" class="form-control" style="width:250px;" name="name" id="name" >
            
        </div>
        <div class="mb-3">
            <label class="form-label">Phone No:</label>
            <input type="number" class="form-control" style="width:250px;" name="phoneno" id="phoneno">
        </div>
        <div class="mb-3">
            <label class="form-label">Email:</label>
            <input type="email" class="form-control" style="width:250px;" name="email" id="email">
        </div>
        <div class="mb-3">
            <label class="form-label">Address:</label><br>
            <textarea name="address" cols="30" rows="1" id="address"></textarea>
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
                <option value="<?php echo $row2['id']; ?>"><?php echo $row2['name']; ?>
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
                <option  value="<?php echo $row3['id']; ?>"><?php echo $row3['name'];?></option>
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
                <option  value="<?php echo $row4['id']; ?>"><?php echo $row4['name']; ?></option>
                <?php } ?>
                
              </select>
            
        </div>

        <button type="submit" name="save" class="btn btn-primary" onclick="return check_validation();">Submit</button>
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
<script>
    function check_validation(){
        var name = $('#name').val();
        if(name == ''){
            alert('enter name');
            return false;
        }

        var phoneno = $('#phoneno').val();
        if(phoneno == ''){
            alert('enter phoneno');
            return false;
        }

        var email = $('#email').val();
        if(email == ''){
            alert('enter email');
            return false;
        }

        var address = $('#address').val();
        if(address == ''){
            alert('enter address');
            return false;
        }
    }
</script>


</body>


</html>