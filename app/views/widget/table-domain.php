<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table class="table table-condensed table-hover table-sm" id="domain" title="OJStat | Traffic Sources Widget">
                <thead>
                    <tr class="bg-dark text-light">
                        <th>Referring Domains</th>
                        <th>Domain Ids</th>
                        <th class='text-center'>All Visitors</th>
                        <th class='text-center'>Unique Visitors</th>
                        <th class='text-center'>Returning Visitors</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach($data['data'] as $tbl)
                        {
                            echo "<tr>";
                            echo "<td>";
                            echo Sanitize::clean($tbl['pv_ref_dom']);
                            echo "<td>";
                            echo Sanitize::clean($tbl['pv_ref_name']);
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
        $('#domain').dataTable({
            order:[[1,'desc']],
            lengthMenu:[[5, 10, 25, 50, 75, 100, -1], [5, 10, 25, 50, 75, 100, "All"]],
            info:false
        });
    });
</script>