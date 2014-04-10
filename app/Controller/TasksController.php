<?php

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
App::uses('CakeTime', 'Utility');

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
		$this->Auth->allow('user', 'run');
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

	protected function sendMail($email, $task) {
		CakeTime::timeAgoInWords($dateTime);
		$Email = new CakeEmail('gmail');
		$Email->to('kashabuya@gmail.com')
				->subject($task['Task']['name'])
				->send($task['Task']['information']);
	}

	//Function that takes task_id and marks it completed on user action.
	public function complete($task_id) {

		$this->Task->id = $task_id;
		if ($this->Task->save(array('completed' => 1))) {
			echo 'Saved';
		} else {
			echo 'Error in saving';
		}
		$this->response->send('aah');
		$this->autoRender = false;
	}

	public function run() {
		$this->autoRender = false;
		CakeLog::info('STARTS');

		//Task Autocomplete at 3 hours since deadline and not completed by user.
		$options = array('conditions' => array(
				'Task.completed' => 0
		));
		$uncompleted = $this->Task->find('all', $options);
		foreach ($uncompleted as $uncomplete) {
			if (CakeTime::isWithinNext('5 minutes', strtotime($uncomplete['Task']['deadline']) + 60 * 3)) {
				$this->complete($uncomplete['Task']['id']);
				CakeLog::info('Marked as completed:'. $uncomplete['Task']['title']);
			}
		}

		//Rescheduling the repeating, completed tasks, 6 hours after task has been submited as completed that day.
		$options = array('conditions' => array(
				'Task.completed' => 1,
				'Task.repeating' => 1
		));
		$repeatingTasks = $this->Task->find('all', $options);
		foreach ($repeatingTasks as $repeatingTask) {
			if (CakeTime::isWithinNext('5 minutes', strtotime($repeatingTask['Task']['deadline']) + 60 * 6)) {
				$this->Task->id = $repeatingTask['Task']['id'];
				$newDeadline = strtotime($repeatingTask['Task']['deadline']) + 60 * 60 * 24;
				$this->Task->save(array(
					'completed' => 0,
					'deadline' => date('Y-m-d H:i:s', $newDeadline))
				);
				CakeLog::info('Task rescheduled: '. $uncomplete['Task']['title']);
			}
		}
		//Sending multiple alerts
		$admins = $this->Task->User->find('all', array('conditions' => array('User.admin' => true)));
		$tasks = $this->Task->find('all', array(
			'contain' => 'User',
			'conditions' => array('Task.completed' => 0)));
		foreach ($tasks as $task) {
			//Send email to Farm Manager at deadline	
			if (CakeTime::isWithinNext('1 minute', $task['Task']['deadline'])) {
				foreach ($admins as $admin) {
					$this->sendMail($admin['User']['email'], $task);
					CakeLog::info('Email sent to:'. $admin['User']['email']);
				}
			}
			//Send email to Task Owner 15 minutes before task deadline	
			if (CakeTime::isWithinNext('1 minute', strtotime($task['Task']['deadline']) - 900)) {
				$this->sendMail($task['User']['email'], $task);
				CakeLog::info('Email sent to:'. $task['User']['email']);
			}
			//Send email to Farm Manager 30 minutes after task deadline	
			if (CakeTime::isWithinNext('1 minute', strtotime($task['Task']['deadline']) + 1800)) {
				foreach ($admins as $admin) {
					$this->sendMail($admin['User']['email'], $task);
					CakeLog::info('Email sent to:'. $admin['User']['email']);
				}
			}
		}
	}

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
		$options = array('conditions' => array('User.username' => $username));
		$user = $this->Task->User->find('first', $options);

		$fromDate = date('Y-m-d') . ' 00:00:00';
		$toDate = date('Y-m-d', time() + 24 * HOUR) . ' 00:00:00';
		$this->paginate = array(
			'conditions' => array(
				'Task.user_id' => $user['User']['id'],
				'Task.completed' => 0,
				'Task.deadline >=' => $fromDate,
				'Task.deadline <=' => $toDate
			)
		);
		$this->set('tasks', $this->paginate());
		$this->set('user', $user);
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
