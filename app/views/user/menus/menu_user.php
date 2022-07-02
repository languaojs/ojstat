<a class="navbar-brand" href="<?=BASEURL;?>/public/<?=$_SESSION['user']['userrole'];?>/"><span class="badge badge-success"><?= $name;?></span></a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse justify-content-end" id="navbarNav">
    <ul class="navbar-nav">
    <li class="nav-item active">
        <a class="nav-link" href="<?=BASEURL;?>/public/<?=$_SESSION['user']['userrole'];?>/"><i class="fa fa-home"></i><span class="sr-only">(current)</span> Home</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?=BASEURL;?>/public/user/edit_profile">Edit Profile</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?=BASEURL;?>/public/journal">Journals</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?=BASEURL;?>/public/user/logout" onclick = "return confirm('Are you sure to logout now?');">Logout <span class="sr-only">(current)</span></a>
    </li>
    </ul>
</div>