<?php
class TryDuplicatesShell extends AppShell {
	
	private $ids_revisados = array();
	public $uses = array('Comercio');

	public function main(){

		$this->getDuplicates();

	}
	private function getDuplicates(){
		$comercio = $this->Comercio->find('first', array(
            'conditions' => array(
            	'Comercio.id !=' => $this->ids_revisados,
            	'Comercio.activo' => true),
            'order' => array('Comercio.id ASC'),
            'recursive' => 1
        ));
        if($comercio){
        	$morethanone = $this->Comercio->find('count', array(
        		'conditions' => array(
        			'Comercio.cuit' => $comercio['Comercio']['cuit'],
        			'Comercio.activo' => true
        		)
        	));
        	
        	if($morethanone > 1){
        		$comercios = $this->Comercio->find('all', array(
	            'conditions' => array(
	            	'Comercio.cuit' => $comercio['Comercio']['cuit'],
	            	'Comercio.activo' => true,
	            	'Comercio.id !=' => $comercio['Comercio']['id']
	            	
	            	),
	            'order' => array('Comercio.id ASC'),
	            'recursive' => 1
            
	        	));

	        	if($comercios){
	        		$this->out('hay cuits repetidos');
	        		foreach ($comercios as $comercio_repetido) {
	        			if($comercio['Comercio']['ciudad_id'] == $comercio_repetido['Comercio']['ciudad_id']){
	        				$this->out('<info>misma ciudad </info>'.$comercio['Comercio']['cuit']);
	        				if(isset($comercio['Rubro']['id']) && isset($comercio_repetido['Rubro']['id'])){
	        					if($comercio['Rubro']['id'] == $comercio_repetido['Rubro']['id']){
	        						$this->out('<info>mismo rubro </info>'.$comercio['Rubro']['nombre']);
	        						if($comercio['Comercio']['codigopostal'] ==$comercio_repetido['Comercio']['codigopostal'] ){
	        							$this->out('<info>mismo codigo postal </info>'.$comercio['Comercio']['codigopostal']);
	        						}
	        					}
	        				} else {
	        					$this->out('<warning>no tiene rubro </warning> '.$comercio['Comercio']['cuit']);
	        				}
	        				
	        			}
	        		}
	        	}
	        	
        	}
        	$this->ids_revisados[] = $comercio['Comercio']['id'];
	        $this->getDuplicates();
        	
        }
	}

}
?>