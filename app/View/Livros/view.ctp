<?php
$this->assign('menu-principal', $this->element('menu-principal'));
$this->set("title_for_layout", "Detalhes Livro");  
$this->extend('/Common/view');
echo $this->Html->script('jquery', false);
echo $this->Html->script('createjs-2013.12.12.min', false);
echo $this->Html->script('jquery-ui', false);
echo $this->Html->script('jquery.confirm', false);

$this->assign('fastwork',$this->Biblioteca->LivroFastWLink().
        $this->Html->image('../img/arrow.png').'<b> DETALHES </b>');
$this->assign('viewtitle',$livro['Viewlivrosdetalhe']['titulo']);
$this->start('sidebar');
if($this->Session->read('Auth.User.role')){
    echo "<hr/><br/><ul>";
if($this->Session->read('Auth.User.role') === 'sadmin' ||
        $this->Session->read('Auth.User.role') === 'admin'){
    echo '<li>'.$this->Biblioteca->EditarLivroLink($livro['Viewlivrosdetalhe']['id'],true).'</li>';
    if(!$livro['Viewlivrosdetalhe']['disponivel']) 
        echo '<li>'.$this->Biblioteca->DevolverLivroLink($id_emp_livro,true).'</li>';
        $date1 = date_create($this->Time->format($livro['Viewlivrosdetalhe']['prazo_devolucao'],"%Y/%m/%d"));
        $date2 = new DateTime();
        $date2->format("%Y/%m/%d");
        $diff=date_diff($date1,$date2,false);
        if($diff->days >= 0 && $diff->invert>0) 
            echo "<li> " .$this->Biblioteca->RenovarPrazoLink($id_emp_livro,true). '</li>';?>
        <li><?=$this->Biblioteca->TodosEmprestimosLivro($livro['Viewlivrosdetalhe']['id']);?></li>
        <li><a id='linkA' href='' onclick='pegaRa();'>Reservar</a></li>
        <script>
            function pegaRa(){
                var ra = prompt('Digite a RA');
                if(ra)$('#linkA').attr('href', '../../Titulos/reservarAdmin/'+ra+
                    '/'+<?=$livro['Viewlivrosdetalhe']['titulo_id'];?>); 
            }
         </script>
<?php }else{ ?>
<li><?=$this->Biblioteca->ReservarTituloPAluno($livro['Viewlivrosdetalhe']['titulo_id']);?></li>
<ul/>
<?php } 
}?>
<hr/>
<br/>
<h3>Autor</h3>
<ul><?=$livro['Viewlivrosdetalhe']['autor'];?></ul>
<br>
<h3>Assunto</h3>
<ul><?=$livro['Viewlivrosdetalhe']['assunto'];?> <br/>
<h3>Resenha</h3>
<?php $this->end(); ?>
<div id="main_div">
    <?=$this->element('biblioteca', array('objs' => $objs,'imgs'=>$imgs,
    'idObj'=>$livro['Viewlivrosdetalhe']['disponivel']?$livro['Viewlivrosdetalhe']['estante_id']:null,
    'prat'=>$livro['Viewlivrosdetalhe']['prateleira']));?>
<table style='clear: none !important; float:left; margin: 0 auto !important'>
    <thead>
            <th><b>EDIÇÃO</b></th> 
            <th><b>EDITORA</b></th> 
            <th><b>PRAZO DEVOLUÇÃO</b></th>
            <th><b>PRATELEIRA</b></th>
    </thead>
    <tbody>
        <tr>
               <td><?=$livro['Viewlivrosdetalhe']['edicao']; ?></td>
               <td><?=$livro['Viewlivrosdetalhe']['editora']; ?></td>
               <td><?=($livro['Viewlivrosdetalhe']['prazo_devolucao']) ?
                    $this->Time->format($livro['Viewlivrosdetalhe']['prazo_devolucao'], '%d/%m/%Y') : 
                      (( $livro['Viewlivrosdetalhe']['reserva_id'] ) ? 'RESERVADO':'DISPONÍVEL'); ?></td>
               <td><?=($livro['Viewlivrosdetalhe']['prazo_devolucao']) ?
                    "EMPRESTADO" : 
                      (( $livro['Viewlivrosdetalhe']['reserva_id'] ) ? 'RESERVADO':
                              $livro['Viewlivrosdetalhe']['prateleira']); ?></td>
        </tr>
    </tbody>
    <tfoot></tfoot>
</table>

<br/>
<br/>
<hr/>
<br/>


</div>