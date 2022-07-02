<?php 

class Report extends Controller {

    public function index($id)
    {
        $data['title']='OJStat Report - Summary';
        $data['config_info'] = $this->model('Report_model')->get_config_info($id);
        $data['journal_info'] = $this->model('Report_model')->get_journal_info($id);
        $data['user_info'] = $this->model('Report_model')->get_user_info($id);
        $data['visitor_count'] = $this->model('Report_model')->get_visitor_count($id);
        $data['all_visit'] = $this->model('Report_model')->get_all_visit($id);
        $data['all_avg'] = $this->model('Report_model')->get_daily_average($id);
        $data['unique_avg'] = $this->model('Report_model')->get_daily_unique_average($id);
        $data['pageview_avg'] = $this->model('Report_model')->get_daily_pageview_average($id);
        $data['visitor_map'] = $this->model('Report_model')->get_visitor_map($id);
        $data['top_country'] = $this->model('Report_model')->get_top_country($id);
        $data['siteid'] = $id;
        $this->view('templates/report-header', $data);
        $this->view('report/index',$data);
        $this->view('templates/report-footer');
    }

    public function journal($id)
    {
        $data['title']='OJStat Report - Journal Detail';
        $data['config_info'] = $this->model('Report_model')->get_config_info($id);
        $data['journal_info'] = $this->model('Report_model')->get_journal_info($id);
        $data['firstlast'] = $this->model('Report_model')->get_firstlast($id);
        $data['user_info'] = $this->model('Report_model')->get_user_info($id);
        $data['siteid'] = $id;
        $this->view('templates/report-header', $data);
        $this->view('report/journal',$data);
        $this->view('templates/report-footer');
    }

    public function scimago($id)
    {
        $data['title']='OJStat Report - Scimago';
        $data['config_info'] = $this->model('Report_model')->get_config_info($id);
        $data['journal_info'] = $this->model('Report_model')->get_journal_info($id);
        $data['metric_data'] = $this->model('Report_model')->get_scimago_data($id);
        $data['siteid'] = $id;
        $this->view('templates/report-header', $data);
        $this->view('report/scimago',$data);
        $this->view('templates/report-footer');
    }

    public function ici($id)
    {
        $data['title']='OJStat Report - Index Copernicus';
        $data['config_info'] = $this->model('Report_model')->get_config_info($id);
        $data['journal_info'] = $this->model('Report_model')->get_journal_info($id);
        $data['metric_data'] = $this->model('Report_model')->get_ici_data($id);
        $data['siteid'] = $id;
        $this->view('templates/report-header', $data);
        $this->view('report/ici',$data);
        $this->view('templates/report-footer');
    }

    public function gs($id)
    {
        $data['title']='OJStat Report - Google Scholar';
        $data['config_info'] = $this->model('Report_model')->get_config_info($id);
        $data['journal_info'] = $this->model('Report_model')->get_journal_info($id);
        $data['metric_data'] = $this->model('Report_model')->get_gs_data($id);
        $data['siteid'] = $id;
        $this->view('templates/report-header', $data);
        $this->view('report/gs',$data);
        $this->view('templates/report-footer');
    }

