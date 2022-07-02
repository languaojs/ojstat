<?php 
Session::start();
$role = array("admin", "user");
$ses_role = Session::get_sess_role();
Session::get_role($ses_role, $role);
$name = Session::get_name();
$siteid = Session::get_session('siteid');
?>
<div class="container">
    <div class="row mt-3">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h1 class="mt-2 bg-dark text-light text-center p-1">Widget Generator</h1>
            <p class="list-group-item border-left-main">With OJStat Widget Generator, you will no longer need to hard code your widget code. All you need to do is to choose what data you want to show and the type of widget you want to use. Moreover, you can set the width and height of the widget. Additionally, you can set whether or not the widget is scrollable and whether or not the frame border to show. Meanwhile, click <a href="#onwidg"> here</a> to get your <i>Online Visitor Widget Code</i>.
            </p>
            <br>
            <p><strong>Generate Widget</strong></p>
            <div class="row mt-2">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <label for="">Widget Type</label>
                        <select name="" id="type" class="form-control">
                            <option>chart</option>
                            <option>table</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Data to Show</label>
                        <select name="" id="data" class="form-control">
                            <option value="visit">Visits</option>
                            <option value="country">Visitor Countries</option>
                            <option value="domain">Traffic Source</option>
                            <option value="system">Operating System</option>
                            <option value="browser">Browser Usage</option>
                            <option value="device">Device Usage</option>
                            <option value="gs">Google Scholar (only for chart)</option>
                            <option value="ici">Index Copernicus (only for chart)</option>
                            <option value="pageview">PageViews (only for table)</option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <label for="">
                            Select Width
                        </label>
                        <select name="" id="iframeWidth" class="form-control">
                            <option value="100">100%</option>
                            <option value="50">50%</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Input Height (in pixel)</label>
                        <input type="number" name="" id="iframeHeight" value=350 class="form-control">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <label for="">Show Frameborder?</label>
                        <select name="" id="iframeborder" class="form-control">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Enable Scrolling?</label>
                        <select name="" id="iframescrolling" class="form-control">
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                            <option value="auto">Auto</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <input type="hidden" name="" value="<?=$siteid;?>" id="siteid">
                        <input type="hidden" name="" value="<?=BASEURL;?>/public/widget" id="baseurl">
                        <button id="create" onclick="getWidgetCode();" class="btn btn-dark btn-sm">Preview Widget and Get Code</button>
                    </div>
                    <p>Your widget preview will be shown <i class="fa fa-arrow-down"></i>
                    <div id="sampleframe"></div>
                    <p class="mt-3">
                        <code class="list-group-item" id="widgetcode"></code>
                    </p>
                </div>
            </div>
            <div class="row mt-2" id="onwidg">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <p><strong>Online Visitor Widget Code</strong></p>
                    <p class=" list-group-item border-left-main p-3">
                        <code>
                            &lt;iframe src=&quot;<?=BASEURL;?>/public/online/<?=$siteid;?>&quot; frameborder=&quot;0&quot; width=&quot;100%&quot; height=&quot;85px&quot; scrolling=&quot;no&quot;&gt;&lt;/iframe&gt;
                        </code>
                    </p>
                    <a href="<?=BASEURL;?>/public/journal"><i class="fa fa-arrow-left"></i> Return</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function getWidgetCode()
    {
        $('#sampleframe').empty();
        var getit = $('#baseurl').val() + '/' + $('#type').val() + '/' + $('#siteid').val() + '/' + $('#data option:selected').val();
        console.log(getit);
        var iframeit = document.createElement('iframe');
        iframeit.width=$('#iframeWidth option:selected').val()+'%';
        iframeit.height=$('#iframeHeight').val();
        iframeit.setAttribute("frameborder", $('#iframeborder option:selected').val());
        iframeit.setAttribute("scrolling", $('#iframescrolling option:selected').val());
        iframeit.src=getit;
        var sampleframe = document.getElementById('sampleframe');
        sampleframe.append(iframeit);
        var widgetcode = "&lt;iframe src=&quot;" +getit+ "&quot; width=&quot;"+iframeit.width+"&quot; height=&quot;"+iframeit.height+"px&quot; frameborder=&quot;"+$('#iframeborder option:selected').val()+"&quot; scrolling=&quot;"+$('#iframescrolling option:selected').val()+"&quot;&gt;&lt;/iframe&gt;";
        $('#widgetcode').html(widgetcode);
    }
</script>