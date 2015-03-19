<?php $this->assign('menu-principal', $this->element('menu-principal'));?>

    <div class="actions" id="actions">
        <h3><?php echo $this->fetch('viewtitle'); ?></h3>    
        <?php echo $this->fetch('sidebar'); ?>
    </div>
    <?php echo $this->fetch('content'); ?>