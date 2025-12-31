<?php 

class Setup_model {

    public function setup_check()
    {
        if(SETUP !== true)
        {
            header('location: '. BASEURL . '/public/home');
            
        }else{
            echo "";
        }
    }

    public function install_tables()
    {
        $pdo_dbhost = DB_HOST;
        $pdo_dbuser = DB_USER;
        $pdo_dbpass = DB_PASS;
        $pdo_dbname = DB_NAME;

        $pdo_dsn = "mysql:host=$pdo_dbhost;dbname=$pdo_dbname";
        // Set Error Mode to Exception so you can catch real connection issues
        $pdo_con = new PDO($pdo_dsn, $pdo_dbuser, $pdo_dbpass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);

        $tables = array('stat_users', 'stat_config', 'stat_webs', 'stat_pageviews');
        $keyfields = array('userid', 'configid', 'web_id', 'pv_id');

        for ($tn = 0; $tn < count($tables); $tn++) {
            $table = $tables[$tn];
            $key = $keyfields[$tn];

            // Check if table exists using SQL metadata
            $check = $pdo_con->query("SHOW TABLES LIKE '$table'");

            if ($check->rowCount() > 0) {
                echo "<i class='fa fa-check text-success'></i> $table exists.<br>";
            } else {
                // Create table in ONE query. Much faster and cleaner.
                $sql = "CREATE TABLE $table (
                $key INT(11) NOT NULL AUTO_INCREMENT,
                PRIMARY KEY ($key)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

                try {
                    $pdo_con->exec($sql);
                    echo "<i class='fa fa-info text-info'></i> $table created successfully.<br>";
                } catch (PDOException $e) {
                    echo "<i class='fa fa-warning text-warning'></i> $table could not be created: " . $e->getMessage() . "<br>";
                }
            }
        }
        $pdo_con = NULL;
    }

    public function upgrade_tables()
    {
        $pdo_dbhost = DB_HOST;
        $pdo_dbuser = DB_USER;
        $pdo_dbpass = DB_PASS;
        $pdo_dbname = DB_NAME;

        $pdo_dsn = "mysql:host=$pdo_dbhost;dbname=$pdo_dbname";

        // Set to Exception mode so we can catch errors, but use logic that doesn't trigger them
        $pdo_con = new PDO($pdo_dsn, $pdo_dbuser, $pdo_dbpass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);

        $table_arr = array('stat_users',  'stat_webs', 'stat_pageviews', 'stat_config');
        $table_term = array('User Table', 'Journal Table', 'Statistics Table', 'Config Table');

        $field_arr = array(
            ['fieldname' => array('userid', 'username', 'userpass', 'userrole', 'roleid', 'userstatus', 'user_fullname', 'user_img_url', 'user_email', 'user_link', 'user_desc')],
            ['fieldname' => array('web_id', 'web_siteid', 'roleid', 'web_name', 'web_url', 'web_img', 'web_desc', 'web_pissn', 'web_eissn', 'web_ici', 'web_scimago', 'web_gscholarid')],
            // Note: fixed a trailing space in 'pv_countrycode' below
            ['fieldname' => array('pv_id', 'pv_siteid', 'pv_pagetitle', 'pv_ip', 'pv_country', 'pv_countrycode', 'pv_date', 'pv_time', 'pv_region', 'pv_city', 'pv_browser', 'pv_os', 'pv_device', 'pv_ref', 'pv_ref_dom', 'pv_ref_name', 'pv_ipkey', 'pv_duration', 'pv_isp')],
            ['fieldname' => array('configid', 'siteid', 'roleid', 'config_gs', 'config_ici', 'config_scimago', 'config_vistat', 'config_uniquevis', 'config_country', 'config_pageview', 'config_domain', 'config_system', 'config_api_key', 'config_gs_type')]
        );

        $field_type_arr = array(
            ['fieldtype' => array('INT(11)', 'VARCHAR(50)', 'TEXT', 'VARCHAR(10)', 'INT(11)', 'VARCHAR(10)', 'VARCHAR(150)', 'TEXT', 'VARCHAR(150)', 'TEXT', 'TEXT')],
            ['fieldtype' => array('INT(11)', 'INT(11)', 'INT(11)', 'TEXT', 'TEXT', 'TEXT', 'TEXT', 'VARCHAR(15)', 'VARCHAR(15)', 'VARCHAR(50)', 'VARCHAR(50)', 'VARCHAR(50)')],
            ['fieldtype' => array('INT(11)', 'INT(11)', 'TEXT', 'VARCHAR(50)', 'VARCHAR(150)', 'VARCHAR(10)', 'DATE', 'TIME', 'VARCHAR(150)', 'VARCHAR(150)', 'VARCHAR(150)', 'VARCHAR(150)', 'VARCHAR(150)', 'TEXT', 'TEXT', 'VARCHAR(50)', 'VARCHAR(150)', 'INT(11)', 'VARCHAR(150)')],
            ['fieldtype' => array('INT(11)', 'INT(11)', 'INT(11)', 'VARCHAR(10)', 'VARCHAR(10)', 'VARCHAR(10)', 'VARCHAR(10)', 'VARCHAR(10)', 'VARCHAR(10)', 'VARCHAR(10)', 'VARCHAR(10)', 'VARCHAR(10)', 'TEXT', 'VARCHAR(10)')]
        );

        for ($utn = 0; $utn < count($table_arr); $utn++) {
            echo "<p class='list-group-item border-left-main p-2 mt-3'>Checking $table_term[$utn]</p>";
            $thisTable = $table_arr[$utn];

            for ($fn = 0; $fn < count($field_arr[$utn]['fieldname']); $fn++) {
                $thisField = trim($field_arr[$utn]['fieldname'][$fn]); // Trim to prevent space errors
                $thisFieldType = $field_type_arr[$utn]['fieldtype'][$fn];

                // BETTER CHECK: Ask MySQL if the column exists in the table schema
                $check = $pdo_con->query("SHOW COLUMNS FROM `$thisTable` LIKE '$thisField'");
                $exists = $check->fetch();

                if ($exists) {
                    echo "<i class='fa fa-check text-success'></i> $thisField exists in $thisTable. <br>";
                } else {
                    try {
                        $pdo_con->exec("ALTER TABLE `$thisTable` ADD `$thisField` $thisFieldType NOT NULL");
                        echo "<i class='fa fa-info text-info'></i> $thisField did not exist in $thisTable but has been created. <br>";
                    } catch (PDOException $e) {
                        echo "<i class='fa fa-warning text-warning'></i> $thisField could not be created: " . $e->getMessage() . "<br>";
                    }
                }
            }
        }
        $pdo_con = NULL;
    }

