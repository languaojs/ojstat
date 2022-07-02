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
            <h2 class="mt-2 bg-dark text-light text-center p-1">Scimago</h2>
        </div>
    </div>
    <br>
    <div class="row mt-2">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
            <?=$data['scimago_data'];?>
        </div>
    </div>
</div>
