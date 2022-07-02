<?php 

$jdata = Sanitize::cleanAll(array(
    'name'=>$data['journal_info']['web_name'],
    'pissn'=>$data['journal_info']['web_pissn'],
    'eissn'=>$data['journal_info']['web_eissn'],
    'url'=>$data['journal_info']['web_url'],
    'desc'=>$data['journal_info']['web_desc'],
    'img'=>$data['journal_info']['web_img'],
    'firstdate'=>$data['firstlast']['first'],
    'lastdate'=>$data['firstlast']['last'],
    'scimago'=>getIndex($data['journal_info']['web_scimago']),
    'ici'=>getIndex($data['journal_info']['web_ici']),
    'gs'=>getIndex($data['journal_info']['web_gscholarid'])
));

$udata = Sanitize::cleanAll(array(
    'name'=>$data['user_info']['user_fullname'],
    'email'=>$data['user_info']['user_email'],
    'desc'=>$data['user_info']['user_desc'],
    'img'=>$data['user_info']['user_img_url'],
    'link'=>$data['user_info']['user_link']
));

function getIndex($colName)
{
    if($colName !==''){
        return "Yes ($colName)";
    }else{
        return 'No';
    }
}

require_once 'top-row.php';
?>
<div class="container">
    <div class="row pl-2">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <p class="list-group-item border-left-main lead">Journal Details</p>
        </div>
    </div>
    <div class="row pl-2">
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 mb-2">
            <img src="<?=$jdata['img'];?>" class="img-thumbnail toHideMe"alt="">
        </div>
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
            <p><strong><?=$jdata['name'];?></strong> joined OJStat since <?=$jdata['firstdate'];?> and the last data OJStat recorded for this journal is at <?=$jdata['lastdate'];?>. Following are the details of this journal.</p>
            <div class="list-group-item text-justify">
                <strong><a href="<?=$jdata['url'];?>" target="blank"><?=$jdata['name'];?></a></strong>
                <br>PISSN: <?=$jdata['pissn'];?> | EISSN: <?=$jdata['eissn'];?><br>
                <br><?=$jdata['desc'];?><br><br>
                <strong>Indexing</strong>
                <div class="d-flex justify-content-start align-items-start">
                    <ul>
                        <li>Index Scimago: <?=$jdata['scimago'];?></li>
                        <li>Index Copernicus: <?=$jdata['ici'];?></li>
                        <li>Index Google Scholar: <?=$jdata['gs'];?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row pl-2 mt-3">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <p class="list-group-item border-left-main"><strong>Journal Manager</strong></p>
            <div class="row pl-2 mt-2">
                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                    <img src="<?=$udata['img'];?>" class="img-thumbnail profilePhoto toHideMe" alt="" width="150" height="200" style="display:none">
                </div>
                <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                    <strong><?=$udata['name'];?></strong><br>
                    <a href="<?=$udata['link'];?>"><i class="fa-brands fa-blogger"></i></a> | <a href="mailto:<?=$udata['email'];?>"><i class="fa-solid fa-envelope"></i></a><br>
                    <blockquote><p class="text-justify"><?=$udata['desc'];?></p></blockquote>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        setTimeout(function(){
            $('.profilePhoto').show("slide",{direction:'right'},1000)
        }, 1000);
    });
</script>