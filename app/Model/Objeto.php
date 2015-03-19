<?php
    class Objeto extends AppModel{
        public $useTable = 'objeto';
        public  $name = "Objeto";
        public $helpers = array('Biblioteca');
        //public $hasMany = array("Emprestimo", "Viewlte", "Viewaluno");
        //public $belongsTo = array("Endereco");
        //public $sequence = 'public.users_id_seq';
        
        
       /* public function getAlunosRa(){
                return $this->query('
                        SELECT ra as "aluno", aluno_id
                        FROM viewalunos;', 'list'); // if table name is `locations`
        }
        
        public $validate = array(
            'nome' => array(
                'required' => array(
                    'rule' => array('notEmpty'),
                    'message' => 'Escreva o nome'
                )
            ),
            'sobrenome' => array(
                'required' => array(
                    'rule' => array('notEmpty'),
                    'message' => 'Escreva o sobrenome'
                )
            ),
            'username' => array(
                'required' => array(
                    'rule' => array('notEmpty'),
                    'message' => 'O usuário é obrigatório'
                )
            ),
            'password' => array(
                'required' => array(
                    'rule' => array('notEmpty'),
                    'message' => 'A senha é obrigatória'
                )
            ),// posso criar uma tela para cada role
            'email' => array(
                'required' => array(
                    'rule' => array('notEmpty'),
                    'message' => 'Digite um email válido'
                )
            ),
            'serie_id' => array(
                'required' => array(
                    'rule' => array('notEmpty'),
                    'message' => 'Selecione a série atual do aluno'
                )
            ),
            'turma_id' => array(
                'required' => array(
                    'rule' => array('notEmpty'),
                    'message' => 'Selecione a turma atual do aluno'
                )
            ),
            'role' => array(
                'valid' => array(
                    'rule' => array('inList', array('admin', 'sadmin', 'user')),
                    'message' => 'Selecione uma função válida',
                    'allowEmpty' => false
                )
            )
        );*/
    }
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
