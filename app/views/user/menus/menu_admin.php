<a class="navbar-brand" href="<?=BASEURL;?>/public/admin"><span class="badge badge-primary"><?= $name;?></span></a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse justify-content-end" id="navbarNav">
    <ul class="navbar-nav">
    <li class="nav-item active">
        <a class="nav-link" href="<?=BASEURL;?>/public/admin"><span class="sr-only">(current)</span> Users</a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="<?=BASEURL;?>/public/journal" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Journals
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
        <a class="dropdown-item" href="<?=BASEURL;?>/public/journal/add_journal_form">Add Journal</a>
        <a class="dropdown-item" href="<?=BASEURL;?>/public/journal">List Journals</a>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?=BASEURL;?>/public/user/logout" onclick = "return confirm('Are you sure to logout now?');">Logout <span class="sr-only">(current)</span></a>
    </li>
    </ul>
</div>