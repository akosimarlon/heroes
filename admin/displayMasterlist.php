
<?php
    include('authentication.php');
      
?>

<?php
    $query = "SELECT *, count(emp_no) FROM masterlist GROUP BY emp_no HAVING count(emp_no) > 1";
    
    $query_run = mysqli_query($con,$query);

    if(mysqli_num_rows($query_run) > 0){
        foreach($query_run as $row){
        ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['emp_no'] ?></td>
                <td><?= $row['fname'] ?></td>
                <td><?= $row['lname'] ?></td>
                <td><?= $row['email'] ?></td>                                                
                <td>
                <?php
                    if($row['status']=='1'){
                        echo '<span style="color:blue;">Active</span>';
                    }
                    elseif($row['status']=='0'){
                        echo '<span style="color:red;">Inactive</span>';
                    }
                ?>
                </td>
                <input type="hidden" id="ufname<?=$row['id']?>" value="<?=$row['fname']?>">
                <input type="hidden" id="ulname<?=$row['id']?>" value="<?=$row['lname']?>">                                                
                <input type="hidden" id="uemail<?=$row['id']?>" value="<?=$row['email']?>">
                <input type="hidden" id="ustatus<?=$row['id']?>" value="<?=$row['status']?>">

                
                <td><button type="button" name="btn_admin_edit" class="btn btn-success btn-sm editbtn" value="<?=$row['id']?>"><i class="far fa-edit"></i> Edit</button></td>
                <td><button type="button" name="btn_user_delete" value="<?=$row['id']?>" class="btn btn-danger btn-sm delete" data-toggle="modal" data-target="#confirmModal"><i class="fa fa-trash"></i> Delete</button></td>
            </tr>
        <?php
        }
    }
    else{
        ?>
            <tr>
                <td colspan="6">No Records Found.</td>
            </tr>
        <?php
    }

?>