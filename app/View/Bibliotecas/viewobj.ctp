<script>
function novo(){
    $("#div_form").show(1000);
}
</script>
<h1><?=$data["Viewobjeto"]["estante"]?"Estante":$data["Viewobjeto"]["tipoobjeto"];?>
 </h1>

<?php if($data["Viewobjeto"]["estante"]){ ?>
        <h2><?=$data["Viewobjeto"]["tipoobjeto"]." - ".$data["Viewobjeto"]["objeto"];?> </h2>
        <input type="hidden" id="idPratSelecionada" value="" ></input>
        <table>
            <thead> 
                <th><b>PRATELEIRA</b></th>
                <th><b>TIPO</b></th>
                <th><b>AÇÕES</b></th>
            </thead>
            <tbody>
        <?php if($prats)foreach($prats as $prat){ ?>
            <tr>
                <td><?=$prat["Viewprateleira"]["prateleira"];?></td>
                <td><input type="hidden" value="<?=$prat["Viewprateleira"]["categoria_prateleira_id"];?>"></input>
                    <?=$prat["Viewprateleira"]["categoriaprateleira"];?>
                    <input type="hidden" value="<?=$prat["Viewprateleira"]["id"];?>"></input>
                </td>
                <td>
                    <?=$this->Html->link($this->Html->image('icondetails.png'), 
                        array('controller' => 'Livros','action' => 'prateleira',
                                                        $prat["Viewprateleira"]["id"]),
                        array('escape' => false, 'title' => "Livros"));?>
                </td>
            </tr>
        <?php } ?>
            </tbody>
        </table>
        <div id="div_form" style="display:none;" >
            <p>PRATELEIRA <input type="text" id="prateleira" /></p>
            <p><?=$this->Form->input('categoriaprateleira_id',array
                  ('options'=>$cats, 'label'=>'CATEGORIA'));?></p>
        </div>
    <?php }else{ ?>
    <p>  </p>
    <?php } ?>