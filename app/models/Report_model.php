<?php 

class Report_model {
    private $con;
    public function __construct()
    {
        $this->con = new Database;
    }

    public function get_simplehtmldom()
    {
        require_once 'simple_html_dom.php';
    }

    public function get_journal_info($id)
    {
        $get_journal_info = $this->con->query("SELECT * FROM stat_webs WHERE web_siteid = ? LIMIT 1", $id);
        $journal_info = $get_journal_info->fetchArray();
        return $journal_info;
    }

    public function get_user_info($id)
    {
        $get_journal_info = $this->con->query("SELECT * FROM stat_webs WHERE web_siteid = ? LIMIT 1", $id);
        $journal_info = $get_journal_info->fetchArray();
        $get_user_info = $this->con->query("SELECT userrole, roleid, user_fullname, user_img_url, user_email, user_link, user_desc FROM stat_users WHERE userrole = ? AND roleid = ? LIMIT 1", 'user', $journal_info['roleid']);
        $user_info = $get_user_info->fetchArray();
        return $user_info;
    }

    public function get_all_visit($id)
    {
        $get_all_visit = $this->con->query("SELECT pv_ipkey, pv_siteid, pv_date, COUNT(pv_ipkey)AS visit FROM stat_pageviews WHERE pv_siteid = ? GROUP BY pv_date", $id);
        $all_visit = $get_all_visit->fetchAll();
        return $all_visit;
    }

    public function get_visitor_count($id)
    {
        $get_visitor_count = $this->con->query("SELECT pv_ipkey, pv_siteid, COUNT(pv_ipkey)AS allVisitor, COUNT(DISTINCT pv_ipkey)AS uniqueVisitor FROM stat_pageviews WHERE pv_siteid = ?", $id);
        $visitor_count = $get_visitor_count->fetchAll();
        foreach($visitor_count as $vcount)
        {
            $count = array(
                'allVisitor' => $vcount['allVisitor'],
                'uniqueVisitor' => $vcount['uniqueVisitor'],
                'returningVisitor' => $vcount['allVisitor']-$vcount['uniqueVisitor']
            );
        }
        return $count;
    }

    public function get_daily_average($id)
    {
        $get_num_1 = $this->con->query("SELECT pv_ipkey FROM stat_pageviews WHERE pv_siteid = ?", $id);
        $num1 = $get_num_1->numRows();
        $get_num_2 = $this->con->query("SELECT pv_siteid, pv_date FROM stat_pageviews WHERE pv_siteid = ? GROUP BY pv_date", $id);
        $num2 = $get_num_2->numRows();
        $avg = number_format($num1/$num2, 1);
        return $avg;
    }

    public function get_daily_unique_average($id)
    {
        $get_num_1 = $this->con->query("SELECT pv_ipkey FROM stat_pageviews WHERE pv_siteid = ?", $id);
        $num1 = $get_num_1->numRows();
        $get_num_2 = $this->con->query("SELECT DISTINCT pv_ipkey FROM stat_pageviews WHERE pv_siteid = ? GROUP BY pv_date", $id);
        $num2 = $get_num_2->numRows();
        $avg = number_format($num1/$num2, 1);
        return $avg;
    }
    public function get_daily_pageview_average($id)
    {
        $get_num_1 = $this->con->query("SELECT pv_ipkey FROM stat_pageviews WHERE pv_siteid = ?", $id);
        $num1 = $get_num_1->numRows();
        $get_num_2 = $this->con->query("SELECT pv_ipkey FROM stat_pageviews WHERE pv_siteid = ? GROUP BY pv_pagetitle", $id);
        $num2 = $get_num_2->numRows();
        $avg = number_format($num1/$num2, 1);
        return $avg;
    }

    public function get_visitor_map($id)
    {
        $get_map = $this->con->query("SELECT pv_ipkey, pv_siteid, pv_country, COUNT(pv_ipkey) AS Visitor FROM stat_pageviews WHERE pv_siteid = ? GROUP BY pv_country", $id);
        $map = $get_map->fetchAll();
        return $map;
    }

