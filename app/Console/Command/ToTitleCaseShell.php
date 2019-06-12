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
            'order' => array('Comercio.id ASC')
        ));
        
        if($comercio){
            
            $this->Comercio->read(null, $comercio['Comercio']['id']);
            
            $this->Comercio->set('razonsocial', ucwords(strtolower($this->remove_bs($comercio['Comercio']['razonsocial']))));
            $this->Comercio->set('direccion', ucwords(strtolower($this->remove_bs($comercio['Comercio']['direccion']))));
            $this->Comercio->set('nombrefantasia', ucwords(strtolower($this->remove_bs($comercio['Comercio']['nombrefantasia']))));
            $this->Comercio->save();
            // $this->out(ucwords(strtolower($comercio['Comercio']['razonsocial'])));
            // $this->out(ucwords(strtolower($comercio['Comercio']['direccion'])));
            // $this->out(ucwords(strtolower($comercio['Comercio']['nombrefantasia'])));
            $this->out('saving '.$comercio['Comercio']['id']);

            $this->last_id[] = $comercio['Comercio']['id'];
//            //$this->out($this->last_id);
            $this->updateComercios();
        }
    }

    private function remove_bs($Str) {  
      $StrArr = str_split($Str); $NewStr = '';
      foreach ($StrArr as $Char) {    
        $CharNo = ord($Char);
        if ($CharNo == 163) { $NewStr .= $Char; continue; } // keep £ 
        if ($CharNo > 31 && $CharNo < 127) {
          $NewStr .= $Char;    
        }
      }  
      return $NewStr;
    }

}