    public function adding_admin()
    {
        $pdo_dbhost = DB_HOST;
        $pdo_dbuser = DB_USER;
        $pdo_dbpass = DB_PASS;
        $pdo_dbname = DB_NAME;

        $pdo_dsn = "mysql:host=$pdo_dbhost;dbname=$pdo_dbname";
        $pdo_con = new PDO($pdo_dsn, $pdo_dbuser, $pdo_dbpass);

        $check_admin = $pdo_con->query("SELECT * FROM stat_users WHERE username !=''");
        if($check_admin->rowCount()<1)
        {
            echo "Admin account is not found. Trying to create now... <br>";
            $initx = 'admin';
            $opt = ['cost'=>8];
            $img_url = BASEURL . '/public/img/profile/admin.png';
            $user_email = 'zainurrahmankalero@gmail.com';
            $user_link = 'https://www.ojstat.eu.org';
            $userpass = password_hash($initx, PASSWORD_BCRYPT,$opt);

            $add_admin = $pdo_con->query("INSERT INTO stat_users (username, userpass, userrole, roleid, userstatus, user_fullname, user_img_url, user_email, user_link, user_desc) VALUES('$initx', '$userpass', '$initx', '1', 'active', 'Administrator', '$img_url', '$user_email', '$user_link', 'I am the administrator of OJStat. My duty is to make sure that all journals under our domain are registered in OJStat.')");

            if($add_admin)
            {
                echo "<i class='fa fa-check text-success'></i> Admin has been added with <i>admin</i> as both username and password.<br>";
            }else{
                echo "<i class='fa fa-warning text-warning'></i> I cannot create an admin account.<br>";
            }
        }else{
            echo "Admin account is found. Checking if the role is set...<br>";
            $check_admin_role = $pdo_con->query("SELECT * FROM stat_users WHERE userrole !=''");
            if($check_admin_role->rowCount()<1)
            {
                $img_url = BASEURL . '/public/img/profile/admin.png';
                $user_email = 'zainurrahmankalero@gmail.com';
                $user_link = 'https://www.ojstat.eu.org';

                $add_admin_role = $pdo_con->query("UPDATE stat_users SET userrole = 'admin', roleid = '1', userstatus = 'active', user_fullname = 'Administrator', user_img_url = '$img_url', user_email = '$user_email', user_link = '$user_link', user_desc='I am the administrator of OJStat. My duty is to make sure that all journals under our domain are registered in OJStat.'");
                if($add_admin_role)
                {
                    echo "<i class='fa fa-check text-success'></i> Admin role been added.<br>";
                }else{
                    echo "<i class='fa fa-warning text-warning'></i> I cannot create an admin role.<br>";
                }
            }else{
                echo "All role is set.<br>";
            }
        }
        $pdo_con = NULL;
    }

