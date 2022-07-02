<?php 
echo $data['setup_check'];
?>
<div class="container">
    <div class="row mt-3">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h1><i class="fa fa-cog"></i> OJStat Setup</h1>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h3>Instructions:</h3>
            <p class="list-group-item border-left-main p3">Select the right setup button. If you are just installing OJStat for the first time, please select New Installation buttons one by one. Otherwise, if you are upgrading from older version (1.3), select Ugrade buttons one by one. Sync the data when all tables are ready. Do not forget to set <i>SETUP</i> to <i>false</i> before login.</p>
            <a href="<?=BASEURL;?>/public/setup" class="btn btn-dark btn-sm"><i class="fa fa-arrow-left"></i> Return</a> <a href="<?=BASEURL;?>/public/setup/start" class="btn btn-dark btn-sm"><i class="fa fa-refresh"></i> Reload</a> <a href="<?=BASEURL;?>/public/home" class="btn btn-dark btn-sm"><i class="fa fa-user"></i> Login</a> <br><br>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <h3 class="mb-2"><i class="fa fa-list-ol"></i> Setup Buttons</h3><br>
            <table class="table table-sm table-condensed">
                <thead>
                    <tr class="bg-unique text-light">
                        <th class="text-center">New Installation</th><th class="text-center">Upgrade</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                        <button class="btn btn-dark btn-sm btn-block mt-2" onclick="install_tables();">#1. Creating Tables</button>
                        <button class="btn btn-dark btn-sm btn-block mt-2" onclick="upgrade_table_fields()">#2. Creating Fields</button>
                        <button class="btn btn-dark btn-sm btn-block mt-2" onclick="add_admin();">#3. Creating Admin Account</button>
                        </td>
                        <td>
                        <button class="btn btn-dark btn-sm btn-block mt-2" onclick="install_tables();">#1. Creating Tables</button>
                        <button class="btn btn-dark btn-sm btn-block mt-2" onclick="upgrade_table_fields()">#2. Creating Fields</button>
                        <button class="btn btn-dark btn-sm btn-block mt-2" onclick="add_admin();">#3. Creating Admin Account</button>
                        <button class="btn btn-dark btn-sm btn-block mt-2" onclick="remove_old_fields();">#4. Removing Unused Fields</button>
                        <button class="btn btn-dark btn-sm btn-block mt-2" onclick="reindex_fields();">#5. Reindexing Fields</button>
                        <button class="btn btn-dark btn-sm btn-block mt-2" onclick="finish_table_setup();">#6. Finishing Table Setup</button>
                        <a href="<?=BASEURL;?>/public/setup/sync" class = "btn btn-dark btn-sm btn-block mt-2">#7. Sync Data</a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <p>Before running the SETUP process, it is good to set the <code>memory_limit</code> and <code>maximum_execution_time</code> to a high or reasonable value. Please run them one by one. Reload the page and retest to see if every step runs well.</p>
            <p>Please review the <b>Setup Log</b> to see the result of the Setup in each steps.</p>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <h3 class="mb-2"><i class="fa fa-clipboard-list"></i> Setup Log </h3><br>
            <div id="setupLog" class="border p-3" style="height:auto">
                <p>Waiting for input...</p>
            </div>
        </div>
    </div>
</div>

<script>

        //install tables
        function install_tables()
        {
            $('#setupLog').html("<p><i class='fa fa-spinner text-info rotating'></i> <code>Please wait...</code></p>");
            $.ajax({
                url: '<?=BASEURL;?>/public/setup/install',
                method:'post',
                success: function(setup_data){
                    $('#setupLog').html(setup_data);
                }

            });
        }

        //upgrade table fields
        function upgrade_table_fields()
        {
            $('#setupLog').html("<p><i class='fa fa-spinner text-info rotating'></i> <code>Please wait...</code></p>");
            $.ajax({
                url: '<?=BASEURL;?>/public/setup/upgrade',
                method:'post',
                success: function(setup_data){
                    $('#setupLog').html(setup_data);
                }

            });
        }

        //add admin account and role
        function add_admin()
        {
            $('#setupLog').html("<p><i class='fa fa-spinner text-info rotating'></i> <code>Please wait...</code></p>");
            $.ajax({
                url: '<?=BASEURL;?>/public/setup/add_admin',
                method:'post',
                success: function(setup_data){
                    $('#setupLog').html(setup_data);
                }

            });
        }

        //removing unused fields
        function remove_old_fields()
        {
            $('#setupLog').html("<p><i class='fa fa-spinner text-info rotating'></i> <code>Please wait...</code></p>");
            $.ajax({
                url: '<?=BASEURL;?>/public/setup/rem_old',
                method:'post',
                success: function(setup_data){
                    $('#setupLog').html(setup_data);
                }

            });
        }

        //reindexing fields
        function reindex_fields()
        {
            $('#setupLog').html("<p><i class='fa fa-spinner text-info rotating'></i> <code>Please wait...</code></p>");
            $.ajax({
                url: '<?=BASEURL;?>/public/setup/reindex_fields',
                method:'post',
                success: function(setup_data){
                    $('#setupLog').html(setup_data);
                }

            });
        }

        //finishing table setup and fixing data error from previous version
        function finish_table_setup()
        {
            $('#setupLog').html("<p><i class='fa fa-spinner text-info rotating'></i> <code>Please wait...</code></p>");
            $.ajax({
                url: '<?=BASEURL;?>/public/setup/finishing_table',
                method:'post',
                success: function(setup_data){
                    $('#setupLog').html(setup_data);
                }

            });
        }

</script>