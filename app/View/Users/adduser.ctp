<div class="users form">
<?php echo $this->Form->create('User');?>
    <fieldset>
        <legend><?php echo __('NOVO USUÁRIO'); ?></legend>
        <?php 
        echo $this->Form->input('nome', array("label"=>"Nome Completo"));
        echo $this->Form->input('email', array("label"=>"E-Mail"));
        echo $this->Form->input('username', array("label"=>"Usuário"));
        echo $this->Form->input('password',array("label"=>"Senha"));
        echo $this->Form->input('role',array("type"=>"hidden", "value"=>"sadmin"));
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
