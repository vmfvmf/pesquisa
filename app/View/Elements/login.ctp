<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User',  
        array('action'=>'login'));?>
    <fieldset>
        <legend><?php echo __('Por favor digite o usuário e a senha'); ?></legend>
        <?php echo $this->Form->input('username',array('label'=>'Usuário'));
        echo $this->Form->input('password', array('label'=>'Senha'));
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Login'));?>
