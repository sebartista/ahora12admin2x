<?php
App::uses('AppModel', 'Model');
/**
 * Comercio Model
 *
 * @property Ciudad $Ciudad
 */
class Comercio extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'razonsocial';


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Ciudade' => array(
			'className' => 'Ciudade',
			'foreignKey' => 'ciudad_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	public $hasAndBelongsToMany = array(
        'Rubro' =>
            array(
                'className' => 'Rubro',
                'joinTable' => 'rubro_comercios',
                'foreignKey' => 'comercio_id',
                'associationForeignKey' => 'rubro_id',
                'unique' => true,
                'conditions' => '',
                'fields' => '',
                'order' => '',
                'limit' => '100',
                'offset' => '',
                'finderQuery' => '',
                'with' => 'RubroComercio'
            )
    );

    /**
    * _validateInputData datos enviados
    *
    * @param string $input_data
    * @return string
    */
    protected function _validateInputData($input_data = ""){

        $rdata = "";
        
        if(!empty($input_data) && is_string($input_data)){
            $rdata = $input_data;//stripslashes($input_data);
        } 
        
        return $rdata;
    }
    public function ahoraEvalQueryData($i){
        return $i;
    }
    
    public function updateComerceFromCsv(){
        return false;
    }
}
