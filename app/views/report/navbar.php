<nav class="navbar navbar-expand-lg navbar-dark">
    <a class="navbar-brand" href="#"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="<?=BASEURL;?>/public/report/<?=$data['siteid'];?>">Summary <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?=BASEURL;?>/public/report/journal/<?=$data['siteid'];?>">Journal Detail</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Metrics
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <?php 
                    if($data['config_info']['scimago']=="show")
                    {
                        echo "<a class='dropdown-item' href='".BASEURL."/public/report/scimago/$data[siteid]'>Scimago</a>";
                    }
                    if($data['config_info']['ici']=="show")
                    {
                        echo "<a class='dropdown-item' href='".BASEURL."/public/report/ici/$data[siteid]'>Index Copernicus</a>";
                    }
                    if($data['config_info']['gs']=="show")
                    {
                        echo "<a class='dropdown-item' href='".BASEURL."/public/report/gs/$data[siteid]'>Google Scholar</a>";
                    }
                ?>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Statistics
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <?php 
                    if($data['config_info']['vistat']=="show")
                    {
                        echo "<a class='dropdown-item' href='".BASEURL."/public/report/visit/$data[siteid]'>Visits Report</a>";
                    }
                    if($data['config_info']['country']=="show")
                    {
                        echo "<a class='dropdown-item' href='".BASEURL."/public/report/geolocation/$data[siteid]'>Geolocation Report</a>";
                    }
                    if($data['config_info']['domain']=="show")
                    {
                        echo "<a class='dropdown-item' href='".BASEURL."/public/report/traffic/$data[siteid]'>Traffic Sources Report</a>";
                    }
                    if($data['config_info']['system']=="show")
                    {
                        echo "<a class='dropdown-item' href='".BASEURL."/public/report/sysdev/$data[siteid]'>System and Device Report</a>";
                    }
                    if($data['config_info']['pageview']=="show")
                    {
                        echo "<a class='dropdown-item' href='".BASEURL."/public/report/pageview/$data[siteid]'>Page View Report</a>";
                    }
                ?>
                </div>
            </li>
        </ul>
    </div>
</nav>