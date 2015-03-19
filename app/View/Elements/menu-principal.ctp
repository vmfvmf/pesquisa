<?php  if(!$this->Session->check('Auth.User')){ ?>
        <li><?=$this->Html->link('Biblioteca',array('controller' => 'Bibliotecas', 'action' => 'index'));?></li>
        <li><?=$this->Html->link('Livros',array('controller' => 'Livros', 'action' => 'index')); ?></li>
<?php }else if($this->Session->read('Auth.User.role') === 'user'  ){ ?>
        <li><?=$this->Html->link('Biblioteca',array('controller' => 'Bibliotecas', 'action' => 'index'));?></li>
        <li><?=$this->Html->link('Empréstimos',array('controller' => 'Emprestimos', 'action' => 'emprestimos_aluno')); ?></li>
        <li><?=$this->Html->link('Livros',array('controller' => 'Livros', 'action' => 'index')); ?></li>
        <li><?=$this->Html->link('Reservas',array('controller' => 'Emprestimos', 'action' => 'reservas_aluno')); ?></li>
<?php }else if($this->Session->read('Auth.User.role') === 'sadmin' || $this->Session->read('Auth.User.role') === 'admin') { ?>
        <li><?=$this->Html->link('Biblioteca',array('controller' => 'Bibliotecas', 'action' => 'index'));?>
            <ul>
                <li><?=$this->Html->link('Editar',array('controller' => 'Bibliotecas', 'action' => 'edit'));?></li>
            </ul>
            <li><?=$this->Html->link('Livros',array('controller' => 'Livros', 'action' => 'index')); ?></li>
        </li>
<?php }  ?>

