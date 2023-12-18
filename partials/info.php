<?php require('header.php');

?>

<!-- info section design -->
<section class="contact" id="info">
        <h2 class="heading">enter your  <span>Info</span></h2>
        <?php
            if (isset($_POST['submit'])) {
                $fullname = $_POST['username'];
                $email = $_POST['email'];
                $jobName = $_POST['job_name'];
                $education = $_POST['education'];
                $about = $_POST['about_user'];
                $employment = $_POST['employment'];
                $selectedSkills = $_POST['selectedSkills'];
                $projectName = $_POST['name'];
                $projectDescription = $_POST['description'];
                $projectURL = $_POST['url'];

                $error = array();
                if (empty($fullname) || empty($email) || empty($jobName) || empty($education) || empty($about) || empty($employment) || empty($selectedSkills)) {
                    array_push($error, 'All fields are required');
                }
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    array_push($error, 'Email is not valid');
                }
                if (count($error) > 0) {
                    foreach ($error as $msg) {
                        echo '<div class="alert alert-danger">' . $msg . '</div>';
                    }
                } else {
                    require_once('database.php');

                    // Insert user_info data into users_info table
                    $insertUserInfoQuery = "INSERT INTO user_info (user_info_name, user_info_email, job_name, about_user, education, employment) VALUES (?, ?, ?, ?, ?, ?)";
                    $stmt = mysqli_stmt_init($conn);
                    $prepareStmt = mysqli_stmt_prepare($stmt, $insertUserInfoQuery);
                    if ($prepareStmt) {
                        mysqli_stmt_bind_param($stmt, "ssssss", $fullname, $email, $jobName, $about, $education, $employment);
                        mysqli_stmt_execute($stmt);

                        $userId = mysqli_insert_id($conn); // Retrieve the auto-generated user_id
                        // print_r($selectedSkills); exit;
                        // Insert selected skills into user_skills table
                        foreach ($selectedSkills as $selectedSkill) {
                            // Extract the skill ID from the value
                            $skillId = explode(' ', $selectedSkill)[0];

                            // Insert the skill_id and user_id into the user_skills table
                            $insertUserSkillsQuery = "INSERT INTO user_skill (skill_id, user_id) VALUES (?, ?)";
                            $stmt = mysqli_stmt_init($conn);
                            $prepareStmt = mysqli_stmt_prepare($stmt, $insertUserSkillsQuery);
                            if ($prepareStmt) {
                                mysqli_stmt_bind_param($stmt, "ii", $skillId, $userId);
                                mysqli_stmt_execute($stmt);
                            } else {
                                die('Something went wrong inserting user skills');
                            }
                        }

                        // Insert project data into works table
                        $insertWorksQuery = "INSERT INTO works (name, description, url,u_id) VALUES (?, ?, ?,?)";
                        $stmt = mysqli_stmt_init($conn);
                        $prepareStmt = mysqli_stmt_prepare($stmt, $insertWorksQuery);
                        if ($prepareStmt) {
                            mysqli_stmt_bind_param($stmt, "ssss", $projectName, $projectDescription, $projectURL,$userId);
                            mysqli_stmt_execute($stmt);
                            echo '<div class="alert alert-success">You have successfully added info.</div>';
                        } else {
                            die('Something went wrong inserting new project');
                        }
                    } else {
                        die('Something went wrong inserting new user');
                    }
                }
            }
            ?>
        <form action="info.php" method="post" id="info-form" enctype="multipart/form-data">
            <div class="input-box">
                <input type="text" name="fullname" placeholder="Full Name" >
                <input type="email" name="email" placeholder="Email Address" >
                <input type="text" name="jobName" placeholder="Job Name" >
                <input type="text" name="education" placeholder="Education" >
            </div>
            <div class="input-box">
            <textarea name="about" id="about" cols="30" rows="10" placeholder="About me"></textarea>
            </div>
            <div class="input-box">
                <label for="mainPicture" class="info-label" style="font-size: 22px;color: gray;display: inline-block;">Main Picture</label>
                <input type="file"  name="mainPicture">
            </div>
            <div class="input-box">
            <label for="secondary"  style="font-size: 22px;color: gray;display: inline-block;">Secondary Picture</label>
                <input type="file"  name="secondaryPicture" class="info-label" >
            </div>
            <div class="input-box">
                <label for="employment" class="info-label" style="font-size: 22px;color: gray;display: inline-block;">Your status:</label>
                <br>
                </div>
            <div class="input-box" style="direction:rtl;">
                <input type="radio" name="employment" id="ready" value="ready for hire">
                <label for="ready" class="info-label" style="font-size: 20px;color: gray;display: inline-block; cursor:pointer;">Ready for hire</label>
            </div>
                <div class="input-box"  style="direction:rtl;">
                <input type="radio" name="employment" id="employed" value="employed">
                <label for="employed" class="info-label" style="font-size: 20px;color: gray;display: inline-block; cursor:pointer;">Employed</label>
            </div>
            <div class="input-box"  style="direction:rtl;">
                <input type="radio" name="employment" id="either" value=" ">
                <label for="either" class="info-label" style="font-size: 20px;color: gray;display: inline-block; cursor:pointer;">Either</label>
            </div>
            <div class="input-box">
                <label for="skills" class="info-label" style="font-size: 22px;color: gray;display: inline-block;">Your skills:</label>
                <br>
            </div>
            <div class="input-box">
                <?php
                    require_once('database.php');
                    $query = "SELECT skill_id, skill_name FROM skills";
                    $result = mysqli_query($conn, $query);
                ?>
                <select name="skills" id="skill"  style="font-size: 20px; color: gray; display: inline-block; cursor: pointer;">
                    <optgroup style="color: #754ef9; cursor: pointer;">
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <option value="<?php echo $row['skill_id'] . ' ' . $row['skill_name']; ?>" name="skills[<?php echo $row['skill_id']; ?>]">
                                <?php echo $row['skill_name']; ?>
                            </option>
                        <?php endwhile; ?>
                    </optgroup>
                </select>
            </div>
            <div class="input-box">
                <button type="button" class="btn btn-primary" id="addTagButton">Add Skill</button>
            </div>
            <div class="input-box" id="tagContainer">
                
            </div >
            <div class="input-box">
                <label for="works" class="info-label" style="font-size: 22px;color: gray;display: inline-block;">Your Works:</label>
                <br>
            </div>
            <div class="input-box">
            <input type="text" name="name" placeholder="Project Name" >
            <input type="text" name="description" placeholder="Project description" >
            <input type="text" name="url" placeholder="Project URL" >
            </div>
            <div class="input-box">
                <label for="project-img" class="info-label" style="font-size: 22px;color: gray;display: inline-block;">Project Image</label>
            </div>
            <div class="input-box">
                <input type="file"  name="project-img">
            </div>
            <input type="submit" name="submit" value="submit" class="btn">
        </form>
