          
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
                <a href="<?= site_url('main/utf8mb4_gci'); ?>" class="btn btn-warning">
                    Convert utf8mb4_uniconde_ci
                </a>
                
                <a href="<?= site_url('main/import_tmp'); ?>" class="btn btn-primary">
                    Import Tmp Tbl
                </a>
                
                <a href="<?= site_url('main/import_data'); ?>" class="btn btn-success">
                    Import Default Data
                </a>
                
                <a href="<?= site_url('main/delete_tmp'); ?>" class="btn btn-danger">
                    Delete Tmp Tbl
                </a>
            </p>
            
            <?php echo $this->session->flashdata('message'); ?>
                                            
            <table class="table">
                <thead>
                   <tr>
                        <th width="120">Table</th>
                        <th>Query</th>
                        <th width="100">Action</th>
                    </tr> 
                </thead>
                                
                <?php foreach($tables as $tmp_tbl ){
                    $query      = '';
                    $org_tbl    = str_replace('_tmp_', '', $tmp_tbl);
                    if($this->db->table_exists( $org_tbl ) ){
                        $src_tbl_str = Db_tools::getTableStructure( $tmp_tbl );
                        $dis_tbl_str = Db_tools::getTableStructure( $org_tbl );
                        
                        if ($src_tbl_str != $dis_tbl_str) {
                            $sql    = Db_tools::generateAlterQuery($src_tbl_str, $dis_tbl_str, $org_tbl);                            
                            $query  = Db_tools::viewMySQLQuery( $sql );
                        }                                                
                    } else {                        
                        $query = Db_tools::createTableQuery( $tmp_tbl );                        
                    }                                        
                    
                ?>
                <tr>
                    <td>
                        <span><?= "{$tmp_tbl}"; ?></span><br/>
                        <strong><span><?= "{$org_tbl}"; ?></span></strong>                    
                    </td>
                    <td><?= $query; ?></td>
                    <td>
                        <?php if($query){ ?>
                        <span class="btn btn-danger execute">
                            Execute
                            <i class="fa fa-play"></i>
                        </span>  
                        <?php } else { ?>
                        <span class="btn btn-success">
                            100% Matched
                            <i class="fa fa-checked"></i>
                        </span>
                        <?php } ?>
                    </td>
                </tr>
                <?php } ?>
            </table>
            
            
            <form method="post" name="custom_sql">
                <textarea class="form-control" id="custom_sql"></textarea>
                <span class="btn btn-danger" id="custom_sql_btn">
                    Execute
                    <i class="fa fa-play"></i>
                </span> 
            </form>
            
        </div>
        
    </div>