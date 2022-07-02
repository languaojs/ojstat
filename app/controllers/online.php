<?php 

class Online extends Controller {

    public function index($id)
    {
        $data['siteid'] = $id;
        $data['title'] = 'Online Visitor Widget';
        $data['check'] = $this->model('Online_model')->check_siteid($id);
        if($data['check'] == "yes")
        {
            $data['widget_source'] = "db/livevisitor$id.db";
            $data['widget_reader'] = "online.php";
            $this->view('templates/online-header', $data);
            $this->view('online/index',$data);
            $this->view('templates/online-footer');
        }elseif($data['check'] == "no")
        {
            $this->view('templates/online-header', $data);
            $this->view('online/error',$data);
            $this->view('templates/online-footer');
        }
    }
}