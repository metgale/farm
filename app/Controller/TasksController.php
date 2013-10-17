<?php

App::uses('AppController', 'Controller');

/**
 * Tasks Controller
 *
 * @property Task $Task
 * @property PaginatorComponent $Paginator
 */
class TasksController extends AppController {

	/**
	 *  Layout
	 *
	 * @var string
	 */
	
	public function beforeFilter() {
		$this->Auth->allow('user');
		parent::beforeFilter();
	}
	public $layout = 'bootstrap';

	/**
	 * Helpers
	 *
	 * @var array
	 */
	public $helpers = array('TwitterBootstrap.BootstrapHtml', 'TwitterBootstrap.BootstrapForm', 'TwitterBootstrap.BootstrapPaginator');

	/**
	 * Components
	 *
	 * @var array
	 */
	public $components = array('Paginator');

	/**
	 * index method
	 *
	 * @return void
	 */
	public function index() {
		$this->paginate = array(
			'Task' => array(
				'contain' => array('User')
			)
		);
		$tasks = $this->paginate();
		$this->set('tasks', $tasks);
	}

	/**
	 * view method
	 *
	 * @param string $id
	 * @return void
	 */
	public function user($username) {
		$options = array(conditions => array('User.username' => $username));
		$user = $this->Task->User->find('first', $options);
		$tasks = $this->paginate = array(
			'conditions' => array('Task.user_id' => $user['User']['id'])
		);
		$this->set('tasks', $this->paginate());
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Task->create();
			if ($this->Task->save($this->request->data)) {
				$this->Session->setFlash(
						__('The %s has been saved', __('task')), 'alert', array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-success'
						)
				);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(
						__('The %s could not be saved. Please, try again.', __('task')), 'alert', array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-error'
						)
				);
			}
		}
		$users = $this->Task->User->find('list');
		$this->set(compact('users'));
	}

	/**
	 * edit method
	 *
	 * @param string $id
	 * @return void
	 */
	public function edit($id = null) {
		$this->Task->id = $id;
		if (!$this->Task->exists()) {
			throw new NotFoundException(__('Invalid %s', __('task')));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Task->save($this->request->data)) {
				$this->Session->setFlash(
						__('The %s has been saved', __('task')), 'alert', array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-success'
						)
				);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(
						__('The %s could not be saved. Please, try again.', __('task')), 'alert', array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-error'
						)
				);
			}
		} else {
			$this->request->data = $this->Task->read(null, $id);
		}
		$users = $this->Task->User->find('list');
		$this->set(compact('users'));
	}

	/**
	 * delete method
	 *
	 * @param string $id
	 * @return void
	 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Task->id = $id;
		if (!$this->Task->exists()) {
			throw new NotFoundException(__('Invalid %s', __('task')));
		}
		if ($this->Task->delete()) {
			$this->Session->setFlash(
					__('The %s deleted', __('task')), 'alert', array(
				'plugin' => 'TwitterBootstrap',
				'class' => 'alert-success'
					)
			);
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(
				__('The %s was not deleted', __('task')), 'alert', array(
			'plugin' => 'TwitterBootstrap',
			'class' => 'alert-error'
				)
		);
		$this->redirect(array('action' => 'index'));
	}

}