    public function get_top_country($id)
    {
        $get_top_country = $this->con->query("SELECT *, COUNT(pv_ipkey)AS Visitor FROM stat_pageviews WHERE pv_siteid = ? GROUP BY pv_country ORDER BY Visitor DESC LIMIT 10", $id);
        $get_top_country = $get_top_country->fetchAll();
        return $get_top_country;
    }

    public function get_config_info($id)
    {
        $get_config_info = $this->con->query("SELECT * FROM stat_config WHERE siteid = ? LIMIT 1", $id);
        $config_info = $get_config_info->fetchArray();
        $config_array = array(
            'gs' => $config_info['config_gs'],
            'ici' => $config_info['config_ici'],
            'scimago' => $config_info['config_scimago'],
            'vistat' => $config_info['config_vistat'],
            'uniquevis' => $config_info['config_uniquevis'],
            'country' => $config_info['config_country'],
            'pageview' => $config_info['config_pageview'],
            'domain'=> $config_info['config_domain'],
            'system' => $config_info['config_system'],
            'apikey'=>$config_info['config_api_key']
        );
        return $config_array;
    }

    public function get_firstlast($id)
    {
        $get_first = $this->con->query("SELECT pv_date, pv_siteid, pv_id FROM stat_pageviews WHERE pv_siteid = ? ORDER BY pv_id ASC LIMIT 1", $id);
        $first = $get_first->fetchArray();
        $get_last = $this->con->query("SELECT pv_date, pv_siteid, pv_id FROM stat_pageviews WHERE pv_siteid = ? ORDER BY pv_id DESC LIMIT 1", $id);
        $last = $get_last->fetchArray();
        $firstlast = array(
            'first' => date('F d, Y', strtotime($first['pv_date'])),
            'last' => date('F d, Y', strtotime($last['pv_date']))
        );
        return $firstlast;
    }

    public function get_scimago_data($id)
    {
        $get_scimago_id = $this->con->query("SELECT web_siteid, web_scimago FROM stat_webs WHERE web_siteid = ? LIMIT 1", $id);
        $scimago_id = $get_scimago_id->fetchArray();
        $scimagoid = $scimago_id['web_scimago'];
        $scimagourl = "https://www.scimagojr.com/journalsearch.php?q=$scimagoid&tip=sid&clean=0";
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
    }

    public function get_ici_data($id)
    {
        $get_ici_id = $this->con->query("SELECT web_siteid, web_ici FROM stat_webs WHERE web_siteid = ? LIMIT 1", $id);
        $ici_id = $get_ici_id->fetchArray();
        $iciid = $ici_id['web_ici'];
        $ici_url = "https://journals.indexcopernicus.com/api/journalRating/getRates/$iciid/ICV";
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
    }

    public function get_gs_data($id)
    {
        $this->get_simplehtmldom();
        $get_gs_id = $this->con->query("SELECT web_siteid, web_gscholarid FROM stat_webs WHERE web_siteid = ? LIMIT 1", $id);
        $gs_id = $get_gs_id->fetchArray();
        $gsid = $gs_id['web_gscholarid'];
        $get_gs_type = $this->con->query("SELECT siteid, config_gs_type FROM stat_config WHERE siteid = ? LIMIT 1", $id);
        $gs_type = $get_gs_type->fetchArray();
        $gstype = $gs_type['config_gs_type'];
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
    }

    public function get_all_visit_report($id)
    {
        $get_all_visit = $this->con->query("SELECT pv_ipkey, pv_siteid, pv_date, COUNT(pv_ipkey)AS allVisitor, COUNT(DISTINCT pv_ipkey)AS uniqueVisitor FROM stat_pageviews WHERE pv_siteid = ? GROUP BY pv_date", $id);
        $all_visit = $get_all_visit->fetchAll();
        return $all_visit;
    }

