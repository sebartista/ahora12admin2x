<?php
App::uses('AppModel', 'Model');
/**
 * Provincia Model
 *
 * @property Ciudade $Ciudade
 */
class Provincia extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'nombre';


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Ciudade' => array(
			'className' => 'Ciudade',
			'foreignKey' => 'provincia_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
