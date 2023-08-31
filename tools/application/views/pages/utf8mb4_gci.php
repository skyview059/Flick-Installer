          
    <h3>
        DB Information
        <small>
            <a href="<?= site_url(); ?>" class="pull-right"> 
                <i class="fa fa-long-arrow-left"></i> 
                Back to Main Page
            </a>
        </small>
    </h3>
    
    
    <div class="row">
        <div class="col-md-12"> 
            
            <p class="text-right">
                <a href="<?= site_url('main/import_tmp'); ?>" class="btn btn-primary">
                    Import Tmp Tbl
                </a>

                <a href="<?= site_url('main/delete_tmp'); ?>" class="btn btn-danger">
                    Delete Tmp Tbl
                </a>
                
                <a href="<?= site_url('main/utf8mb4_gci'); ?>" class="btn btn-warning">
                    Convert utf8mb4_uniconde_ci
                </a>
            </p>
            
             
<pre>
<?php 
   
    foreach($tbl_collat as $tbl ){ 
        echo $tbl->TABLE_NAME . " | "; 
        echo $tbl->TABLE_COLLATION . "\r\n"; 
    }

?>
</pre>

<pre id="utf8mb4">
<?php 

    foreach($quries as $query ){ 
        echo $query->AlterQuery . "\r\n"; 
    }

?>
</pre>
    <span class="btn btn-danger utf8mb4_alter">
        Execute
        <i class="fa fa-play"></i>
    </span>
        </div>        
    </div>