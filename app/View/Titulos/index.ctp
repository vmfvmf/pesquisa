<?php
$this->set("title_for_layout", "Títulos");  
$this->extend('/Common/simple');
$this->assign('fastwork',$this->Html->link(' BIBLIOTECA ','../')   .
        $this->Html->image('../img/arrow.png').'<b> TÍTULOS </b>');?>
<div id="main_div">
<table>
    <thead>
        <tr>
            <th></th>
                <th><?=$this->Paginator->sort('titulo','TÍTULO');?></th> 
                <th>LOCALIZAÇÃO</th>
                <th>AUTORES</th>
                <th>ASSUNTO</th>
                <th>AÇÃO</th>
        </tr>
    </thead>
    <tbody>
<?php foreach($titulos as $titulo){  ?>
        <tr>
            <td><?=$this->Biblioteca->DetalhesTitulo($titulo['Viewtitulosdetalhe']['id']);?></td>
               <td><?=$titulo['Viewtitulosdetalhe']['titulo']; ?></td>
               <td><?=$titulo['Viewtitulosdetalhe']['localizacao']; ?></td>
               <td><?php
                                $txt = "";
                                $autor = explode(',',$titulo['Viewtitulosdetalhe']['autores']);
                                foreach($autor as $a){
                                    $txt .= str_replace(array('"','{','}'), '',$a).'<br>';
                                }
                                echo $txt;
                           ?>
               </td>
               <td><?=$titulo['Viewtitulosdetalhe']['assunto'];?>
               </td>
               <td>
                <?= $this->Html->link($this->Html->image('edit.png'), 
                        array("controller"=>"Titulos", "action"=>"edit",$titulo['Viewtitulosdetalhe']['id']), 
                        array('escape' => false, 'title' => "Editar"));?>
                   
                  | <?= $this->Html->link($this->Html->image('trash.png'), 
                        array("controller"=>"Titulos", "action"=>"delete",$titulo['Viewtitulosdetalhe']['id']), 
                        array('escape' => false, 'title' => "Deletar"), "Deseja excluir este titulo?");?> 
               </td> 
        </tr>
<?php  }  ?>
        </tbody>
</table>
<br/>
<?=$this->Paginator->prev('Ant | '),$this->Paginator->next('Prox       | '),$this->Paginator->numbers();?>
</div>