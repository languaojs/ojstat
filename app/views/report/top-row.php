<div class="bg-unique text-light mb-3">
    <div class="container p-3">
        <div class="row d-flex justify-content-between align-items-center pl-2">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <h1 class="text-light mt-3">OJStat Report Page</h1>
                <p class="text-light">
                   <?= $data['journal_info']['web_name'];?> <br>
                    PISSN: <?= $data['journal_info']['web_pissn'];?> EISSN: <?= $data['journal_info']['web_eissn'];?>
                </p>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <?php include 'navbar.php';?>
            </div>
        </div>
    </div>
</div>