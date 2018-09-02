<?php
App::uses('AppController', 'Controller');
/**
 * Rubros Controller
 *
 * @property Rubro $Rubro
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class RubrosController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'Flash', 'RequestHandler');
	public function beforeFilter() {
		parent::beforeFilter();
        $this->Auth->allow('get_rubros');
    }

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Rubro->recursive = 0;
		$this->set('rubros', $this->Paginator->paginate());
	}


	public function get_rubros() {
		$rubros = $this->Rubro->find('all', array(
			'recursive' => 0));
		$this->set(array(
            'rubros' => $rubros,
            '_serialize' => array('rubros')
        ));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Rubro->exists($id)) {
			throw new NotFoundException(__('Invalid rubro'));
		}
		//$options = array('conditions' => array('Rubro.' . $this->Rubro->primaryKey => $id));		
		//$this->set('rubro', $this->Rubro->find('first', $options));
		$rubro = $this->Rubro->find('first', array('conditions' => array('Rubro.id' => $id)));
		$this->set(
			array(
				'rubro' => $rubro,
				'_serialize' => array('rubro')
			)
		);
			
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Rubro->create();
			if ($this->Rubro->save($this->request->data)) {
				$this->Flash->success(__('The rubro has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The rubro could not be saved. Please, try again.'));
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
		if (!$this->Rubro->exists($id)) {
			throw new NotFoundException(__('Invalid rubro'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Rubro->save($this->request->data)) {
				$this->Flash->success(__('The rubro has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The rubro could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Rubro.' . $this->Rubro->primaryKey => $id));
			$this->request->data = $this->Rubro->find('first', $options);
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
		$this->Rubro->id = $id;
		if (!$this->Rubro->exists()) {
			throw new NotFoundException(__('Invalid rubro'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Rubro->delete()) {
			$this->Flash->success(__('The rubro has been deleted.'));
		} else {
			$this->Flash->error(__('The rubro could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
