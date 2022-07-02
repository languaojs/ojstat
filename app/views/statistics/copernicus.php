<?php 
Session::start();
$role = array("admin", "user");
$ses_role = Session::get_sess_role();
Session::get_role($ses_role, $role);
$name = Session::get_name();
?>
<div class="container">
    <div class="row mt-3">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <?php require_once '../app/views/user/menus/menu_statistics.php';?>
            </nav>
            <h1 class="mt-2 bg-dark text-light text-center p-1">Index Copernicus</h1>
            <br>
            <div id="ici_result">
                <?=$data['chartContainer'];?>
            </div>
        </div>
    </div>
</div>
<?php 
if(is_array($data['datalabel']))
{
    require_once 'ici-script.php';
}
?>