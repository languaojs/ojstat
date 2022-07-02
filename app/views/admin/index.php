<?php
Session::start();
$role = array("admin");
$ses_role = Session::get_sess_role();
Session::get_role($ses_role, $role);
$name = Session::get_name();
?>
<div class="flash" style="display:none;">
    <?php 
        Flasher::flash();
    ?>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <?php require_once '../app/views/user/menus/menu_'.$data['userrole'].'.php';?>
            </div>
        </nav>
    </div>
</div>
<br>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="row">
                <div id="myVisitChartBox" style="width:100%; height:300px" class="p-3">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <img src="<?=BASEURL;?>/public/img/misc/see-stat-4.jpg" class="img-fluid float-right" alt="">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <p class="list-group-item border-left-main">Now, you can add users as many as necessary. Different users can be assigned to manage different journals. It will be useful to decrease your working time while increasing your team-work. You can disable particular users if you need to restrict their access to OJStat. You can also edit their profiles and passwords when needed. Instead of adding new users, you can edit existing users.</p>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="flex-between mb-3">
                <h3 class="text-primary">Users</h3>
                <a href="<?=BASEURL;?>/public/admin/add_user_form" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add User</a>
            </div>
            <table class="table table-condensed table-sm">
                <thead>
                    <tr class='bg-dark text-light'>
                        <th class='text-center'>Num.</th>
                        <th>User Name</th>
                        <th>User Role</th>
                        <th class='text-center'>RoleID</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $num = 1;
                    if(!empty($data['users_data']))
                    {
                    foreach($data['users_data'] as $userdata)
                        {
                            echo "<tr>";
                            echo "<td class='text-center'>";
                            echo $num++;
                            echo '<td>';
                            echo Sanitize::clean($userdata['fullname']);
                            echo '<td>';
                            echo Sanitize::clean($userdata['role']);
                            echo "<td class='text-center'>";
                            echo Sanitize::clean($userdata['roleid']);
                            echo '<td>';
                            echo Sanitize::clean($userdata['status']);
                            echo '<td>';
                            echo "<a href='". BASEURL."/public/user/detail/". $userdata['user_id']."' class='badge badge-primary'>Detail</a> ";
                            
                            if($userdata['status']=='active' && $userdata['role'] !=='admin')
                            {
                                echo "<a href='". BASEURL."/public/user/disable/|ssd324df4|". $userdata['user_id']."|sdascs3432c"."' class='badge badge-warning'>Disable</a> ";
                            }elseif($userdata['status']=='disabled' && $userdata['role'] !=='admin')
                            {
                                echo "<a href='". BASEURL."/public/user/enable/|ssd324df4|". $userdata['user_id']."|sdascs3432c"."' class='badge badge-success'>Enable</a> ";
                            }else{
                                echo "<span class='badge badge-secondary'>Cannot Change</span> ";
                            }

                            echo "<a href='". BASEURL."/public/user/password_form/|ssd324df4|". $userdata['user_id']."|sdascs3432c"."' class='badge badge-info'>Password</a> ";

                            echo '</td>';
                            echo '</tr>';
                        }
                    }else{
                        echo "<tr>";
                        echo "<td colspan='6'>";
                        echo "Please add at least one user before adding a journal.";
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <br>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col md-12 col-lg-12">
            <?php 
                if(OJSTATART == 'true')
                {?>
                   <div id='carouselExampleSlidesOnly' class='carousel slide' data-ride='carousel' data-interval='5000'>
                    <div class='carousel-inner'>
                        <div class="carousel-item active">
                         <p class='list-group-item border-left-main'><a href='https://www.ojstat.eu.org' target='blank'>Visit OJStat Official Blog</a></h4>
                        </div>
                        <?php 
                            foreach($data['curlojstat'] as $curlo)
                            {
                                echo "<div class='carousel-item'>";
                                echo "<p class='list-group-item border-left-main'><a href ='$curlo[href]' target='blank'>$curlo[text]</a>";
                                echo "</div>";
                            }
                        ?>
                    </div>
                   </div>
                <?php }else{
                    echo "";
                }
            ?>
        </div>
    </div>
</div>
<script>

$(document).ready(function(){
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Journals', 'Users'],
            datasets: [{
                label: '# OJStat State',
                data: [<?=$data['journalNum'];?>,<?=$data['userNum'];?>],
                backgroundColor: [
                    'rgba(48, 47, 171, 0.8)',
                    'rgba(48, 47, 171, 0.51)'
                ],
                borderColor: [
                    'rgba(48, 47, 171, 1)',
                    'rgba(48, 47, 171, 0.51)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    grid:{
                        display:false
                    }
                },
            },
            responsive: true,
            maintainAspectRatio: false,
        }
    });
});

</script>