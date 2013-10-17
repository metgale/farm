<?php

App::uses('AppModel', 'Model');

/**
 * User Model
 *
 * @property Task $Task
 */
class User extends AppModel {

	/**
	 * Display field
	 *
	 * @var string
	 */
	public $displayField = 'username';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	/**
	 * hasMany associations
	 *
	 * @var array
	 */
	public $validate = array(
		'admin' => array('required' => false));
	
	public $hasMany = array(
		'Task' => array(
			'className' => 'Task',
			'foreignKey' => 'user_id',
			'dependent' => false
		)
	);

	public function beforeSave($options = array()) {
		if (isset($this->data['User']['password'])) {
			$this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
		}
		return true;
	}

}
