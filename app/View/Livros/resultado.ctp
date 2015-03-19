<?php
$this->set("title_for_layout", "Resultado da Busca"); 
$this->assign('fastwork',$this->Biblioteca->LivroFastWLink().
        $this->Html->image('../img/arrow.png').'<b> RESULTADO </b>');
$this->extend('/Common/simple'); ?>

<div id="main_div">
    <table>
        <thead>
            <tr>
                <th></th>
                <th><?=$this->Paginator->sort('titulo','TÍTULO');?></th> 
                <th>AUTOR</th>
                <th>ASSUNTO</th>
                <th>EXEMPLARES</th>
                <th>DISPONÍVEIS</th>
            </tr>
        </thead>

<?php foreach($livros as $l){ ?>
        <tr>
            <td><?= $this->Biblioteca->DetalhesTitulo($l['Viewtitulosdetalhe']['id']);?></td>
            <td><?=$l['Viewtitulosdetalhe']['titulo']; ?></td>
            <td><?=$l['Viewtitulosdetalhe']['autor']?></td>
            <td><?=$l['Viewtitulosdetalhe']['assunto'];?></td>
            <td><?=$l['Viewtitulosdetalhe']['exemplares']; ?></td>
            <td><?=$l['Viewtitulosdetalhe']['disponiveis']; ?></td>
        </tr>
<?php  }  ?>

    </table>

</div>