    public function visit($id)
    {
        $data['title']='OJStat Report - Visit';
        $data['config_info'] = $this->model('Report_model')->get_config_info($id);
        $data['journal_info'] = $this->model('Report_model')->get_journal_info($id);
        $get_all_visit = $this->model('Report_model')->get_all_visit_report($id);
        $all_visit_datalabel = array();
        $all_visit_dataset = array();
        $unique_visit_dataset = array();
        foreach($get_all_visit as $visit_data)
        {
            $all_visit_datalabel[]=$visit_data['pv_date'];
            $all_visit_dataset[]=$visit_data['allVisitor'];
            $unique_visit_dataset[]=$visit_data['uniqueVisitor'];
        }
        $data['all_visit_data'] = array(
            'datalabel'=>Sanitize::cleanAll($all_visit_datalabel),
            'alldataset'=>Sanitize::cleanAll($all_visit_dataset),
            'uniquedataset'=>Sanitize::cleanAll($unique_visit_dataset)
        );
        $data['visitor_count'] = $this->model('Report_model')->get_visitor_count($id);
        $thisMonth = $this->model('Report_model')->get_visitor_this_month($id);
        $monthDate = array();
        $monthAll =array ();
        $monthUnique = array();
        $monthRet = array();
        foreach($thisMonth as $month)
        {
            $monthDate[] = $month['pv_date'];
            $monthAll[] = $month['thisallVisitor'];
            $monthUnique[] = $month['thisuniqueVisitor'];
            $monthRet[] = $month['thisallVisitor']-$month['thisuniqueVisitor'];
        }
        $data['this_month'] = array(
            'monthDate' => Sanitize::cleanAll($monthDate),
            'monthRet' => Sanitize::cleanAll($monthRet),
            'monthUnique' => Sanitize::cleanAll($monthUnique)
        );

        $get_monthly_visit= $this->model('Report_model')->get_monthly_visit($id);
        $monthly_month = array();
        $monthly_all = array();
        $monthly_unique = array();
        $monthly_ret = array();
        foreach($get_monthly_visit as $monthly)
        {
            $monthly_month[] = date('F', strtotime($monthly['pv_date']));
            $monthly_all[] = $monthly['allVisitor'];
            $monthly_unique[] = $monthly['uniqueVisitor'];
            $monthly_ret[] = $monthly['allVisitor']-$monthly['uniqueVisitor'];
        }
        $data['monthly_visit'] = array(
            'monthlyMonth' => Sanitize::cleanAll($monthly_month),
            'monthlyRet' => Sanitize::cleanAll($monthly_ret),
            'monthlyUnique' => Sanitize::cleanAll($monthly_unique)
        );

        $get_yearly_visit = $this->model('Report_model')->get_yearly_visit($id);
        $yearly_year = array();
        $yearly_all = array();
        $yearly_unique = array();
        $yearly_ret = array();
        foreach($get_yearly_visit as $yearly)
        {
            $yearly_year[] = date('Y', strtotime($yearly['pv_date']));
            $yearly_all[] = $yearly['allVisitor'];
            $yearly_unique[] = $yearly['uniqueVisitor'];
            $yearly_ret[] = $yearly['allVisitor']-$yearly['uniqueVisitor'];
        }
        $data['yearly_visit'] = array(
            'yearlyYear' => Sanitize::cleanAll($yearly_year),
            'yearlyRet' => Sanitize::cleanAll($yearly_ret),
            'yearlyUnique' => Sanitize::cleanAll($yearly_unique)
        );
        $data['visit_table'] = $this->model('Report_model')->get_visit_table($id);
        $data['visit_time'] = $this->model('Report_model')->get_visit_duration($id);
        $data['monthly_avg']= $this->model('Report_model')->get_monthly_avg($id);
        $data['yearly_avg']= $this->model('Report_model')->get_yearly_avg($id);
        $data['siteid'] = $id;
        $this->view('templates/report-header', $data);
        $this->view('report/visit',$data);
        $this->view('templates/report-footer');
    }

    public function geolocation($id)
    {
        $data['title']='OJStat Report - Geolocation';
        $data['siteid'] = $id;
        $data['config_info'] = $this->model('Report_model')->get_config_info($id);
        $data['journal_info'] = $this->model('Report_model')->get_journal_info($id);
        $data['visitor_map'] = $this->model('Report_model')->get_visitor_map($id);
        $data['top_country'] = $this->model('Report_model')->get_top_country($id);
        $data['countries'] = $this->model('Report_model')->get_countries($id);
        $data['regions'] = $this->model('Report_model')->get_regions($id);
        $data['cities'] = $this->model('Report_model')->get_cities($id);
        $data['isp'] = $this->model('Report_model')->get_isp($id);
        $this->view('templates/report-header', $data);
        $this->view('report/geolocation',$data);
        $this->view('templates/report-footer');
    }

    public function traffic($id)
    {
        $data['title']='OJStat Report - Traffic Sources';
        $data['siteid'] = $id;
        $data['config_info'] = $this->model('Report_model')->get_config_info($id);
        $data['journal_info'] = $this->model('Report_model')->get_journal_info($id);
        $get_traffic_data = $this->model('Report_model')->get_traffic_data($id);
        $get_all_traffic_data = $this->model('Report_model')->get_all_traffic_data($id);
        $tf_label = array();
        $tf_data_all = array();
        $tf_data_u = array();
        $tf_data_ret = array();
        foreach($get_traffic_data as $tf)
        {
            $tf_label[] = Sanitize::clean($tf['pv_ref_name']);
            $tf_data_all[] = Sanitize::clean($tf['allVisitor']);
            $tf_data_u[] = Sanitize::clean($tf['uniqueVisitor']);
            $tf_data_ret[]= Sanitize::clean($tf['allVisitor']-$tf['uniqueVisitor']);
        }
        $data['traffic_data'] = array(
            'tf_labels'=>$tf_label,
            'tf_ret'=>$tf_data_ret,
            'tf_u'=>$tf_data_u
        );

        $get_ten_top_domains = $this->model('Report_model')->get_ten_top_domains($id);
        $tftop_label = array();
        $tftop_data_all = array();
        $tftop_data_u = array();
        $tftop_data_ret = array();
        foreach($get_ten_top_domains as $tftop)
        {
            $tftop_label[] = Sanitize::clean($tftop['pv_ref_dom']);
            $tftop_data_all[] = Sanitize::clean($tftop['allVisitor']);
            $tftop_data_u[] = Sanitize::clean($tftop['uniqueVisitor']);
            $tftop_data_ret[]= Sanitize::clean($tftop['allVisitor']-$tftop['uniqueVisitor']);
        }
        $data['top_domain_data'] = array(
            'tftop_labels'=>$tftop_label,
            'tftop_ret'=>$tftop_data_ret,
            'tftop_u'=>$tftop_data_u
        );

        $get_all_traffic_data = $this->model('Report_model')->get_all_traffic_data($id);
        $tfall_label = array();
        $tfall_data_all = array();
        $tfall_data_u = array();
        $tfall_data_ret = array();
        foreach($get_all_traffic_data as $tfall)
        {
            $tfall_label[] = Sanitize::clean($tfall['pv_ref_dom']);
            $tfall_data_all[] = Sanitize::clean($tfall['allVisitor']);
            $tfall_data_u[] = Sanitize::clean($tfall['uniqueVisitor']);
            $tfall_data_ret[]= Sanitize::clean($tfall['allVisitor']-$tfall['uniqueVisitor']);
        }
        $data['all_traffic_data'] = array(
            'tf_labels'=>$tfall_label,
            'tf_ret'=>$tfall_data_ret,
            'tf_u'=>$tfall_data_u
        );

        $data['top_networks'] = $this->model('Report_model')->top_networks($id);
        
        $this->view('templates/report-header', $data);
        $this->view('report/traffic',$data);
        $this->view('templates/report-footer');
    }

