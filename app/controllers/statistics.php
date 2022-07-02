<?php 

class Statistics extends Controller {

    public function index($id)
    {
        Session::set_user_session('siteid',$id);
        
        if(isset($_SESSION['user']['userrole']))
        {
            $data['title'] = 'Journals - Statistics';
            $data['userrole'] = $_SESSION['user']['userrole'];
            $data['roleid'] = $_SESSION['user']['roleid'];
            $this->view('templates/header', $data);
            $this->view('statistics/index', $data);
            $this->view('templates/footer');
        }else{
            $this->logout();
        }
    }

    public function scimago($id)
    {
        if(isset($_SESSION['user']['userrole']))
        {
            $data['title'] = 'Journals - Scimago';
            $data['userrole'] = $_SESSION['user']['userrole'];
            $data['roleid'] = $_SESSION['user']['roleid'];
            $data['metric_data'] = $this->model('Statistics_model')->get_scimago_data($id);
            $data['config'] = $this->model('Statistics_model')->get_config($id);
            $this->view('templates/header', $data);
            if(is_array($data['metric_data']))
            {
                $scimago = Sanitize::cleanAll(array(
                    'name'=>$data['metric_data']['name'],
                    'issn'=>$data['metric_data']['issn'],
                    'url'=>$data['metric_data']['url'],
                    'publisher'=>$data['metric_data']['publisher'],
                    'hindex'=>$data['metric_data']['hindex']
                ));
                $data['scimago_data']="
                <img src='$scimago[url]' class='img-fluid' alt=''>
                <p class='lead mt-5'>$scimago[name] ($scimago[issn])</p>
                <p><strong>Published by $scimago[publisher]</strong></p>
                <h1>H-Index: $scimago[hindex]</h1> 
                ";
            }else{
                $scimago = Sanitize::clean($data['metric_data']);
                $data['scimago_data']="<p>$scimago</p>";
            }
            $this->view('statistics/scimago', $data);
            $this->view('templates/footer');
        }else{
            $this->logout();
        }
    }

    public function copernicus($id)
    {
        if(isset($_SESSION['user']['userrole']))
        {
            $data['title'] = 'Journals - Index Copernicus';
            $data['userrole'] = $_SESSION['user']['userrole'];
            $data['roleid'] = $_SESSION['user']['roleid'];
            $data['metric_data'] = $this->model('Statistics_model')->get_ici_data($id);
            if(is_array($data['metric_data']))
            {
                $data_label = array();
                $data_set = array();
                foreach($data['metric_data']['year'] as $year)
                {
                    $data_label[] = Sanitize::clean($year);
                }
                foreach($data['metric_data']['value'] as $value)
                {
                    $data_set[] = Sanitize::clean($value);
                }
                $data['datalabel'] = $data_label;
                $data['dataset'] = $data_set;
                $data['chartContainer'] = "
                <div id='chartBox' style='width:100%; height:300px' class='p-2 shadow'>
                <canvas id='iciChart'></canvas></div>
                ";
            }else{
                $data['datalabel'] = '';
                $data['dataset'] = '';
                $data['chartContainer'] = "
                <p class='text-center'>$data[metric_data]</p>
                ";
            }
            $data['config'] = $this->model('Statistics_model')->get_config($id);
            $this->view('templates/header', $data);
            $this->view('statistics/copernicus', $data);
            $this->view('templates/footer');
        }else{
            $this->logout();
        }
    }

    public function gscholar($id)
    {
        if(isset($_SESSION['user']['userrole']))
        {
            $data['title'] = 'Journals - Google Scholar';
            $data['userrole'] = $_SESSION['user']['userrole'];
            $data['roleid'] = $_SESSION['user']['roleid'];
            $data['metric_data'] = $this->model('Statistics_model')->get_gs_data($id);
            if(is_array($data['metric_data']))
            {
                $data['chartContainer']="
                <div id='chartBox' style='width:100%; height:300px' class='p-2 shadow'>
                <canvas id='gsChart'></canvas></div>
                ";
            }else{
                $data['chartContainer'] = "
                <p class='text-center'>$data[metric_data]</p>
                ";
            }
            $data['config'] = $this->model('Statistics_model')->get_config($id);
            $this->view('templates/header', $data);
            $this->view('statistics/gscholar', $data);
            $this->view('templates/footer');
        }else{
            $this->logout();
        }
    }