</section>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    const selectOptions = document.getElementById('skill');
    const addTagButton = document.getElementById('addTagButton');
    const tagContainer = document.getElementById('tagContainer');
    const selectedSkills = []; // Array to store selected skills

    addTagButton.addEventListener('click', function() {
        const selectedOption = selectOptions.value;

        if (selectedOption && !selectedSkills.includes(selectedOption)) {
            const checkbox = document.createElement('input');
            checkbox.type = 'checkbox';
            checkbox.value = selectedOption;
            checkbox.name = 'selectedSkills[]';
            checkbox.id = 'checkbox-' + selectedOption;

            const label = document.createElement('label');
            label.textContent = selectedOption;
            label.htmlFor = 'checkbox-' + selectedOption;

            const closeButton = document.createElement('span');
            closeButton.textContent = 'x';
            closeButton.classList.add('close-button');
            closeButton.addEventListener('click', function() {
                tagContainer.removeChild(checkbox.parentNode);
                selectedSkills.splice(selectedSkills.indexOf(selectedOption), 1);
            });

            const tag = document.createElement('div');
            tag.classList.add('tag');
            tag.appendChild(checkbox);
            tag.appendChild(label);
            tag.appendChild(closeButton);
            tagContainer.appendChild(tag);

            selectedSkills.push(selectedOption);
        }
    });
});
    // document.addEventListener('DOMContentLoaded', function() {
    //     // const form=document.getElementById('info-form')
    //     const selectOptions = document.getElementById('skill');
    //     const addTagButton = document.getElementById('addTagButton');
    //     const tagContainer = document.getElementById('tagContainer');
    //     const selectedSkills = []; // Array to store selected skills

    //     addTagButton.addEventListener('click', function() {
    //     const selectedOption = selectOptions.value;

    //     if (selectedOption && !selectedSkills.includes(selectedOption)) {
    //         const tag = document.createElement('span');
    //         tag.textContent = selectedOption;
    //         tag.classList.add('badge', 'bg-primary', 'me-1');

    //         const closeButton = document.createElement('span');
    //         closeButton.textContent = 'x';
    //         closeButton.classList.add('close-button');
    //         closeButton.addEventListener('click', function() {
    //         tagContainer.removeChild(tag);
    //         selectedSkills.splice(selectedSkills.indexOf(selectedOption), 1);
    //         });

    //         tag.appendChild(closeButton);
    //         tagContainer.appendChild(tag);

    //         selectedSkills.push(selectedOption);
    //     }
    //     });
        
        // form.addEventListener('submit',function(e){
        //     let skills=[];
        //     // e.preventDefault();
        //     const tag =document.querySelectorAll("#tagContainer > span")
        //     // console.log(tag);
        //     tag.forEach(e =>{
        //         console.log(e)

        //         const id=e.innerText;

        //         skills.push(+id.split(" ")[0])
                
        //     })
            
        //     console.log(skills)
        //     const http = new XMLHttpRequest();
        //     http.onload=()=>{

        //     }
        //     http.open("post",'info.php');
        //     http.send(skills)
        // })
    // });
</script>
<?php require('footer.php'); ?>