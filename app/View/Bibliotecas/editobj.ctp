<script>
function novo(){
    $("#div_form").show(1000);
}

function salvarPrateleira(){
    var id = $(selected)[0].name;
    var cat_id = $("#categoriaprateleira_id").val();
    var prat = $("#prateleira").val();
    var idPrat = $("#idPratSelecionada").val();
    $.post("addPrateleira2Estante",{id:id, idPrat:idPrat,
        categoriaprateleira_id:cat_id, prateleira:prat},
        function( data ) {
            atualiza();
    });
}

function atualiza(){
    var id = $(selected)[0].name;
    $.post("editobj",{id:id},
            function( data ) {
                $("#main_div_esquerda").html(data);
            });
}

function delPrat(id){
    if(!confirm("Deseja deletar prateleira?"))return;
    $.post("delprat",{id:id},
        function( data ) {
            atualiza();
    });
}

function editPrat(prat){
    var row = $(prat).parent().parent()[0].children;
    $("#div_form").show(1000);
    var inputPratId = $(row[1]).children()[1];
   $("#prateleira").val(row[0].innerHTML);
   $("#categoriaprateleira_id").val($(row[1]).children().val());
    $("#idPratSelecionada").val($(inputPratId).val());
}

function deletarObjeto(){
    if(!confirm("Deseja deletar objeto?"))return;
    var sel = $(selected)[0];
    $.post("delobj",{id:id},
        function( data ) {
            if(data){
                $(container)[0].removeChild(sel);
                $(stage)[0].update();
            }
    });
}

function rotate(){
    var sel = $(selected)[0];
    var obj = $.grep($(objs), function(e){ return e.id == sel.name; })[0];
    var src = obj["img_base"]; 
    obj["rotacao"] = obj["rotacao"]>=obj["max_rotacao"] ? 1 : Number(obj["rotacao"])+1;
    src = src + String(obj["rotacao"]);
    sel.image.src = "../img/gifs/"+src+".gif";
    $(stage)[0].update();
    $.post("rotateobj",{
                            Objeto:{id:sel.name,rotacao:obj["rotacao"]}
                        },function( data, status ) {
                            console.log( data ); 
                          }, "json");
}

</script>
<h1><?=$data["Viewobjeto"]["estante"]?"Estante":$data["Viewobjeto"]["tipoobjeto"];?>
    <button onclick="rotate();"> R </button> 
    <button onclick="deletarObjeto();"> - </button>
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
        <?php foreach($prats as $prat){ ?>
            <tr>
                <td><?=$prat["Viewprateleira"]["prateleira"];?></td>
                <td><input type="hidden" value="<?=$prat["Viewprateleira"]["categoria_prateleira_id"];?>"></input>
                    <?=$prat["Viewprateleira"]["categoriaprateleira"];?>
                    <input type="hidden" value="<?=$prat["Viewprateleira"]["id"];?>"></input>
                </td>
                <td>
                    <button onclick="delPrat(<?=$prat["Viewprateleira"]["id"];?>);"> - </button> 
                    <button onclick="editPrat(this);" > E </button>
                    <?=$this->Html->link($this->Html->image('icondetails.png'), 
                        array('controller' => 'Livros','action' => 'prateleira',
                                                        $prat["Viewprateleira"]["id"]),
                        array('escape' => false, 'title' => "Livros"));?>
                </td>
            </tr>
        <?php } ?>
            </tbody>
            <tfoot> 
                <td colspan="3">
                    <button onclick="novo();"> + </button>
                </td>
            </tfoot>
        </table>
        <div id="div_form" style="display:none;" >
            <p>Selecione<?=$this->Form->input('categoriaprateleira_id',array
                  ('options'=>$cats, 'label'=>'CATEGORIA'));?></p>
            <p><button onclick="salvarPrateleira();">ADICIONAR</button></p>
        </div>
    <?php }else{ ?>
    <p>  </p>
    <?php } ?>



