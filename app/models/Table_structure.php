<?php 

$table_arr = array('stat_users',  'stat_webs', 'stat_pageviews', 'stat_config');

$field_arr = array(

    ['fieldname'=> array('userid', 'username', 'userpass', 'userrole', 'roleid', 'userstatus', 'user_fullname', 'user_img_url', 'user_email', 'user_link', 'user_desc')],

    ['fieldname'=> array('web_id', 'web_siteid', 'roleid', 'web_name', 'web_url', 'web_img', 'web_desc', 'web_pissn', 'web_eissn', 'web_ici', 'web_scimago', 'web_gscholarid')],

    ['fieldname'=> array('pv_id','pv_siteid','pv_pagetitle', 'pv_ip', 'pv_country', 'pv_countrycode ', 'pv_date','pv_time', 'pv_region','pv_city','pv_browser','pv_os', 'pv_device', 'pv_ref', 'pv_ref_dom', 'pv_ref_name', 'pv_ipkey', 'pv_duration', 'pv_isp')],

    ['fieldname'=> array('configid', 'siteid','roleid','config_gs','config_ici','config_scimago','config_vistat','config_uniquevis','config_country','config_pageview','config_domain','config_system','config_api_key', 'config_gs_type')]
);

$field_type_arr = array(
    ['fieldtype' => array('INT(11)', 'VARCHAR(50)', 'TEXT', 'VARCHAR(10)', 'INT(11)', 'VARCHAR(10)', 'VARCHAR(150)', 'TEXT', 'VARCHAR(150)', 'TEXT', 'TEXT')],

    ['fieldtype' => array('INT(11)', 'INT(11)', 'INT(11)', 'TEXT', 'TEXT', 'TEXT', 'TEXT', 'VARCHAR(15)', 'VARCHAR(15)', 'VARCHAR(50)', 'VARCHAR(50)', 'VARCHAR(50)')],

    ['fieldtype' => array('INT(11)', 'INT(11)', 'TEXT', 'VARCHAR(50)', 'VARCHAR(150)', 'VARCHAR(10)', 'DATE', 'TIME', 'VARCHAR(150)', 'VARCHAR(150)', 'VARCHAR(150)', 'VARCHAR(150)', 'VARCHAR(150)', 'TEXT', 'TEXT','VARCHAR(50)', 'VARCHAR(150)','INT(11)', 'VARCHAR(150)')],

    ['fieldtype' => array('INT(11)', 'INT(11)', 'INT(11)', 'VARCHAR(10)', 'VARCHAR(10)', 'VARCHAR(10)', 'VARCHAR(10)', 'VARCHAR(10)', 'VARCHAR(10)', 'VARCHAR(10)', 'VARCHAR(10)', 'VARCHAR(10)', 'TEXT', 'VARCHAR(10)')]
);

$table_init_arr = array(
    ['tbl_name'=>'stat_users', 'key_field'=>'userid'],
    ['tbl_name'=>'stat_webs', 'key_field'=>'web_id'],
    ['tbl_name'=>'stat_pageviews', 'key_field'=>'pv_id'],
    ['tbl_name'=>'stat_config', 'key_field'=>'configid']
);
?>