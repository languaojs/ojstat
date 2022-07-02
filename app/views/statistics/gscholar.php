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
            <h2 class="mt-2 bg-dark text-light text-center p-1">Google Scholar</h2>
            <br>
            <?=$data['chartContainer'];?>
        </div>
    </div>
</div>
<?php 
if(isset($data['metric_data']['type']))
{
    $gstype=$data['metric_data']['type'];
    require_once "gs-$gstype.php";
}
?>
