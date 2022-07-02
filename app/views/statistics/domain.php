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
            <br>
            <h3 class="mt-2 bg-hard-blue text-light text-center p-1">Traffic Sources</h3>
            <p class="list-group-item border-left-main">This page contains one of the most important information regarding this journal statistics, traffic sources or referring domains. This information tells you whether or not this journal is indexed by popular search engines and how visitors found this journal. Click <a href="#additionalInfo">here</a> to read more.</p>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
                    <h4 class="mt-2 bg-dark text-light text-center p-1 border-left-main">Referring Domains</h4>
                    <table class="table table-condensed table-striped table-sm" id="domainTable">
                        <thead>
                            <tr class="bg-dark text-light">
                                <th>Domains</th>
                                <th>Site Name</th>
                                <th class='text-center'>All</th>
                                <th class='text-center'>Unique</th>
                                <th class='text-center'>Returning</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                foreach($data['traffic'] as $dom)
                                {
                                    echo "<tr>";
                                    echo "<td>";
                                    echo Sanitize::clean($dom['pv_ref_dom']);
                                    echo "<td>";
                                    echo Sanitize::clean($dom['pv_ref_name']);
                                    echo "<td class='text-center'>";
                                    echo Sanitize::clean($dom['allVisitor']);
                                    echo "<td class='text-center'>";
                                    echo Sanitize::clean($dom['uniqueVisitor']);
                                    echo "<td class='text-center'>";
                                    echo Sanitize::clean($dom['allVisitor']-$dom['uniqueVisitor']);
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                    <h4 class="mt-2 bg-dark text-light text-center p-1 border-left-main">Popular Networks</h4>
                    <table class="table table-condensed table-striped table-sm" id="tsource">
                        <thead>
                            <tr class="bg-dark text-light">
                                <th>Networks</th>
                                <th class="text-center">Visits</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><i class='fa-brands fa-google'></i> Google</td><td class="text-center"><span class="badge badge-dark"><?=Sanitize::clean($data['google']);?></span></td>
                            </tr>
                            <tr>
                                <td><i class='fa-brands fa-yahoo'></i> Yahoo!</td><td class="text-center"><span class="badge badge-dark"><?=Sanitize::clean($data['yahoo']);?></span></td>
                            </tr>
                            <tr>
                                <td><i class='fa-brands fa-facebook'></i> Facebook</td><td class="text-center"><span class="badge badge-dark"><?=Sanitize::clean($data['facebook']);?></span></td>
                            </tr>
                            <tr>
                                <td><i class='fa-brands fa-twitter'></i> Twitter</td><td class="text-center"><span class="badge badge-dark"><?=Sanitize::clean($data['twitter']);?></span></td>
                            </tr>
                            <tr>
                                <td><i class='fa-brands fa-yandex'></i> Yandex</td><td class="text-center"><span class="badge badge-dark"><?=Sanitize::clean($data['yandex']);?></span></td>
                            </tr>
                            <tr>
                                <td><i class='fa-brands fa-microsoft'></i> Microsoft Bing</td><td class="text-center"><span class="badge badge-dark"><?=Sanitize::clean($data['bing']);?></span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            <p class="list-group-item">Last visitor was from <i><?=Sanitize::clean($data['last']['pv_ref_dom'])?></i>.</p>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="additionalInfo">
            <hr>
            <h3>Additional Information</h3>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 p-2">
                    <p><strong>Terms</strong></p>
                    <ol class="list-group">
                        <li class="list-group-item"><strong>Referring Domains</strong>: Domain of the websites where visitors found this journal URL and clicked on the URL.</li>
                        <li class="list-group-item"><strong>Popular Networks</strong>: The most popular domains or social networks known as referring domains.</li>
                    </ol>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 p-2">
                    <p><strong>Why it matters</strong></p>
                    <p class="list-group-item">Referring domains or traffic sources are telling you how this journal is distributed and found on the internet. It is expected that the articles published in this journal are searchable on Google Scholar and other indexing services or search engines because as an electronic journal, being indexed is very important for a journal.</p>
                    <p><strong>Best Practice</strong></p>
                    <p class="list-group-item">Take a look on the referring domain table and check if you can find Google Scholar (scholar.google). If you cannot find, it can be that this journal is not indexed yet. Look at the popular networks and find out what networks give this journal 0 visit. Manually index this journal through the search engines Webmaster (e.g. Google Search Console) so that people can find this journal easily. Also, encourage authors to write about trending topics and use strong or trending keywords. Additionally, share this journal URL to the social networks.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $.fn.DataTable.ext.pager.numbers_length = 5;
        $('#domainTable, #tsource').dataTable(
            {
                order:[[1, 'desc']]
            }
        );
    });
</script>