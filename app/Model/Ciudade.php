<?php
App::uses('AppModel', 'Model');
/**
 * Ciudade Model
 *
 * @property Provincia $Provincia
 */
class Ciudade extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'nombre';


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Provincia' => array(
			'className' => 'Provincia',
			'foreignKey' => 'provincia_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	public $hasMany = array(
		'Comercio' => array(
			'className' => 'Comercio',
			'foreignKey' => 'ciudad_id'
		)
	);

/**
* valida datos enviados
*
* @param string $input_data
* @return string
*/

    protected function validateInputData($input_data = ""){

        $rdata = "";
        
        if( !empty($input_data) && is_string($input_data) ){
            $rdata = $input_data;//stripslashes($input_data);
        } 
        
        return $rdata;
    }
}