    public function get_visitor_this_month($id)
    {
        $thismonth = date('m');
        $thisyear = date('Y');

        $get_this_month_visit = $this->con->query("SELECT pv_ipkey, pv_siteid, pv_date, COUNT(pv_ipkey)AS thisallVisitor, COUNT(DISTINCT pv_ipkey)AS thisuniqueVisitor FROM stat_pageviews WHERE pv_siteid = ? AND YEAR(pv_date) = ? AND MONTH(pv_date)=? GROUP BY pv_date", $id,$thisyear,$thismonth);
        $this_month_visit = $get_this_month_visit->fetchAll();

        return $this_month_visit;
    }

    public function get_monthly_visit($id)
    {
        $year = date('Y');
        $get_monthly_visit = $this->con->query("SELECT pv_ipkey, pv_siteid, pv_date, COUNT(MONTH(pv_date))AS allVisitor, COUNT(DISTINCT pv_ipkey)AS uniqueVisitor FROM stat_pageviews WHERE pv_siteid= ? AND YEAR(pv_date)= ? GROUP BY MONTH(pv_date)", $id, $year);
        $monthly_visit = $get_monthly_visit->fetchAll();
        return $monthly_visit;
    }

    public function get_yearly_visit($id)
    {
        $get_yearly_visit = $this->con->query("SELECT pv_date, pv_siteid, COUNT(pv_ipkey)AS allVisitor, COUNT(DISTINCT pv_ipkey)AS uniqueVisitor FROM stat_pageviews WHERE pv_siteid = ? GROUP BY YEAR(pv_date)", $id);
        $yearly_visit = $get_yearly_visit->fetchAll();
        return $yearly_visit;
    }

    public function get_visit_table($id)
    {
        $get_visit_table = $this->con->query("SELECT pv_ipkey, pv_date, pv_time, pv_siteid, COUNT(pv_ipkey)AS allVisitor, COUNT(DISTINCT pv_ipkey)AS uniqueVisitor FROM stat_pageviews WHERE pv_siteid = ? GROUP BY pv_date", $id);
        $visit_table = $get_visit_table->fetchAll();
        return $visit_table;
    }
    
    public function get_visit_duration($id)
    {
        $get_visit_duration = $this->con->query("SELECT pv_siteid, pv_date, pv_time, pv_ipkey, COUNT(pv_ipkey)AS allVisitor, COUNT(DISTINCT pv_ipkey)AS uniqueVisitor FROM stat_pageviews WHERE pv_siteid = ? GROUP BY pv_date, hour(pv_time)", $id);
        $visit_duration = $get_visit_duration->fetchAll();
        return $visit_duration;
    }

    public function get_monthly_avg($id)
    {
        $year = date('Y');
        $months = array();
        $month = array();
        $monthlyAllAvg = array();
        $monthlyUniqueAvg = array();
        $monthlyRetAvg = array();
        $get_date_amount = $this->con->query("SELECT pv_date, pv_siteid, COUNT(DISTINCT pv_date)AS dateAmount FROM stat_pageviews WHERE pv_siteid=? AND YEAR(pv_date)=? GROUP BY MONTH(pv_date)", $id, $year);
        $date_amount = $get_date_amount->fetchAll();
        
        $get_monthly_visit = $this->con->query("SELECT pv_ipkey, pv_date, pv_siteid, COUNT(pv_ipkey)AS allVisitor, COUNT(DISTINCT pv_ipkey)AS uniqueVisitor FROM stat_pageviews WHERE pv_siteid = ? AND YEAR(pv_date)=? GROUP BY MONTH(pv_date)", $id, $year);

        $monthly_visit = $get_monthly_visit->fetchAll();
        foreach($monthly_visit as $visit)
        {
            $month[]=date('F', strtotime($visit['pv_date']));
            $monthlyAllAvg[]=$visit['allVisitor'];
            $monthlyUniqueAvg[]=$visit['uniqueVisitor'];
            $monthlyRetAvg[]=($visit['allVisitor']-$visit['uniqueVisitor']);
        }
        $unAvg = array();
        $retAvg = array();
        for($i=0;$i<count($date_amount);$i++)
        {
            $unAvg[] = number_format($monthlyUniqueAvg[$i]/$date_amount[$i]['dateAmount'],1);
            $retAvg[] = number_format($monthlyRetAvg[$i]/$date_amount[$i]['dateAmount'],1);
        }
        $return = array(
            'month'=>Sanitize::cleanAll($month),
            'unAvg'=>Sanitize::cleanAll($unAvg),
            'retAvg'=>Sanitize::cleanAll($retAvg)
        );
        // return $date_amount;
        return $return;
        
    }

