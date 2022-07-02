<?php 

class Journal extends Controller {
    
    public function index()
    {
        if(isset($_SESSION['user']['userrole']))
        {
            $data['title'] = 'Journals';
            $data['userrole'] = $_SESSION['user']['userrole'];
            $data['roleid'] = $_SESSION['user']['roleid'];
            if($_SESSION['user']['userrole']=='admin')
            {
                $data['journal_list'] = $this->model('Journal_model')->list_journal();
            }elseif($_SESSION['user']['userrole']=='user')
            {
                $data['journal_list'] = $this->model('Journal_model')->list_journal_user($_SESSION['user']['roleid']);
            }
            $this->view('templates/header', $data);
            $this->view('journal/index', $data);
            $this->view('templates/footer');
        }else{
            $this->logout();
        }
    }

    public function add_journal_form()
    {
        if(isset($_SESSION['user']['userrole']))
        {
            $data['title'] = 'Add Journal';
            $data['userrole'] = $_SESSION['user']['userrole'];
            $data['roleid'] = $_SESSION['user']['roleid'];
            $data['user_list'] = $this->model('Journal_model')->list_user();
            $this->view('templates/header', $data);
            $this->view('journal/add_journal_form', $data);
            $this->view('templates/footer');
        }else{
            $this->logout();
        }
    }

    public function journal_form_data()
    {
        if(isset($_POST['sendJournalData']))
        {
            $journal_data = Sanitize::cleanAll($_POST);
            $this->model('Journal_model')->add_journal($journal_data);
        }
    }

    public function edit($id)
    {
        if(isset($id))
        {
            if(isset($_SESSION['user']['userrole']))
            {
                $data['title'] = 'OJStat - Edit Journal';
                $data['journal'] = $this->model('Journal_model')->edit_journal_form($id);
                $data['user_list'] = $this->model('Journal_model')->list_user();
                $this->view('templates/header', $data);
                $this->view('journal/edit_journal_form', $data);
                $this->view('templates/footer');
            }else{
                $this->logout();
            }
        }else{
            $this->logout();
        }
    }

    public function journal_edit_form()
    {
        if(isset($_POST['sendJournalData']))
        {
            $journal_data = Sanitize::cleanAll($_POST);
            $this->model('Journal_model')->edit_journal($journal_data);
        }
    }

    public function config($id)
    {
        if(isset($id))
        {
            if(isset($_SESSION['user']['userrole']))
            {
                $data['title'] = 'OJStat - Edit Journal Configuration';
                $data['config'] = $this->model('Journal_model')->check_config($id);
                $this->view('templates/header', $data);
                $this->view('journal/edit_journal_config', $data);
                $this->view('templates/footer');
            }else{
                $this->logout();
            }
        }else{
            $this->logout();
        }
    }

    public function config_form_data()
    {
        if(isset($_POST['editConfig']))
        {
            if(isset($_SESSION['user']['userrole']))
            {
                $config_data = Sanitize::cleanAll($_POST);
                $this->model('Journal_model')->save_config($config_data);
            }else{
                $this->logout();
            }
        }else{
            $this->logout();
        }
    }

    public function statistics ($id)
    {
        if(isset($id))
        {
            if(isset($_SESSION['user']['userrole']))
            {
                $data['title'] = 'OJStat - Journal Statistics';
                $data['visit'] = $this->model('Journal_model')->get_visit($id);
                $this->view('templates/header', $data);
                $this->view('journal/statistics', $data);
                $this->view('templates/footer');
            }else{
                $this->logout();
            }
        }else{
            $this->logout();
        }
    }

    public function close($id)
    {
        if(isset($id))
        {
            if(isset($_SESSION['user']['userrole']))
            {
                if($_SESSION['user']['userrole']=='admin')
                {
                    $this->model('Journal_model')->close_journal($id);
                }else{
                    $this->logout();
                }
            }else{
                $this->logout();
            }
        }
    }

    public function masterdata($id)
    {
        if(isset($_SESSION['user']['userrole']))
        {
            if($_SESSION['user']['userrole']=='admin')
            {
                $data['title'] = 'OJStat - Journal Master Data';
                $data['allvisit'] = $this->model('Journal_model')->get_allvisit($id);
                $this->view('templates/header', $data);
                $this->view('journal/masterdata', $data);
                $this->view('templates/footer');
            }else{
                $this->logout();
            }
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