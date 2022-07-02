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
            <h3 class="mt-2 bg-hard-blue text-light text-center p-1">PageViews</h3>
            <p class="list-group-item border-left-main">Basically, what visitors were looking for are articles. That is the reason why they visited this journal. This page shows how many visits each article published in this journal has gotten. Click <a href="#additionalInfo">here</a> to read more.</p>
            <table class="table table-condensed table-striped table-sm" id="pageviewTable">
                <thead>
                    <tr class="bg-dark text-light">
                        <th>Page Titles</th>
                        <th class='text-center'>All</th>
                        <th class='text-center'>Unique</th>
                        <th class='text-center'>Returning</th>
                        <th class='text-center'>Average Duration</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    foreach($data['pageview'] as $pageview)
                    {
                        echo "<tr>";
                        echo "<td>";
                        echo Sanitize::clean($pageview['pv_pagetitle']);
                        echo "<td class='text-center'>";
                        echo Sanitize::clean($pageview['allVisitor']);
                        echo "<td class='text-center'>";
                        echo Sanitize::clean($pageview['uniqueVisitor']);
                        echo "<td class='text-center'>";
                        echo Sanitize::clean($pageview['allVisitor']-$pageview['uniqueVisitor']);
                        echo "<td class='text-center'>";
                        $visitAvg = ($pageview['visitDuration']/1000)/$pageview['allVisitor'];
                        echo Sanitize::clean( number_format($visitAvg, 2)) . " s";
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <br>
            <p class="list-group-item">The last page visited is <?=Sanitize::clean($data['last']['pv_pagetitle']);?> at <?=Sanitize::clean($data['last']['pv_date']);?>, <?=Sanitize::clean($data['last']['pv_time']);?>.</p>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="additionalInfo">
            <hr>    
            <h3>Additional Information</h3>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 p-3">
                    <p><strong>Terms</strong></p>
                    <p class="list-group-item"><strong>Page Views</strong>: Page views (or usually written PageView) is number represent the number of views of a page.</p>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 p-3">
                    <p><strong>Why it matters</strong></p>
                    <p class="list-group-item">Page view gives us information about the trending article in this journal, that also represents the trending topic searched by the visitors. It is expected that all articles published in this journal are visited.</p>
                    <p><strong>Best Practice</strong></p>
                    <p class="list-group-item">Search each article that has been published in this journal. If any article is not found in this table, you should check whether or not the link to the article is working. Broken link makes articles inaccessible. Additionally, share the link of least visited articles wherever possible to increase its visit (to make it contributive).</p>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $.fn.DataTable.ext.pager.numbers_length = 5;
        $('#pageviewTable').dataTable({
            order:[[1, 'desc']]
        });
    });
</script>