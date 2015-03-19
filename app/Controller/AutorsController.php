<?php
    class AutorsController extends AppController{
        
        public  $name = "Autors";
        
        public function index() {
            $this->paginate = array('limit' => 10, 'order' => array( 'autor' => 'asc'));
            $autors = $this->paginate('Autor');
                        
            $this->set(compact('autors'));
            //pr($autors); exit(0);
        }
        
        public function add(){
            if ($this->data){
                if($this->Autor->save($this->data)){
                    $this->Session->setFlash(__('Autor cadastrado', null),
                            'default', 
                             array('class' => 'notice success'));
                    return $this->redirect(array('action' => 'index'));
                }
            }
        }
        
        public function edit($id = null){
            if (!$id) {
                throw new NotFoundException(__('Invalid autor'));
            }
            $autor = $this->Autor->findById($id);
            if (!$autor) {
                throw new NotFoundException(__('Invalid autor'));
            }
            if ($this->request->is(array('$autor', 'put'))) {
                $this->Autor->id = $id;
            if ($this->Autor->save($this->request->data)) {
                $this->Session->setFlash(__('Autor atualizado', null),
                            'default', 
                             array('class' => 'notice success'));
                return $this->redirect(array('action' => 'index'));
            }
                $this->Session->setFlash(__('Não foi possível atualizar autor.'));
            }
            if (!$this->request->data) {
                $this->request->data = $autor;
            }
        }
        
        public function delete($id = null){
            if($id){
                if($this->Autor->delete($id)){
                    $this->Session->setFlash(__('Autor excluído', null),
                            'default', 
                             array('class' => 'notice'));
                }
                $this->redirect(array('controller' => 'Autors', 'action' => 'index'));
            }
        }
        
        public function getCategorias(){
            $categorias = $this->Titulo->Categoria->find('list',array('fields' => array( 'id', 'categoria'),
                                'order'=>'categoria'));
            $this->set(compact('categorias'));
        }
        
        public function view($id = null){
            if($id){
                $titulo = $this->Titulo->read(null, $id);
                $this->set(compact("titulo"));
                self::getLocalizacao();
            self::getAutors();
            self::getCategorias();
                //pr($titulo);exit(0);
            }
        }
        
        public function getAutors(){
            $autors = $this->Titulo->Autor->find('list',array('fields' => array( 'id', 'nome'),
                                'order'=>'nome'));
            $this->set(compact('autors'));
        }
        
        
        
        public function getLocalizacao(){
            $localizacao = $this->Titulo->Localizacao->find('list',array('fields' => array( 'id', 'nome'),
                                'order'=>'nome'));
            $this->set(compact('localizacao'));
        }
        
     /*   function auto_complete() { 
            $localizacaos = $this->Localizacao->find('all', array( 
                'conditions' => array( 
                    'Localizacao.nome LIKE' => $this->params['url']['autoCompleteText'].'%' 
                ), 
                'fields' => array('nome'), 
                'limit' => 3, 
                'recursive'=>-1, 
            )); 
            $localizacaos2 = Set::Extract($localizacaos,'{n}.Localizacao.nome'); 
            $this->set('localizacaos', $localizacaos2); 
            $this->layout = 'ajax';     
          } */
    }      
?>