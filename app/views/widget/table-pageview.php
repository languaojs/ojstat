<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table class="table table-condensed table-hover table-sm" id="pageview" title="OJStat | PageView Widget">
                <thead>
                    <tr class="bg-dark text-light">
                        <th>Page Titles</th>
                        <th class='text-center'>All Visitors</th>
                        <th class='text-center'>Unique Visitors</th>
                        <th class='text-center'>Returning Visitors</th>
                        <th class='text-center'>AVG Duration per View</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach($data['data'] as $tbl)
                        {
                            echo "<tr>";
                            echo "<td>";
                            echo Sanitize::clean($tbl['pv_pagetitle']);
                            echo "<td class='text-center'>";
                            echo Sanitize::clean($tbl['allVisitor']);
                            echo "<td class='text-center'>";
                            echo Sanitize::clean($tbl['uniqueVisitor']);
                            echo "<td class='text-center'>";
                            echo Sanitize::clean($tbl['allVisitor']-$tbl['uniqueVisitor']);
                            echo "<td class='text-center'>";
                            $pvDur = number_format($tbl['pvDur']/1000,1)."s"; 
                            echo Sanitize::clean($pvDur);
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
       var pvTable = $('#pageview').dataTable({
            order:[[1,'desc']],
            lengthMenu:[[5, 10, 25, 50, 75, 100, -1], [5, 10, 25, 50, 75, 100, "All"]],
            responsive:true
        });
        new $.fn.dataTable.FixedHeader(pvTable);
    });
</script>