<?php include('Header_Footer/menu.php'); ?>

        <!-- Main Content Section Begin -->
        <div class="main_content">
            <div class="wrapper">
                <h1>Manage Order</h1>

                <br /><br /><br />

                <table class="table_full text_fix">
                    <tr>
                        <th>Serial Number</th>
                        <th>Food</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Customer Name</th>
                        <th>Customer Contact</th>
                        <th>Customer Email</th>
                        <th>Customer Address</th>
                        <th>Actions</th>
                    </tr>

                    <?php 
                        // Query to get all Admin
                        $sql = "SELECT * FROM tbl_order ORDER BY id DESC";
                        // Execute Query
                        $res = mysqli_query($conn,$sql);

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
                                    $food=$rows['food'];
                                    $price=$rows['price'];
                                    $quantity=$rows['quantity'];
                                    $total=$rows['total'];
                                    $order_date=$rows['order_date'];
                                    $status = $rows['status'];
                                    $customer_name=$rows['customer_name'];
                                    $customer_contact=$rows['customer_contact'];
                                    $customer_email=$rows['customer_email'];
                                    $customer_address=$rows['customer_address'];

                                    //Display value to table
                                    ?>
                                         <tr>
                                            <td><?php echo $serial_number++ ?></td>
                                            <td><?php echo $food ?></td>
                                            <td><?php echo $price ?></td>
                                            <td><?php echo $quantity ?></td>
                                            <td><?php echo $total ?></td>
                                            <td><?php echo $order_date ?></td>
                                            <td><?php echo $status ?></td>

                                            <td><?php echo $customer_name ?></td>
                                            <td><?php echo $customer_contact ?></td>
                                            <td><?php echo $customer_email ?></td>
                                            <td><?php echo $customer_address ?></td>

                                            <td>
                                                <a href="<?php echo SITE_URL; ?>admin/update_food.php?id=<?php echo $id; ?>" class="button_secondary">Update Order</a>
                                                <br><br>
                                                <a href="<?php echo SITE_URL; ?>admin/remove_food.php?id=<?php echo $id; ?>&img_name=<?php echo $img_name?>" class="button_danger">Remove Order</a>
                                            </td>
                                        </tr>
                                    <?php
                                }
                            }
                        }
                    ?>
                </table>
            </div>
        </div>
        <!-- Main Content Section End -->

<?php include('Header_Footer/footer.php');?>