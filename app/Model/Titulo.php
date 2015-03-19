<?php
    class Titulo extends AppModel{
        public $useTable ="titulo";
        public $name = "Titulo";
        //public $helpers = array("Biblioteca");
        public $belongsTo = array("Localizacao", "Assunto");
        public $hasMany = array("Livro",
            "Viewtitulosdetalhe" => array(
                'className' => 'Viewtitulosdetalhe',
                'foreignKey' => 'id'),
            "Viewlivrosdetalhe" => array(
                'className' => 'Viewlivrosdetalhe',
                'foreignKey' => 'titulo_id')
        );
        
    }
?>
