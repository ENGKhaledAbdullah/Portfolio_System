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
        // print_r($user); 
        // exit;
        if(!empty($user)){
            $sql="SELECT * FROM user_info WHERE id ='".$user['id']."'";
            $result = mysqli_query($conn,$sql);
            $userInfo = mysqli_fetch_array($result,MYSQLI_ASSOC);
            // print_r($userInfo); 
            if(!empty($userInfo)){
                $sql="SELECT distinct name,img FROM user_info INNER JOIN user_skill ON ".$userInfo['id']."=user_skill.u_id INNER JOIN skills ON skills.id = user_skill.s_id ";
                $result = mysqli_query($conn,$sql);
                $skills = array();
                // while ($row = mysqli_fetch_array($result)) {
                while($userSkill = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                    $skills[] = $userSkill;
                }
                // print_r($skills);
                // exit;
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
                // exit;
            }
        }
    }
    
    require('header.php'); 
    ?>

    <!-- user-info section design -->
    <section class="home" id="home">
        <div class="home-content">
            <h3>Hello, I am</h3>
            <h1><?= $user['username']?></h1>
            <p> <?= $user['about_user']?></p>

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
            <img src="<?= $user['main_img']?>" alt="">
        </div>
    </section>

    <!-- about section design -->
    <section class="about" id="about">
        <div class="about-img">
            <img src="<?= $user['about_img']?>" alt="">
        </div>

        <div class="about-content">
            <h2 class="heading">About <span>Me</span></h2>
            <p><?= $user['about_user']?></p>
            <br>
            <a href="#" class="btn">Read More</a>
        </div>
    </section>

    <!-- skills section design -->
    <section class="services" id="services">
        <h2 class="heading">My <span>Skills</span></h2>

        <div class="services-container">
            <?php foreach ($skills as $skill): ?>
                <div class="services-box">
                    <img src="<?= $skill['img'] ?>" alt="">
                    <h3><?= $skill['name'] ?></h3>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- works section design -->
    <section class="portfolio" id="portfolio">
        <h2 class="heading">Latest <span>Projects</span></h2>

        <div class="portfolio-container">
            <?php foreach ($works as $work): ?>
                <div class="portfolio-box">
                    <img src="<?= $work['img'] ?>" alt="">

                    <div class="portfolio-layer">
                        <h4><?= $work['name'] ?></h4>
                        <p><?= $work['description'] ?></p>
                        <a href="<?= $work['url'] ?>"><i class='bx bx-link-external'></i></a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
<?php
    require('footer.php');
?>
