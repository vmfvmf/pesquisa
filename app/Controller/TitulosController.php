<?php
    class TitulosController extends AppController{
        
        public  $name = "Titulos";
        public $uses = array("Titulo", "Viewtitulosdetalhe","Viewlivrosdetalhe","Reserva","Livro","Aluno");
        
       
        public function index() { 
            $this->paginate = array('limit' => 10,'contain' => array('Autor'), 'recursive' => 0, 
                'order' => array( 'titulo' => 'asc'));
            $titulos = $this->paginate('Viewtitulosdetalhe');
                        
            $this->set(compact('titulos'));
        }
        
        public function add(){
            if ($this->data){
                if($this->Titulo->save($this->data)){
                    $this->Session->setFlash(__('Cadastrado com sucesso!', null),
                            'default', 
                             array('class' => 'notice success'));
                    return $this->redirect(array('action' => 'index'));
                }
            }
            self::getDepends();
        }
        
        public function edit($id = null){
           if (!$id) {
                throw new NotFoundException(__('Invalid titulo'));
            }
            $titulo = $this->Titulo->find('first', array(
                'conditions' => array('Titulo.id' => $id ), // URL to fetch the required page
                'recursive' => 1
            ));
            if (!$titulo) {
                throw new NotFoundException(__('Invalid titulo'));
            }
            if ($this->request->is(array('$titulo', 'put'))) {
                $this->Titulo->id = $id;
            if ($this->Titulo->save($this->request->data)) {
                $this->Session->setFlash(__('Atualizado com sucesso!', null),
                            'default', 
                             array('class' => 'notice success'));
                return $this->redirect(array('action' => 'index'));
            }
                $this->Session->setFlash(__('Não foi possível atualizar titulo.'));
            }
            if (!$this->request->data) {
                $this->request->data = $titulo;
            }
            self::getDepends();
        }
        
        public function getDepends(){
            self::getLocalizacao();
            self::getAutors();
            self::getAssuntos();
        }
        
        public function delete($id = null){
            if($id){
                if($this->Titulo->delete($id)){
                    $this->Session->setFlash(__('Excluído com sucesso!', null),
                            'default', 
                             array('class' => 'notice'));
                }
                $this->redirect(array('controller' => 'Titulos', 'action' => 'index'));
            }
        }
        
        
        public function getAssuntos(){
            $assuntos = $this->Titulo->Assunto->find('list',array('fields' => array( 'id', 'assunto'),
                                'order'=>'assunto'));
            $this->set(compact('assuntos'));
        }
        
        public function reservarAdmin($ra_aluno = null, $titulo_id = null){
            if(!$ra_aluno || !$titulo_id){
                $this->Session->setFlash(__('Aluno ou Título nulo', null),
                            'default', 
                             array('class' => 'notice'));
                return $this->redirect($this->referer());
            }
            $aluno = $this->Aluno->find("first", array("conditions"=>array("username"=>$ra_aluno)));
            self::reservar($aluno["Aluno"]["id"],$titulo_id);
        }
        
        public function reservar($aluno_id = null, $titulo_id = null){
            if(!$aluno_id || !$titulo_id){
                $this->Session->setFlash(__('Aluno ou Título nulo', null),
                            'default', 
                             array('class' => 'notice'));
                return $this->redirect($this->referer());
            }
            $this->Reserva->create();
            
            if($this->Reserva->save(array("Reserva"=>array("aluno_id"=>$aluno_id,
                "titulo_id"=>$titulo_id,"data_reserva"=>date("d/m/Y"))))){
                $this->Session->setFlash(__('Reserva registrada.', null),
                            'default', 
                             array('class' => 'notice success'));
                self::checkReserva($this->Reserva->id);
                return $this->redirect($this->referer());
            }else{
                $this->Session->setFlash(__('ERRO', null),
                            'default', 
                             array('class' => 'notice success'));
                return $this->redirect($this->referer());
            }
        }
        
        public function reservarPAluno($titulo_id = null){
            if(!$titulo_id){
                $this->Session->setFlash(__('Título nulo', null),'default', 
                             array('class' => 'notice'));
                return $this->redirect($this->referer());
            }
            $this->Reserva->create();
            
            if($this->Reserva->save(array("Reserva"=>array(
                "aluno_id"=>$this->Auth->user('id'),"titulo_id"=>$titulo_id,
                "data_reserva"=>date("d/m/Y"))))){
                $this->Session->setFlash(__('Reserva registrada.', null),
                            'default', 
                             array('class' => 'notice success'));
                self::checkReserva($this->Reserva->id);
                return $this->redirect($this->referer());
            }else{
                $this->Session->setFlash(__('ERRO', null),
                            'default', 
                             array('class' => 'notice success'));
                return $this->redirect($this->referer());
            }
        }
        
        private function checkReserva($reserva_id){
            $reserva = $this->Reserva->find("first", array(
                    "conditions"=>array("id"=>$reserva_id)
                ));
            $livro = $this->Livro->find("first", array(
                "conditions"=>array("disponivel"=>"true", "reserva_id isnull", 
                    "titulo_id" => $reserva["Reserva"]["titulo_id"])
            ));
            if($livro){
                $livro["Livro"]["reserva_id"] = $reserva["Reserva"]["id"];
                if($this->Livro->save($livro)){
                    $reserva["Reserva"]["prazo_retirada"] = 
                            date('Y-m-d', strtotime(date('Y-m-d'). ' + 2 days'));
                    $this->Reserva->save($reserva);
                    $this->Session->setFlash(__('Reservado! Aguardando retirada.', null),
                                'default', 
                                 array('class' => 'notice success'));
                }
            }
        }


        public function view($id = null){
            if($id){
                $titulo = $this->Viewtitulosdetalhe->read(null, $id);
                $this->set(compact("titulo"));
                $livros = $this->Viewlivrosdetalhe->find('all',array('conditions'=>array('titulo_id'=>$id),
                                'order'=>'disponivel desc'));
                /*$livros = $this->Viewlivrosdetalhe->query(
                            'SELECT * '
                            . " FROM viewlivrosdetalhes WHERE titulo_id = ".$id
                            . ' ORDER BY disponivel desc');*/
                $this->set(compact('livros'));
            }
        }
        public function isAuthorized($user) {
            if (parent::isAuthorized($user)) {
                if ($this->action === 'reservarPAluno') {
                    return true;
                }else if($user['role'] === 'sadmin' || $user['role'] === 'admin'){
                    return true;
                }
                /*
                if (in_array($this->action, array('edit', 'delete'))) {
                    $postId = (int) $this->request->params['pass'][0];
                    return $this->Post->isOwnedBy($postId, $user['id']);
                }*/
            }
            return false;
        }
        
        function beforeFilter() {
            parent::beforeFilter(); 
            $this->Auth->allow('view'); 
        }
        
        public function getAutors(){
            $autors = $this->Titulo->Autor->find('list',array('fields' => array( 'id', 'autor'),
                                'order'=>'autor'));
            $this->set(compact('autors'));
        }
        
        public function getLocalizacao(){
            $localizacao = $this->Titulo->Localizacao->find('list',array('fields' => array( 'id', 'localizacao'),
                                'order'=>'localizacao'));
            $this->set(compact('localizacao'));
        }
        
    }      
?>