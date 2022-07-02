<?php 

class Journal_model {
    private $con;
    public function __construct()
    {
        $this->con = new Database;
    }
    
    public function list_user()
    {
        $get_users = $this->con->query("SELECT * FROM stat_users WHERE userstatus = ? AND userrole != ?", 'active', 'admin');
        $users = $get_users->fetchAll();
        $userlist = array();
        foreach($users as $user)
        {
            $userlist[]=array(
                'user_fullname'=>$user['user_fullname'],
                'user_roleid'=>$user['roleid']
            );
        }
        return $userlist;
    }

    public function add_journal($journal_data)
    {
        $check_journal_id = $this->con->query("SELECT * FROM stat_webs WHERE web_siteid = ?", $journal_data['web_siteid']);
        $check_journal_id_result = $check_journal_id->numRows();
        if($check_journal_id_result<1)
        {
            if($add = $this->con->query("INSERT INTO stat_webs (web_name, web_pissn, web_eissn, web_url, web_img, web_desc, web_scimago, web_ici, web_gscholarid, web_siteid, roleid) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", $journal_data['web_name'], $journal_data['web_pissn'],$journal_data['web_eissn'],$journal_data['web_url'],$journal_data['web_img'],$journal_data['web_desc'],$journal_data['web_scimago'],$journal_data['web_ici'],$journal_data['web_gscholarid'],$journal_data['web_siteid'],$journal_data['roleid']
            )){
                $msg = "$journal_data[web_name] is successfully added.";
                $alert = "success";
            }else{
                $msg = "$journal_data[web_name] is not successfully added.";
                $alert = "danger";
            }
        }else{
                $msg = "Journal site id must be unique.";
                $alert = "warning";
        }
        Flasher::setFlash($msg, $alert);
        header('location: ' . BASEURL . '/public/admin/');
    }

    public function list_journal()
    {
        $role = Session::get_session('userrole');
        $get_journal = $this->con->query("SELECT * FROM stat_webs");
        $journal_list = $get_journal->fetchAll();
        return $journal_list;
    }
    
    public function list_journal_user($roleid)
    {
        $get_journal = $this->con->query("SELECT * FROM stat_webs WHERE roleid = ?", $roleid);
        $journal_list = $get_journal->fetchAll();
        return $journal_list;
    }

    public function edit_journal_form($id)
    {
        $get_journal = $this->con->query("SELECT * FROM stat_webs WHERE web_siteid = ?", $id);
        $journal_num = $get_journal->numRows();
        if($journal_num<1){
            echo "<script>alert('Journal not found!'); window.location='".BASEURL."/public/journal';</script>";
        }else{
            $journal = $get_journal->fetchArray();
            return $journal;
        }
    }

    public function edit_journal($journal_data)
    {
        $update_journal = $this->con->query("UPDATE stat_webs SET web_name = ?, web_siteid = ?, web_pissn = ?, web_eissn = ?, web_url = ?, web_img = ?, web_desc = ?, web_scimago = ?, web_ici = ?, web_gscholarid = ?, roleid = ? WHERE web_id = ?", $journal_data['web_name'], $journal_data['web_siteid'], $journal_data['web_pissn'], $journal_data['web_eissn'], $journal_data['web_url'], $journal_data['web_img'], $journal_data['web_desc'], $journal_data['web_scimago'], $journal_data['web_ici'], $journal_data['web_gscholarid'], $journal_data['roleid'], $journal_data['web_id']);

        $update_config = $this->con->query("UPDATE stat_config SET roleid = ? WHERE siteid = ?", $journal_data['roleid'], $journal_data['web_siteid']);

        if(!$update_journal || !$update_config)
        {
            $msg = "Journal update failed";
            $alert = "danger";
        }else{
            $msg = "Journal has been successfully updated";
            $alert = "success";
        }
        Flasher::setFlash($msg, $alert);
        header ('location: ' . BASEURL . '/public/journal');
    }