    public function get_yearly_avg($id)
    {
        $year = array();
        $yearlyAllAvg = array();
        $yearlyUniqueAvg = array();
        $yearlyRetAvg = array();
        $get_month_amount = $this->con->query("SELECT pv_date, pv_siteid, COUNT(DISTINCT MONTH(pv_date))AS monthAmount FROM stat_pageviews WHERE pv_siteid=? GROUP BY YEAR(pv_date)", $id);
        $month_amount = $get_month_amount->fetchAll();
        
        $get_yearly_visit = $this->con->query("SELECT pv_ipkey, pv_date, pv_siteid, COUNT(pv_ipkey)AS allVisitor, COUNT(DISTINCT pv_ipkey)AS uniqueVisitor FROM stat_pageviews WHERE pv_siteid = ? GROUP BY YEAR(pv_date)", $id);

        $yearly_visit = $get_yearly_visit->fetchAll();
        foreach($yearly_visit as $visit)
        {
            $year[]=date('Y', strtotime($visit['pv_date']));
            $yearlyAllAvg[]=$visit['allVisitor'];
            $yearlyUniqueAvg[]=$visit['uniqueVisitor'];
            $yearlyRetAvg[]=($visit['allVisitor']-$visit['uniqueVisitor']);
        }
        $unAvg = array();
        $retAvg = array();
        for($i=0;$i<count($month_amount);$i++)
        {
            $unAvg[] = number_format($yearlyUniqueAvg[$i]/$month_amount[$i]['monthAmount'],1);
            $retAvg[] = number_format($yearlyRetAvg[$i]/$month_amount[$i]['monthAmount'],1);
        }
        $return = array(
            'year'=>Sanitize::cleanAll($year),
            'unAvg'=>Sanitize::cleanAll($unAvg),
            'retAvg'=>Sanitize::cleanAll($retAvg)
        );
        // return $date_amount;
        return $return;   
    }

    public function get_countries($id)
    {
        $get_countries = $this->con->query("SELECT pv_ipkey, pv_siteid, pv_city, pv_countrycode, pv_country,pv_region, COUNT(pv_ipkey)AS allVisitor, COUNT(DISTINCT pv_ipkey)AS uniqueVisitor FROM stat_pageviews WHERE pv_siteid = ? GROUP BY pv_country", $id);
        $countries = $get_countries->fetchAll();
        return $countries;
    }

    public function get_regions($id)
    {
        $get_regions = $this->con->query("SELECT pv_ipkey, pv_siteid, pv_city, pv_countrycode, pv_country,pv_region, COUNT(pv_ipkey)AS allVisitor, COUNT(DISTINCT pv_ipkey) AS uniqueVisitor FROM stat_pageviews WHERE pv_siteid = ? GROUP BY pv_region", $id);
        $regions = $get_regions->fetchAll();
        return $regions;
    }

    public function get_cities($id)
    {
        $get_cities = $this->con->query("SELECT pv_ipkey, pv_siteid, pv_city, pv_countrycode, pv_country,pv_region, COUNT(pv_ipkey)AS allVisitor, COUNT(DISTINCT pv_ipkey) AS uniqueVisitor FROM stat_pageviews WHERE pv_siteid = ? GROUP BY pv_city", $id);
        $cities = $get_cities->fetchAll();
        return $cities;
    }

