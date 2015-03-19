<?php
$this->assign('menu-principal', $this->element('menu-principal'));
$this->extend('/Common/simple');
$this->set("title_for_layout", "Livros");  
$this->assign('fastwork',$this->Biblioteca->LivroFastWLink().
        $this->Html->image('../img/arrow.png').'<b> TODOS </b>'); ?>
<div id="main_div">
<table>
    <thead>
        <tr>
        <th></th>
            <th><?=$this->Paginator->sort('titulo','TÍTULO');?></th> 
            <th>EDIÇÃO</th> 
            <th>ANO</th> 
            <th>EDITORA</th> 
            <th>LOCALIZAÇÃO</th>
            <th>IDIOMA</th>
            <th>AUTORES</th>
            <?= $this->Session->read('Auth.User.role') === 'sadmin' ||
            $this->Session->read('Auth.User.role') === 'admin' ? '</li><th>AÇÃO</th>':''; ?>
        </tr>
    </thead>
    <tbody>
<?php foreach($livros as $livro){  ?>
        <tr>
            <td><?=$this->Biblioteca->DetalhesLivro($livro['Viewlivrosdetalhe']['id']);?></td>
               <td><?=$livro['Viewlivrosdetalhe']['titulo']; ?></td>
               <td><?=$livro['Viewlivrosdetalhe']['edicao']; ?></td>
               <td><?=$livro['Viewlivrosdetalhe']['ano']; ?></td>
               <td><?=$livro['Viewlivrosdetalhe']['editora']; ?></td>
               <td><?=$livro['Viewlivrosdetalhe']['localizacao']; ?></td>
               <td><?=$livro['Viewlivrosdetalhe']['idioma']; ?></td>
               <td><?php
                                $txt = "<ul>";
                                $autor = explode(',',$livro['Viewlivrosdetalhe']['autores']);
                                foreach($autor as $a){
                                    $txt .= '<li>'.str_replace(array('"','{','}'), '',$a).'</li>';
                                }
                                echo '</ul>'.$txt; 
                           ?>
               </td>
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
        </tbody>
</table>
<br/>
<?=$this->Paginator->prev('Ant | '),$this->Paginator->next('Prox       | '),$this->Paginator->numbers();?>
</div>