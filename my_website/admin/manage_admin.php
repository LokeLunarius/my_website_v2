<?php include('Header_Footer/menu.php'); ?>

        <!-- Main Content Section Begin -->
        <div class="main_content">
            <div class="wrapper">
                <!-- <h1>Manage Admin</h1> -->
                
                <!-- <br /><br /> -->
                
                <?php 
                    if(isset($_SESSION['add'])) //check message
                    {
                        echo $_SESSION['add'];  //display message
                        unset($_SESSION['add']); //remove message
                    }
                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                    if(isset($_SESSION['user_not_found']))
                    {
                        echo $_SESSION['user_not_found'];
                        unset($_SESSION['user_not_found']);
                    }
                    if(isset($_SESSION['pw_change']))
                    {
                        echo $_SESSION['pw_change'];
                        unset($_SESSION['pw_change']);
                    }
                ?>

                <!-- <br /><br /><br /> -->

                <!-- Add Admin Button -->
                <!-- <a href="<?php echo SITE_URL;?>admin/add_admin.php" class="button_primary">Add Admin</a>

                <br /><br /><br /><br />

                <table class="table_full">
                    <tr>
                        <th>Serial Number</th>
                        <th>Full Name</th>
                        <th>User Name</th>
                        <th>Actions</th>
                    </tr>

                    <?php 
                        // Query to get all Admin
                        $sql = "SELECT * FROM tbl_admin";
                        // Execute Query
                        $res = mysqli_query($conn,$sql) or  die(mysqli_error());

                        //Check
                        if($res==TRUE)
                        {
                            //Count Rows to check data in Database
                            $count = mysqli_num_rows($res);
                            $serial_number=1;

                            if($count>0)
                            {
                                while($rows=mysqli_fetch_assoc($res))
                                {
                                    $id=$rows['id'];
                                    $full_name=$rows['full_name'];
                                    $username=$rows['username'];

                                    //Display value to table
                                    ?>
                                        <tr>
                                            <td><?php echo $serial_number++ ?></td>
                                            <td><?php echo $full_name ?></td>
                                            <td><?php echo $username ?></td>
                                            <td>
                                                <a href="<?php echo SITE_URL; ?>admin/update_password.php?id=<?php echo $id; ?>" class="button_primary">Change Password</a>
                                                <a href="<?php echo SITE_URL; ?>admin/update_admin.php?id=<?php echo $id; ?>" class="button_secondary">Update Admin</a>
                                                <a href="<?php echo SITE_URL; ?>admin/remove_admin.php?id=<?php echo $id; ?>" class="button_danger">Remove Admin</a>
                                            </td>
                                        </tr>
                                    <?php
                                }
                            }
                        }
                    ?>
                </table> -->
                
                <br /><br /><br />
                <h1>Hashed Content</h1>
                <br /><br /><br />
                <!-- <a href="<?php //echo shell_exec("python -m scripts.check_content");?>" class="button_primary">Scan</a>  -->
                <a href="<?php echo SITE_URL;;?>py_activator.php" class="button_primary">Scan (still testing)</a> 
                <a href="<?php echo SITE_URL; ?>admin/remove_hash_all.php" class="button_primary">Delete</a> 
                <br /><br /><br />
 
                    <?php 
                        // Query to get all Admin
                        $sql = "SELECT * FROM tbl_hashed_web_content where result='changed'";
                        // Execute Query
                        $res = mysqli_query($conn,$sql) or  die(mysqli_error());

                        //Check
                        if($res==TRUE)
                        {
                            //Count Rows to check data in Database
                            $count = mysqli_num_rows($res);
                            $serial_number=1;

                            if($count>0)
                            {?> 
                                <table class="table_full">
                                <tr>
                                    <th>No.</th>
                                    <th>Path</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            
                            <?php 
                                while($rows=mysqli_fetch_assoc($res))
                                {
                                    $id = $rows['id'];
                                    $file_path=$rows['file_path'];
                                    $result=$rows['result'];

                                    //Display value to table
                                    ?>
                                        <tr>
                                            <td><?php echo $id ?></td>
                                            <td><?php echo $file_path ?></td>
                                            <td><?php echo $result ?></td>
                                            <td>
                                                <a href="<?php echo SITE_URL; ?>admin/remove_hash_one.php?id=<?php echo $id; ?>" class="button_danger">Accept change</a>
                                            </td>
                                        </tr>
                                    <?php
                                }
                                ?>
                                
                                        </table>
                                </div>
                                </div>
                             <?php
                            }else{
                                ?> Not found any changes recently
                                <br /><br /><br /><?php
                            }
                        }
                    ?>
        <!-- Main Content Section End -->

<?php include('Header_Footer/footer.php');?>