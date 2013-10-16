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
	public $displayField = 'name';
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

}
