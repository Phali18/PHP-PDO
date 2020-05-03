<!DOCTYPE html>
<?php session_start(); ?>

<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Library Registration Form</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    </head>
    <body>
        <?php
        $dsn = "mysql:host=127.0.0.1;dbname=finalversion_database";
        $user = "root";
        $password = NULL;
        $options = NULL;
        $message = "";

        try {

            $pdo = new PDO($dsn, $user, $password, $options);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            if (empty($_POST["username"]) || empty($_POST["password"])) {

                $message = '<label>All fields are required</label>';
            } else {

                $stmt = $pdo->prepare("INSERT INTO membership (firstname, lastname, DoB, email, username, password) VALUES (:firstname, :lastname,:DoB, :email ,:username, :password)");
                $stmt->bindParam(":firstname", $firstname);
                $stmt->bindParam(":lastname", $lastname);
                $stmt->bindParam(":DoB", $DoB);
                $stmt->bindParam(":email", $email);
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':password', $password);


                $firstname = "Melissa";
                $lastname = "Williams";
                $DoB = "1970-07-01";
                $email = "melissahere@hotmail.com";
                $username = "melw100";
                $password = "foreveryoung";
                $stmt->execute();


                $count = $stmt->rowCount();

                if ($count > 0) {

                    $_SESSION["username"] = $_POST["username"];
                    header("location: signup_success.php");
                } else {

                    $message = '<label>Please enter the required details</label>';
                }
            }
        } catch (Exception $e) {
            $message = $e->getMessage();
        }
        ?>

        <h3 align="center">Library Registration Form</h3><br/>



        <div class="container">
            <div class ="col-xm-6">  
                <form action="" method="POST">

                    <div class="form-group">
                        <label for="firstname">First name</label>
                        <input type="text" name="firstname" class="form-control" id="inputlg" required>

                        <div class="form-group">
                            <label for="lastname">Last name</label>
                            <input type="text" name="lastname" class="form-control" id="inputlg" required> 
                        </div>
                        <div class="form-group">
                            <label for="DoB">Date of Birth</label>
                            <input type="date" name="DoB" class="form-control" id="inputlg" required> 
                        </div>
                        <div class="form-group">
                            <label for="Email">Email</label>
                            <input type="email" name="email" class="form-control" id="inputlg" required> 
                        </div>
                        <div class="form-group">
                            <label for="userame">Username</label>
                            <input type="text" name="username" class="form-control" id="inputlg" required> 
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="inputlg" required> 
                        </div>


                        <input  class="btn btn-primary" type="submit" name="submit" value="Submit">
                        </form>
                        <br>
                        <br>

                        <?php
                        if (isset($message)) {
                            echo '<label class="text-danger">' . $message . '</label>';
                        }
                        ?>



                    </div>
            </div>
        </div>       
    </body>
</html>
