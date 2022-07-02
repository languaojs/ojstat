<?php 

class User_model {
    
    private $con;
    
    public function __construct()
    {
        $this->con = new Database;
    }

    public function login($userData)
    {
        $username = $userData['username'];
        $userpassinput = $userData['userpass'];

        $check_user = $this->con->query('SELECT * FROM stat_users WHERE username = ? AND userstatus = ?', $username, 'active');
        $check_result = $check_user->numRows();
        if($check_result < 1)
        {
            echo "
            <script>
            alert('You are not allowed to login!');
            window.location='". BASEURL . "';
            </script>;
            ";

        }else{
            $user_data = $check_user->fetchArray();
            $user_pass = $user_data['userpass'];
            if(!password_verify($userpassinput, $user_pass))
            {
                echo "
                <script>
                alert('Password is Wrong!');
                window.location='". BASEURL . "';
                </script>;
                ";

            }else{

                Session::start();
                Session::set_user_session('userrole', $user_data['userrole']);
                Session::set_user_session('roleid', $user_data['roleid']);
                Session::set_user_session('username', $user_data['user_fullname']);
                $user_role = Session::get_sess_role();
                switch($user_role)
                {
                    case 'admin':
                        header('location: ' . BASEURL . '/public/admin/');
                        break;
                    case 'user':
                        header('location: ' . BASEURL . '/public/user/');
                        break;
                }

            }

        }
    }

    public function get_profile()
    {
        $get_profile = $this->con->query("SELECT * FROM stat_users WHERE roleid = ?", $_SESSION['user']['roleid']);
        $profile = $get_profile->fetchArray();
        return $profile;
    }

    public function get_user_detail($id)
    {
        $get_profile_detail = $this->con->query("SELECT * FROM stat_users WHERE userid = ?", $id);
        $profile_detail = $get_profile_detail->fetchArray();
        return $profile_detail;
    }

    public function save_user_profile($user_profile_data)
    {
        $msg = "";
        if($save_profile = $this->con->query("UPDATE stat_users SET user_fullname = ?, user_img_url = ?, user_desc = ?, user_link = ?, user_email = ? WHERE userid = ?", $user_profile_data['user_fullname'], $user_profile_data['user_img_url'], $user_profile_data['user_desc'], $user_profile_data['user_link'], $user_profile_data['user_email'], $user_profile_data['userid'])){
            $msg .= "User profile has been saved.";
            $alert = 'success';
        }else{
            $msg .= "User profile has not been saved.";
            $alert = 'danger';
        }

        Flasher::setFlash($msg, $alert);
        header("location: ". BASEURL . "/public/" . $_SESSION['user']['userrole']);
    }

    public function save_my_profile($my_data)
    {
        $msg = "";
        if($save_profile = $this->con->query("UPDATE stat_users SET user_fullname = ?, user_img_url = ?, user_desc = ?, user_link = ?, user_email = ? WHERE userid = ?", $my_data['user_fullname'], $my_data['user_img_url'], $my_data['user_desc'], $my_data['user_link'], $my_data['user_email'], $my_data['userid'])){
            $msg .= "User profile has been saved.";
            $alert = 'success';
        }else{
            $msg .= "User profile has not been saved.";
            $alert = 'danger';
        }
        Flasher::setFlash($msg, $alert);
        $baseurl = BASEURL;
        $return_to = $_SESSION['user']['userrole'];
        header("location: $baseurl/public/$return_to");
    }

    public function disable_user($getid)
    {
        if($_SESSION['user']['userrole'] !=='admin')
        {
            echo "<h2>You are not authorized to take that action!</h2>";
        }else{
            $getuserid = explode("|", $getid);
            if(count($getuserid)<4)
            {
                echo "<h2>Bad Request</h2><p>Your request cannot be processed!</p>";
            }else{
                $userid = $getuserid[2];
                if($disable_user = $this->con->query("UPDATE stat_users SET userstatus = ? WHERE userid = ?", 'disabled', $userid))
                {
                    $msg = "User has been disabled.";
                    $alert = 'success';
                }else{
                    $msg = "User has not been disabled.";
                    $alert = 'danger';
                }
                Flasher::setFlash($msg, $alert);
                header('location: '. BASEURL . '/public/admin');
            }
        }
    }

    public function enable_user($getid)
    {
        if($_SESSION['user']['userrole'] !=='admin')
        {
            echo "<h2>You are not authorized to take that action!</h2>";
        }else{
            $getuserid = explode("|", $getid);
            if(count($getuserid)<4)
            {
                echo "<h2>Bad Request</h2><p>Your request cannot be processed!</p>";
            }else{
                $userid = $getuserid[2];
                if($enable_user = $this->con->query("UPDATE stat_users SET userstatus = ? WHERE userid = ?", 'active', $userid))
                {
                    $msg = "User has been enabled.";
                    $alert = 'success';
                }else{
                    $msg = "User has not been enabled.";
                    $alert = 'danger';
                }
                Flasher::setFlash($msg, $alert);
                header('location: '. BASEURL . '/public/admin');
            }
        }
    }

    public function change_user_password($password_data)
    {
        $userid = $password_data['userid'];
        $username = $password_data['username'];
        $userpass1 = $password_data['userpass1'];
        $userpass2 = $password_data['userpass2'];
        $username = $password_data['username'];
        if($userpass1 !== $userpass2){
            $msg = "New passwords not match!";
            $alert = "danger";
            Flasher::setFlash($msg, $alert);
            header('location: '. BASEURL . '/public/admin');
        }else{
            $opt = ['cost'=>8];
            $userpass = password_hash($userpass1, PASSWORD_BCRYPT,$opt);
            if($username !==''){
                if($this->con->query("UPDATE stat_users SET username = ?, userpass = ? WHERE userid = ?", $username, $userpass, $userid)){
                    $msg = "Username and password changed!";
                    $alert = "success";
                    Flasher::setFlash($msg, $alert);
                    header('location: '. BASEURL . '/public/admin');
                }else{
                    $msg = "Username and password not changed!";
                    $alert = "danger";
                    Flasher::setFlash($msg, $alert);
                    header('location: '. BASEURL . '/public/admin');
                }
            }else{
                if($this->con->query("UPDATE stat_users SET userpass = ? WHERE userid = ?", $userpass, $userid)){
                    $msg = "Password changed!";
                    $alert = "success";
                    Flasher::setFlash($msg, $alert);
                    header('location: '. BASEURL . '/public/admin');
                }else{
                    $msg = "Password not changed!";
                    $alert = "danger";
                    Flasher::setFlash($msg, $alert);
                    header('location: '. BASEURL . '/public/admin');
                }
            }
        }
    }
}