<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table class="table table-condensed table-hover table-sm" id="browser" title="OJStat | Browser Widget">
                <thead>
                    <tr class="bg-dark text-light">
                        <th>Browsers</th>
                        <th class='text-center'>All Visitors</th>
                        <th class='text-center'>Unique Visitors</th>
                        <th class='text-center'>Returning Visitors</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach($data['data'] as $tbl)
                        {
                            $icons = "<img src='".BASEURL."/public/img/icons/".strtolower($tbl['pv_browser']).".png' width='30' height='30'/>";
                            echo "<tr>";
                            echo "<td>";
                            echo $icons ."  ". Sanitize::clean($tbl['pv_browser']);
                            echo "<td class='text-center'>";
                            echo Sanitize::clean($tbl['allVisitor']);
                            echo "<td class='text-center'>";
                            echo Sanitize::clean($tbl['uniqueVisitor']);
                            echo "<td class='text-center'>";
                            echo Sanitize::clean($tbl['allVisitor']-$tbl['uniqueVisitor']);
                            echo "</td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#browser').dataTable({
            order:[[1,'desc']],
            lengthMenu:[[5, 10, 25, 50, 75, 100, -1], [5, 10, 25, 50, 75, 100, "All"]],
            info:false
        });
    });
</script>