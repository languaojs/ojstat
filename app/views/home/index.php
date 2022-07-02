<div class="index-wrapper">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 d-flex justify-content-center mt-5">
            <div class="card mb-3 shadow" style=" display:none; max-width: 25rem;" id="loginForm">
                <div class="card-header bg-unique text-light text-center"><i class="fa fa-chart-line"></i> OJStat 1.4</div>
                <div class="card-body text-dark">
                    <h5 class="card-title"><?=$data['form-text'];?></h5>
                    <form action="<?=BASEURL;?>/public/user/login" method="post">
                    <?=$data['form-content'];?>
                    <div class="form-group text-center">
                        <?=$data['login'];?>
                        <?=$data['setup'];?>
                    </div>
                    </form>
                </div>
                <div class="peek shadow">
                    <img src="<?=BASEURL;?>/public/img/misc/welcome.jpg" alt="" class="toHideMe">
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#loginForm').toggle('slow');
        setTimeout(function(){
            $('.peek').show("slide",{direction:'right'},1000)
        }, 2000);
    });
</script>