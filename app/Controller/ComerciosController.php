<?php
App::uses('AppController', 'Controller');
/**
 * Comercios Controller
 *
 * @property Comercio $Comercio
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class ComerciosController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'Flash', 'RequestHandler');
	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('get_comercios');
		$this->response->header('Access-Control-Allow-Origin','*');
        $this->response->header('Access-Control-Allow-Methods','*');
	}
/**
 * api json method
 *
 * @throws NotFoundException
 * @return void
 */
	public function get_comercios() {
		if($this->request->is('get')){
			
			
			if(isset($this->request->query['ciudad_id'])){
				$options['conditions']['AND'] = array ('Comercio.ciudad_id' => $this->request->query['ciudad_id']) ;//= $this->request->query['ciudad_id'];//$this->Comercio->_validateInputData($this->request->query['ciudad_id']);
			}
			//si viene con nombre
			if(isset($this->request->query['nombre'])){
				$options['conditions'] = array('Comercio.nombrefantasia LIKE' => '%'.$this->request->query['nombre'].'%');
				
			}
			if(isset($this->request->query['rubro_id'])){
				$options['joins'] = array(
				    array('table' => 'rubro_comercios',
				        'alias' => 'RubroComercio',
				        'type' => 'INNER',
				        'conditions' => array(
				            'Comercio.id = RubroComercio.comercio_id',
				        )
				        
				    ) );
				$options['conditions']['RubroComercio.rubro_id'] = $this->Comercio->ahoraEvalQueryData($this->request->query['rubro_id']);
			}

			$options['conditions']['Comercio.activo'] = true;
			
				//$options['fields'] =  array('Comercio.razonsocial', 'Rubro.nombre');//array('Comercio.razonsocial','Comercio.cuit','Comercio.direccion','Comercio.codigopostal','Comercio.sitioweb','Comercio.email','Comercio.telefono','Comercio.nombrefantasia','Ciudade.nombre');
				//$options['limit'] = 100;
				$options['recursive'] = 1;
			
			$comercios = $this->Comercio->find('all', $options);
			foreach ($comercios as &$c) {
				unset($c['Ciudade']['id']);
				unset($c['Ciudade']['provincia_id']);
				foreach ($c['Rubro'] as &$r) {

					unset($r['RubroComercio']);
					unset($r['id']);
				}
			}
			$this->set(
				array(
				 	'comercios' => $comercios,
					'_serialize' => array('comercios')
				)
			);

			
			
		} else {
			throw new NotFoundException(__('Datos incorrectos'));
		}
		
	}
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Comercio->recursive = 0;
		$this->set('comercios', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Comercio->exists($id)) {
			throw new NotFoundException(__('Invalid comercio'));
		}
		$options = array('conditions' => array('Comercio.' . $this->Comercio->primaryKey => $id));
		$this->set('comercio', $this->Comercio->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Comercio->create();
			if ($this->Comercio->save($this->request->data)) {
				$this->Flash->success(__('The comercio has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The comercio could not be saved. Please, try again.'));
			}
		}
		$ciudads = $this->Comercio->Ciudad->find('list');
		$this->set(compact('ciudads'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Comercio->exists($id)) {
			throw new NotFoundException(__('Invalid comercio'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Comercio->save($this->request->data)) {
				$this->Flash->success(__('The comercio has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The comercio could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Comercio.' . $this->Comercio->primaryKey => $id));
			$this->request->data = $this->Comercio->find('first', $options);
		}
		$ciudads = $this->Comercio->Ciudad->find('list');
		$this->set(compact('ciudads'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Comercio->id = $id;
		if (!$this->Comercio->exists()) {
			throw new NotFoundException(__('Invalid comercio'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Comercio->delete()) {
			$this->Flash->success(__('The comercio has been deleted.'));
		} else {
			$this->Flash->error(__('The comercio could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
