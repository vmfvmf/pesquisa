<?php
$this->extend('/Common/simple');

$this->set("title_for_layout", "Buscar Livro"); 
$this->assign('fastwork',$this->Html->link(' BIBLIOTECA ','../')   .
        $this->Html->image('../img/arrow.png').'<b> LIVROS</b>');

echo $this->Html->script('jquery', false);
echo $this->Html->script('jquery-ui', false);
    echo $this->Html->script('ui.multiselect', false);
    echo     $this->Html->css('ui.multiselect', null, array('inline' => false)); ?>
<div id="main_div">
    <div id="accordion"> 
        <?php
            if($this->Session->read('Auth.User.role') === 'admin' || 
                    $this->Session->read('Auth.User.role') === 'sadmin'){
                echo '<h3 class="divh3">Por Cód. Barras</h3><div>',
                
                    $this->Form->create(),
                         $this->Form->input("codbarras", array("type"=>"text", "label"=>"", "class"=>"autocomplete")),
                         $this->Form->input("tipo", array("type"=>"hidden", "value"=>"codbarras")  ),
                         $this->Form->end("Buscar"),
                
                 '</div>';
            }
        ?>
        <h3 class="divh3">Por Título</h3>
        <div>
                <?php
                    echo $this->Form->create(),
                         $this->Form->input("busca", array("type"=>"text", "label"=>"", "class"=>"autocomplete")),
                         $this->Form->input("tipo", array("type"=>"hidden", "value"=>"titulo")  ),
                         $this->Form->end("Buscar");
                ?>
        </div>

        <h3 class="divh3">Por Autor</h3>
        <div>
        <?php
                    echo $this->Form->create(),
                         $this->Form->input("busca", array("type"=>"text", "label"=>"", "class"=>"autocomplete")),
                         $this->Form->input("tipo", array("type"=>"hidden", "value"=>"autor")  ),
                         $this->Form->end("Buscar");
                ?>
        </div>
        
        <h3 class="divh3">Por Assunto</h3>
        <div>
       <?php
                    echo $this->Form->create(),
                         $this->Form->input("busca", array("type"=>"text", "label"=>"", "class"=>"autocomplete")),
                         $this->Form->input("tipo", array("type"=>"hidden", "value"=>"assunto")  ),
                         $this->Form->end("Buscar");
                ?>
        </div>
    </div>
</div>
    <?php
    $scrip = 'var names = [';
        foreach($titulos as $key => $al){
            $scrip .= '{label:"'.$al.'" , value:"'.$key.'" },';
        }
        $scrip = substr($scrip, 0, strlen($scrip)-1);
        $scrip .= '];
           $(function(){
            $( ".autocomplete" ).autocomplete(
             {
                source: names,
                select: function( event, ui ) {
                    $( "#titulo_id" ).val(ui.item.value);
                    $( ".autocomplete" ).val( ui.item.label);
                    $.get("data/"+ui.item.value,function(data,status)
                                  { /*$("#rel_div").html(data);*/ } );
			return false;
		},focus: function( event, ui ) {
                    $( ".autocomplete" ).val( ui.item.label);
			return false;}
            });});';
    $this->Html->scriptStart(array('inline' => false));
    
    echo $scrip.
        '
            $(function() { $( ".autocomplete" ).autocomplete();
            $(".multiselect").multiselect();
            $(document).tooltip();
            $( "#accordion" ).accordion();
            
        });';
    $this->Html->scriptEnd();
    echo $this->Js->writeBuffer();
    ?>