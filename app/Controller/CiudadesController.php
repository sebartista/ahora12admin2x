<?php
App::uses('AppController', 'Controller');
/**
 * Ciudades Controller
 *
 * @property Ciudade $Ciudade
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class CiudadesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'Flash', 'RequestHandler');
	public function beforeFilter(){
		parent::beforeFilter();
        $this->Auth->allow('get_by_province');
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Ciudade->recursive = 0;
		$this->set('ciudades', $this->Paginator->paginate());
	}

	public function get_by_province(){
		
		if($this->request->is('get')){
			if( isset( $this->request->query['provincia_id'] ) ){
				$ciudades = $this->Ciudade->find('all', array(
					'conditions' => array( 'Ciudade.provincia_id' => $this->request->query['provincia_id'] ),
					'fields' => array('Ciudade.nombre'),
					'recursive' => 0
					));
		
					$this->set(
						array(
						 	'ciudad' => $ciudades,
							'_serialize' => array('ciudad')
						)
					);		
				
			} else {
				throw new NotFoundException(__('Datos incorrectos'));	
			}
			
		} else {
			throw new NotFoundException(__('Datos incorrectos'));
		}
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Ciudade->exists($id)) {
			throw new NotFoundException(__('Invalid ciudade'));
		}
		$options = array('conditions' => array('Ciudade.' . $this->Ciudade->primaryKey => $id));
		$ciudad = $this->Ciudade->find('first', $options);
		$comercios = $this->Ciudade->Comercio->find('all', 
			array(
				'conditions' => array(
					'Comercio.ciudad_id' => $id
					)
			)
		);
		$this->set(array(
			'ciudade' => $ciudad,
			'comercios' => $comercios
		));
		//$this->set('ciudade', $this->Ciudade->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Ciudade->create();
			if ($this->Ciudade->save($this->request->data)) {
				$this->Flash->success(__('The ciudade has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The ciudade could not be saved. Please, try again.'));
			}
		}
		$provincias = $this->Ciudade->Provincium->find('list');
		$this->set(compact('provincias'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Ciudade->exists($id)) {
			throw new NotFoundException(__('Invalid ciudade'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Ciudade->save($this->request->data)) {
				$this->Flash->success(__('The ciudade has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The ciudade could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Ciudade.' . $this->Ciudade->primaryKey => $id));
			$this->request->data = $this->Ciudade->find('first', $options);
		}
		$provincias = $this->Ciudade->Provincium->find('list');
		$this->set(compact('provincias'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Ciudade->id = $id;
		if (!$this->Ciudade->exists()) {
			throw new NotFoundException(__('Invalid ciudade'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Ciudade->delete()) {
			$this->Flash->success(__('The ciudade has been deleted.'));
		} else {
			$this->Flash->error(__('The ciudade could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
