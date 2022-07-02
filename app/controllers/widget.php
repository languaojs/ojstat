<?php 

class Widget extends Controller {
    
    public function index($id)
    {
        Session::set_user_session('siteid',$id);
        
        if(!empty($_SESSION['user']))
        {
            $data['title'] = 'Journals - Widgets';
            $data['userrole'] = $_SESSION['user']['userrole'];
            $data['roleid'] = $_SESSION['user']['roleid'];
            $this->view('templates/header', $data);
            $this->view('widget/index', $data);
            $this->view('templates/footer');
        }else{
            $this->logout();
        }
    }

    public function chart($id, $chartdata)
    {
        if($chartdata == 'visit')
        {
            $data['data']=$this->model('Widget_model')->get_visit_chart($id);
            $this->view('templates/widget_header', $data);
            $this->view('widget/chart-visit', $data);
            $this->view('templates/widget_footer');
        }elseif($chartdata == 'country')
        {
            $data['data']=$this->model('Widget_model')->get_country_chart($id);
            $this->view('templates/widget_header', $data);
            $this->view('widget/chart-country', $data);
            $this->view('templates/widget_footer');   
        }elseif($chartdata == 'domain')
        {
            $data['data']=$this->model('Widget_model')->get_domain_chart($id);
            $this->view('templates/widget_header', $data);
            $this->view('widget/chart-domain', $data);
            $this->view('templates/widget_footer');   
        }elseif($chartdata == 'system')
        {
            $data['data']=$this->model('Widget_model')->get_system_chart($id);
            $this->view('templates/widget_header', $data);
            $this->view('widget/chart-system', $data);
            $this->view('templates/widget_footer');   
        }elseif($chartdata == 'browser')
        {
            $data['data']=$this->model('Widget_model')->get_browser_chart($id);
            $this->view('templates/widget_header', $data);
            $this->view('widget/chart-browser', $data);
            $this->view('templates/widget_footer');   
        }elseif($chartdata == 'device')
        {
            $data['data']=$this->model('Widget_model')->get_device_chart($id);
            $this->view('templates/widget_header', $data);
            $this->view('widget/chart-device', $data);
            $this->view('templates/widget_footer');   
        }elseif($chartdata == 'gs')
        {
            $data['data']=$this->model('Widget_model')->get_gs_chart($id);
            $this->view('templates/widget_header', $data);
            $this->view('widget/chart-gs', $data);
            $this->view('templates/widget_footer');   
        }elseif($chartdata == 'ici')
        {
            $data['data']=$this->model('Widget_model')->get_ici_chart($id);
            $this->view('templates/widget_header', $data);
            $this->view('widget/chart-ici', $data);
            $this->view('templates/widget_footer');   
        }else{
            $this->view('templates/widget_header');
            $this->view('widget/404');
            $this->view('templates/widget_footer');  
        }
    }

    public function table($id, $tabledata)
    {
        if($tabledata == 'visit')
        {
            $data['data']=$this->model('Widget_model')->get_visit_table($id);
            $this->view('templates/widget_header', $data);
            $this->view('widget/table-visit', $data);
            $this->view('templates/widget_footer');
        }elseif($tabledata == 'country')
        {
            $data['data']=$this->model('Widget_model')->get_country_table($id);
            $this->view('templates/widget_header', $data);
            $this->view('widget/table-country', $data);
            $this->view('templates/widget_footer');
        }elseif($tabledata == 'domain')
        {
            $data['data']=$this->model('Widget_model')->get_domain_table($id);
            $this->view('templates/widget_header', $data);
            $this->view('widget/table-domain', $data);
            $this->view('templates/widget_footer');
        }elseif($tabledata == 'system')
        {
            $data['data']=$this->model('Widget_model')->get_system_table($id);
            $this->view('templates/widget_header', $data);
            $this->view('widget/table-system', $data);
            $this->view('templates/widget_footer');   
        }elseif($tabledata == 'browser')
        {
            $data['data']=$this->model('Widget_model')->get_browser_table($id);
            $this->view('templates/widget_header', $data);
            $this->view('widget/table-browser', $data);
            $this->view('templates/widget_footer');   
        }elseif($tabledata == 'device')
        {
            $data['data']=$this->model('Widget_model')->get_device_table($id);
            $this->view('templates/widget_header', $data);
            $this->view('widget/table-device', $data);
            $this->view('templates/widget_footer');   
        }elseif($tabledata == 'pageview')
        {
            $data['data']=$this->model('Widget_model')->get_pageview_table($id);
            $this->view('templates/widget_header', $data);
            $this->view('widget/table-pageview', $data);
            $this->view('templates/widget_footer');   
        }else{
            $this->view('templates/widget_header');
            $this->view('widget/404');
            $this->view('templates/widget_footer');
        }
    }

    public function logout()
    {
        session_destroy();
        header('location: '. BASEURL . '/public/home');
    }
}