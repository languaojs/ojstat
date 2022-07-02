<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table class="table table-condensed table-hover table-sm" id="country" title="OJStat | Country Widget">
                <thead>
                    <tr class="bg-dark text-light">
                        <th>Countries</th>
                        <th class='text-center'>All Visitors</th>
                        <th class='text-center'>Unique Visitors</th>
                        <th class='text-center'>Returning Visitors</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach($data['data'] as $tbl)
                        {
                            $flag = "<img src='".BASEURL."/public/img/flags/".strtolower($tbl['pv_countrycode']).".png' width='30' height='20' class='shadow'/>";
                            echo "<tr>";
                            echo "<td>";
                            echo $flag ."  ". Sanitize::clean($tbl['pv_country']);
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
        $('#country').dataTable({
            order:[[1,'desc']],
            lengthMenu:[[5, 10, 25, 50, 75, 100, -1], [5, 10, 25, 50, 75, 100, "All"]],
            info:false
        });
    });
</script>