    public function rem_old_fields()
    {
        $pdo_dbhost = DB_HOST;
        $pdo_dbuser = DB_USER;
        $pdo_dbpass = DB_PASS;
        $pdo_dbname = DB_NAME;

        $pdo_dsn = "mysql:host=$pdo_dbhost;dbname=$pdo_dbname";

        // Initialize connection with Exception mode
        $pdo_con = new PDO($pdo_dsn, $pdo_dbuser, $pdo_dbpass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);

        $tables_field_to_drop = array('stat_webs', 'stat_config', 'stat_pageviews');
        $fields_to_drop = array(
            ['fieldsname' => array('web_cf', 'web_mora')],
            ['fieldsname' => array('config_cf', 'config_mora')],
            ['fieldsname' => array('pv_lat', 'pv_long', 'pv_vistime')]
        );

        for ($tf = 0; $tf < count($tables_field_to_drop); $tf++) {
            $theTable = $tables_field_to_drop[$tf];

            for ($fd = 0; $fd < count($fields_to_drop[$tf]['fieldsname']); $fd++) {
                $theField = $fields_to_drop[$tf]['fieldsname'][$fd];

                // 1. Check if the column actually exists first
                $check = $pdo_con->query("SHOW COLUMNS FROM `$theTable` LIKE '$theField'");
                $columnExists = $check->fetch();

                if ($columnExists) {
                    // 2. If it exists, try to drop it
                    try {
                        $pdo_con->exec("ALTER TABLE `$theTable` DROP `$theField`Status");
                        echo "<i class='fa fa-check text-success'></i> $theField has been dropped from $theTable <br>";
                    } catch (PDOException $e) {
                        echo "<i class='fa fa-warning text-warning'></i> Error dropping $theField: " . $e->getMessage() . "<br>";
                    }
                } else {
                    // 3. If it doesn't exist, don't try to drop it (prevents the crash)
                    echo "<i class='fa fa-info text-info'></i> $theField does not exist in $theTable (already dropped).<br>";
                }
            }
        }
        $pdo_con = NULL;
    }

    public function get_data_size()
    {
        $pdo_dbhost = DB_HOST;
        $pdo_dbuser = DB_USER;
        $pdo_dbpass = DB_PASS;
        $pdo_dbname = DB_NAME;

        $pdo_dsn = "mysql:host=$pdo_dbhost;dbname=$pdo_dbname";
        $pdo_con = new PDO($pdo_dsn, $pdo_dbuser, $pdo_dbpass);

        $get_data_size = $pdo_con->query("SELECT pv_ipkey FROM stat_pageviews WHERE pv_ipkey = ''");
        $data_size = $get_data_size->rowCount();
        return $data_size;
    }

