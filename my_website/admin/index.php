
<?php include('Header_Footer/menu.php'); ?>

        <!-- Main Content Section Begin -->
        <div class="main_content">
            <div class="wrapper">
                <h1>DASHBOARD</h1>
                <br><br>
                <?php 
                    if(isset($_SESSION['login'])) //check message
                    {
                        echo $_SESSION['login'];  //display message
                        unset($_SESSION['login']); //remove message
                    }
                ?>
                <br><br>
                <div class="col_4 text_center">
                    <h1>5</h1>
                    <br />
                    Catergories
                </div>
                <div class="col_4 text_center">
                    <h1>5</h1>
                    <br />
                    Catergories
                </div>
                <div class="col_4 text_center">
                    <h1>5</h1>
                    <br />
                    Catergories
                </div>
                <div class="col_4 text_center">
                    <h1>5</h1>
                    <br />
                    Catergories
                </div>

                <div class="clearfix"></div>
            </div>
        </div>
        <!-- Main Content Section End -->

<?php include('Header_Footer/footer.php');?>