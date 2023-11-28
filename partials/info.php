<?php require('header.php') ?>

<!-- info section design -->
<section class="contact" id="info">
        <h2 class="heading">enter your  <span>Info</span></h2>
        <?php
        
        ?>
        <form action="info.php" method="post" enctype="multipart/form-data">
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
                <label for="hireState" class="info-label" style="font-size: 22px;color: gray;display: inline-block;">Your status:</label>
                <br>
                </div>
            <div class="input-box" style="direction:rtl;">
                <input type="radio" name="hireState" id="ready" value="ready for hire">
                <label for="ready" class="info-label" style="font-size: 20px;color: gray;display: inline-block; cursor:pointer;">Ready for hire</label>
            </div>
                <div class="input-box"  style="direction:rtl;">
                <input type="radio" name="hireState" id="employed" value="employed">
                <label for="employed" class="info-label" style="font-size: 20px;color: gray;display: inline-block; cursor:pointer;">Employed</label>
            </div>
            <div class="input-box"  style="direction:rtl;">
                <input type="radio" name="hireState" id="either" value=" ">
                <label for="either" class="info-label" style="font-size: 20px;color: gray;display: inline-block; cursor:pointer;">Either</label>
            </div>
            <div class="input-box">
                <label for="skills" class="info-label" style="font-size: 22px;color: gray;display: inline-block;">Your skills:</label>
                <br>
            </div>
            <div class="input-box">
                <select name="skills" id="skill" style="font-size: 20px;color: gray;display: inline-block; cursor:pointer;" >
                    <optgroup style="color:#754ef9; cursor:pointer;">
                        <option value="html" name="html" >html</option>
                        <option value="css" name="css">css</option>
                        <option value="js" name="js">javascript</option>
                        <option value="bootstrap" name="bootstrap">bootstrap</option>
                        <option value="node" name="node">node.js</option>
                        <option value="php" name="name">php</option>
                        <option value="mysql" name="mysql">mysql</option>
                        <option value="mongodb" name="mongodb">mongodb</option>
                        <option value="jquery" name="jquery">jquery</option>
                        <option value="ajax" name="ajax">ajax</option>
                        <option value="git" name="git">git</option>
                        <option value="github" name="github">github</option>
                        <option value="figma" name="figma">figma</option>
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
            <input type="text" name="project-name" placeholder="Project Name" >
            <input type="text" name="project-description" placeholder="Project description" >
            <input type="text" name="project-url" placeholder="Project URL" >
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
            const tag = document.createElement('span');
            tag.textContent = selectedOption;
            tag.classList.add('badge', 'bg-primary', 'me-1');

            const closeButton = document.createElement('span');
            closeButton.textContent = 'x';
            closeButton.classList.add('close-button');
            closeButton.addEventListener('click', function() {
            tagContainer.removeChild(tag);
            selectedSkills.splice(selectedSkills.indexOf(selectedOption), 1);
            });

            tag.appendChild(closeButton);
            tagContainer.appendChild(tag);

            selectedSkills.push(selectedOption);
        }
        });
    });
</script>
<?php require('footer.php') ?>