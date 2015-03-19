<?php

class LivrosController extends AppController {

    public $name = "Livros";
    //var $components = array('Barcoder');
    var $uses = array('Livro', 'Viewlivrosdetalhe','Viewtitulosdetalhe', 'Emprestimos_livro',
        'Viewprateleira','Titulo', 'Assunto', 'Viewobjeto', 'Tipoobjeto');

    public function todos() {
        $this->paginate = array('limit' => 10, 'recursive' => 1,
            'order' => array('Viewlivrosdetalhe.titulo' => 'asc'));
        $livros = $this->paginate('Viewlivrosdetalhe');
        $this->set(compact('livros'));
    }

    public function add() {
        if ($this->data) {
            $textoBarcode = $this->data['Livro']['titulo'] . 'ô' .
                    self::textoBarcode($this->data['Livro']['editora_id']) . ' - ed ' .
                    $this->data['Livro']['edicao'];
            if ($this->data['Livro']['qtd'] == 1) {
                $id = $this->Livro->save($this->data);
                if ($id) {
                    $this->Session->setFlash(__('Adicionado com sucesso!', null), 'default', array('class' => 'notice success'));
                    self::barcoder($id['Livro']['id'], $textoBarcode);
                    return $this->redirect(array('controller' => 'Livros',
                                'action' => 'index'));
                }
            } else {
                $arr = array();
                for ($i = 0; $i < $this->data['Livro']['qtd']; $i++) {
                    $this->Livro->create();
                    array_push($arr, $this->Livro->save($this->data));
                }
                if (count($arr) > 1) {
                    for ($i = 0; $i < count($arr); $i++) {
                        self::barcoder($arr[$i]['Livro']['id'], $textoBarcode);
                    }
                    $this->Session->setFlash(__('Adicionados com sucesso!', null), 'default', array('class' => 'notice success'));
                    return $this->redirect(array('controller' => 'Livros',
                                'action' => 'index'));
                }
            }
        }
        self::getTitulosList();
        self::getEditoras();
        self::getIdiomas();
        self::getProgramas();
        self::getPrateleiras();
    }

