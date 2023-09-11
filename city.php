<?php
    include('db.php');
?>

<?php
    $datacity1 = "select * from city where state_id='".$_POST['city_id']."'";
    $result_city1 = $con->query($datacity1);
?>
<select name="city">
            <?php while($row41 = $result_city1->fetch_assoc()){ ?>
                <option  value="<?php echo $row41['id']; ?>"><?php echo $row41['name']; ?></option>
                <?php } ?>
                
              </select>