    public function start_sync_data($data_num)
    {
        $pdo_dbhost = DB_HOST;
        $pdo_dbuser = DB_USER;
        $pdo_dbpass = DB_PASS;
        $pdo_dbname = DB_NAME;

        $pdo_dsn = "mysql:host=$pdo_dbhost;dbname=$pdo_dbname";
        $pdo_con = new PDO($pdo_dsn, $pdo_dbuser, $pdo_dbpass);
        $data_num = $data_num['data_num']; 
        $get_data_to_sync = $pdo_con->query("SELECT pv_id, pv_ip, pv_ref_dom, pv_ref_name, pv_ipkey, pv_duration FROM stat_pageviews WHERE pv_ref_name = '' LIMIT $data_num");
        $data_to_sync = $get_data_to_sync->fetchAll(PDO::FETCH_ASSOC);

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

        foreach($data_to_sync as $sync_data)
        {
            $pv_id = $sync_data['pv_id'];
            $pv_ref_name = $this->get_ref_name($sync_data['pv_ref_dom'], $ref_name_array);
            $pv_ipkey = Sanitize::hashIp($sync_data['pv_ip']);
            $pv_duration = $this->randDur();
            if($sync_start = $pdo_con->query("UPDATE stat_pageviews SET pv_ref_name = '$pv_ref_name', pv_ipkey = '$pv_ipkey', pv_duration = '$pv_duration' WHERE pv_id = '$pv_id'"))
            {
                echo "<i class='fa fa-check text-success'></i> Data with id $pv_id is synced.<br>";
            }else{
                echo "<i class='fa fa-warning text-warning'></i> Data with id $pv_id is not synced.<br>";
            }

        }
    }

    public function reindex()
    {
        $pdo_dbhost = DB_HOST;
        $pdo_dbuser = DB_USER;
        $pdo_dbpass = DB_PASS;
        $pdo_dbname = DB_NAME;

        $pdo_dsn = "mysql:host=$pdo_dbhost;dbname=$pdo_dbname";
        $pdo_con = new PDO($pdo_dsn, $pdo_dbuser, $pdo_dbpass);

        $tables_to_reindex = array('stat_users', 'stat_webs', 'stat_pageviews', 'stat_config');
        $tables_term = array('User table', 'Journal table', 'Statistic table', 'Configuration table');
        $fields_to_reindex = array('userid', 'web_id', 'pv_id', 'configid');

        for($x=0; $x<count($tables_to_reindex);$x++)
        {
            $xTable = $tables_to_reindex[$x];
            $xTerm = $tables_term[$x];
            $xField = $fields_to_reindex[$x];

            $reindex_start_drop = $pdo_con->query("ALTER TABLE $xTable DROP $xField");
            if($reindex_start_drop)
            {
                echo "<i class='fa fa-check text-success'></i> $xTerm is being reindexed...<br>";
            }else{
                echo "<i class='fa fa-warning text-warning'></i> $xTerm is not being reindexed...<br>";
            }

            $reindex_start_add = $pdo_con->query("ALTER TABLE $xTable ADD $xField INT NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST");
            if($reindex_start_add)
            {
                echo "<i class='fa fa-check text-success'></i> $xTerm is reindexed successfully.<br>";
            }else{
                echo "<i class='fa fa-warning text-warning'></i> I cannot reindex $xTerm.<br>";
            }
        }
    }

    public function finish_table_setup()
    {
        $pdo_dbhost = DB_HOST;
        $pdo_dbuser = DB_USER;
        $pdo_dbpass = DB_PASS;
        $pdo_dbname = DB_NAME;

        $pdo_dsn = "mysql:host=$pdo_dbhost;dbname=$pdo_dbname";
        $pdo_con = new PDO($pdo_dsn, $pdo_dbuser, $pdo_dbpass);

        $get_countrycode = $pdo_con->query("SELECT pv_id, pv_countrycode FROM stat_pageviews WHERE pv_countrycode LIKE '%2%'");
        if($get_countrycode->rowCount()<1)
        {
            echo "<p>All data is good.</p>";
        }else{
            $countrycode = $get_countrycode->fetchAll(PDO::FETCH_ASSOC);
            echo "<h3>Fixing Country Code</h3>";
            foreach($countrycode as $ccode)
            {
                $pv_countrycode = str_replace('2','', $ccode['pv_countrycode']);
                $pv_id = $ccode['pv_id'];
                $update_countrycode = $pdo_con->query("UPDATE stat_pageviews SET pv_countrycode = '$pv_countrycode' WHERE pv_id = '$pv_id'");
                if($update_countrycode)
                {
                    echo "<i class='fa fa-check text-success'></i> Country code with id $pv_id is fixed.<br>";
                }else{
                    echo "<i class='fa fa-warning text-warning'></i> I cannot fix country code with id $pv_id.<br>";
                }
            }
        }
    }

    function get_ref_name($var, $ref_name_arr, int $offset=NULL)
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

    function randDur()
    {
        $num = rand(1111,9999);
        return $num;
    }
}

?>
