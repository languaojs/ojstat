<?php 

class Record_model {
    private $con;
    public function __construct()
    {
        $this->con = new Database;
    }

    function get_ref_name($var, $ref_name_arr, $offset=NULL)
    {
        foreach(array_keys($ref_name_arr) as $ref)
        {
            if(stripos($var, $ref, $offset)!==false)
            {
                return $ref_name_arr[$ref];
            }
        }
        return 'Generic';
    }

    public function record($ojData)
    {
        $ref_name_array = array(
            'Facebook'=>'Facebook',
            'Twitter'=>'Twitter',
            'Instagram'=>'Instagram',
            'Youtube'=>'Youtube',
            'Blogspot'=>'Blogger',
            'Pinterest'=>'Pinterest',
            'Google'=>'Google',
            'Yahoo'=>'Yahoo',
            'Bing'=>'Bing',
            'Yandex'=>'Yandex',
            'OJStat'=>'OJStat',
            'Reddit'=>'Reddit',
            'GitHub'=>'GitHub',
            'Sinta'=>'Sinta',
            'PKP'=>'PKP',
            'Publons'=>'Publons',
            'Copernicus'=>'Index Copernicus',
            'Elsevier'=>'Elsevier',
            'Eric'=>'Eric Digest',
            'Scholar'=>'Google Scholar',
            'Localhost'=>'Localhost'
        );

        $pv_siteid = htmlspecialchars($ojData['siteId']);
        $pv_pagetitle = htmlspecialchars($ojData['pageTitle']);
        $pv_ref = htmlspecialchars($ojData['referrer']);
        $ref_dom = parse_url($pv_ref);
        $pv_ref_dom = htmlspecialchars($ref_dom['host']);
        $pv_ref_name = $this->get_ref_name($pv_ref_dom, $ref_name_array);
        $pv_browser = htmlspecialchars($ojData['browser']);
        $pv_os = htmlspecialchars($ojData['os']);
        $pv_device = htmlspecialchars($ojData['device']);
        $pv_ip_in = $ojData['clientIp'];
        $pv_ip_key = Sanitize::hashIp($pv_ip_in);
        $pv_ip = preg_replace(['/\.\d*$/', '/[\da-f]*:[\da-f]*$/'],['.XXX'],$pv_ip_in);
        $pv_country = htmlspecialchars($ojData['clientCountry']);
        $pv_countrycode = htmlspecialchars($ojData['clientCountryCode']);
        $pv_region = htmlspecialchars($ojData['clientRegion']);
        $pv_city = htmlspecialchars($ojData['clientCity']);
        $pv_date = date("Y-m-d");
        $pv_time = date("h:i:s");
        $pv_duration = htmlspecialchars($ojData['clientExitTime']);
        $pv_isp = htmlspecialchars($ojData['clientIsp']);

        if($pv_ip !=='' && $pv_country !=='' && $pv_siteid !=='')
        {
            $record = $this->con->query("INSERT INTO stat_pageviews (
                pv_siteid, 
                pv_pagetitle, 
                pv_ip, 
                pv_country, 
                pv_countrycode, 
                pv_date, 
                pv_time, 
                pv_region, 
                pv_city, 
                pv_browser, 
                pv_os, 
                pv_device, 
                pv_ref, 
                pv_ref_dom,
                pv_ref_name, 
                pv_ipkey,
                pv_duration,
                pv_isp) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",
                $pv_siteid,
                $pv_pagetitle,
                $pv_ip,
                $pv_country,
                $pv_countrycode,
                $pv_date,
                $pv_time,
                $pv_region,
                $pv_city,
                $pv_browser,
                $pv_os,
                $pv_device,
                $pv_ref,
                $pv_ref_dom,
                $pv_ref_name,
                $pv_ip_key,
                $pv_duration,
                $pv_isp
            );
        }
    }
}