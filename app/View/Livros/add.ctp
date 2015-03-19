<?php
$this->extend('/Common/simple');
echo $this->Html->script('jquery', false);
$this->set("title_for_layout", 'Novo Livro');
$this->assign('fastwork',$this->Biblioteca->LivroFastWLink().
        $this->Html->image('../img/arrow.png').'<b> NOVO </b>');

        echo    $this->Form->create('Livro',array( 'action' => 'add')),
                $this->Form->input('titulo_id',array('type' => 'hidden', 
                    'value'=> '0', 'id' => 'titulo_id')),
                $this->Form->input('titulo',array(
                    'id' => 'titulo', 'label' => 'Título',
                    'type' => 'text', 'class' => 'autocomplete'
                )),
                
                $this->Form->input('editora_id',array
                  ('options'=>$editoras, 'empty' => 'Selecione a editora')),
                $this->Form->input('Livro.edicao', array('label'=>'Edição')),
                $this->Form->input("Livro.data_aquisicao", array("id"=>"data_aquisicao", 
                    "label"=>"Data de Aquisição", "type"=>"text")),
                $this->Form->input('Livro.obs', array('label'=>'Observações')),
                $this->Form->input('Livro.ano'),
                $this->Form->input('idioma_id',array
                  ('options'=>$idiomas, 'empty' => 'Selecione o idioma')),
                $this->Form->input('programa_id',array
                  ('options'=>$progs, 'empty' => 'Selecione o programa')),
                $this->Form->input('prateleira_id',array
                  ('options'=>$prateleiras, 'empty' => 'Selecione prateleira')),
                $this->Form->input('qtd', array('label' => 'Quantidade','value'=>'1', 'type'=>'number')),
                $this->Form->end('cadastrar');
        
        $scrip = 'var availableTags = [';
                foreach($titulos as $key => $al){
                        $scrip .= '{label:"'.$al.'" , value:"'.$key.'" },';
                }
                $scrip = substr($scrip, 0, strlen($scrip)-1);
                $scrip .= '];
                    $(function(){$( ".autocomplete" ).autocomplete(
                        {
                            source:availableTags,
                            select: function( event, ui ) {
                                $( "#titulo_id" ).val(ui.item.value);
                                $( ".autocomplete" ).val( ui.item.label);
                                return false;
                        },focus: function( event, ui ) {
                            $( ".autocomplete" ).val( ui.item.label);
                            return false;}
                    });
                        $("#data_aquisicao").datepicker(
                            {   defaultDate: "01/01/2010",
                                dateFormat: "dd/mm/yy",
                                dayNames: ["Domingo","Segunda","Terça","Quarta","Quinta","Sexta","Sábado"],
                                dayNamesMin: ["D","S","T","Q","Q","S","S"],
                                dayNamesShort: ["Dom","Seg","Ter","Qua","Qui","Sex","Sáb"],
                                monthNames: ["Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro"],
                                monthNamesShort: ["Jan","Fev","Mar","Abr","Mai","Jun","Jul","Ago","Set","Out","Nov","Dez"],
                                nextText: "Próx",
                                prevText: "Ante",
                                changeYear: true,
                                changeMonth: true,
                            }
                        );
                    });';
        $this->Html->scriptStart(array('inline' => false));
                    echo $scrip;

                    $this->Html->scriptEnd();
                echo $this->Js->writeBuffer();
?>
