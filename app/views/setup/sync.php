<?php 

echo $data['setup_check'];

?>

<div class="container">
    <div class="row mt-3">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h1><i class="fa fa-cog"></i> Synchronizing Journal Data</h1>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <p class="list-group-item border-left-main p-3">
                Please be aware that synchronizing journal data may take a lot of time and resource, based on the data amount. Avoid synchronizing journal data in one run. Gradual synchronization is preferred. Reload page to see the remaining data amount to sync.
            </p>
            <p><a href="<?=BASEURL;?>/public/setup/start" class="btn btn-dark btn-sm" id="returnBtn"><i class="fa fa-arrow-left"></i> Return</a>  <a href="<?=BASEURL;?>/public/setup/sync"  class="btn btn-dark btn-sm" id="reloadBtn"><i class="fa fa-refresh"></i> Reload page</a> <a href="<?=BASEURL;?>/public/home"  class="btn btn-dark btn-sm" id="homeBtn"><i class="fa fa-user"></i> Login</a></p>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <h3><i class="fa fa-exchange-alt"></i> Sync Data</h3>
            <br>
            
            <div class="form-group form-inline">
                <input type="number" name="data_num" id="data_num" class="form-control mr-2" value="150">
                <input type="submit" value="Sync" class="btn btn-sm btn-dark" id="syncBtn" onclick="sync_data();">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <h3 class="mb-2"><i class="fa fa-clipboard-list"></i> Setup Log</h3><br>
            <div id="setupLog" class="border p-3" style="height:auto">
            <p>You have <?=$data['data_size'];?> data to sync.</p>
            </div>
        </div>
    </div>
</div>

<script>
    function sync_data()
    {
        var dataNum = $('#data_num').val();
        $('#setupLog').html("<p><i class='fa fa-spinner text-info rotating'></i> <code>Please wait...</code></p>");
        $("#syncBtn").prop("disabled", true);
        $('#returnBtn, #reloadBtn, #homeBtn').toggle('slow');
        $.ajax({
            url: '<?=BASEURL;?>/public/setup/sync_data',
            data:{'data_num':dataNum},
            method:'post',
            success: function(setup_data){
                $('#setupLog').html(setup_data);
                $("#syncBtn").prop("disabled", false);
                $('#returnBtn, #reloadBtn, #homeBtn').toggle('slow');
            }

        });
    }
</script>