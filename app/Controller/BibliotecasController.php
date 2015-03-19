<?php
    class BibliotecasController extends AppController{
        
        public $name = "Bibliotecas";
        
        public $uses = array("Viewobjeto", "Objeto", "Viewprateleira","Categoriaprateleira", 
            "Tipoobjeto", "Prateleira", "Livro","Emprestimo");
        
        function beforeFilter() {
            parent::beforeFilter();
            $this->Auth->allow('index', 'detalhesBiblioteca','viewobj'); 
        }
        
        public function index() {
            self::getObjects();
        }
        
        public function edit() {
            self::getObjects();
        }
        
        
        public function localizacao($idObj = null){
            self::getObjects();
            if($idObj){
                $this->set(compact('idObj'));
            }
        }


        private function getObjects(){
            $objs = $this->Viewobjeto->find("all");
            $this->set(compact('objs'));
            
            $imgs = $this->Tipoobjeto->find("all");
            $this->set(compact('imgs'));
        }
        
        
        public function addobj(){
            $this->layout = null ;
            //$data = 
            $this->Objeto->create();
            $data = $this->request->data["Objeto"];
            if($this->Objeto->save(array("Objeto"=>array("tipoobjeto_id"=>$data["tipoobjeto_id"],
                "x"=>0,"y"=>0, "rotacao"=>1,"objeto"=>$data["objeto"])))){
                $this->set('data', $data);
            }else{
                $this->set('data', 0);
            }
            $this->render('/Elements/ajaxreturn');
        }
        
        public function delobj(){
            $this->layout = null ;
            $id = $this->request->data["id"]; 
                if($this->Objeto->delete($id)){
                    $data = true;
                }else{
                    $data = null;
                }
            $this->set('data', $data);
            $this->render('/Elements/ajaxreturn');
        }
        
        public function delprat(){
            $this->layout = null ;
            $id = $this->request->data["id"]; 
                if($this->Prateleira->delete($id)){
                    $data = true;
                }else{
                    $data = $this->request->data["id"]; 
                }
            $this->set('data', $data);
            $this->render('/Elements/ajaxreturn');
        }
        
        public function saveobj(){
            $this->layout = null ;
            $data = $this->request->data["Objeto"]; 
            if (!$data["id"]) {
                   $data = null;
            }else{
                $obj = $this->Objeto->findById($data["id"]);
                $obj["Objeto"]["x"] = $data["x"];
                $obj["Objeto"]["y"] = $data["y"];
                //$obj["Objeto"]["rotacao"] = $data["rotacao"]!=false?$data["rotacao"]:$obj["Objeto"]["rotacao"];

                if($this->Objeto->save($obj)){
                   $data = $obj;
                }
            } 
            $this->set('data', $data);
            $this->render('/Elements/ajaxreturn');
        }
        
        public function rotateobj(){
            $this->layout = null ;
            $data = $this->request->data["Objeto"]; 
            if (!$data["id"]) {
                   $data = null;
            }else{
                $obj = $this->Objeto->findById($data["id"]);
                $obj["Objeto"]["rotacao"] = $data["rotacao"];

                if($this->Objeto->save($obj)){
                   $data = $obj;
                }
            } 
            $this->set('data', $data);
            $this->render('/Elements/ajaxreturn');
        }
        public function savecanvas(){
            $this->layout = null ;
            foreach($this->request->data["itens"] as $data){ 
                if (!$data["id"]) {
                   $data = null;
                }else{
                    $obj = $this->Objeto->findById($data["id"]);
                    $obj["Objeto"]["x"] = $data["x"];
                    $obj["Objeto"]["y"] = $data["y"];
                    $obj["Objeto"]["rotacao"] = $data["rotacao"];

                   if($this->Objeto->save($obj)){
                       $data = $obj;
                   }
                } 
            }
             
            $this->set('data', $data );
            $this->render('/Elements/ajaxreturn');
        }
        
        public function renameobj(){
            $this->layout = null ;
            $obj = $this->Objeto->findById($this->request->data["id"]);
            $obj["Objeto"]["objeto"] = $this->request->data["objeto"];

            if($this->Objeto->save($obj)){
                $data = $obj;
            }
            $this->set('data', $data );
            $this->render('/Elements/ajaxreturn');
        }
        
        public function addPrateleira2Estante(){
            $this->layout = null ;
            $estante_id = $this->request->data["id"]; 
            $catPrat = $this->request->data["categoriaprateleira_id"];
            
            $this->Prateleira->create();
            $this->set('data', $this->Prateleira->save(array("Prateleira"=>array("objeto_id"=>$estante_id,
                    "categoria_prateleira_id"=>$catPrat))));
            $this->render('/Elements/ajaxreturn');
        }
        
        public function editobj(){
            $id = $this->request->data["id"];
            if ($id) {
               $data = $this->Viewobjeto->find("first",array("conditions"=>array("id"=>$id)));
                if($data["Viewobjeto"]["estante"]){
                    $prats = $this->Viewprateleira->find("all",array(
                        "conditions"=>array("objeto_id"=>$id)));
                    $this->set(compact('prats'));
                    $cats = $this->Categoriaprateleira->find("list",array("fields"=>array("id","categoriaprateleira"),
                        "conditions"=>array("tipoobjeto_id"=>$data["Viewobjeto"]["tipoobjeto_id"])));
                    $this->set(compact('cats'));
                }
            }
            $this->layout = "ajax";
            $this->set(compact('data'));
        }
        
        public function viewobj(){
            $id = $this->request->data["id"];
            if (!$id) {
               
            }else{
                $data = $this->Viewobjeto->find("first",array("conditions"=>array("id"=>$id)));
                if($data["Viewobjeto"]["estante"]){
                    $prats = $this->Viewprateleira->find("all",array(
                        "conditions"=>array("objeto_id"=>$id)));
                    $this->set(compact('prats'));
                    $cats = $this->Categoriaprateleira->find("list",array("fields"=>array("id","categoriaprateleira"),
                        "conditions"=>array("tipoobjeto_id"=>$data["Viewobjeto"]["tipoobjeto_id"])));
                    $this->set(compact('cats'));
                }
            } 
            $this->layout = "ajax";
            $this->set(compact('data'));
        }
        
        public function detalhesBiblioteca(){
            $livros = $this->Livro->find("first",array(
                "fields"=>array('min(data_aquisicao) as "min"','max(data_aquisicao) as "max"', 'count(*) as "count"'),
                "recursive"=>-1));
          /*  $emps = $this->Emprestimo->find("first",array(
                "fields"=>array('min(data_emprestimo) as "min"','max(data_emprestimo) as "max"', 'count(*) as "count"',
                    '(select count(*) from emprestimos_livros where data_devolucao isnull) as "abertos"',
                    '(select count(*) from reservas) as "reservas"'),
                "recursive"=>-1));
            */
            $this->set(compact('livros'));
            //$this->set(compact('emps'));
            $this->layout = "ajax";
        }
    }      
    