<?php include('Header_Footer_mainpage/HFM_menu.php'); ?>

    <?php
        if(isset($_GET['food_id']))
        {
            $food_id = $_GET['food_id'];
            $sql = "SELECT*FROM tbl_food WHERE id=$food_id";

            $res = mysqli_query($conn,$sql);

            $count = mysqli_num_rows($res);

            if($count==1)
            {
                $row = mysqli_fetch_assoc($res);

                $title=$row['title'];
                $price = $row['price'];
                $img_name = $row['img_name'];
            }
            else
            {
                header('location:'.SITE_URL);
            }
        }
        else
        {
            header('location:'.SITE_URL);
        }
    ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php
                            if($img_name=="")
                            {
                                echo "<div class='fail'>Image Not Available</div>";
                            }
                             else
                            {
                                ?>
                                    <img src="<?php echo SITE_URL; ?>images/food/<?php echo $img_name  ?>" alt="" class="img-resposive img-curve food-menu-img-refix">
                                <?php
                            } 
                            ?>
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title ?>">

                        <p class="food-price"><?php echo $price; ?>VND</p>
                        <input type="hidden" name="price" value="<?php echo $price ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="Full name" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="Phone number" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="Email Address" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="Home Address" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php  
                if(isset($_POST['submit']))
                {
                    $food = $_POST['food'];
                    $price = $_POST['price'];
                    $quantity = $_POST['qty'];

                    $total = $price * $quantity;

                    $order_date = date("Y-m-d h:i:sa"); //order date

                    $status = "Ordered";

                    $customer_name=$_POST['full-name'];
                    $customer_contact = $_POST['contact'];
                    $customer_email = $_POST['email'];
                    $customer_address = $_POST['address'];

                    $sql3 = "INSERT INTO tbl_order SET
                    food='$food',
                    price=$price,
                    quantity=$quantity,
                    total=$total,
                    order_date='$order_date',
                    status = '$status',
                    customer_name='$customer_name',
                    customer_contact='$customer_contact',
                    customer_email='$customer_email',
                    customer_address='$customer_address'
                    ";

                    $res3 = mysqli_query($conn,$sql3);

                    if($res3==TRUE)
                    {
                        $_SESSION['order']="<div class='success text_center'>Food Order Success</div>";
                        header('location:'.SITE_URL);
                    }
                    else
                    {
                        $_SESSION['order']="<div class='fail text_center'>Food Order Fail</div>";
                        header('location:'.SITE_URL);
                    }
                }
                else
                {

                }
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

<?php include('Header_Footer_mainpage/HFM_footer.php'); ?>