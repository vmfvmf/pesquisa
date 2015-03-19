<?php  if(!$this->Session->check('Auth.User')){ ?>
    <li><?=$this->Html->link('Biblioteca',array('controller' => 'Bibliotecas', 'action' => 'index'));?></li>
    <li><?=$this->Html->link('Livros',array('controller' => 'Livros', 'action' => 'index')); ?></li>
<?php }else if($this->Session->read('Auth.User.role') === 'user'  ){ ?>
<li><?=$this->Html->link('Biblioteca',array('controller' => 'Bibliotecas', 'action' => 'index'));?></li>
<li><?=$this->Html->link('Empréstimos',array('controller' => 'Emprestimos', 'action' => 'emprestimos_aluno')); ?></li>
<li><?=$this->Html->link('Livros',array('controller' => 'Livros', 'action' => 'index')); ?></li>
<li><?=$this->Html->link('Reservas',array('controller' => 'Emprestimos', 'action' => 'reservas_aluno')); ?></li>
<?php }else if($this->Session->read('Auth.User.role') === 'sadmin' ||
        $this->Session->read('Auth.User.role') === 'admin') { ?>
<li><?=$this->Html->link('Biblioteca',array('controller' => 'Bibliotecas', 'action' => 'index'));?>
    <ul>
        <li><?=$this->Html->link('Editar',array('controller' => 'Bibliotecas', 'action' => 'edit'));?></li>
    </ul>
</li>
<li>
    <a href='#'>Cadastros</a>
    <ul>
        <li>
            <?=$this->Html->link('Alunos',array('controller' => 'Alunos', 'action' => 'index'));?>
            <ul>
                <li><?=$this->Html->link('Buscar',array('controller' => 'Alunos', 'action' => 'index'));?></li>
                <li><?=$this->Html->link('Novo',array('controller' => 'Alunos', 'action' => 'add'));?></li>
                <li><?=$this->Html->link('Todos',array('controller' => 'Alunos', 'action' => 'todos'));?></li>
            </ul>
        </li>
        <li><?=$this->Html->link('Assuntos',array('controller' => 'Assuntos', 'action' => 'index'));?>
            <ul>
                <li><?=$this->Html->link('Novo',array('controller' => 'Assuntos', 'action' => 'add'));?></li>
                <li><?=$this->Html->link('Todos',array('controller' => 'Assuntos', 'action' => 'index'));?></li>
            </ul>    
        </li>
        <li><?=$this->Html->link('Autores',array('controller' => 'Autors', 'action' => 'index'));?>
            <ul>
                <li><?=$this->Html->link('Novo',array('controller' => 'Autors', 'action' => 'add'));?></li>
                <li><?=$this->Html->link('Todos',array('controller' => 'Autors', 'action' => 'index'));?></li>
            </ul>
        </li>
        <li><?=$this->Html->link('Editoras',array('controller' => 'Editoras', 'action' => 'index'));?>
            <ul>
                <li><?=$this->Html->link('Novo',array('controller' => 'Editoras', 'action' => 'add'));?></li>
                <li><?=$this->Html->link('Todas',array('controller' => 'Editoras', 'action' => 'index'));?></li>
            </ul>
        </li>
        <li><?=$this->Html->link('Empréstimos',array('controller' => 'Emprestimos', 'action' => 'index'));?>
            <ul>
                <li><?=$this->Html->link('Buscar',array('controller' => 'Emprestimos', 'action' => 'index'));?></li>
                <li><?=$this->Html->link('Novo',array('controller' => 'Emprestimos', 'action' => 'add'));?></li>
                <li><?=$this->Html->link('Reservas',array('controller' => 'Emprestimos', 'action' => 'reservas'));?></li>
                <li><?=$this->Html->link('Todos',array('controller' => 'Emprestimos', 'action' => 'todos'));?></li>
            </ul>
        </li>
        <li><?=$this->Html->link('Idiomas',array('controller' => 'Idiomas', 'action' => 'index'));?>
            <ul>
                <li><?=$this->Html->link('Novo',array('controller' => 'Idiomas', 'action' => 'add'));?></li>
                <li><?=$this->Html->link('Todos',array('controller' => 'Idiomas', 'action' => 'index'));?></li>
            </ul>
        </li>
        <li><?=$this->Html->link('Livros',array('controller' => 'Livros', 'action' => 'index'));?>
            <ul>
                <li><?=$this->Html->link('Buscar',array('controller' => 'Livros', 'action' => 'index'));?></li>
                <li><?=$this->Html->link('Novo',array('controller' => 'Livros', 'action' => 'add'));?></li>
                <li><?=$this->Html->link('Todos',array('controller' => 'Livros', 'action' => 'todos'));?></li>
            </ul>
        </li>
        <li><?=$this->Html->link('Localizações',array('controller' => 'Localizacaos', 'action' => 'index'));?>
            <ul>
                <li><?=$this->Html->link('Nova',array('controller' => 'Localizacaos', 'action' => 'add'));?></li>
                <li><?=$this->Html->link('Todas',array('controller' => 'Localizacaos', 'action' => 'index'));?></li>
            </ul>
        </li>
        <li><?=$this->Html->link('Programas',array('controller' => 'Programas', 'action' => 'index'));?>
            <ul>
                <li><?=$this->Html->link('Novo',array('controller' => 'Programas', 'action' => 'add'));?></li>
                <li><?=$this->Html->link('Todos',array('controller' => 'Programas', 'action' => 'index'));?></li>
            </ul>
        </li>
        <li><?=$this->Html->link('Títulos',array('controller' => 'Titulos', 'action' => 'index'));?>
            <ul>
                <li><?=$this->Html->link('Novo',array('controller' => 'Titulos', 'action' => 'add'));?></li>
                <li><?=$this->Html->link('Todos',array('controller' => 'Titulos', 'action' => 'index'));?></li>
            </ul>
        </li>
    </ul>
</li>
<li><?=$this->Html->link('Relatórios',array('controller' => 'Relatorios', 'action' => 'index')); ?></li>
<?php }  ?>

