<?php 
class Server_model {
    private $server_json;
    public function get_server_version(){
        $server_version = '1.5';
        return $server_version;
    }

    public function getsimplehtmldom()
    {
        require 'simple_html_dom.php';
    }
    
    public function get_article_list()
    {
        $this->getsimplehtmldom();
        $ojstatUrl = "https://www.ojstat.eu.org/p/ojstat-news.html";
        $ojcurl = curl_init();
        curl_setopt($ojcurl, CURLOPT_URL, $ojstatUrl);
        curl_setopt($ojcurl, CURLOPT_HEADER, 0);
        curl_setopt($ojcurl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ojcurl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ojcurl, CURLOPT_CONNECTTIMEOUT, 100);
        curl_setopt($ojcurl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ojcurl, CURLOPT_REFERER, $ojstatUrl);
        $ojstatResult = curl_exec($ojcurl);
        curl_close($ojcurl);
        $html_base = new simple_html_dom();
        $html_base->load($ojstatResult);
        $article = array();
        foreach($html_base->find('a.ojstatSitemap')as $element)
        {
            $article[] = array(
                'href' => $element->href,
                'text' => $element->innertext
            );
        }
        return $article;
    }
    public function get_alt_list()
    {
        $list = array(
            'text'=>Sanitize::clean('OJStat is a free and simple Statistic Counter for OJS-based Journals.'),
            'href'=>Sanitize::clean('https://ojstat.eu.org')
        );
        return $list;
    }
}