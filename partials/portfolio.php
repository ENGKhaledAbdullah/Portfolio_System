<?php 
    if (isset($_POST['username'])) {
        $username = $_POST['username'];
        require_once('database.php');
        $sql="SELECT * FROM users WHERE user_name ='$username'";
        $result = mysqli_query($conn,$sql);
        $user = mysqli_fetch_array($result,MYSQLI_ASSOC);
        // print_r($user); exit;
        if(!empty($user)){
            $sql="SELECT * FROM user_info WHERE user_id ='".$user['user_id']."'";
            $result = mysqli_query($conn,$sql);
            $userInfo = mysqli_fetch_array($result,MYSQLI_ASSOC);
            // print_r($userInfo); exit;
            if(!empty($userInfo)){
                $sql="SELECT * FROM user_skill WHERE user_id ='".$userInfo['info_id']."'";
                $result = mysqli_query($conn,$sql);
                $skills = array();
                // while ($row = mysqli_fetch_array($result)) {
                while($userSkill = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                    $skills[] = $userSkill;
                }
                print_r($skills);
            }
            if(!empty($userInfo)){
                $sql="SELECT * FROM works WHERE u_id ='".$userInfo['info_id']."'";
                $result = mysqli_query($conn,$sql);
                $works = array();
                // while ($row = mysqli_fetch_array($result)) {
                while($userWork = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                    $works[] = $userWork;
                }
                print_r($works);
            }
        }
    }
    exit;
    require('header.php'); 
    echo $username;

    require('footer.php');
?>
