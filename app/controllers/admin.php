<?php 

class Admin extends Controller{
    public function index()
    {
        if(isset($_SESSION['user']['userrole']))
        {
            $data['title'] = 'OJStat Admin';
            $data['userrole'] = $_SESSION['user']['userrole'];
            $data['roleid'] = $_SESSION['user']['roleid'];
            $data['journalNum'] = $this->model('Admin_model')->count_journal();
            $data['userNum'] = $this->model('Admin_model')->count_user();
            $data['users_data'] = $this->model('Admin_model')->list_users();
            $data['user_check']= $this->model('Admin_model')->check_users();
            if(OJSTATART==true)
            {
                $data['curlojstat'] = $this->model('Server_model')->get_article_list();
                
            }else{
                $data['curlojstat'] = "";
            }
            $this->view('templates/header', $data);
            $this->view('admin/index', $data);
            $this->view('templates/footer');
        }else{
            $this->logout();
        }
    }
    
    public function add_user_form()
    {
        if(isset($_SESSION['user']['userrole']))
        {
            $data['title'] = 'OJStat Add User';
            $data['role_id_suggest'] = $this->model('Admin_model')->get_roleid();
            $this->view('templates/header', $data);
            $this->view('admin/add_user_form', $data);
            $this->view('templates/footer');
        }else{
            $this->logout();
        }
    }

    public function add_user()
    {
        if(isset($_POST['addUser']))
        {
            $new_user = Sanitize::cleanAll($_POST);
            $this->model('Admin_model')->addUser($new_user);
        }else{
            $this->logout();
        }
    }

    public function logout()
    {
        session_destroy();
        header('location: '. BASEURL . '/public/home');
    }
}