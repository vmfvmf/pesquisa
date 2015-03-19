<?php
$this->extend('/Common/simple');
$this->set("title_for_layout", 'Novo Autor');
$this->assign('fastwork',$this->Biblioteca->AutorFastWLink().
        $this->Html->image('../img/arrow.png').'<b> NOVO </b>');


        echo    $this->Form->create('Autor',array( 'action' => 'add')),
                       $this->Form->input('autor'),
            $this->Form->end('cadastrar');
?>
