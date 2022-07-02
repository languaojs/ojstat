<?php 
class Home extends Controller {
    
    public function index()
    {
        $data['title']='OJStat Home';
        $data['server_version'] = $this->model('Server_model')->get_server_version();
        $this->view('templates/home-header', $data);
        if(SETUP == true){
            $data['form-text']="<p class='text-center'>Run Setup to start using OJStat</p>";
            $data['form-content']="<h1 class='text-center p-3'><i class='fa fa-cog'></i></h1><p class='text-center p-3'>Your SETUP is active. Do not forget to set the SETUP to <i>false</i> after setup completed.</p>";
            $data['login'] = "";
            $data['setup'] = "<a href='".BASEURL."/public/setup' class='btn btn-dark btn-block'>Setup</a>";
        }else{
            $data['form-text']="<p class='text-center'>Login to start using OJStat</p>";
            $data['form-content']="
            <div class='form-group'>
                <label for=''>Username</label>
                <div class='input-group'>
                    <div class='input-group-prepend'>
                        <span class='input-group-text'>
                            <i class='fa fa-user'></i>
                        </span>
                    </div>
                    <input type='text' name='username' id='userName' class='form-control' autocomplete='off' required/>
                </div>
            </div>
            <div class='form-group'>
                <label for=''>Password</label>
                <div class='input-group'>
                    <div class='input-group-prepend'>
                        <span class='input-group-text'>
                            <i class='fa fa-key'></i>
                        </span>
                    </div>
                    <input type='password' name='userpass' id='userPass' class='form-control' autocomplete='off' required/>
                </div>
            </div>";
            $data['login'] = "<input type='submit' name='userLogin' class='btn btn-dark btn-block' value='Login'/>";
            $data['setup'] = "";
        }
        $this->view('home/index', $data);
        $this->view('templates/home-footer');
    }
}