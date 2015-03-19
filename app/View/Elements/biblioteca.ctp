<canvas id="canvas" width="600" height="400" style="border:1px solid #c3c3c3;top:0px;">
        Your browser does not support the HTML5 canvas tag.
</canvas>
<script>
    var canvas, stage, selected;
    var messageField;
        var loadingInterval = 0;
        var mouseTarget;	// the display object currently under the mouse, or being dragged
        var dragStarted;	// indicates whether we are currently in a drag operation
        var offset;
        var update = true;
        var container;
        var preload;
        var selectedimg, simgy;
        
         function handleBG(event){
            var image = event.target;
            var back = new createjs.Shape();
            back.x = 0;
            back.y = 0;
            back.name = "bg";
            back.graphics.beginBitmapFill(image,"repeat").drawRect(0,0,canvas.width,canvas.height);
            container.addChild(back);
            
            var img = new Image();
            img.src = "http://localhost/biblioteca/img/gifs/selected.GIF";
            img.onload = function(event){
                selectedimg = new createjs.Bitmap(event.target);
                stage.addChild(selectedimg);
                selectedimg.scaleX = selectedimg.scaleY = selectedimg.scale = 1;
                selectedimg.x = selectedimg.y = 20;
                selectedimg.visible = false;
            };
            document.getElementById("main_div").className = "";
            createjs.Ticker.addEventListener("tick", tick);
        }
