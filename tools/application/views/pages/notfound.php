<p>&nbsp;&nbsp;&nbsp;</p>
<p class="text-center">
    <a href="<?= site_url('installer'); ?>" class="btn btn-primary btn-lg">
        <i class="fa fa-gears"></i> 
        Installer 
    </a>

    <a href="<?= site_url('upgrader'); ?>" class="btn btn-danger btn-lg">
        <i class="fa fa-refresh fa-spin"></i>
        Upgrade
    </a>

    <a href="<?= site_url('sync-db'); ?>" class="btn btn-warning btn-lg">
        <i class="fa fa-hdd-o"></i>
        DB Alter & Sync
    </a>
</p>
<p>&nbsp;&nbsp;&nbsp;</p> 
<?php echo $this->session->flashdata('message'); ?>