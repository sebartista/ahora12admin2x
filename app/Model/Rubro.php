<?php
App::uses('AppModel', 'Model');
/**
 * Rubro Model
 *
 */
class Rubro extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'nombre';
	
	public $hasAndBelongsToMany = array(
        'Comercio' =>
            array(
                'className' => 'Comercio',
                'joinTable' => 'rubro_comercios',
                'foreignKey' => 'rubro_id',
                'associationForeignKey' => 'comercio_id',
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
    

}