    public function get_isp($id)
    {
        $get_isp = $this->con->query("SELECT pv_ipkey, pv_siteid, pv_isp, COUNT(pv_ipkey)AS allVisitor, COUNT(DISTINCT pv_ipkey) AS uniqueVisitor FROM stat_pageviews WHERE pv_siteid = ? AND pv_isp !='' GROUP BY pv_isp", $id);
        $isp = $get_isp->fetchAll();
        return $isp;
    }

    public function get_traffic_data($id)
    {
        $get_ref = $this->con->query("SELECT pv_ipkey, pv_siteid, pv_ref_name, COUNT(pv_ipkey)AS allVisitor, COUNT(DISTINCT pv_ipkey)AS uniqueVisitor FROM stat_pageviews WHERE pv_siteid = ? GROUP BY pv_ref_name", $id);
        $ref = $get_ref->fetchAll();
        return $ref;
    }

    public function get_ten_top_domains($id)
    {
        $get_ref = $this->con->query("SELECT pv_ipkey, pv_siteid, pv_ref_dom, COUNT(pv_ipkey)AS allVisitor, COUNT(DISTINCT pv_ipkey)AS uniqueVisitor FROM stat_pageviews WHERE pv_siteid = ? GROUP BY pv_ref_dom ORDER BY allVisitor DESC LIMIT 10", $id);
        $ref = $get_ref->fetchAll();
        return $ref;
    }

    public function top_networks($id)
    {
        $get_google = $this->con->query("SELECT pv_ref_dom, pv_siteid FROM stat_pageviews WHERE pv_siteid = ? AND pv_ref_dom LIKE '%google%'", $id);
        $google = $get_google->numRows();
        $get_yahoo = $this->con->query("SELECT pv_ref_dom, pv_siteid FROM stat_pageviews WHERE pv_siteid = ? AND pv_ref_dom LIKE '%yahoo%'", $id);
        $yahoo = $get_yahoo->numRows();
        $get_facebook = $this->con->query("SELECT pv_ref_dom, pv_siteid FROM stat_pageviews WHERE pv_siteid = ? AND pv_ref_dom LIKE '%facebook%'", $id);
        $facebook = $get_facebook->numRows();
        $get_twitter = $this->con->query("SELECT pv_ref_dom, pv_siteid FROM stat_pageviews WHERE pv_siteid = ? AND pv_ref_dom LIKE '%twitter%'", $id);
        $twitter = $get_twitter->numRows();
        $get_instagram = $this->con->query("SELECT pv_ref_dom, pv_siteid FROM stat_pageviews WHERE pv_siteid = ? AND pv_ref_dom LIKE '%instagram%'", $id);
        $instagram = $get_instagram->numRows();
        $get_yandex = $this->con->query("SELECT pv_ref_dom, pv_siteid FROM stat_pageviews WHERE pv_siteid = ? AND pv_ref_dom LIKE '%yandex%'", $id);
        $yandex = $get_yandex->numRows();

        $networks = array(
            'networks'=>array('\uf1a0', '\uf19e', '\uf413', '\uf09a', '\uf099', '\ue055' ),
            'counts'=>array($google, $yahoo, $yandex , $facebook, $twitter, $instagram)
        );
        return $networks;
    }

    public function get_all_traffic_data($id)
    {
        $get_ref = $this->con->query("SELECT pv_ipkey, pv_siteid, pv_ref_dom, COUNT(pv_ipkey)AS allVisitor, COUNT(DISTINCT pv_ipkey)AS uniqueVisitor FROM stat_pageviews WHERE pv_siteid = ? GROUP BY pv_ref_dom", $id);
        $ref = $get_ref->fetchAll();
        return $ref;
    }
   