    public function sysdev($id)
    {
        $data['title']='OJStat Report - Systems and Devices';
        $data['siteid'] = $id;
        $data['config_info'] = $this->model('Report_model')->get_config_info($id);
        $data['journal_info'] = $this->model('Report_model')->get_journal_info($id);

        $get_os_data = $this->model('Report_model')->get_os_data($id);
        $os = array();
        $os_all = array();
        $os_u = array();
        $os_ret = array();
        foreach($get_os_data as $os_data)
        {
            $os[] = Sanitize::clean($os_data['pv_os']);
            $os_all[] = Sanitize::clean($os_data['allVisitor']);
            $os_u[] = Sanitize::clean($os_data['uniqueVisitor']);
            $os_ret[] = Sanitize::clean($os_data['allVisitor']-$os_data['uniqueVisitor']);
        }
        $data['os_data'] = array(
            'os_label'=>$os,
            'os_u'=>$os_u,
            'os_ret'=>$os_ret
        );

        $data['os_table'] = $this->model('Report_model')->get_os_table($id);

        $get_browser_data = $this->model('Report_model')->get_browser_data($id);
        $brow = array();
        $brow_all = array();
        $brow_u = array();
        $brow_ret = array();
        foreach($get_browser_data as $brow_data)
        {
            $brow[] = Sanitize::clean($brow_data['pv_browser']);
            $brow_all[] = Sanitize::clean($brow_data['allVisitor']);
            $brow_u[] = Sanitize::clean($brow_data['uniqueVisitor']);
            $brow_ret[] = Sanitize::clean($brow_data['allVisitor']-$brow_data['uniqueVisitor']);
        }
        $data['browser_data'] = array(
            'browser_label'=>$brow,
            'browser_u'=>$brow_u,
            'browser_ret'=>$brow_ret
        );
        $data['browser_table'] = $this->model('Report_model')->get_browser_table($id);

        $get_device_data = $this->model('Report_model')->get_device_data($id);
        $dev = array();
        $dev_all = array();
        $dev_u = array();
        $dev_ret = array();
        foreach($get_device_data as $dev_data)
        {
            $dev[] = Sanitize::clean($dev_data['pv_device']);
            $dev_all[] = Sanitize::clean($dev_data['allVisitor']);
            $dev_u[] = Sanitize::clean($dev_data['uniqueVisitor']);
            $dev_ret[] = Sanitize::clean($dev_data['allVisitor']-$dev_data['uniqueVisitor']);
        }
        $data['device_data'] = array(
            'device_label'=>$dev,
            'device_u'=>$dev_u,
            'device_ret'=>$dev_ret
        );
        $data['device_table'] = $this->model('Report_model')->get_device_table($id);
        $this->view('templates/report-header', $data);
        $this->view('report/sysdev',$data);
        $this->view('templates/report-footer');
    }

    public function pageview($id)
    {
        $data['title']='OJStat Report - Pageviews';
        $data['siteid'] = $id;
        $data['config_info'] = $this->model('Report_model')->get_config_info($id);
        $data['journal_info'] = $this->model('Report_model')->get_journal_info($id);
        $data['duration_avg'] = $this->model('Report_model')->get_avg_duration($id);
        $data['monthly_duration_avg'] = $this->model('Report_model')->get_monthly_dur_avg($id);
        $data['all_pageview'] = $this->model('Report_model')->get_all_dur($id);
        $this->view('templates/report-header', $data);
        $this->view('report/pageview',$data);
        $this->view('templates/report-footer');
    }

}