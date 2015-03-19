<?php
$this->set("title_for_layout", "Detalhes Título");  
$this->extend('/Common/view');
$this->assign('fastwork', $this->Html->link(' BIBLIOTECA ','../')   .
        $this->Html->image('../img/arrow.png').
      (( $this->Session->read('Auth.User.role') === 'admin' ||
          $this->Session->read('Auth.User.role') === 'sadmin') ?
        $this->Html->link(' TÍTULOS ',array('controller' => 'Titulos', 'action' => 'index')) : 
        $this->Html->link(' TÍTULOS ',array('controller' => 'Livros', 'action' => 'index'))) .
        $this->Html->image('../img/arrow.png').'<b> DETALHES </b>');


$this->assign('viewtitle',$titulo['Viewtitulosdetalhe']['titulo']);
$this->start('sidebar');
if($this->Session->read('Auth.User.role') === 'admin' || $this->Session->read('Auth.User.role') === 'user'
         || $this->Session->read('Auth.User.role') === 'sadmin' ){ ?>
<hr/>

<ul>
    <li><?= $this->Session->read('Auth.User.role') === 'user'?
    $this->Biblioteca->ReservarTituloPAluno($titulo['Viewtitulosdetalhe']['id']) :
    "<li><a id='linkA' href='' onclick='pegaRa();'>Reservar</a></li><script>function pegaRa(){"
             . "var ra = prompt('Digite a RA');"
                 . " if(ra)$('#linkA').attr('href', '../reservarAdmin/'+ra+'/"
                 .$titulo['Viewtitulosdetalhe']['id'].
                 "'); }</script>" ;?></li>
</ul>  
<hr/>
<?php } ?>

<h3>Autor</h3>
<ul>
<?=$titulo['Viewtitulosdetalhe']['autor']?>       
</ul>
<br>
<h3>Assunto</h3>
<ul>
<?=$titulo['Viewtitulosdetalhe']['assunto'];?>
</ul>
<br/>
<h3>Resenha</h3>
<p id="p_resenha"><?=$titulo['Viewtitulosdetalhe']['resenha'];?></p>
<br/>
<br/>
<?php $this->end(); ?>
<h2>EXEMPLARES</h2>
<table style='clear: none !important; float:right; width:76%; margin: 0 auto !important'>
    <thead><tr>
        <th></th>
            <th>EDIÇÃO</th> 
            <th>EDITORA</th> 
            <th>PRAZO DEVOLUÇÃO</th>
    </tr></thead>
    <?php foreach($livros as $livro){  ?>
        <tr>
            <td><?=$this->Biblioteca->DetalhesLivro($livro['Viewlivrosdetalhe']['id']);?></td>
               <td><?=$livro['Viewlivrosdetalhe']['edicao']; ?></td>
               <td><?=$livro['Viewlivrosdetalhe']['editora']; ?></td>
               <td><?=$livro['Viewlivrosdetalhe']['disponivel']?($livro['Viewlivrosdetalhe']['reserva_id']?"RESERVADO":"DISPONÍVEL"):
                    $this->Time->format($livro['Viewlivrosdetalhe']['prazo_devolucao'], '%d/%m/%Y'); ?></td>
        </tr>
    <?php  }  ?>

</table>
