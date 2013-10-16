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
		$this->Task->recursive = 0;
		$this->set('tasks', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Task->id = $id;
		if (!$this->Task->exists()) {
			throw new NotFoundException(__('Invalid %s', __('task')));
		}
		$this->set('task', $this->Task->read(null, $id));
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
					__('The %s has been saved', __('task')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-success'
					)
				);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(
					__('The %s could not be saved. Please, try again.', __('task')),
					'alert',
					array(
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
					__('The %s has been saved', __('task')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-success'
					)
				);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(
					__('The %s could not be saved. Please, try again.', __('task')),
					'alert',
					array(
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
				__('The %s deleted', __('task')),
				'alert',
				array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-success'
				)
			);
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(
			__('The %s was not deleted', __('task')),
			'alert',
			array(
				'plugin' => 'TwitterBootstrap',
				'class' => 'alert-error'
			)
		);
		$this->redirect(array('action' => 'index'));
	}

}
