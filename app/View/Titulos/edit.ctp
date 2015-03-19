<?php
$this->assign('menu-principal', $this->element('menu-principal'));
$this->set("title_for_layout", "Editar Título"); 
$this->assign('fastwork',$this->Biblioteca->TituloFastWLink().
        $this->Html->image('../img/arrow.png').'<b> EDITAR </b>');

echo $this->Html->script('jquery', false);
echo $this->Html->script('jquery-ui', false);
    echo $this->Html->script('ui.multiselect', false);
    echo     $this->Html->css('ui.multiselect', null, array('inline' => false));
    
       echo    $this->Form->create(),
          $this->Form->input('titulo', array('label'=>'Título')),
                       
          $this->Form->input('Autor', array(
                              'label' => __('Autores',true),
                              'type' => 'select',
                              'options'=>$autors,
                               'class' => 'multiselect',
                               'multiple' => 'multiple',
                               'style' => 'clear: none !important; width:460px; height:200px;'
          )),                
          $this->Form->input('assunto_id',array('options'=>$assuntos, 'empty' => '')),
          $this->Form->input('localizacao_id',array('options'=>$localizacao, 'empty' => '')),
               $this->Form->input('resenha',array('label' => 'Resenha')),      
          $this->Form->end('Salvar');
       
          $this->Html->scriptStart(array('inline' => false));
          echo '$(function(){$(".multiselect").multiselect();});';

          $this->Html->scriptEnd();
          echo $this->Js->writeBuffer();
?>