<?php 

class Online_model {
    private $con;
    public function __construct()
    {
        $this->con = new Database;
    }

    public function check_siteid($id)
    {
        $check_siteid = $this->con->query("SELECT web_siteid FROM stat_webs WHERE web_siteid = ?", $id);
        $check_result = $check_siteid->numRows();
        if($check_result>0)
        {
            $result = "yes";
        }else{
            $result = "no";
        }
        return $result;
    }
}