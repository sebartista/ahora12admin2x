<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * CakePHP ToTitleCaseShell
 * @author sebar
 */
class ToTitleCaseShell extends AppShell {

    public $uses = array('Comercio');
    private $last_id = array();

    public function main() {
        $this->updateComercios();
        
    }
    
    private function updateComercios(){
        $comercio = $this->Comercio->find('first', array(
            'conditions' => array('Comercio.id !=' => $this->last_id),
            'fields' => array('Comercio.id'),
            'order' => array('Comercio.id ASC')
        ));
        //debug($comercio);
        if($comercio){
            
            $this->Comercio->read('nombrefantasia', $comercio['Comercio']['id']);
            $this->out($this->Comercio->nombrefantasia);
//            $this->last_id[] = $comercio['Comercio']['id'];
//            //$this->out($this->last_id);
//            $this->updateComercios();
        }
    }

}