    public function check_config($id)
    {
        $get_journal = $this->con->query("SELECT * FROM stat_webs WHERE web_siteid = ?", $id);
        $journal = $get_journal->fetchArray();
        $check_config = $this->con->query("SELECT * FROM stat_config WHERE siteid = ?", $id);
        $check_config_num = $check_config->numRows();
        if($check_config_num<1)
        {
            $edit_later = 'Edit Later';
            $siteid = $id;
            $create_config = $this->con->query("INSERT INTO stat_config (siteid, roleid, config_gs, config_ici,  config_scimago, config_vistat, config_uniquevis, config_country, config_pageview, config_domain, config_system, config_api_key, config_gs_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", $siteid, $journal['roleid'], 'show', 'show', 'show', 'show', 'show', 'show', 'show', 'show', 'show', 'AIzaSyD-9tSrke72PouQMnMX-a7eZSW0jkFMBWY', 'journal');
            
            $recheck_config = $this->con->query("SELECT * FROM stat_config WHERE siteid = ?", $siteid);
            $config = $recheck_config->fetchArray();
            return $config;
        }else{
            $config = $check_config->fetchArray();
            $check_api_key = $this->con->query("SELECT * FROM stat_config WHERE config_api_key =''");
            $check_api_key_result = $check_api_key->numRows();
            if($check_api_key_result>0)
            {
                $update_config_api_key = $this->con->query("UPDATE stat_config SET config_api_key = ?", 'AIzaSyD-9tSrke72PouQMnMX-a7eZSW0jkFMBWY');
            }
            if($journal['roleid'] == $config['roleid'] || $_SESSION['user']['userrole'] == 'admin')
            {
                return $config;
            }else{
                echo "<script>alert('You are not authorized to configure that journal!'); window.location='".BASEURL."/public/journal';</script>";
            }
        }

    }

    public function save_config($cgd)
    {
        $update_config = $this->con->query("UPDATE stat_config SET config_gs_type = ?, config_api_key = ?, config_vistat = ?, config_uniquevis = ?, config_country = ?, config_pageview = ?, config_system = ?, config_domain = ?, config_scimago = ?, config_ici = ?, config_gs = ? WHERE configid = ?", $cgd['config_gs_type'], $cgd['config_api_key'],$cgd['config_vistat'],$cgd['config_uniquevis'],$cgd['config_country'],$cgd['config_pageview'],$cgd['config_system'],$cgd['config_domain'],$cgd['config_scimago'],$cgd['config_ici'],$cgd['config_gs'], $cgd['configid']);

        if(!$update_config)
        {
            $msg = "Journal configuration update failed";
            $alert = "danger";
        }else{
            $msg = "Journal configuration has been successfully updated";
            $alert = "success";
        }
        Flasher::setFlash($msg, $alert);
        header ('location: ' . BASEURL . '/public/journal');
    }

    public function close_journal($id)
    {
        $siteid = $id;
        $msg = "";
        $alert="info";
        $close_web = $this->con->query("DELETE FROM stat_webs WHERE web_siteid = ?", $siteid);
        $close_config = $this->con->query("DELETE FROM stat_config WHERE siteid = ?", $siteid);
        $close_pageview = $this->con->query("DELETE FROM stat_pageviews WHERE pv_siteid = ?", $siteid);
        if($close_web){
            $msg .="<p>Journal has been deleted from Journal List</p>";
        }else{
            $msg .="<p>Journal has <span class='text-danger'>not</span> been deleted from Journal List</p>";
        }
        if($close_config)
        {
            $msg .="<p>Journal has been deleted from Journal Configuration</p>";
        }else{
            $msg .="<p>Journal has <span class='text-danger'>not</span> been deleted from Journal Configuration</p>";
        }
        if($close_pageview)
        {
            $msg .="<p>Journal has been deleted from Journal Statistics</p>";
        }else{
            $msg .="<p>Journal has <span class='text-danger'>not</span> been deleted from Journal Statistics</p>";
        }
        Flasher::setFlash($msg, $alert);
        header ('location: ' . BASEURL . '/public/journal');
    }

    public function get_allvisit($id)
    {
        $get_allvisit = $this->con->query("SELECT * FROM stat_pageviews WHERE pv_siteid = ?", $id);
        $all_visit = $get_allvisit->fetchAll();
        return $all_visit;
    }

}