</script>
<?php
    $scrip = 'var objs = [';
    foreach($objs as $obj){
        $scrip .= '{id:"'.$obj['Viewobjeto']['id'].'" , '
            . 'objeto:"'.$obj['Viewobjeto']['objeto'].'" , '
            . 'tipoobjeto_id:"'.$obj['Viewobjeto']['tipoobjeto_id'].'" , '
            . 'tipoobjeto:"'.$obj['Viewobjeto']['tipoobjeto']   .'" , '
            . 'max_rotacao:"'.$obj['Viewobjeto']['max_rotacao']   .'" , '
            . 'x:"'.$obj['Viewobjeto']['x'].'" , '
            . 'y:"'.$obj['Viewobjeto']['y'].'" , '
            . 'rotacao:"'.$obj['Viewobjeto']['rotacao'].'" , '
            . 'img_base:"'.$obj['Viewobjeto']['img_base'].'" , '
            . 'img:"'.$obj['Viewobjeto']['img']
            . '" },';
    }
    $scrip = substr($scrip, 0, strlen($scrip)-1);
    $scrip .= '];
            var manifest = [';
    foreach($imgs as $img){
        for($i=1;$i<=$img["Tipoobjeto"]["max_rotacao"];$i++)$scrip .= '{id:"'.$img["Tipoobjeto"]["img"].$i.'", '
                . 'src:"http://localhost/biblioteca/img/gifs/'.$img["Tipoobjeto"]["img"].$i.'.gif", cod:"'.$img["Tipoobjeto"]["id"].'" },';
        
    }
    $scrip = substr($scrip, 0, strlen($scrip)-1);
    $scrip .= '];
        
        /****** IMAGENS ***********/
        function init() {
            if (window.top != window) {
                document.getElementById("header").style.display = "none";
            }
            document.getElementById("main_div").className = "loader";
            // create stage and point it to the canvas:
            canvas = document.getElementById("canvas");
            stage = new createjs.Stage(canvas);
            selected = null;

            messageField = new createjs.Text("Loading", "bold 24px Arial", "#FFFFFF");
		messageField.maxWidth = 1000;
		messageField.textAlign = "center";
		messageField.x = canvas.width / 2;
		messageField.y = canvas.height / 2;
		stage.addChild(messageField);
		stage.update(); 

            // enabled mouse over / out events
            stage.enableMouseOver(10);
            stage.mouseMoveOutside = true; // keep tracking the mouse even when it leaves the canvas

            container = new createjs.Container();
            stage.addChild(container);
            stage.width=350;
            stage.height=350;
            

            preload = new createjs.LoadQueue();
            preload.addEventListener("complete", doneLoading); // add an event listener for when load is completed
            preload.addEventListener("progress", updateLoading);
            preload.loadManifest(manifest);
            
            // background
            var image = new Image();
            image.src = "http://localhost/biblioteca/img/gifs/308.gif";
            image.onload = handleBG;
        }

       
        
        function stop() {
            if (preload != null) { preload.close(); }
            createjs.Ticker.removeEventListener("tick", tick);
        }
        
        function updateLoading() {
		messageField.text = "Loading " + (preload.progress*100|0) + "%"
		stage.update();
	}
        
        function doneLoading(event) {
		clearInterval(loadingInterval);
		messageField.text = "Welcome: Click to play";
                stage.removeChild(messageField);
                logImages();
                stage.update();
                $("#obj-menu").show( 1000 );
	}
        
        function logImages() {
            var bitmap;
            objs.forEach(function(obj){
                src = $.grep(manifest, function(e){ return e.id == obj["img_base"]+obj["rotacao"]; })[0].src;
                bitmap = new createjs.Bitmap(src);
                bitmap.x = obj["x"];
                bitmap.y = obj["y"];
                bitmap.scaleX = bitmap.scaleY = bitmap.scale = 1;
                bitmap.name = obj["id"];';
        if(isset($idObj)){
            $scrip .= '
                if(bitmap.name =='.$idObj.'){
                    bitmap.cursor = "pointer";
                    bitmap.on("click", function(evt) {
                        alert("Prateleira: '.$prat.'");
                    });
                    selectedimg.x = Number(bitmap.x)+(bitmap.image.width/4);
                    simgy = selectedimg.y = Number(bitmap.y)-(bitmap.image.width/4); 
                    selectedimg.visible = true;
                }';
        }
        $scrip .='
            container.addChild(bitmap);
            });
            update = true;
        }

        function tick(event) {
            // this set makes it so the stage only re-renders when an event handler indicates a change has happened.
            /*if (update) {
                update = false; // only update once
                stage.update(event);
            }*/
            if(createjs.Ticker.getTicks()%10==0){
                // efeito de mexer da flecha selecionada
                selectedimg.y= (selectedimg.y==simgy)?selectedimg.y+2:simgy;
            }
            stage.update(event);
        }
        
        $(function(){
            $("#btSalvar").click( function(){
                var itens2save = new Array();
                container.children.forEach(function(obj){
                    if(obj.name != "bg"){ 
                        i = $.grep(objs, function(e){ return e.id == obj.name; })[0];
                        atual = $.grep(container.children, function(e){ return e.name == obj.name; })[0];
                        console.log("x:"+atual["x"]+",y:"+atual["y"]);
                        i["x"] = atual["x"];
                        i["y"] = atual["y"]>0?atual["y"]:0;
                        i["img"] = atual.image.src;
                        itens2save.push(i);
                    }
                });
                $.post("http://localhost/biblioteca/Bibliotecas/savecanvas",{
                            itens:itens2save
                        },function( data, status ) {
                            if(data["Objeto"]["id"])alert( "Dados armazenados." ); 
                            //console.log( JSON.stringify(data) ); 
                          }, "json");
            } );
            $(".add-objeto").click(function(){ 
                id = this.href.split("#")[1];
                objNome = prompt("Digite um nome:");
                    $.post("http://localhost/biblioteca/Bibliotecas/addobj",{
                        Objeto:{ objeto:objNome, tipoobjeto_id:id, x:0, y:0, rotacao:1 }
                    },function( data, status ) {
                        document.location.reload(true);
                      }, "json");
                });
            init();
            $("#obj-menu").superfish({});';
    $scrip .= ' 
            });';
    
    $this->Html->scriptStart(array('inline' => false));
    
    echo $scrip;
    $this->Html->scriptEnd();
    echo $this->Js->writeBuffer();
    ?>
