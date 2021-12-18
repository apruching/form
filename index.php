<?php
session_start();
require_once("header.php");
?>

<div class="container">
    <div class="row">
        <div class="col-lg-6 m-auto mt-3">
            <div class="card">
                <div class="card-body">
                    <?php
                    if (isset($_SESSION['err_msg'])) {
                    ?>
                        <div class="alert alert-danger" role="alert">
                            <!-- invalid form alert -->
                            <?php
                            echo $_SESSION['err_msg'];
                            unset($_SESSION['err_msg']);
                            ?>
                        </div>
                    <?php
                    }
                    ?>


                    <?php
                    if (isset($_SESSION['success_msg'])) {
                    ?>
                        <div class="alert alert-success" role="alert">
                            <!-- invalid form alert -->
                            <?php
                            echo $_SESSION['success_msg'];
                            unset($_SESSION['success_msg']);
                            ?>
                        </div>
                    <?php
                    }
                    ?>

                    <form action="result.php" method="post">
                        <h3>Register Form</h3>
                        <label for="">
                            Full Name:
                            <input type="text" placeholder="Enter your name" name="user_name">
                        </label>
                        <label for="">Email:
                            <input type="text" placeholder="Enter your email" name="email">
                        </label>
                        <label for="">Phone:
                            <input type="text" placeholder="Enter your number" name="phone">
                        </label>
                        <label for="">Password:
                            <input type="password" placeholder="Enter your password" name="password">
                        </label>
                        <button type="submit">Submit</button>
                        <button type="reset">Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>