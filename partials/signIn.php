<?php include('header.php')?>

<!-- register section design -->
<section class="contact" id="register">
        <h2 class="heading">Sign <span>in</span></h2>
        <?php
        if(isset($_POST['login'])){
            $email = $_POST['email'];
            $password = $_POST['password'];
            require_once('database.php');
            $sql="SELECT * FROM users WHERE email ='$email'";
            $result=mysqli_query($conn,$sql);
            $user=mysqli_fetch_array($result,MYSQLI_ASSOC);
            if($user){
                $password_hash=hash('sha512',$password);
                
                if($password_hash === $user["password"]){
                    header("Location: index.php");
                    die();
                }
                else{
                    echo "<div class='alert alert-danger'>Password is not correct</div>";
                }
            }
            else{
                echo "<div class='alert alert-danger'>Email is not correct</div>";
            }
        }
        ?>
        <form action="signIn.php" class="sign-in-from" method="post">
            <div class="input-box" id="box-input">
                <input type="email" name="email" placeholder="Email Address" >    
            </div>
            <div class="input-box" id="box-input">
                <input type="password" name="password" placeholder="Password" >
            </div>
            <input type="submit" name="login" value="Login" class="btn">
        </form>
</section>

<?php include('footer.php')?>