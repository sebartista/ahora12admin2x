<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * CakePHP ProcessInserts
 * @author sebartista
 */
App::uses('File', 'Utility');

class ProcessInsertsShell extends AppShell {

    public $uses = array('Comercio', 'Ciudade');
    private $rubros_reference = array();
    private $provincias_reference = array();
    private $inserts_file;

    public function main() {
        $this->_populateRubros();
        $this->_populateProvinces();
        //$this->inserts_file = new File('/var/www/html/ahora12admin2x/app/webroot/files/inserts_2019-06-21-19-01-03-31.csv', true);
        //$this->out("test write file ".$this->data_with_errors_file->append("test"));
        $this->_processFile();
    }

    private function _processFile() {
        $this->stdout->styles('flashy', array('text' => 'green', 'blink' => true));

        $this->out('<flashy>working</flashy>');

        $file = new File('/var/www/html/ahora12admin2x/app/webroot/files/inserts_2019-06-21-06-55-48-segundamitad.csv', false);

        $file->open('r');

        $this->out('file opened');
        $line_counter = 0;
        while (($line = fgets($file->handle)) !== false) {
            $exploded = explode("|", $line);
            $line_counter++;

            $this->_processLine($exploded);
        }
        $file->close();
    }

    private function _processLine($data) {

        $this->_insertNewComerce($data);
    }

    private function _insertNewComerce($data) {

        foreach ($data as &$d) {
            $d = str_replace('"', '', $d);
        }
        //condicion si la provincia no es nula, y el rubro es mayor a 100, sino dato mal cargado
        if ($data[6] > 0 && $data[1] > 99) {
            $localidad = $this->_getLocalidad($data[5]);
            
            $rubro = $this->_getRubroReference($data[1]);
            $provincia_id = $this->_getProvinciaReference(trim($data[6]));
            //insert
            $new_comerce = array(
                "cuit" => $data[0],
                "nombrefantasia" => $data[2],
                "direccion" => str_replace("-", "", $data[3]),
                "codigopostal" => $data[4],
                "provincia" => $provincia_id,
                "ciudad_id" => $localidad
            );
            if ($rubro > 0) {
                $new_comerce['Rubro']['id'] = $rubro;
            }
            $this->Comercio->create();
            //debug($new_comerce);
            $saved = $this->Comercio->save($new_comerce);
            $this->out("<flashy>Insertado</flashy> " . $saved['Comercio']['nombrefantasia']);
            //$this->out("<flashy>Insertado</flashy> ");
        }
    }

    private function _populateRubros() {
        $this->rubros_reference[180] = 7;
        $this->rubros_reference[130] = 2;
        $this->rubros_reference[610] = 18;
        $this->rubros_reference[150] = 3;
        $this->rubros_reference[710] = 17;
        $this->rubros_reference[410] = 13;
        $this->rubros_reference[140] = 1;
        $this->rubros_reference[170] = 5;
        $this->rubros_reference[165] = 8;
        $this->rubros_reference[160] = 4;
        $this->rubros_reference[810] = 0;
        $this->rubros_reference[110] = 8;
        $this->rubros_reference[310] = 14;
        $this->rubros_reference[230] = 11;
        $this->rubros_reference[220] = 12;
        $this->rubros_reference[210] = 9;
        $this->rubros_reference[240] = 10;
        $this->rubros_reference[120] = 6;
        $this->rubros_reference[510] = 16;
    }

    private function _populateProvinces() {
        $this->provincias_reference[1] = 5;
        $this->provincias_reference[2] = 1;
        $this->provincias_reference[3] = 2;
        $this->provincias_reference[4] = 3;
        $this->provincias_reference[5] = 4;
        $this->provincias_reference[6] = 6;
        $this->provincias_reference[7] = 7;
        $this->provincias_reference[8] = 8;
        $this->provincias_reference[9] = 9;
        $this->provincias_reference[10] = 10;
        $this->provincias_reference[11] = 11;
        $this->provincias_reference[12] = 12;
        $this->provincias_reference[13] = 13;
        $this->provincias_reference[14] = 14;
        $this->provincias_reference[15] = 15;
        $this->provincias_reference[16] = 16;
        $this->provincias_reference[17] = 17;
        $this->provincias_reference[18] = 18;
        $this->provincias_reference[19] = 19;
        $this->provincias_reference[20] = 20;
        $this->provincias_reference[21] = 21;
        $this->provincias_reference[22] = 22;
        $this->provincias_reference[23] = 23;
        $this->provincias_reference[24] = 24;
    }

    private function _getRubroReference($external_id) {
        return $this->rubros_reference[$external_id];
    }

    private function _getProvinciaReference($external_id) {

        return $this->provincias_reference[$external_id];
    }

    private function _getLocalidad($dirty_name) {

        $ciudade = $this->Ciudade->find('first', array(
            'conditions' => array("Ciudade.nombre" => trim($dirty_name)),
            'fields' => array('Ciudade.nombre', 'Ciudade.id'),
            'recursive' => 0
        ));

        if (!$ciudade) {
            $this->out("<flashy>debo crear ciudad</flashy> " . $dirty_name);
        }


        return $ciudade ? $ciudade['Ciudade']['id'] : 1;
    }

}
