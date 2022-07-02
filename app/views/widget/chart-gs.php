<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <?php 
                if($data['data']['gs_id'] !=='')
                {

                    if($data['data']['gs_type'] == 'user')
                    {
                        $lang="en";
                        $pagesize = "100";
                        $userid = $data['data']['gs_id'];
                        include_once 'curl_gs.php';
                    }else{
                        $gs_id = $data['data']['gs_id'];
                        $gs_lang = "en";
                        include_once 'curl_gs_3.php';
                    }

                }else{
                    echo "<p>This journal does not have Google Scholar ID.</p>";
                }
            ?>
        </div>
    </div>
</div>