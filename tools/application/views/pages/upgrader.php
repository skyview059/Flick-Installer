<h3>
    Application Information
    <small>
        <a href="<?= site_url(); ?>" class="pull-right"> 
            <i class="fa fa-long-arrow-left"></i> 
            Back to Main Page
        </a>
    </small>
</h3>

<hr/>

    <div class="row">
        
        <div class="col-md-12 bg-white">                                

            <p style="display: none;">
                <a href="" class="btn btn-success">
                    <i class="fa fa-gears"></i>
                    Run Upgrade
                    <i class="fa fa-play"></i>
                </a>
            </p>

            

            <ol class="steps">

                <li>Keep Backup of Files & Database
                    &nbsp;&nbsp;
                    <a href="action/bakup_files">Backup Files</a>
                    &nbsp;&nbsp;
                    <a href="action/bakup_db">Backup DB</a>
                </li>
                <li>Set Site Mode
                    &nbsp;&nbsp;
                    <a href="action/set_main">Under Maintenance</a>
                    &nbsp;&nbsp;
                    <a href="action/set_live">Live Back</a>
                </li>
                
                <li>MySQL Alter Query
                    &nbsp;&nbsp;
                    <a href="<?= site_url('sync-db'); ?>">
                        Open Page
                    </a>                
                </li>                                
                
                <li>Sync Default Data (Settings, Email Template)
                    &nbsp;&nbsp;
                    <a href="<?= site_url('main/import_data'); ?>">
                        Open Page
                    </a>
                </li>
                
                <li> 
                    <form method="post" name="dl" action="action/down_zip_n_unzip">
                    <div class="input-group">
                        <span class="input-group-addon">Download Patch</span>
                        <input name="patch_src" class="form-control" 
                               value="https://portal.flickmedialtd.com/uploads/plugins/27/vendor_v314.zip" type="text"/>                        
                        <span  class="input-group-btn">                            
                            <button type="submit" class="btn btn-primary">
                                Start
                                <i class="fa fa-play"></i>
                            </button>                                                        
                        </span>
                    </div>  
                    </form> 
                </li>
                <li> 
                    <form method="post" name="dl" action="action/down_zip_n_unzip">
                    <div class="input-group">
                        <span class="input-group-addon">Download Patch</span>
                        <input name="patch_src" class="form-control" 
                               value="https://portal.flickmedialtd.com/uploads/plugins/27/patch_v317.zip" type="text"/>
                        
                        <span  class="input-group-btn">                            
                            <button type="submit" class="btn btn-primary">
                                Start
                                <i class="fa fa-play"></i>
                            </button>                                                        
                        </span>
                    </div>  
                    </form> 
                </li>
                <li> 
                    <form method="post" name="dl" action="action/down_zip_n_unzip">
                    <div class="input-group">
                        <span class="input-group-addon">Download Patch</span>
                        <input name="patch_src" class="form-control" 
                               value="https://portal.flickmedialtd.com/uploads/plugins/27/assets_v317.zip" type="text"/>
                        
                        <span  class="input-group-btn">                            
                            <button type="submit" class="btn btn-primary">
                                Start
                                <i class="fa fa-play"></i>
                            </button>                                                        
                        </span>
                    </div>  
                    </form> 
                </li>
                
                
                
                
                
                
            </ol>

            <p>
                <a href="" class="btn btn-danger">
                    <i class="fa fa-trash"></i>
                    Delete Temp Backup Files
                </a>
            </p>

            <br/>
            <h4>Core Upgrades Area</h4>
            <ol class="steps">
                <li>Download Latest Version Zip File</li>
                <li>Keep Backup of Files & Database</li>
            </ol>


            <br/>
            <h4>Run Checkup before Upgrade</h4>
            <ol class="steps">
                <li>Download Latest Version Zip File</li>
                <li>Keep Backup of Files & Database</li>
            </ol>

            
        </div>
        
        
    </div>

<div class="bg-gray">                                
                       
    <?php echo $lic_info; ?>
</div>

