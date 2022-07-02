<?php 
class User extends Controller {

    public function index()
    {
        if(isset($_SESSION['user']['userrole']))
        {
            $data['title'] = 'OJStat - User';
            $data['userrole'] = $_SESSION['user']['userrole'];
            if(OJSTATART==true)
            {
                $data['curlojstat'] = $this->model('Server_model')->get_article_list();
                
            }else{
                $data['curlojstat'] = "";
            }
            $this->view('templates/header', $data);
            $this->view('user/index', $data);
            $this->view('templates/footer');
        }else{
            $this->logout();
        }
    }
    
    public function login()
    {
        if(isset($_POST['userLogin']))
        {
            if(!empty($_POST['username'] && !empty($_POST['userpass'])))
            {
                $userData = Sanitize::cleanAll($_POST);
                $this->model('User_model')->login($userData);
            }else{
                $this->logout();
            }
        }
    }

    public function edit_profile()
    {
        if(isset($_SESSION['user']['userrole']))
        {
            $data['title'] = 'OJStat - Edit Profile';
            $data['userrole'] = $_SESSION['user']['userrole'];
            $data['user_profile'] = $this->model('User_model')->get_profile();
            $this->view('templates/header', $data);
            $this->view('user/edit_profile', $data);
            $this->view('templates/footer');
        }else{
            $this->logout();
        }
    }

    public function edit_user_detail()
    {
        if(isset($_POST['edit_user_profile']))
        {
            $user_profile_data = Sanitize::cleanAll($_POST);
            $this->model('User_model')->save_user_profile($user_profile_data);
        }else{
            header('location: ' . BASEURL . '/public/home');
        }
    }

    public function edit_my_detail()
    {
        if(isset($_POST['edit_this_profile']))
        {
            $my_data = Sanitize::cleanAll($_POST);
            $this->model('User_model')->save_my_profile($my_data);
        }else{
            header('location: ' . BASEURL . '/public/home');
        }
    }

    public function detail($id)
    {
        if(isset($_SESSION['user']['userrole']))
        {
            $data['title'] = 'OJStat - Profile Detail';
            $data['profile_detail'] = $this->model('User_model')->get_user_detail($id);
            $this->view('templates/header', $data);
            $this->view('user/detail', $data);
            $this->view('templates/footer');
        }else{
            $this->logout();
        }
    }

    public function disable($id)
    {
        $getid = explode("|", $id);
        if(count($getid)<4 || count($getid)>4)
        {
            echo "<h2>Bad Request</h2><p>Your request cannot be processed!</p>";
        }else{
            $this->model('User_model')->disable_user($id);
        }
    }

    public function enable($id)
    {
        $getid = explode("|", $id);
        if(count($getid)<4 || count($getid)>4)
        {
            echo "<h2>Bad Request</h2><p>Your request cannot be processed!</p>";
        }else{
            $this->model('User_model')->enable_user($id);
        }
    }

    public function password_form($id)
    {
        if(isset($_SESSION['user']['userrole']))
        {
            if(isset($id))
            {
                $get_userid = explode('|', $id);
                if(count($get_userid)<4 || $_SESSION['user']['userrole'] !=='admin')
                {
                    echo "<h3>You are not authorized to change user password!</h3>";
                }else{
                    $data['userid'] = $get_userid['2'];
                    $data['title'] = 'OJStat - Password';
                    $data['user_data'] = $this->model('User_model')->get_user_detail($data['userid']);
                    $this->view('templates/header', $data);
                    $this->view('admin/password_form', $data);
                    $this->view('templates/footer');
                }
            }
        }else{
            $this->logout();
        }
    }

    public function change_password()
    {
        if($_SESSION['user']['userrole'] !== 'admin'){
            echo "<h3>You are not authorized to change user password!</h3>";
        }else{
            if(isset($_POST['changePassword']))
            {
                $get_user_id = explode('|', $_POST['userid']);
                $password_data = array(
                    'username' => Sanitize::clean($_POST['username']),
                    'userpass1' => Sanitize::clean($_POST['userpass1']),
                    'userpass2' => Sanitize::clean($_POST['userpass2']),
                    'userid'=> Sanitize::clean($get_user_id[2])
                );
                $this->model('User_model')->change_user_password($password_data);
            }
        }
    }

    public function logout()
    {
        session_destroy();
        header('location: '. BASEURL . '/public/home');
    }
}