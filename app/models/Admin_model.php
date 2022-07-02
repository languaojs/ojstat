<?php 

class Admin_model {

    private $con;
    public function __construct()
    {
        $this->con = new Database;
    }

    public function count_journal()
    {
        $get_journal_num = $this->con->query("SELECT web_id FROM stat_webs");
        $journal_num = $get_journal_num->numRows();
        return $journal_num;
    }
    public function count_user()
    {
        $get_user_num = $this->con->query("SELECT userid FROM stat_users");
        $user_num = $get_user_num->numRows();
        return $user_num;
    }

    public function check_users()
    {
        $check_users = $this->con->query("SELECT userrole FROM stat_users WHERE userrole = ?", 'user');
        $user_num = $check_users->numRows();
        if($user_num<1)
        {
            Flasher::setFlash('Please add a user now!', 'danger');
        }else{
            return "";
        }
    }

    public function get_roleid()
    {
        $get_role_id = $this->con->query("SELECT roleid, MAX(roleid) FROM stat_users WHERE roleid !=1");
        $role_id = $get_role_id->fetchArray();
        return $role_id['roleid']+1;
    }

    public function list_users()
    {
        $users_data = "";
        $users = array();
        $get_all_users = $this->con->query("SELECT * FROM stat_users");
        $all_users=$get_all_users->numRows();
        if($all_users <1)
        {
            $users_data .= "No users has been added!";
            return $users_data;
        }
        else{
            $get_users = $get_all_users->fetchAll();
            foreach($get_users as $users_array)
            {
                $users[] = array(
                    'roleid'=>$users_array['roleid'],
                    'fullname'=>$users_array['user_fullname'],
                    'role'=>$users_array['userrole'],
                    'status'=>$users_array['userstatus'],
                    'user_id'=>$users_array['userid']);
            }
            return $users;
        }        
    }

    public function addUser($userData)
    {
        $username = $userData['username'];
        $userpassinput = $userData['userpass'];
        $roleid = $userData['roleid'];
        $user_fullname = $userData['user_fullname'];
        $user_img_url = $userData['user_img_url'];
        $user_email = $userData['user_email'];
        $user_link = $userData['user_link'];
        $user_desc = $userData['user_desc'];
        $userrole = 'user';
        $userstatus = 'active';
        $opt = ['cost'=>8];
        $userpass = password_hash($userpassinput, PASSWORD_BCRYPT,$opt);

        $check_user = $this->con->query("SELECT * FROM stat_users WHERE roleid = ?", $roleid);
        $check_user_count = $check_user->numRows();
        if($check_user_count<1)
        {
            if($this->con->query("INSERT INTO stat_users (username, userpass, userrole, roleid, userstatus, user_fullname, user_img_url, user_email, user_link, user_desc) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", $username, $userpass, $userrole, $roleid, $userstatus, $user_fullname, $user_img_url, $user_email, $user_link, $user_desc))
            {
                $add_user_notif = "$user_fullname is successfully added as $userrole.";
                $alert_type = 'success';
            }else{
                $add_user_notif = "$user_fullname is not successfully added as $userrole.";
                $alert_type = 'danger';
            }
        }else{
            $add_user_notif = "This roleID exists! Use unique number.";
            $alert_type = 'warning';
        }
        Flasher::setFlash($add_user_notif, $alert_type);
        header('location: '. BASEURL . '/public/admin');
    }
}