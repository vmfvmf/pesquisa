<?php

$this->set("title_for_layout", "Biblioteca"); 
$this->extend('/Common/simple');
$this->assign('fastwork','<b> BIBLIOTECA </b>');

echo $this->Html->script('jquery', false);
echo $this->Html->script('createjs-2013.12.12.min', false);
echo $this->Html->script('jquery-ui', false);
echo $this->Html->script('jquery.confirm', false);
    echo $this->Html->script('ui.multiselect', false);
    echo     $this->Html->css('ui.multiselect', null, array('inline' => false)); ?>
    <div id="main_div_esquerda"></div>
    <div id="main_div_direita">&nbsp;
     <br/>
     <br/>
    <canvas id="canvas" width="600" height="400" style="border:1px solid #c3c3c3;">
        Your browser does not support the HTML5 canvas tag.
    </canvas>
    </div>


    <?php
    $scrip = ' var canvas, stage, selected;'.
            'var objs = [';
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
                . 'src:"img/gifs/'.$img["Tipoobjeto"]["img"].$i.'.gif", cod:"'.$img["Tipoobjeto"]["id"].'" },';
        
    }
    $scrip = substr($scrip, 0, strlen($scrip)-1);
    $scrip .= '];
        var messageField;
        var loadingInterval = 0;
        var mouseTarget;	// the display object currently under the mouse, or being dragged
        var dragStarted;	// indicates whether we are currently in a drag operation
        var offset;
        var update = true;
        var container;
        var preload;
        var selectedimg, simgy;
        /****** IMAGENS ***********/
        function init() {
            if (window.top != window) {
                document.getElementById("header").style.display = "none";
            }
            document.getElementById("main_div_direita").className = "loader";
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
            image.src = "img/gifs/308.gif";
            image.onload = handleBG;
        }

        function handleBG(event){
            var image = event.target;
            var back = new createjs.Shape();
            back.x = 0;
            back.y = 0;
            back.name = "bg";
            back.graphics.beginBitmapFill(image,"repeat").drawRect(0,0,canvas.width,canvas.height);
            container.addChild(back);
            back.on("click", function(evt) {
                selectedimg.visible = false;
                
                detalhesBiblioteca();
            });
            document.getElementById("main_div_direita").className = "";
            createjs.Ticker.addEventListener("tick", tick);
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
        
        function detalhesBiblioteca(){
            $.post("Bibliotecas/detalhesBiblioteca",
                            function( data ) {
                                $("#main_div_esquerda").html(data);
                              });
        }
        
        function logImages() {
            var bitmap;
            objs.forEach(function(obj){
                src = $.grep(manifest, function(e){ return e.id == obj["img_base"]+obj["rotacao"]; })[0].src;
                
                bitmap = new createjs.Bitmap(src);
                bitmap.x = obj["x"];
                bitmap.y = obj["y"];
                bitmap.scaleX = bitmap.scaleY = bitmap.scale = 1;
                bitmap.name = obj["id"];
                bitmap.cursor = "pointer";
                // using "on" binds the listener to the scope of the currentTarget by default
                // in this case that means it executes in the scope of the button.
                bitmap.on("mousedown", function (evt) {
                        this.parent.addChild(this);
                        this.offset = {x: this.x - evt.stageX, y: this.y - evt.stageY};
                        selected = this;
                });

                bitmap.on("rollover", function (evt) {
                        this.scaleX = this.scaleY = this.scale * .98;
                        update = true;
                });

                bitmap.on("rollout", function (evt) {
                        this.scaleX = this.scaleY = this.scale;
                        update = true;
                });
                bitmap.on("click", function(evt) {
                    id = evt.target.name;
                        $.post("Bibliotecas/viewobj",{id:id},
                            function( data ) {
                                $("#main_div_esquerda").html(data);
                              });
                        selectedimg.x = Number(this.x)+(this.image.width/4);  //Number(this.x)+10;
                        simgy = selectedimg.y = Number(this.y)-(this.image.width/4); //Number(this.y)-10;
                        selectedimg.visible = true;
                });
                container.addChild(bitmap);
            });
            //selected
            img = new Image();
            img.src = "img/gifs/selected.GIF";
            img.onload = function(event){
                selectedimg = new createjs.Bitmap(event.target);
                selectedimg.scaleX = selectedimg.scaleY = selectedimg.scale = 1;
                selectedimg.x = selectedimg.y = 0;
                selectedimg.visible = false;
                stage.addChild(selectedimg);
                };
            update = true;
        }

        function tick(event) {
            if(createjs.Ticker.getTicks()%10==0){
                // efeito de mexer da flecha selecionada
                selectedimg.y= (selectedimg.y==simgy)?selectedimg.y+2:simgy;
            }
            stage.update(event);
        }
  
        $(function(){
            init();
            detalhesBiblioteca();
            $("#obj-menu").superfish({});';
            
    $scrip .= ' 
            });';
    
    $this->Html->scriptStart(array('inline' => false));
    
    echo $scrip;
    $this->Html->scriptEnd();
    echo $this->Js->writeBuffer();
    ?>
