<?php
$this->extend('/Common/simple');
$this->set("title_for_layout", 'Editar Autor');
$this->assign('fastwork',$this->Biblioteca->AutorFastWLink().
        $this->Html->image('../img/arrow.png').'<b> EDITAR </b>');

echo    $this->Form->create(),
                       $this->Form->input('autor'),
                       $this->Form->end('salvar');
?>