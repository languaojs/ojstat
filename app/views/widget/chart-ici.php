<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <?php 
                if($data['data']['ici_id'] !=='' && $data['data']['api_key'] !=='')
                {
                    $ici_id = $data['data']['ici_id'];
                    $ici_url = "https://journals.indexcopernicus.com/api/journalRating/getRates/$ici_id/ICV";
                    include_once 'curl_ici.php';
                }else{
                    echo "<p>This journal does not have Google Scholar ID or API Key is not set.</p>";
                }
            ?>
        </div>
    </div>
</div>
