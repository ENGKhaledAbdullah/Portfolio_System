<?php include('header.php')?>
<!-- register section design -->
<section class="contact" id="register">
        <h2 class="heading">Register <span>Now!</span></h2>
        <?php
        if (isset($_POST['submit'])){
            $full_name = $_POST['fullname'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            $password2 = $_POST['password-repeat'];
            $password_hash=hash('sha512',$password);

            $error=array();
            if(empty($email) || empty($password) || empty($password2) || empty($email)){
                array_push($error,'All field are required');
                
            }
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                array_push($error,'Email is not valid');
            }
            if(strlen($password) < 8){
                array_push($error,'Password must be at least 8 characters long');
            }
            if($password != $password2){
                array_push($error,'Password does not match');
            }
            require_once('database.php');
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = $conn->query($sql);
            $rowCount = $result->num_rows;
            if($rowCount > 0){
                array_push($error,"Email is already exist!");
            }
            if(count($error) > 0){
                foreach($error as $msg){
                    echo '<div class="alert alert-danger">'.$msg.'</div>';
                }
            }
            else{
                require_once('database.php');
                $sql = "INSERT INTO users (user_name,email,password) VALUES ( ? , ? , ? )";
                $stmt = mysqli_stmt_init($conn);
                $prepareStmt= mysqli_stmt_prepare($stmt,$sql);
                if($prepareStmt){
                    mysqli_stmt_bind_param($stmt,"sss",$full_name, $email,$password_hash);
                    mysqli_stmt_execute($stmt);
                    echo '<div class="alert alert-success">You are successfully registered.</div>';
                    sleep(3);
                    header('Location: signIn.php');
                    
                }
                else{
                    die('something went wrong inserting new user');
                }   
            }
        }
        ?>
        <form action="register.php" method="post">
            <div class="input-box">
                <input type="text" name="fullname" placeholder="Full Name" >
                <input type="password" name="password" placeholder="Password" >
                <input type="password" name="password-repeat" placeholder="repeat password" >
            </div>
            <div class="input-box">
                <input type="email" name="email" placeholder="Email Address" >
            </div>
            <input type="submit" name="submit" value="Register" class="btn">
        </form>
</section>
<?php include('footer.php')?>    