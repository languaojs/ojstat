<?php 
$siteid = Session::get_session('siteid');
?>
<a class="navbar-brand" href="<?=BASEURL;?>/public/<?=$_SESSION['user']['userrole'];?>/"><span class="badge badge-info"><?= $name;?></span></a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse justify-content-end align-items-center" id="navbarNav">
    <ul class="navbar-nav">
        <li class="nav-item active">
            <a class="nav-link" href="<?=BASEURL;?>/public/statistics/<?=$siteid;?>"><i class="fa fa-home"></i><span class="sr-only">(current)</span> Home</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Metrics
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="<?=BASEURL;?>/public/statistics/scimago/<?=$siteid;?>">Scimago</a>
            <a class="dropdown-item" href="<?=BASEURL;?>/public/statistics/copernicus/<?=$siteid;?>">Index Copernicus</a>
            <a class="dropdown-item" href="<?=BASEURL;?>/public/statistics/gscholar/<?=$siteid;?>">Google Scholar</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Statistics
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="<?=BASEURL;?>/public/statistics/visits/<?=$siteid;?>">Visits</a>
            <a class="dropdown-item" href="<?=BASEURL;?>/public/statistics/countries/<?=$siteid;?>">Visitor Countries</a>
            <a class="dropdown-item" href="<?=BASEURL;?>/public/statistics/domain/<?=$siteid;?>">Traffic Sources</a>
            <a class="dropdown-item" href="<?=BASEURL;?>/public/statistics/sysdev/<?=$siteid;?>">Systems and Devices</a>
            <a class="dropdown-item" href="<?=BASEURL;?>/public/statistics/pageview/<?=$siteid;?>">PageViews</a>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?=BASEURL;?>/public/journal">Journals</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?=BASEURL;?>/public/user/logout" onclick = "return confirm('Are you sure to logout now?');">Logout <span class="sr-only">(current)</span></a>
        </li>
    </ul>
</div>