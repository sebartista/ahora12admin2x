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
    private $last_id_bulk = 10500;

    public function main() {
        //$this->updateComercios();
        $this->updateComerciosBulk();
        //$this->updateSingle(3105);
    }

    private function updateComercios() {
        $comercio = $this->Comercio->find('first', array(
            'conditions' => array('Comercio.id !=' => $this->last_id),
            'order' => array('Comercio.id ASC')
        ));

        if ($comercio) {

            $this->Comercio->read(null, $comercio['Comercio']['id']);

            $this->Comercio->set('razonsocial', ucwords(strtolower($this->remove_bs($comercio['Comercio']['razonsocial']))));
            $this->Comercio->set('direccion', ucwords(strtolower($this->remove_bs($comercio['Comercio']['direccion']))));
            $this->Comercio->set('nombrefantasia', ucwords(strtolower($this->remove_bs($comercio['Comercio']['nombrefantasia']))));
            $this->Comercio->save();
            $this->out('saving ' . $comercio['Comercio']['id']);
            $this->last_id[] = $comercio['Comercio']['id'];
            $this->updateComercios();
        }
    }

    private function updateComerciosBulk() {
        $comercios = $this->Comercio->find('all', array(
            'conditions' => array('Comercio.id >' => $this->last_id_bulk),
            'order' => array('Comercio.id ASC'),
            'limit' => 10
        ));
        if($comercios){
            foreach ($comercios as &$comercio) {
            

                //$this->Comercio->read(null, $comercio['Comercio']['id']);

                $comercio['Comercio']['razonsocial'] = ucwords(strtolower($this->remove_bs($comercio['Comercio']['razonsocial'])));
                $comercio['Comercio']['direccion'] = ucwords(strtolower($this->remove_bs($comercio['Comercio']['direccion'])));
                $comercio['Comercio']['nombrefantasia'] = ucwords(strtolower($this->remove_bs($comercio['Comercio']['nombrefantasia'])));
                
                $this->out('changing ' . $comercio['Comercio']['id']);
                $this->last_id_bulk = $comercio['Comercio']['id'];
                
            
            }
            $this->Comercio->saveMany($comercios, array('deep' => false, 'validate' => false, 'callbacks'=> false));
            $this->updateComerciosBulk();
        } else {
            $this->out("fin");
        }
        
    }

    private function updateSingle($cid) {
        $comercio = $this->Comercio->findById($cid);

        if ($comercio) {

            $this->Comercio->read(null, $comercio['Comercio']['id']);

            $this->Comercio->set('razonsocial', ucwords(strtolower($this->remove_bs($comercio['Comercio']['razonsocial']))));
            $this->Comercio->set('direccion', ucwords(strtolower($this->remove_bs($comercio['Comercio']['direccion']))));
            $this->Comercio->set('nombrefantasia', ucwords(strtolower($this->remove_bs($comercio['Comercio']['nombrefantasia']))));
            $this->Comercio->save();
            $this->out('saving ' . $comercio['Comercio']['id']);
            $this->last_id[] = $comercio['Comercio']['id'];
        }
    }

    private function remove_bs($Str) {
        $StrArr = str_split($Str);
        $NewStr = '';
        foreach ($StrArr as $Char) {
            $CharNo = ord($Char);

            if ($CharNo == 163) {
                $NewStr .= ''; //$Char;
                continue;
            } // keep £ 
            if ($CharNo > 31 && $CharNo < 127) {
                //$this->out($CharNo."deberia ser menor de 127");
                $NewStr .= $Char;
            }
            //$this->out($NewStr);
        }

        return utf8_encode($NewStr); // $NewStr;
    }

    private function check_utf8($str) {
        $len = strlen($str);
        for ($i = 0; $i < $len; $i++) {
            $c = ord($str[$i]);
            if ($c > 128) {
                if (($c > 247))
                    return false;
                elseif ($c > 239)
                    $bytes = 4;
                elseif ($c > 223)
                    $bytes = 3;
                elseif ($c > 191)
                    $bytes = 2;
                else
                    return false;
                if (($i + $bytes) > $len)
                    return false;
                while ($bytes > 1) {
                    $i++;
                    $b = ord($str[$i]);
                    if ($b < 128 || $b > 191)
                        return false;
                    $bytes--;
                }
            }
        }
        return true;
    }

}
