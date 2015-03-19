<?php
    class Emprestimo extends AppModel{
        public $useTable = "emprestimo";
        public $name = "Emprestimo";
        public $helpers = array("Biblioteca");
        //public $hasMany = array("Viewlte");
        /*public $belongsTo = array("Viewaluno" => array('foreignKey' => 'aluno_id'));
        public $hasAndBelongsToMany = array(
                            "Livro" => array(
                                'className' => 'Livro',
                                'joinTable' => 'emprestimos_livros',
                                'foreignKey' => 'emprestimo_id',
                                'associationForeignKey' => 'livro_id'));
        
        public $validate = array(
            'aluno_id'=> array(
                'rule' => 'notEmpty',
                'message'  => 'Escolha um aluno',
                'required' => 'true'
             ),
            'LivroLivro'=> array(
                'notEmpty' => array(
                    'rule' => array('notEmpty'),
                    'message'  => 'Escolha um livro',
                    'allowEmpty' => 'false'
                )
             )
        );*/
        public function isOwnedBy($alunoId, $userId) {
            return $alunoId === $userId;
        }
    }
?>

