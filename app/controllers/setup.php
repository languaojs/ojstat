<?php 

class Setup extends Controller {

    public function index(){
        if(SETUP == true)
        {
            $data['title'] = 'OJStat Setup';
            $data['setup_check'] = $this->model('Setup_model')->setup_check();
            $this->view('templates/setup-header', $data);
            $this->view('setup/index', $data);
            $this->view('templates/setup-footer');
        }else{
            $this->not_allowed();
        }
    }

    public function install()
    {
        if(SETUP == true)
        {
            $this->model('Setup_model')->install_tables();
        }else{
            $this->not_allowed();
        }
    }

    public function start()
    {
        if(SETUP == true)
        {
            $data['title'] = 'OJStat Setup Start';
            $data['setup_check'] = $this->model('Setup_model')->setup_check();
            $this->view('templates/setup-header', $data);
            $this->view('setup/start', $data);
            $this->view('templates/setup-footer');
        }else{
            $this->not_allowed();
        }
    }

    public function upgrade()
    {
        if(SETUP == true)
        {
            $this->model('Setup_model')->upgrade_tables();
        }else{
            $this->not_allowed();
        }
        
    }

    public function add_admin()
    {
        if(SETUP == true)
        {
            $this->model('Setup_model')->adding_admin();
        }else{
            $this->not_allowed();
        }
    }

    public function rem_old()
    {
        if(SETUP == true)
        {
            $this->model('Setup_model')->rem_old_fields();
        }else{
            $this->not_allowed();
        }
        
    }

    public function sync()
    {
        if(SETUP == true)
        {
            $data['title'] = 'OJStat Setup - Sync';
            $data['setup_check'] = $this->model('Setup_model')->setup_check();
            $data['data_size'] = $this->model('Setup_model')->get_data_size();
            $this->view('templates/setup-header', $data);
            $this->view('setup/sync', $data);
            $this->view('templates/setup-footer');
        }else{
            $this->not_allowed();
        }
        
    }

    public function sync_data()
    {
        if(SETUP == true)
        {
            if(isset($_POST['data_num']))
            {
                $data_num = Sanitize::cleanAll($_POST);
                $this->model('Setup_model')->start_sync_data($data_num);
            }
        }else{
            $this->not_allowed();
        }
    }

    public function reindex_fields()
    {
        if(SETUP == true)
        {
            $this->model('Setup_model')->reindex();
        }else{
            $this->not_allowed();
        }
    }

    public function finishing_table()
    {
        if(SETUP == true)
        {
            $this->model('Setup_model')->finish_table_setup();
        }else{
            $this->not_allowed();
        }
    }

    public function not_allowed()
    {
        $data['title'] = 'OJStat Restriction';
        $this->view('templates/setup-header', $data);
        $this->view('setup/restriction', $data);
        $this->view('templates/setup-footer');
    }
}