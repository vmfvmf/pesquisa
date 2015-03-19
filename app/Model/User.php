<?php
App::uses('AuthComponent', 'Controller/Component');
class User extends AppModel {
    public $name = 'User';
    
    public $validate = array(
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
        'role' => array(
            'valid' => array(
                'rule' => array('inList', array('admin', 'sadmin', 'user')),
                'message' => 'Selecione uma função válida',
                'allowEmpty' => false
            )
        )
    );
    
    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = 
                    AuthComponent::password($this->data[$this->alias]['password']);
        }
        return true;
    }
}
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
