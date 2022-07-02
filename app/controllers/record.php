<?php 

class Record extends Controller {
    public function index()
    {
        $ojJson = file_get_contents('php://input');
        $ojData = json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $ojJson),true);
        $this->model('Record_model')->record($ojData);
    }
}