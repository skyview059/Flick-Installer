<h3>
        Site Settings 
        <small>
            <a href="<?= site_url(); ?>" class="pull-right"> 
                <i class="fa fa-long-arrow-left"></i> 
                Back to Main Page
            </a>
        </small>
    </h3>

    <hr/>


    <form class="form-horizontal" action="action/crm_installer" method="post" name="config" id="config">
        <fieldset>

            <div class="form-group">
                <label class="col-md-3 control-label" for="src_file">Site URL</label>  
                <div class="col-md-9">
                    <input id="site_url" name="src_file" value="<?= $install; ?>" type="text" class="form-control input-md">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label" for="site_url">Site URL</label>  
                <div class="col-md-9">
                    <input id="site_url" name="site_url" value="<?= $site_url; ?>" type="text" class="form-control input-md">                                    
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label" for="db_host">DB Host</label>  
                <div class="col-md-9">
                    <input id="db_host" name="db_host" value="<?= $db_host; ?>" type="text" class="form-control input-md">                                    
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label" for="db_name">DB Name</label>  
                <div class="col-md-9">
                    <input id="db_name" name="db_name" value="<?= $db_name; ?>"  type="text" class="form-control input-md">                                    
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label" for="db_user">DB User</label>  
                <div class="col-md-9">
                    <input id="db_user" name="db_user" value="<?= $db_user; ?>" type="text" class="form-control input-md">                                    
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label" for="db_pass">DB Pass</label>
                <div class="col-md-9">
                    <input id="db_pass" name="db_pass" value="<?= $db_pass; ?>" type="text" class="form-control input-md">                                    
                </div>
            </div>

            <div class="form-group">                                
                <div class="col-md-9 col-md-offset-3">
                    <div id="respond"></div>
                    <button type="button" id="test_conn" class="btn btn-primary">Test DB Connection</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>
        </fieldset>
    </form>  