<?php 
echo $data['setup_check'];
?>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 py-4 bg-dark text-light text-center">
            <h2>OJStat Setup Page</h2>
            <h1 class="display-1">Welcome</h1>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
            <blockquote><p>Thank you for choosing OJStat as your journal Statistic Counter. We provide you with this setup page to help you prepare OJStat so that your journal statistics recording can run as expected. Both new installations and upgrades must be run through this setup page. We hope you can read the setup instructions we provide below according to your type of OJStat installation. Enjoy the convenience of analyzing your journal statistics with OJStat. - Zainurrahman</p></blockquote>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h2>Instructions</h2>
            <p><strong>Notes for the current version of OJStat:</strong></p>
            <p>OJStat version 1.4 is a big leap that I have made in terms of developing the system. Most of the development going on in OJStat is based on suggestions I received on the PKP forums. Among the developments I've done on OJStat are security systems, feature additions, and performance improvements. Major improvements in OJStat cause the upgrade process to require a fairly large amount of resources. Therefore, it is wise to set the memory limit and maximum execution time to a high value. I would also suggest running the setup process step by step so that OJStat is ready to be used as it should be.</p>
            <h3>Fresh Installation</h3>
            <p>If this is your first time using OJStat, then there are only three setup steps you need to do.</p>
            <div class="alert alert-primary">
                <ol class="list-group">
                    <li class="list-group-item"><span class="badge badge-dark">Creating Tables</span> : I assume that you have created an empty database and that you have included this database information in the configuration file. This step aims to create the tables required by OJStat in the database. However, the fields in each table are only created in the second step.</li>
                    <li class="list-group-item"><span class="badge badge-dark">Creating Fields</span> : As you have installed or created the tables, this step will help you to create all the necessary fields in each table.</li>
                    <li class="list-group-item"><span class="badge badge-dark">Creating Admin Account</span> : When tables and fields are ready in your OJStat database, this step will create an administrator account. By default, the username and password is <i>admin</i> and you can change this login information later.</li>
                </ol>
            </div>
            <p>After completing the installation process, you need to set the value of the SETUP variable to false in the configuration file. By setting the value of the SETUP variable to false, you can access the login page.</p>
            <h3>Upgrade</h3>
            <p>The upgrade process is intended for those who have previously used OJStat version 1.3. Those using an earlier version of OJStat should upgrade to OJStat version 1.3 before moving on to OJStat version 1.4.</p>
            <p>There are more steps in the upgrade process than a fresh install. This is caused by fields that need to be removed from the database table as well as data that needs to be synchronized and some bugs from the previous version of OJStat that must be fixed. The resources required in the upgrade process depend on the amount of data in your OJStat database. In general, you need to set a high maximum memory limit and execution time value.</p>
            <p>There are seven steps in the upgrade process, three of which are the steps in the installation process that I described above.</p>
            <div class="alert alert-primary">
                <ol class="list-group">
                    <li class="list-group-item"><span class="badge badge-dark">Creating Tables</span> : This step aims to check whether your OJStat database has all the tables required by OJStat. Make sure that all tables get a <i class="fa fa-check text-success"></i> mark in the log.</li>
                    <li class="list-group-item"><span class="badge badge-dark">Creating Fields</span> : There are several new fields added in this version so this step aims to create fields that are not already in any table in your database.</li>
                    <li class="list-group-item"><span class="badge badge-dark">Creating Admin Account</span> : You still have a default account from the previous version of OJStat but this account is not an administrator account. Since OJStat version 1.4 is multiuser OJStat, each account has its own role. This step will create the existing account as an administrator account.</li>
                    <li class="list-group-item"><span class="badge badge-dark">Removing Unused Fields</span> : Some fields are no longer needed in this version so this step serves to delete those fields.</li>
                    <li class="list-group-item"><span class="badge badge-dark">Reindexing Fields</span> : Reindexing means updating the primary key for each table in the database.</li>
                    <li class="list-group-item"><span class="badge badge-dark">Finishing Table Setup</span> : The database table setup process is completed by fixing the country code record error that occurred in version 1.3. This bug causes country flags not to appear as they should so in the previous version I provided a patch to fix this bug. In this version, the patch is no longer needed.</li>
                    <li class="list-group-item"><span class="badge badge-dark">Sync Data</span> : To complete the setup process, the data must be synchronized. This last step requires quite a bit of resources (I thought I already told you about this). I believe that the amount of data held by your OJStat is in the tens of thousands. By default, OJStat will sync 150 data at a time. If you have a very good internet connection and have set maximum memory and execution time limits, you can increase the amount of data to sync from 150 to 200 or more. However I suggest that data synchronization occurs gradually.</li>
                </ol>
            </div>
            <p>After the data synchronization process is complete and you have 0 data to sync, then you are allowed to set the value of the SETUP variable to false and login with your account. Are you ready to start the Setup now?</p>
            <p class="text-center"><a href="<?=BASEURL;?>/public/setup/start" class="btn btn-dark btn-lg">Start Setup Now</a></p>
        </div>
    </div>
</div>