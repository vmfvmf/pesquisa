<?php
    class Livro extends AppModel{
        public $useTable = 'livro';
        public $name = "Livro";
        //public $helpers = array('Barcode','Biblioteca');
        public $belongsTo = array("Titulo", "Editora","Programa");
        /*public $hasMany = array(
            "Viewlivrosdetalhe" => array(
                'className' => 'Viewlivrosdetalhe',
                'foreignKey' => 'id')
        );
        
        public $validate = array(
            );
        
        public $hasAndBelongsToMany = array(
                            "Emprestimo" => array(
                                'className' => 'Emprestimo',
                                'joinTable' => 'emprestimos_livros',
                                'foreignKey' => 'livro_id',
                                'associationForeignKey' => 'emprestimo_id'));
        
        */
        
    }
?>