    public function get_os_data($id)
    {
        $get_os = $this->con->query("SELECT pv_ipkey, pv_siteid, pv_os, COUNT(pv_ipkey)AS allVisitor, COUNT(DISTINCT pv_ipkey)AS uniqueVisitor FROM stat_pageviews WHERE pv_siteid = ? GROUP BY pv_os ORDER BY allVisitor DESC", $id);
        $os = $get_os->fetchAll();
        return $os;
    }

    public function get_os_table($id)
    {
        $get_os_table = $this->con->query("SELECT pv_os, pv_siteid, COUNT(pv_ipkey)AS allVisitor, COUNT(DISTINCT pv_ipkey)AS uniqueVisitor FROM stat_pageviews WHERE pv_siteid = ? GROUP BY pv_os", $id);
        $os_table = $get_os_table->fetchAll();
        return $os_table;
    }

    public function get_browser_data($id)
    {
        $get_brow = $this->con->query("SELECT pv_ipkey, pv_siteid, pv_browser, COUNT(pv_ipkey)AS allVisitor, COUNT(DISTINCT pv_ipkey)AS uniqueVisitor FROM stat_pageviews WHERE pv_siteid = ? GROUP BY pv_browser ORDER BY allVisitor DESC", $id);
        $brow = $get_brow->fetchAll();
        return $brow;
    }

    public function get_browser_table($id)
    {
        $get_browser_table = $this->con->query("SELECT pv_browser, pv_siteid, COUNT(pv_ipkey)AS allVisitor, COUNT(DISTINCT pv_ipkey)AS uniqueVisitor FROM stat_pageviews WHERE pv_siteid = ? GROUP BY pv_browser", $id);
        $browser_table = $get_browser_table->fetchAll();
        return $browser_table;
    }

    public function get_device_data($id)
    {
        $get_dev = $this->con->query("SELECT pv_ipkey, pv_siteid, pv_device, COUNT(pv_ipkey)AS allVisitor, COUNT(DISTINCT pv_ipkey)AS uniqueVisitor FROM stat_pageviews WHERE pv_siteid = ? GROUP BY pv_device ORDER BY allVisitor DESC", $id);
        $dev = $get_dev->fetchAll();
        return $dev;
    }

    public function get_device_table($id)
    {
        $get_device_table = $this->con->query("SELECT pv_device, pv_siteid, COUNT(pv_ipkey)AS allVisitor, COUNT(DISTINCT pv_ipkey)AS uniqueVisitor FROM stat_pageviews WHERE pv_siteid = ? GROUP BY pv_device", $id);
        $device_table = $get_device_table->fetchAll();
        return $device_table;
    }

    public function get_avg_duration($id)
    {
        $get_avg_dur = $this->con->query("SELECT pv_duration, pv_siteid, AVG(pv_duration)AS avgDuration FROM stat_pageviews WHERE pv_siteid = ? GROUP BY pv_ipkey", $id);
        $avg_dur = $get_avg_dur->fetchArray();
        return $avg_dur['avgDuration'];
    }

    public function get_monthly_dur_avg($id)
    {
        $year = date('Y');
        $get_dur_avg = $this->con->query("SELECT pv_siteid, pv_date, AVG(pv_duration)AS monthlyAvg FROM stat_pageviews WHERE pv_siteid = ? AND YEAR(pv_date)=? GROUP BY MONTH(pv_date)", $id, $year);
        $dur_avg = $get_dur_avg->fetchAll();
        return $dur_avg;
    }

    public function get_all_dur($id)
    {
        $get_all_dur = $this->con->query("SELECT pv_pagetitle, pv_siteid, pv_duration, AVG(pv_duration)AS pageDur, COUNT(pv_ipkey)AS allVisitor, COUNT(DISTINCT pv_ipkey)AS uniqueVisitor FROM stat_pageviews WHERE pv_siteid = ? GROUP BY pv_pagetitle", $id);
        $all_dur = $get_all_dur->fetchAll();
        return $all_dur;
    }
}