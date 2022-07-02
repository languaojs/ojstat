<?php 

class Widget_model {
    private $con;
    public function __construct()
    {
        $this->con = new Database;
    }

    public function get_visit_chart($id)
    {
        $get_data = $this->con->query("SELECT pv_ipkey, pv_siteid, pv_date, COUNT(pv_ipkey)AS allVisitor, COUNT(DISTINCT pv_ipkey)AS uniqueVisitor FROM stat_pageviews WHERE pv_siteid = ? GROUP BY pv_date", $id);
        $data = $get_data->fetchAll();
        return $data;
    }

    public function get_visit_table($id)
    {
        $get_data = $this->con->query("SELECT pv_ipkey, pv_siteid, pv_date, COUNT(pv_ipkey)AS allVisitor, COUNT(DISTINCT pv_ipkey)AS uniqueVisitor FROM stat_pageviews WHERE pv_siteid = ? GROUP BY pv_date", $id);
        $data = $get_data->fetchAll();
        return $data;
    }

    public function get_country_chart($id)
    {
        $get_data = $this->con->query("SELECT pv_ipkey, pv_siteid, pv_country, COUNT(pv_ipkey)AS allVisitor, COUNT(DISTINCT pv_ipkey)AS uniqueVisitor FROM stat_pageviews WHERE pv_siteid = ? GROUP BY pv_country", $id);
        $data = $get_data->fetchAll();
        return $data;
    }
    public function get_country_table($id)
    {
        $get_data = $this->con->query("SELECT pv_ipkey, pv_siteid, pv_country, pv_countrycode, COUNT(pv_ipkey)AS allVisitor, COUNT(DISTINCT pv_ipkey)AS uniqueVisitor FROM stat_pageviews WHERE pv_siteid = ? GROUP BY pv_country", $id);
        $data = $get_data->fetchAll();
        return $data;
    }

    public function get_domain_chart($id)
    {
        $get_data = $this->con->query("SELECT pv_ipkey, pv_siteid, pv_ref_dom, COUNT(pv_ipkey)AS allVisitor, COUNT(DISTINCT pv_ipkey)AS uniqueVisitor FROM stat_pageviews WHERE pv_siteid = ? GROUP BY pv_ref_dom", $id);
        $data = $get_data->fetchAll();
        return $data;
    }
    public function get_domain_table($id)
    {
        $get_data = $this->con->query("SELECT pv_ipkey, pv_siteid, pv_ref_dom, pv_ref_name, COUNT(pv_ipkey)AS allVisitor, COUNT(DISTINCT pv_ipkey)AS uniqueVisitor FROM stat_pageviews WHERE pv_siteid = ? GROUP BY pv_ref_dom", $id);
        $data = $get_data->fetchAll();
        return $data;
    }
    public function get_system_chart($id)
    {
        $get_data = $this->con->query("SELECT pv_ipkey, pv_siteid, pv_os, COUNT(pv_ipkey)AS allVisitor, COUNT(DISTINCT pv_ipkey)AS uniqueVisitor FROM stat_pageviews WHERE pv_siteid = ? GROUP BY pv_os", $id);
        $data = $get_data->fetchAll();
        return $data;
    }
    public function get_system_table($id)
    {
        $get_data = $this->con->query("SELECT pv_ipkey, pv_siteid, pv_os, COUNT(pv_ipkey)AS allVisitor, COUNT(DISTINCT pv_ipkey)AS uniqueVisitor FROM stat_pageviews WHERE pv_siteid = ? GROUP BY pv_os", $id);
        $data = $get_data->fetchAll();
        return $data;
    }
    public function get_browser_chart($id)
    {
        $get_data = $this->con->query("SELECT pv_ipkey, pv_siteid, pv_browser, COUNT(pv_ipkey)AS allVisitor, COUNT(DISTINCT pv_ipkey)AS uniqueVisitor FROM stat_pageviews WHERE pv_siteid = ? GROUP BY pv_browser", $id);
        $data = $get_data->fetchAll();
        return $data;
    }
    public function get_browser_table($id)
    {
        $get_data = $this->con->query("SELECT pv_ipkey, pv_siteid, pv_browser, COUNT(pv_ipkey)AS allVisitor, COUNT(DISTINCT pv_ipkey)AS uniqueVisitor FROM stat_pageviews WHERE pv_siteid = ? GROUP BY pv_browser", $id);
        $data = $get_data->fetchAll();
        return $data;
    }
    public function get_device_chart($id)
    {
        $get_data = $this->con->query("SELECT pv_ipkey, pv_siteid, pv_device, COUNT(pv_ipkey)AS allVisitor, COUNT(DISTINCT pv_ipkey)AS uniqueVisitor FROM stat_pageviews WHERE pv_siteid = ? GROUP BY pv_device", $id);
        $data = $get_data->fetchAll();
        return $data;
    }
    public function get_gs_chart($id)
    {
        $get_gs_id = $this->con->query("SELECT * FROM stat_webs WHERE web_siteid = ? LIMIT 1", $id);
        $gs_id = $get_gs_id->fetchArray();
        $get_gs_type = $this->con->query("SELECT * FROM stat_config WHERE siteid = ? LIMIT 1", $id);
        $gs_type = $get_gs_type->fetchArray();
        $data = array(
            'gs_type'=>$gs_type['config_gs_type'],
            'gs_id'=>$gs_id['web_gscholarid']
        );
        return $data;
        
    }
    public function get_ici_chart($id)
    {
        $get_api_key = $this->con->query("SELECT * FROM stat_config WHERE siteid = ? LIMIT 1", $id);
        $api_key = $get_api_key->fetchArray();
        $get_ici_id = $this->con->query("SELECT * FROM stat_webs WHERE web_siteid = ? LIMIT 1", $id);
        $ici_id = $get_ici_id->fetchArray();
        $data = array(
            'api_key'=>$api_key['config_api_key'],
            'ici_id'=>$ici_id['web_ici']
        );
        return $data;
        
    }
    public function get_device_table($id)
    {
        $get_data = $this->con->query("SELECT pv_ipkey, pv_siteid, pv_device, COUNT(pv_ipkey)AS allVisitor, COUNT(DISTINCT pv_ipkey)AS uniqueVisitor FROM stat_pageviews WHERE pv_siteid = ? GROUP BY pv_device", $id);
        $data = $get_data->fetchAll();
        return $data;
    }
    public function get_pageview_table($id)
    {
        $get_data = $this->con->query("SELECT pv_ipkey, pv_siteid, pv_pagetitle, pv_duration, COUNT(pv_ipkey)AS allVisitor, COUNT(DISTINCT pv_ipkey)AS uniqueVisitor, AVG(pv_duration)AS pvDur FROM stat_pageviews WHERE pv_siteid = ? GROUP BY pv_pagetitle", $id);
        $data = $get_data->fetchAll();
        return $data;
    }
   
}