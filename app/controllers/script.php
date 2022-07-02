<?php 

class Script extends Controller {
    public function index($id)
    {
        Session::set_user_session('siteid',$id);
        if(isset($_SESSION['user']['userrole']))
        {
            $data['title'] = 'Journals - Script Tag';
            $data['userrole'] = $_SESSION['user']['userrole'];
            $data['roleid'] = $_SESSION['user']['roleid'];
            $this->view('templates/header', $data);
            $this->view('script/index', $data);
            $this->view('templates/footer');
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