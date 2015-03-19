<?php
$this->extend('/Common/simple');
$this->set("title_for_layout", "Novo Título"); 
$this->assign('fastwork',$this->Biblioteca->TituloFastWLink().
        $this->Html->image('../img/arrow.png').'<b> NOVO </b>');

echo $this->Html->script('jquery', false);
echo $this->Html->script('jquery-ui', false);
    echo $this->Html->script('ui.multiselect', false);
    echo     $this->Html->css('ui.multiselect', null, array('inline' => false));
    
        echo    $this->Form->create('Titulo',array( 'action' => 'add')),
                       $this->Form->input('titulo', array('label'=>'Título')),
                       
          $this->Form->input('Autor', array(
                'label' => __('Autores',true), 'type' => 'select', 'options'=>$autors,
                'class' => 'multiselect', 'multiple' => 'multiple',
                'style' => 'clear: none !important; width:460px; height:200px;'
          )),
                
          $this->Form->input('assunto_id',array('options'=>$assuntos, 'empty' => '')),
          $this->Form->input('localizacao_id',array('options'=>$localizacao, 'empty' => 'Selecione...', 
              'label'=>'Localização')),
          $this->Form->input('resenha',array('label' => 'Resenha')),      
          $this->Form->end('cadastrar');
     
        $this->Html->scriptStart(array('inline' => false));
                    echo '$(function(){
                        $(".multiselect").multiselect();
                        $(document).tooltip();
                    });';

                    $this->Html->scriptEnd();
                echo $this->Js->writeBuffer();
?>
