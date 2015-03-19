<?php
$this->assign('menu-principal', $this->element('menu-principal'));
$this->extend('/Common/simple');
$this->set("title_for_layout", "Livros");  
$this->assign('fastwork',$this->Biblioteca->LivroFastWLink().
        $this->Html->image('../img/arrow.png').'<b> ESTANTE - '.$prateleira["Viewprateleira"]["categoriaprateleira"]
        ." - ".$prateleira["Viewprateleira"]["objeto"].'</b>'); ?>
<div id="main_div">
    <h1>PRATELEIRA - <?=$prateleira["Viewprateleira"]["prateleira"];?> </h1>
<table>
    <tr>
        <td></td>
            <td><b><?=$this->Paginator->sort('titulo','TÍTULO');?></b></td> 
            <td><b>EDIÇÃO</b></td> 
            <td><b>EDITORA</b></td> 
            <td><b>AUTORES</b></td>
            <td><b>PROGRAMA</b></td>
            <?= $this->Session->read('Auth.User.role') === 'sadmin' ||
            $this->Session->read('Auth.User.role') === 'admin' ? '</li><td><b>AÇÃO</b></td>':''; ?>
    </tr>
    
<?php foreach($livros as $livro){  ?>
        <tr>
            <td><?=$this->Biblioteca->DetalhesLivro($livro['Viewlivrosdetalhe']['id']);?></td>
               <td><?=$livro['Viewlivrosdetalhe']['titulo']; ?></td>
               <td><?=$livro['Viewlivrosdetalhe']['edicao']; ?></td>
               <td><?=$livro['Viewlivrosdetalhe']['editora']; ?></td>
               <td><?=$livro['Viewlivrosdetalhe']['autor']; ?></td>
               <td><?=$livro['Viewlivrosdetalhe']['programa']; ?></td>
               
              <?= $this->Session->read('Auth.User.role') === 'sadmin' ||
            $this->Session->read('Auth.User.role') === 'admin' ?  
               '<td>
                   '.$this->Html->link($this->Html->image('edit.png'), 
                        array('controller' => 'Livros', 'action' => 'edit',$livro['Viewlivrosdetalhe']['id']),
                        array('escape' => false, 'title' => "Editar")).
                   
                 ' | '.$this->Html->link($this->Html->image('trash.png'), 
                        array('controller' => 'Livros', 'action' => 'delete',$livro['Viewlivrosdetalhe']['id']), 
                        array('escape' => false, 'title' => "Deletar"), "Deseja excluir este livro?").'</td> ' : ''; ?>

        </tr>
<?php  }  ?>
</table>
<br/>
<?=$this->Paginator->prev('Ant | '),$this->Paginator->next('Prox       | '),$this->Paginator->numbers();?>
</div>