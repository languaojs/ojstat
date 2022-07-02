<?php 
$siteid =  $_SESSION['user']['siteid'];
?>
<div class="container">
    <div class="row mt-3">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h3 class="bg-hard-blue text-light text-center p-3">Script Tag</h3>
            <div class="list-group-item border-left-main">
            <p><strong>What is a script tag?</strong></p>
            <p>Every journal registered in OJStat must have a script tag. A script tag is a JavaScript that functions to connect OJS and OJStat. The script tag below must be installed/copied into the header of the journal in OJS.</p>
            </div>
            <br>
            <p><strong>Instruction:</strong></p>
            <ol>
                <li>Login to your OJS as the journal editor</li>
                <li>Go to Settings and select Distribution</li>
                <li>Click Indexing</li>
                <li>Copy and paste the following code in the textbox (custom header tag)</li>
                <li>Make sure that it is on the top line</li>
                <li>Save change</li>
            </ol>
            <p><strong>Your Script Tag:</strong></p>
            <textarea id="scripttag" class="form-control border-left-main"></textarea>
            <br>
            <p><a href="<?=BASEURL;?>/public/journal"><i class="fa fa-arrow-left"></i> Return</a></p>
        </div>
    </div>
</div>
<script>
    var mybaseurl = "<?php echo BASEURL;?>";
    var mysiteid = "<?php echo $siteid;?>"
    var mytag = "&lt;script&gt;var ojSiteId="+mysiteid+";var ojstaturl=&quot;"+mybaseurl+"&quot;;var eajs = document.createElement(&apos;script&apos;);eajs.setAttribute(&quot;async&quot;,&quot;async&quot;);eajs.src=ojstaturl+&quot;/public/js/ojstat.js&quot;;document.head.append(eajs);&lt;/script&gt;";
    var scripttag = document.getElementById('scripttag');
    scripttag.innerHTML=mytag;
</script>