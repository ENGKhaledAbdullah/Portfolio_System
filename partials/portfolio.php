<?php 
    $username='';
    if (isset($_POST['username'])) {
        $username = $_POST['username'];
        // $fullname = $_POST['fullname'];
        // $email = $_POST['email'];
        // $jobName = $_POST['jobName'];
        // $education = $_POST['education'];
        // $about = $_POST['about'];
        // $hireState = $_POST['hireState'];
        // $selectedSkills = $_POST['selectedSkills'];
        // $projectName = $_POST['project-name'];
        // $projectDescription = $_POST['project-description'];
        // $projectURL = $_POST['project-url'];
        require_once('database.php');
        $sql="SELECT * FROM user_info WHERE username ='$username'";
        $result = mysqli_query($conn,$sql);
        $user = mysqli_fetch_array($result,MYSQLI_ASSOC);
        print_r($user); 
        exit;
        if(!empty($user)){
            $sql="SELECT * FROM user_info WHERE id ='".$user['id']."'";
            $result = mysqli_query($conn,$sql);
            $userInfo = mysqli_fetch_array($result,MYSQLI_ASSOC);
            // print_r($userInfo); 
            if(!empty($userInfo)){
                $sql="SELECT * FROM user_skill WHERE user_id ='".$userInfo['id']."'";
                $result = mysqli_query($conn,$sql);
                $skills = array();
                // while ($row = mysqli_fetch_array($result)) {
                while($userSkill = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                    $skills[] = $userSkill;
                }
                // print_r($skills);
            }
            if(!empty($userInfo)){
                $sql="SELECT * FROM works WHERE u_id ='".$userInfo['id']."'";
                $result = mysqli_query($conn,$sql);
                $works = array();
                // while ($row = mysqli_fetch_array($result)) {
                while($userWork = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                    $works[] = $userWork;
                }
                // print_r($works);
            }
        }
    }
    
    require('header.php'); 
    ?>
    <section class="home" id="home">
        <div class="home-content">
            <h3>Hello, I am</h3>
            <h1><?php echo $result['username']?></h1>
            <p> <?php echo $result['about_user']?></p>

            <div class="social-media">
                <a href="#"><i class='bx bxl-facebook'></i></a>
                <a href="#"><i class='bx bxl-twitter'></i></a>
                <a href="#"><i class='bx bxl-instagram-alt'></i></a>
                <a href="#"><i class='bx bxl-linkedin'></i></a>
            </div>

            <a href="#" class="btn">Download CV</a>
        </div>

        <div class="profession-container">
            <div class="profession-box">
                <div class="profession" style="--i:0;">
                    <i class='bx bx-code-alt'></i>
                    <h3>Web Developer</h3>
                </div>
                <div class="profession" style="--i:1;">
                    <i class='bx bx-pencil'></i>
                    <h3>Web Content Writer</h3>
                </div>
                <div class="profession" style="--i:2;">
                    <i class='bx bx-palette'></i>
                    <h3>Web Designer</h3>
                </div>
                <div class="profession" style="--i:3;">
                    <i class='bx bx-search'></i>
                    <h3>UI/UX Tester</h3>
                </div>

                <div class="circle"></div>
            </div>

            <div class="overlay"></div>
        </div>

        <div class="home-img">
            <img src="images/home.png" alt="">
        </div>
    </section>

<?php
    require('footer.php');
?>
