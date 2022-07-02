<?php 
$gstype = $data['metric_data']['type'];
require_once 'top-row.php';
?>
<div class="container">
    <div class="row mt-3 pl-2">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <p class="list-group-item border-left-main">Google Scholar</p>
        </div>
    </div>
    <div class="row mt-3 pl-2">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div id="chartBox" style="width:100%; height:300px" class="p-2 shadow">
                <canvas id="gsChart"></canvas>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <p class="list-group-item border-left-main">
                <strong>What is Google Scholar?</strong>
                <p class="text-justify">Google Scholar provides a simple way to broadly search for scholarly literature. From one place, you can search across many disciplines and sources: articles, theses, books, abstracts and court opinions, from academic publishers, professional societies, online repositories, universities and other web sites. Google Scholar helps you find relevant work across the world of scholarly research.</p>
                <a href="https://scholar.google.com/intl/en/scholar/about.html" target="blank">Read more about Google Scholar</a>
            </p>
        </div>
    </div>
</div>
<?php 
require_once "gs-$gstype.php";
?>