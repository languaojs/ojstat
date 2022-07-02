<?php 
class Statistics_model {
    private $con;
    public function __construct()
    {
        $this->con = new Database;
    }

    public function get_simplehtmldom()
    {
        require_once 'simple_html_dom.php';
    }

    public function get_config($id)
    {
        $get_config = $this->con->query("SELECT * FROM stat_config WHERE siteid = ? LIMIT 1", $id);
        $config = $get_config->fetchArray();
        return $config;
    }
    public function get_metric_id($id)
    {
        $get_id = $this->con->query("SELECT * FROM stat_webs WHERE web_siteid = ? LIMIT 1", $id);
        $metric_id = $get_id->fetchArray();
        return $metric_id;
    }

    public function get_scimago_data($id)
    {
        $get_id = $this->get_metric_id($id);
        $scimago_id = $get_id['web_scimago'];

        if($scimago_id !=='')
        {
            $scimagourl = "https://www.scimagojr.com/journalsearch.php?q=$scimago_id&tip=sid&clean=0";
            $scimagocurl = curl_init();
            curl_setopt($scimagocurl, CURLOPT_URL, $scimagourl);
            curl_setopt($scimagocurl, CURLOPT_HEADER, 0);
            curl_setopt($scimagocurl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($scimagocurl, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($scimagocurl, CURLOPT_CONNECTTIMEOUT, 100);
            curl_setopt($scimagocurl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($scimagocurl, CURLOPT_REFERER, $scimagourl);
            $scimagoResult = curl_exec($scimagocurl);
            curl_close($scimagocurl);

            $this->get_simplehtmldom();

            $scimagohtml = new simple_html_dom();
            $scimagohtml->load($scimagoResult);

            $scimagodata1 = array();
            $scimagodata2 = array();
            $scimagodata3 = array();

            foreach($scimagohtml->find('h1')as $scimagoelement){
                $scimagodata1[]=$scimagoelement->plaintext;
            }
            foreach($scimagohtml->find('p')as $scimagoelement){
                $scimagodata2[]=$scimagoelement->plaintext;
            }
            foreach($scimagohtml->find('img.imgwidget')as $scimagoelement){
                $scimagodata3[]=$scimagoelement->src;
            }

            $scimago_data = array(
                'name'=>$scimagodata1[0],
                'issn'=>$scimagodata2[5],
                'publisher'=>$scimagodata2[2],
                'url'=>$scimagodata3[0],
                'hindex'=>$scimagodata2[3]
            );

            return $scimago_data;
        }else{
            $scimago_data = "This journal does not have Scimago ID yet";
            return $scimago_data;
        }
    }

    public function get_ici_data($id)
    {
        $get_ici_id = $this->get_metric_id($id);
        $ici_id = $get_ici_id['web_ici'];
        if($ici_id !=='')
        {
            $ici_url = "https://journals.indexcopernicus.com/api/journalRating/getRates/$ici_id/ICV";
            $chici = curl_init();
            $urlici = $ici_url;
            curl_setopt($chici, CURLOPT_URL, $urlici);
            curl_setopt($chici, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($chici, CURLOPT_HEADER, 0);
            curl_setopt($chici, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($chici, CURLOPT_CONNECTTIMEOUT, 100);
            curl_setopt($chici, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($chici, CURLOPT_REFERER, $urlici);
            $resultici = curl_exec($chici);
            if (curl_errno($chici)) { echo curl_error($chici); }
            else {
            $decodedici = json_decode($resultici, true);
            }
            curl_close($chici);

            $data_label = array();
            $data_set = array();

            foreach ($decodedici as $datainit)
            {
            $data_label[] = $datainit['year'];
            $data_set[] = $datainit['valueNum'];
            }

            $metric_data = array(
                'year'=>$data_label,
                'value'=>$data_set
            );

            return $metric_data;
        }else{
            $metric_data = 'This journal does not have Index Copernicus ID';
            return $metric_data;
        }
    }

    public function get_gs_data($id)
    {
        $get_gs_id = $this->get_metric_id($id);
        $gsid = $get_gs_id['web_gscholarid'];
        $get_gs_type = $this->get_config($id);
        $gstype = $get_gs_type['config_gs_type'];
        $this->get_simplehtmldom();
        if($gsid !=='')
        {
            if($gstype=='user'){
                $lang="en";
                $pagesize=100;
                $gsurl = "https://scholar.google.com/citations?view_op=list_works&hl=".$lang."&user=".$gsid."&pagesize=".$pagesize;
                $gscurl = curl_init();
                curl_setopt($gscurl, CURLOPT_URL, $gsurl);
                curl_setopt($gscurl, CURLOPT_HEADER, 0);
                curl_setopt($gscurl, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($gscurl, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($gscurl, CURLOPT_CONNECTTIMEOUT, 100);
                curl_setopt($gscurl, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($gscurl, CURLOPT_REFERER, $gsurl);
                $gsResult = curl_exec($gscurl);
                curl_close($gscurl);
                $gshtml = new simple_html_dom();
                $gshtml->load($gsResult);
                $gsdata1 = array();
                $gsdata2 = array();
                $gsdata3 = array();
                foreach($gshtml->find('.gsc_g_al')as $gselement){
                    $gsdata1[]=$gselement->plaintext;
                }
                foreach($gshtml->find('.gsc_g_t')as $gselement){
                    $gsdata2[]=$gselement->plaintext;
                }
                foreach($gshtml->find('.gsc_rsb_std')as $gselement){
                    $gsdata3[]=$gselement->plaintext;
                }
    
                $metric_data = array(
                    'type'=>'user',
                    'total'=>$gsdata3[0],
                    'hindex'=>$gsdata3[2],
                    'i10index'=>$gsdata3[4],
                    'year'=>$gsdata2,
                    'value'=>$gsdata1
                );
    
                return $metric_data;
            }elseif($gstype=='journal'){
                $nowYear = date('Y');
                $years = array ($nowYear-1, $nowYear-2, $nowYear-3);
                $h5year = array();
                $h5index = array();
                $h5median = array();
                $gs_lang="en";
                foreach($years as $year){
                    $gsurl = "https://scholar.google.com/citations?hl=$gs_lang&view_op=list_hcore&venue=$gsid.$year";
                    $gscurl = curl_init();
                    curl_setopt($gscurl, CURLOPT_URL, $gsurl);
                    curl_setopt($gscurl, CURLOPT_HEADER, 0);
                    curl_setopt($gscurl, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($gscurl, CURLOPT_FOLLOWLOCATION, 1);
                    curl_setopt($gscurl, CURLOPT_CONNECTTIMEOUT, 100);
                    curl_setopt($gscurl, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($gscurl, CURLOPT_REFERER, $gsurl);
                    $gsResult = curl_exec($gscurl);
                    curl_close($gscurl);
                    $gshtml = new simple_html_dom();
                    $gshtml->load($gsResult);
                    $gsdata1 = array();
                    $gsdata2 = array();
                    $gsdata3 = array();
                    foreach($gshtml->find('.gsc_mp_anchor')as $gselement){
                        $gsdata1[]=$gselement->plaintext;
                    }
                    foreach($gshtml->find('p')as $gselement){
                        $gsdata2[]=$gselement->plaintext;
                    }
                    foreach($gshtml->find('span')as $gselement){
                        $gsdata3[]=$gselement->plaintext;
                    }
                    $h5year[]=$year;
                    $h5index[]=$gsdata3['34'];
                    $h5median[]=$gsdata3['35'];
                }
                $metric_data = array(
                    'type'=>'journal',
                    'h5year'=>$h5year,
                    'h5index'=>$h5index,
                    'h5median'=>$h5median
                );
                return $metric_data;
            }
        }else{
            $metric_data = 'This journal does not have Google Scholar ID';
            return $metric_data;
        }
        
    }
    
    public function get_daily_visit($id)
    {
        $get_daily_visit = $this->con->query("SELECT *, COUNT(pv_ipkey)AS allVisitor, COUNT(DISTINCT pv_ipkey)AS uniqueVisitor FROM stat_pageviews WHERE pv_siteid = ? GROUP BY DATE(pv_date)", $id);
        $daily_visit = $get_daily_visit->fetchAll();
        
        return $daily_visit;
    }
    public function get_monthly_visit($id)
    {
        $year = date('Y');
        $get_monthly_visit = $this->con->query("SELECT *, COUNT(MONTH(pv_date))AS allVisitor, COUNT(DISTINCT pv_ipkey)AS uniqueVisitor FROM stat_pageviews WHERE pv_siteid= ? AND YEAR(pv_date)= ? GROUP BY MONTH(pv_date)", $id, $year);
        $monthly_visit = $get_monthly_visit->fetchAll();
        return $monthly_visit;
    }
    public function get_yearly_visit($id)
    {
        $get_yearly_visit = $this->con->query("SELECT pv_date, pv_siteid, COUNT(pv_ipkey)AS allVisitor, COUNT(DISTINCT pv_ipkey)AS uniqueVisitor FROM stat_pageviews WHERE pv_siteid = ? GROUP BY YEAR(pv_date)", $id);
        $yearly_visit = $get_yearly_visit->fetchAll();
        return $yearly_visit;
    }
    public function get_visit_chart($id)
    {
        $get_chart_data = $this->con->query("SELECT *,COUNT(pv_ipkey)AS Visitor FROM stat_pageviews WHERE pv_siteid = ? GROUP BY DATE(pv_date)", $id);
        $chart_data = $get_chart_data->fetchAll();
        return $chart_data;
    }
    public function get_today_visit($id)
    {
        $today = date('Y-m-d');
        $get_today_visit = $this->con->query("SELECT pv_ipkey FROM stat_pageviews WHERE pv_siteid = ? AND DATE(pv_date) = '$today'", $id);
        $today_visit = $get_today_visit->numRows();
        return $today_visit;
    }
    public function get_average_visit($id)
    {
        $get_num_1 = $this->con->query("SELECT pv_ipkey FROM stat_pageviews WHERE pv_siteid = ?", $id);
        $num1 = $get_num_1->numRows();
        $get_num_2 = $this->con->query("SELECT * FROM stat_pageviews WHERE pv_siteid = ? GROUP BY pv_date", $id);
        $num2 = $get_num_2->numRows();
        $avg = number_format($num1/$num2, 0);
        return $avg;
    }

    public function get_map($id)
    {
        $get_map = $this->con->query("SELECT *, COUNT(DISTINCT pv_ipkey) AS uniqueVisitor FROM stat_pageviews WHERE pv_siteid = ? GROUP BY pv_country", $id);
        $map = $get_map->fetchAll();
        return $map;
    }
    public function get_top_country($id)
    {
        $get_top_country = $this->con->query("SELECT *, COUNT(pv_ipkey)AS Visitor FROM stat_pageviews WHERE pv_siteid = ? GROUP BY pv_country ORDER BY Visitor DESC LIMIT 10", $id);
        $get_top_country = $get_top_country->fetchAll();
        return $get_top_country;
    }
    public function get_countries($id)
    {
        $get_countries = $this->con->query("SELECT *, COUNT(pv_ipkey)AS allVisitor, COUNT(DISTINCT pv_ipkey)AS uniqueVisitor FROM stat_pageviews WHERE pv_siteid = ? GROUP BY pv_country", $id);
        $countries = $get_countries->fetchAll();
        return $countries;
    }
    public function get_cities($id)
    {
        $get_cities = $this->con->query("SELECT *, COUNT(pv_ipkey)AS allVisitor, COUNT(DISTINCT pv_ipkey) AS uniqueVisitor FROM stat_pageviews WHERE pv_siteid = ? GROUP BY pv_city", $id);
        $cities = $get_cities->fetchAll();
        return $cities;
    }
    public function get_traffic($id)
    {
        $get_traffic = $this->con->query("SELECT *, COUNT(pv_ipkey)AS allVisitor, COUNT(DISTINCT pv_ipkey)AS uniqueVisitor FROM stat_pageviews WHERE pv_siteid = ? GROUP BY pv_ref_dom", $id);
        $traffic = $get_traffic->fetchAll();
        return $traffic;
    }
    public function get_traffic_google($id)
    {
        $get_traffic_google = $this->con->query("SELECT pv_siteid, pv_ref_dom FROM stat_pageviews WHERE pv_siteid = ? AND pv_ref_dom LIKE '%google%'", $id);
        $traffic_google = $get_traffic_google->numRows();
        return $traffic_google;
    }
    public function get_traffic_yahoo($id)
    {
        $get_traffic_yahoo = $this->con->query("SELECT pv_siteid, pv_ref_dom FROM stat_pageviews WHERE pv_siteid = ? AND pv_ref_dom LIKE '%yahoo%'", $id);
        $traffic_yahoo = $get_traffic_yahoo->numRows();
        return $traffic_yahoo;
    }
    public function get_traffic_facebook($id)
    {
        $get_traffic_facebook = $this->con->query("SELECT pv_siteid, pv_ref_dom FROM stat_pageviews WHERE pv_siteid = ? AND pv_ref_dom LIKE '%facebook%'", $id);
        $traffic_facebook = $get_traffic_facebook->numRows();
        return $traffic_facebook;
    }
    public function get_traffic_twitter($id)
    {
        $get_traffic_twitter = $this->con->query("SELECT pv_siteid, pv_ref_dom FROM stat_pageviews WHERE pv_siteid = ? AND pv_ref_dom LIKE '%twitter%'", $id);
        $traffic_twitter = $get_traffic_twitter->numRows();
        return $traffic_twitter;
    }
    public function get_traffic_yandex($id)
    {
        $get_traffic_yandex = $this->con->query("SELECT pv_siteid, pv_ref_dom FROM stat_pageviews WHERE pv_siteid = ? AND pv_ref_dom LIKE '%yandex%'", $id);
        $traffic_yandex = $get_traffic_yandex->numRows();
        return $traffic_yandex;
    }
    public function get_traffic_bing($id)
    {
        $get_traffic_bing = $this->con->query("SELECT pv_siteid, pv_ref_dom FROM stat_pageviews WHERE pv_siteid = ? AND pv_ref_dom LIKE '%bing%'", $id);
        $traffic_bing = $get_traffic_bing->numRows();
        return $traffic_bing;
    }
    public function get_system($id)
    {
        $get_system = $this->con->query("SELECT pv_siteid, pv_os, COUNT(pv_ipkey)AS allVisitor, COUNT(DISTINCT pv_ipkey)AS uniqueVisitor FROM stat_pageviews WHERE pv_siteid = ? GROUP BY pv_os ORDER BY allVisitor DESC", $id);
        $system = $get_system->fetchAll();
        return $system;
    }
    public function get_device($id)
    {
        $get_device = $this->con->query("SELECT pv_siteid, pv_device, COUNT(pv_ipkey)AS allVisitor, COUNT(DISTINCT pv_ipkey)AS uniqueVisitor FROM stat_pageviews WHERE pv_siteid = ? GROUP BY pv_device ORDER BY allVisitor DESC", $id);
        $device = $get_device->fetchAll();
        return $device;
    }
    public function get_browser($id)
    {
        $get_browser = $this->con->query("SELECT pv_siteid, pv_browser, COUNT(pv_ipkey)AS allVisitor, COUNT(DISTINCT pv_ipkey)AS uniqueVisitor FROM stat_pageviews WHERE pv_siteid = ? GROUP BY pv_browser ORDER BY allVisitor DESC", $id);
        $browser = $get_browser->fetchAll();
        return $browser;
    }
    public function get_pageview($id)
    {
        $get_pageview = $this->con->query("SELECT pv_siteid, pv_pagetitle, COUNT(pv_ipkey)AS allVisitor, COUNT(DISTINCT pv_ipkey)AS uniqueVisitor, SUM(pv_duration)AS visitDuration FROM stat_pageviews WHERE pv_siteid = ? GROUP BY pv_pagetitle", $id);
        $pageview = $get_pageview->fetchAll();
        return $pageview;
    }
    public function get_last($id)
    {
        $get_last = $this->con->query("SELECT * FROM stat_pageviews WHERE pv_siteid = ? ORDER BY pv_id DESC LIMIT 1", $id);
        $last = $get_last->fetchArray();
        return $last;
    }
}