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
            <h3 class="mt-2 bg-hard-blue text-light text-center p-1">System and Devices</h3>
            <p class="list-group-item border-left-main">This page contains information regarding the operating system, device, and browser used by visitors when visit this journal. This information is important for journal website optimization. Click <a href="#additionalInfo">here</a> to find out more.</p>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <h4 class="mt-2 bg-dark text-light text-center p-1 border-left-main">Operating Systems</h4>
                    <table class="table table-condensed table-sm">
                        <thead>
                            <tr class="bg-dark text-light">
                                <th class='text-center'>OS</th>
                                <th class='text-center'>All</th>
                                <th class='text-center'>Unique</th>
                                <th class='text-center'>Returning</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            foreach($data['system'] as $system)
                            {
                                $os = "<img src='".BASEURL."/public/img/icons/".$system['pv_os'].".png' width='30' height='30' title='".$system['pv_os']."'/>";
                                echo "<tr>";
                                echo "<td class='text-center'>";
                                echo $os;
                                echo "<td class='text-center'>";
                                echo Sanitize::clean($system['allVisitor']);
                                echo "<td class='text-center'>";
                                echo Sanitize::clean($system['uniqueVisitor']);
                                echo "<td class='text-center'>";
                                echo Sanitize::clean($system['allVisitor']-$system['uniqueVisitor']);
                                echo "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <h4 class="mt-2 bg-dark text-light text-center p-1 border-left-main">Devices</h4>
                    <table class="table table-condensed table-sm">
                        <thead>
                            <tr class="bg-dark text-light">
                                <th class='text-center'>Devices</th>
                                <th class='text-center'>All</th>
                                <th class='text-center'>Unique</th>
                                <th class='text-center'>Returning</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            foreach($data['device'] as $device)
                            {
                                $dev = "<img src='".BASEURL."/public/img/icons/".$device['pv_device'].".png' width='30' height='30' title='".$device['pv_device']."'/>";
                                echo "<tr>";
                                echo "<td class='text-center'>";
                                echo $dev;
                                echo "<td class='text-center'>";
                                echo Sanitize::clean($device['allVisitor']);
                                echo "<td class='text-center'>";
                                echo Sanitize::clean($device['uniqueVisitor']);
                                echo "<td class='text-center'>";
                                echo Sanitize::clean($device['allVisitor']-$device['uniqueVisitor']);
                                echo "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <h4 class="mt-2 bg-dark text-light text-center p-1 border-left-main">Browsers</h4>
                    <table class="table table-condensed table-sm">
                        <thead>
                            <tr class="bg-dark text-light">
                                <th class='text-center'>Browsers</th>
                                <th class='text-center'>All</th>
                                <th class='text-center'>Unique</th>
                                <th class='text-center'>Returning</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            foreach($data['browser'] as $browser)
                            {
                                $brw = "<img src='".BASEURL."/public/img/icons/".$browser['pv_browser'].".png' width='30' height='30' title='".$browser['pv_browser']."'/>";
                                echo "<tr>";
                                echo "<td class='text-center'>";
                                echo $brw;
                                echo "<td class='text-center'>";
                                echo Sanitize::clean($browser['allVisitor']);
                                echo "<td class='text-center'>";
                                echo Sanitize::clean($browser['uniqueVisitor']);
                                echo "<td class='text-center'>";
                                echo Sanitize::clean($browser['allVisitor']-$browser['uniqueVisitor']);
                                echo "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            <p class="list-group-item">Last visitor accessed this journal by using <?=$data['last']['pv_browser'];?> in a <?=Sanitize::clean($data['last']['pv_device']);?> with <?=Sanitize::clean($data['last']['pv_os']);?> installed.</p>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="additionalInfo">
            <hr>
            <h3>Additional Information</h3>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 p-3">
                    <p><strong>Terms</strong></p>
                    <ol class="list-group">
                        <li class="list-group-item"><strong>Operating System</strong>: system (Microsoft Windows, Linux, iOS, Android, etc) installed on the visitor's device when visiting this journal.</li>
                        <li class="list-group-item"><strong>Device</strong>: device (desktop, laptop, netbook, tablet, smartphone, etc.) used by the visitors when they visited this journal.</li>
                        <li class="list-group-item"><strong>Browser</strong>: browser application used by the visitors when they visited this journal.</li>
                    </ol>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 p-3">
                        <p><strong>Why it matters</strong></p>
                        <p class="list-group-item">We want to serve visitor as best as we can. We want this journal to appear on different devices perfectly. Consequently, we need to know the system and device used by the visitor when accessing this journal. Armed with this information, we can optimize this journal finding 'bugs' and fixing them. For example, some plugins or add-ons we installed on this journal does not work in several browsers so that we may need to find the alternative rather than showing errors to the visitors.</p>
                        <p><strong>Best Practice</strong></p>
                        <p class="list-group-item">Take a look at the most used operating system, device, and browser. Try to mimic the visitor by using the device of similar screen size, using the same browser app, and the same operating system. Look at the parts on this journal that do not work properly and fix them. Find out whether this journal appears responsively on various screen sizes.</p>
                </div>
            </div>
        </div>
    </div>
</div>