    function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('buscar', 'display', 'resultado', 'index', 'view', 'livros','prateleira');
    }

    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }
        $livro = $this->Livro->findById($id);
        $titulo = $this->Viewtitulosdetalhe->findById($livro["Livro"]["titulo_id"]);
        $prateleiras = $this->Viewprateleira->find("list", array(
            "conditions"=>array("categoriaprateleira_id"=>$titulo["Viewtitulosdetalhe"]["categoriaprateleira_id"]),
            "fields"=>array("id","prateleira")));
        $this->set(compact('prateleiras'));
        if (!$livro) {
            throw new NotFoundException(__('Invalid Livro'));
        }
        if ($this->request->is(array('livro', 'put'))) {
            $this->Livro->id = $id;
            if ($this->Livro->save($this->request->data)) {
                $this->Session->setFlash(__('Atualizado com sucesso!', null), 'default', array('class' => 'notice success'));
                return $this->redirect($this->referer());
            }
            $this->Session->setFlash(__('Unable to update your livro.'));
        }
        if (!$this->request->data) {
            $this->request->data = $livro;
        }
        self::getTitulosList();
        self::getEditoras();
        self::getIdiomas();
    }

    public function delete($id = null) {
        if ($id) {
            if ($this->Livro->delete($id)) {
                $this->Session->setFlash(__('Excluído com sucesso!', null), 'default', array('class' => 'notice'));
            }
            $this->redirect(array('controller' => 'Livros', 'action' => 'index'));
        }
    }

    public function checkRetornoBusca($variavel = null) {
        if (!$variavel) {
            $this->Session->setFlash(__('A busca não encontrou livros!', null), 'default', array('class' => 'notice error'));
            return $this->redirect(array('controller' => 'Livros', 'action' => 'index'));
        }
    }

    public function prateleira($prat_id){
        if($prat_id){
            $this->paginate = array('limit' => 10, 'recursive' => 1,
                "conditions"=>array("prateleira_id"=>$prat_id),
                'order' => array('Viewlivrosdetalhes.titulo' => 'asc'));
            $livros = $this->paginate('Viewlivrosdetalhe');
            $prateleira = $this->Viewprateleira->findById($prat_id);
            $this->set(compact('livros'));
            $this->set(compact('prateleira'));
            if(!$livros){
                $this->Session->setFlash(__('Prateleira Inválida ou sem livros.'));
                return $this->redirect(array('controller' => 'Bibliotecas', 'action' => 'index'));
            }
        }else{
            $this->Session->setFlash(__('Prateleira Inválida'));
            return $this->redirect(array('controller' => 'Bibliotecas', 'action' => 'index'));
        }
    }
    
    public function resultado($tipo = null, $valor = null) {
        if ($tipo && $valor) {
            $this->paginate = array('limit'=> 10, 'recursive' => 1,
                        'conditions' => array($tipo." like '%".$valor."%'"),
                        'order' => 'titulo');
                    $livros = $this->paginate('Viewtitulosdetalhe');
                    $this->set(compact('livros'));
                    self::checkRetornoBusca($livros);
        }
    }

    public function index() {
        if ($this->data) {
            switch ($this->data["Livro"]["tipo"]) {
                case "codbarras":
                    return $this->redirect(array('controller' => 'Livros', 'action' => 'view',
                                $this->data["Livro"]["codbarras"]));
                case"autor":case "titulo": case "assunto":
                    return $this->redirect(array('controller' => 'Livros', 'action' => 'resultado',
                                $this->data["Livro"]["tipo"], $this->data["Livro"]["busca"]));
            }
        }
        self::getTitulosList();
        //self::getEditoras();
        //self::getIdiomas();
        //self::getAutors();
        //self::getAssuntos();
    }

    public function view($id = null) {
        if ($id) {
            $livro = $this->Viewlivrosdetalhe->find('first', array(
                'conditions' => array('id =' => $id),
                'order' => array('disponivel' => 'desc')));
            if ($livro) {
                self::getObjects();
                $this->set(compact("livro"));
                //$id_emp_livro = $this->Emprestimo_livros->find('first',array(
                //    'conditions'=>array('livro_id'=>$id), 'fields' => 'max(id)'));
                //$id_emp_livro = $id_emp_livro[0]['max'];
                //$this->set(compact("id_emp_livro"));
            } else {
                $this->Session->setFlash(__('Livro não encontrado!', null), 'default', array('class' => 'notice error'));
                return $this->redirect(array('action' => 'index'));
            }
        }
    }

    public function getTitulosList() {
        $titulos = $this->Livro->Titulo->find('list', array('fields' => array('id', 'titulo'),
            'order' => 'titulo'));
        $this->set(compact('titulos'));
    }
    
    public function getProgramas() {
        $progs = $this->Livro->Programa->find('list', array('fields' => array('id', 'programa'),
            'order' => 'programa'));
        $this->set(compact('progs'));
    }

    public function getAssuntos() {
        $assuntos = $this->Livro->Titulo->Assunto->find('list', array(
            'fields' => array('id', 'assunto'),
            'order' => 'assunto'));
        $this->set(compact('assuntos'));
    }
    
    public function getPrateleiras() {
        $prateleiras = $this->Viewprateleira->find('list', array(
            'fields' => array('id', 'prateleira'),
            'order' => 'prateleira'));
        $this->set(compact('prateleiras'));
    }
    
    private function getObjects(){
            $objs = $this->Viewobjeto->find("all");
            $this->set(compact('objs'));
            
            $imgs = $this->Tipoobjeto->find("all");
            $this->set(compact('imgs'));
            
        }

    public function getAutors() {
        $autor = $this->Livro->Titulo->Autor->find('list', array('fields' => array('id', 'autor'),
            'order' => 'autor'));
        $this->set(compact('autor'));
    }

    public function getIdiomas() {
        $idiomas = $this->Livro->Idioma->find('list', array('fields' => array('id', 'idioma'),
            'order' => 'idioma'));
        $this->set(compact('idiomas'));
    }

    public function getEditoras() {
        $editoras = $this->Livro->Editora->find('list', array('fields' => array('id', 'editora'),
            'order' => 'editora'));
        $this->set(compact('editoras'));
    }

    public function barcoder($id = null, $text = null) {
        $this->Barcoder->barcode();
        $this->Barcoder->setType('C128');
        $this->Barcoder->setCode($id);
        $this->Barcoder->setSize(80, 160);
        $this->Barcoder->setText($text);
        $this->Barcoder->writeBarcodeFile('img/barcode/code_' . $id . '.png');
    }

    public function textoBarcode($editoraId) {
        $txt = $this->Livro->Editora->find('all', array(
            'fields' => array('editora'),
            'conditions' => array('id =' => $editoraId)
        ));
        return $txt[0]['Editora']['editora'];
    }

}

?>
