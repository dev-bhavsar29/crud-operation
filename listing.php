<?php
include('db.php');
?>

<?php
    if(isset($_GET['deleteid']))
    {
        $id=$_GET['deleteid'];

        $sql="delete from formdata where id=$id";
        $result=mysqli_query($con,$sql);
        if($result)
        {
            echo "deleted successfully";
            
        }
        else{
            echo "cannot deleted successfully";
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
<div class="container">
   
    <table class="table">
    <thead>
        <tr>
        <th scope="col">id</th>
        <th scope="col">name</th>
        <th scope="col">phoneno</th>
        <th scope="col">email</th>
        <th scope="col">address</th>
        <th scope="col">country</th>
        <th scope="col">state</th>
        <th scope="col">city</th>
        </tr>
    </thead>
    <tbody>
    
        <?php 
        $data = "select * from formdata";
        // FETCHING DATA FROM DATABASE
        $result = $con->query($data);
        
        if ($result->num_rows > 0) 
        {
            // OUTPUT DATA OF EACH ROW
            while($row = $result->fetch_assoc())
            {
                $id=$row['id'];
                $name=$row['name'];
                $phoneno=$row['phoneno'];
                $email=$row['email'];
                $address=$row['address'];
                $country=$row['country'];
                $state=$row['state'];
                $city=$row['city'];
                echo '<tr>
                <td>'.$id.'</td>
                <td>'.$name.'</td>
                <td>'.$phoneno.'</td>
                <td>'.$email.'</td>
                <td>'.$address.'</td>
                <td>'.$country.'</td>
                <td>'.$state.'</td>
                <td>'.$city.'</td>
                <td><button class="btn btn-danger" name="delete"><a href="listing.php?deleteid='.$id.'" class="text-light" style="text-decoration:none;">DELETE</a></button>
                <td><button class="btn btn-success" name="edit"><a href="update.php?updateid='.$id.'" class="text-light" style="text-decoration:none;">EDIT</a></button>
                </tr>';
            }
        } 
        else {
            echo "0 results";
        }

            
        ?>
</tbody>
</table>
    
</body>
</html>
