<?php
App::uses('AppController', 'Controller');
/**
 * Tarjetas Controller
 *
 * @property Tarjeta $Tarjeta
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class TarjetasController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'Flash');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Tarjeta->recursive = 0;
		$this->set('tarjetas', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Tarjeta->exists($id)) {
			throw new NotFoundException(__('Invalid tarjeta'));
		}
		$options = array('conditions' => array('Tarjeta.' . $this->Tarjeta->primaryKey => $id));
		$this->set('tarjeta', $this->Tarjeta->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Tarjeta->create();
			if ($this->Tarjeta->save($this->request->data)) {
				$this->Flash->success(__('The tarjeta has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The tarjeta could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Tarjeta->exists($id)) {
			throw new NotFoundException(__('Invalid tarjeta'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Tarjeta->save($this->request->data)) {
				$this->Flash->success(__('The tarjeta has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The tarjeta could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Tarjeta.' . $this->Tarjeta->primaryKey => $id));
			$this->request->data = $this->Tarjeta->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Tarjeta->id = $id;
		if (!$this->Tarjeta->exists()) {
			throw new NotFoundException(__('Invalid tarjeta'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Tarjeta->delete()) {
			$this->Flash->success(__('The tarjeta has been deleted.'));
		} else {
			$this->Flash->error(__('The tarjeta could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