    public function visits($id)
    {
        if(isset($_SESSION['user']['userrole']))
        {
            $data['title'] = 'Journals - Statistics';
            $data['userrole'] = $_SESSION['user']['userrole'];
            $data['roleid'] = $_SESSION['user']['roleid'];
            $data['daily'] = $this->model('Statistics_model')->get_daily_visit($id);
            $data['monthly'] = $this->model('Statistics_model')->get_monthly_visit($id);
            $data['yearly'] = $this->model('Statistics_model')->get_yearly_visit($id);
            $data['chart'] = $this->model('Statistics_model')->get_visit_chart($id);
            $data['today'] = $this->model('Statistics_model')->get_today_visit($id);
            $data['average'] = $this->model('Statistics_model')->get_average_visit($id);
            $this->view('templates/header', $data);
            $this->view('statistics/visits', $data);
            $this->view('templates/footer');
        }else{
            $this->logout();
        }
    }

    public function countries($id)
    {
        if(isset($_SESSION['user']['userrole']))
        {
            $data['title'] = 'Journals - Statistics';
            $data['userrole'] = $_SESSION['user']['userrole'];
            $data['roleid'] = $_SESSION['user']['roleid'];
            $data['map'] = $this->model('Statistics_model')->get_map($id);
            $data['top'] = $this->model('Statistics_model')->get_top_country($id);
            $data['countries'] = $this->model('Statistics_model')->get_countries($id);
            $data['cities'] = $this->model('Statistics_model')->get_cities($id);
            $data['last'] = $this->model('Statistics_model')->get_last($id);
            $this->view('templates/header', $data);
            $this->view('statistics/countries', $data);
            $this->view('templates/footer');
        }else{
            $this->logout();
        }
    }
    
    public function domain($id)
    {
        if(isset($_SESSION['user']['userrole']))
        {
            $data['title'] = 'Journals - Statistics';
            $data['userrole'] = $_SESSION['user']['userrole'];
            $data['roleid'] = $_SESSION['user']['roleid'];
            $data['traffic'] = $this->model('Statistics_model')->get_traffic($id);
            $data['google'] = $this->model('Statistics_model')->get_traffic_google($id);
            $data['yahoo'] = $this->model('Statistics_model')->get_traffic_yahoo($id);
            $data['facebook'] = $this->model('Statistics_model')->get_traffic_facebook($id);
            $data['twitter'] = $this->model('Statistics_model')->get_traffic_twitter($id);
            $data['yandex'] = $this->model('Statistics_model')->get_traffic_yandex($id);
            $data['bing'] = $this->model('Statistics_model')->get_traffic_bing($id);
            $data['last'] = $this->model('Statistics_model')->get_last($id);
            $this->view('templates/header', $data);
            $this->view('statistics/domain', $data);
            $this->view('templates/footer');
        }else{
            $this->logout();
        }
    }

    public function sysdev($id)
    {
        if(isset($_SESSION['user']['userrole']))
        {
            $data['title'] = 'Journals - Statistics';
            $data['userrole'] = $_SESSION['user']['userrole'];
            $data['roleid'] = $_SESSION['user']['roleid'];
            $data['system'] = $this->model('Statistics_model')->get_system($id);
            $data['device'] = $this->model('Statistics_model')->get_device($id);
            $data['browser'] = $this->model('Statistics_model')->get_browser($id);
            $data['last'] = $this->model('Statistics_model')->get_last($id);
            $this->view('templates/header', $data);
            $this->view('statistics/sysdev', $data);
            $this->view('templates/footer');
        }else{
            $this->logout();
        }
        
    }

    public function pageview($id)
    {
        if(isset($_SESSION['user']['userrole']))
        {
            $data['title'] = 'Journals - Statistics';
            $data['userrole'] = $_SESSION['user']['userrole'];
            $data['roleid'] = $_SESSION['user']['roleid'];
            $data['pageview'] = $this->model('Statistics_model')->get_pageview($id);
            $data['last'] = $this->model('Statistics_model')->get_last($id);
            $this->view('templates/header', $data);
            $this->view('statistics/pageview', $data);
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