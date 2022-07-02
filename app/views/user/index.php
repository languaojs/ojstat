<?php
Session::start();
$role = array("user");
$ses_role = Session::get_sess_role();
Session::get_role($ses_role, $role);
$name = Session::get_name();
?>
<div class="flash">
<?php 
    Flasher::flash();
?>
</div>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <?php require_once '../app/views/user/menus/menu_'.$data['userrole'].'.php';?>
            </nav>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <h1 class="display-2 text-info mt-5">Welcome, OJStat User.</h1>
            <p class="lead text-info"> We are glad to see you joining this team.</p>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <img src="<?=BASEURL;?>/public/img/misc/see-stat-4.jpg" class="img-fluid" alt="">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col md-12 col-lg-12">
            <?php 
                if(OJSTATART == 'true')
                {?>
                   <div id='carouselExampleSlidesOnly' class='carousel slide' data-ride='carousel' data-interval='5000'>
                    <div class='carousel-inner'>
                        <div class="carousel-item active">
                         <p class='list-group-item border-left-main'><a href='https://www.ojstat.eu.org' target='blank'>Visit OJStat Official Blog</a></h4>
                        </div>
                        <?php 
                            foreach($data['curlojstat'] as $curlo)
                            {
                                echo "<div class='carousel-item'>";
                                echo "<p class='list-group-item border-left-main'><a href ='$curlo[href]' target='blank'>$curlo[text]</a>";
                                echo "</div>";
                            }
                        ?>
                    </div>
                   </div>
                <?php }else{
                    echo "";
                }
            ?>
        </div>
    </div>
    <br>
</div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 bg-smooth-blue p-3">
            <p class="lead text-center"><strong>What's new in this version?</strong></p>
            <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 p-2">
                    <div class="list-group-item text-center rounded shadow border-left-main multiuser" style="display:none;">
                        <i class="fa fa-users text-info display-4"></i>
                        <h5 class="my-3">Multi-user</h5>
                        <p>Decreasing working time, increasing teamwork.</p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 p-2">
                    <div class="list-group-item text-center rounded shadow border-left-main widgen"style="display:none;">
                        <i class="fa fa-code text-info display-4"></i>
                        <h5 class="my-3">Widget Generator</h5>
                        <p>Easing widget creation, goodbye hard coding.</p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 p-2">
                <div class="list-group-item text-center rounded shadow border-left-main report"style="display:none;">
                        <i class="fa fa-file text-info display-4"></i>
                        <h5 class="my-3">Report Page</h5>
                        <p>New <i><b>Report Page</b></i>, new UI, and more feature control.</p>
                    </div>
                </div>
            </div>
</div>
            <br>
            <p class="lead text-center"><strong>And more...</strong></p>
        </div>
    </div>
<script>
$(document).ready(function(){
    $(document).scroll(function(){
        var y = $(this).scrollTop();
        if(y>70){
            $('.multiuser').fadeIn();
        }else{
            $('.multiuser').fadeOut();
        }
        if(y>120){
            $('.widgen').fadeIn();
        }else{
            $('.widgen').fadeOut();
        }
        if(y>150){
            $('.report').fadeIn();
        }else{
            $('.report').fadeOut();
        }
    });
});
</script>

