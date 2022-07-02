<?php 

$scimago = Sanitize::cleanAll(array(
    'name'=>$data['metric_data']['name'],
    'issn'=>$data['metric_data']['issn'],
    'url'=>$data['metric_data']['url'],
    'publisher'=>$data['metric_data']['publisher'],
    'hindex'=>$data['metric_data']['hindex']
));
require_once 'top-row.php';
?>
<div class="container">
    <div class="row mt-3 pl-2">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <p class="list-group-item border-left-main">Index Scimago</p>
        </div>
    </div>
    <div class="row mt-3 pl-2">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 text-center">
            <img src="<?=$scimago['url'];?>" class="img-fluid" alt="">
            <p class="lead mt-5"><?=$scimago['name'];?> (<?=$scimago['issn'];?>)</p>
            <p><strong>Published by <?=$scimago['publisher'];?></strong></p>
            <h1>H-Index: <?=$scimago['hindex'];?></h1> 
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <p class="list-group-item border-left-main">
                <strong>What is SCImago?</strong>
                <p class="text-justify">The SCImago Journal & Country Rank is a publicly available portal that includes the journals and country scientific indicators developed from the information contained in the Scopus® database (Elsevier B.V.). These indicators can be used to assess and analyze scientific domains. Journals can be compared or analysed separately. Country rankings may also be compared or analysed separately. Journals can be grouped by subject area (27 major thematic areas), subject category (309 specific subject categories) or by country. Citation data is drawn from over 34,100 titles from more than 5,000 international publishers and country performance metrics from 239 countries worldwide.</p>
                <br>
                <a href="https://www.scimagojr.com/aboutus.php" target="blank">Read more about Scimago</a>
            </p>
        </div>
    </div>
</div>