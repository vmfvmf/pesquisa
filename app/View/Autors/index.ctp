<?php
//$this->extend('/Common/simple');
//$this->set("title_for_layout", "Autores");  
//$this->assign('fastwork',$this->Html->link(' BIBLIOTECA ','../')   .
//        $this->Html->image('../img/arrow.png').'<b> AUTORES </b>');?>

<div id="main_div" >
<table>
    <thead>
        <tr>
            <th><b><?=$this->Paginator->sort('autor','AUTOR');?></b></th> 
            <th><b>AÇÃO</b></th>
        </tr>
    </thead>
    <tbody>
<?php foreach($autors as $autor){  ?>
        <tr>
               <td><?=$autor['Autor']['autor']; ?></td>
               
               <td>
                   <?= $this->Html->link($this->Html->image('edit.png'), 
                        array('controller' => 'Autors', 'action' => 'edit',$autor['Autor']['id']),
                        array('escape' => false, 'title' => "Editar"));?>
                   
                  | <?= $this->Html->link($this->Html->image('trash.png'), 
                        array('controller' => 'Autors', 'action' => 'delete',$autor['Autor']['id']),
                        array('escape' => false, 'title' => "Deletar"), "Deseja excluir este autor?");?> 
                 

               </td> 
        </tr>
<?php  }  ?>
</tbody>
</table>
<br/>
<?=$this->Paginator->prev('Ant | '),$this->Paginator->next('Prox       | '),$this->Paginator->numbers();?>
</div>