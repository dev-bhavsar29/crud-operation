<?php
    include('db.php');
?>

<?php
     $datastate1 = "select * from state where country_id='".$_POST['state_id']."'";
     $result_state1 = $con->query($datastate1);    
?>
<select name="state">
            <?php while($row31 = $result_state1->fetch_assoc()){ ?>
                <option  value="<?php echo $row31['id']; ?>"><?php echo $row31['name'];?></option>
                <?php } ?>
                
              </select>