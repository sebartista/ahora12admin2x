<?php

App::uses('Folder', 'Utility');
App::uses('File', 'Utility');

class TransactionIntegrationShell extends AppShell {

    public $uses = array('Comercio', 'Ciudade');
    private $rubros_reference = array();
    private $provincias_reference = array();
    private $data_with_errors_file;

    public function main() {
        $this->populateRubros();
        $this->populateProvinces();
        $this->data_with_errors_file = new File('/var/www/html/ahora12admin2x/app/webroot/files/with_errors'.date("Y-m-d-h-i-s").'.csv', true);
        $this->data_with_errors_file->open("w");
        //$this->out("test write file ".$this->data_with_errors_file->append("test"));
        $this->processComerces();
    }

    private function processComerces() {
        $this->stdout->styles('flashy', array('text' => 'green', 'blink' => true));

        $this->out('<flashy>working</flashy>');
        $dir = new Folder('C:\Users\sebar\Downloads\ahora12', false);
        $file = new File('/var/www/html/ahora12admin2x/app/webroot/files/comercios_junio2018_2019.csv', false);

        $file->open('r');
        //$contents = $file->read();
        $this->out('file opened');
        $find_counter = 0;
        while (($line = fgets($file->handle)) !== false) {
            $exploded = explode("|", $line);

            if ($exploded[0] != '"cuit"') {
                $this->processLine($exploded);
            }
        }
        $this->out("encontre " . $find_counter);


        $file->close();
    }

    private function insertNewComerce($data) {
        //no existe cuit
        foreach ($data as &$d) {
            $d = str_replace('"', '', $d);
        }
        //$this->out("<flashy>no existe comercio</flashy> " . $data[0]);
        $localidad = $this->getLocalidad($data[5]);
        if (!$localidad) {
            $this->data_with_errors_file->append(trim(implode("|", $data) )."\r\n");
        } else {
            //insert
            $new_comerce = array(
                "cuit" => $data[0],
                "nombrefantasia" => $data[2],
                "direccion" => str_replace("-", "", $data[3]),
                "codigopostal" => $data[4],
                "provincia" => $this->getProvinciaReference(trim($data[6])),
                "ciudad_id" => $localidad,
                "Rubro" => array(
                    "id" => $this->getRubroReference($data[1])
                )
            );
            $this->Comercio->create();
            //debug($new_comerce);
            $saved = $this->Comercio->save($new_comerce);
            $this->out("<flashy>Insertado</flashy> ".$saved['Comercio']['nombrefantasia']);
        }
    }

    private function populateRubros() {
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

    private function populateProvinces() {
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

    private function getRubroReference($external_id) {
        return $this->rubros_reference[$external_id];
    }

    private function getProvinciaReference($external_id) {

        return $this->provincias_reference[$external_id];
    }

    private function processLine($data) {
        $comercios = $this->Comercio->find('all', array(
            'conditions' => array('Comercio.cuit' => $data[0])
        ));
        if (!$comercios) {
            $this->insertNewComerce($data);
        } 
    }

    private function updateExisting($comerces_by_cuit, $data) {
        foreach ($comerces_by_cuit as $c) {
            if ($c['Comercio']['activo'] == false) {
                $this->out("debo activar ");
            }
            //si codigo postal es igual y no tiene rubro
            if (isset($c['Rubro']) && count($c['Rubro']) == 0 && $data[4] == $c['Comercio']['codigopostal']) {
                //debug($c);
                $this->out("debo agregar rubro " . $this->getRubroReference($data[1]));
            }
        }
    }

    private function getLocalidad($dirty_name) {

        $ciudade = $this->Ciudade->find('first', array(
            'conditions' => array("Ciudade.nombre" => trim($dirty_name)),
            'fields' => array('Ciudade.nombre', 'Ciudade.id'),
            'recursive' => 0
        ));

        if (!$ciudade) {
            $this->out("<flashy>debo crear ciudad</flashy> " . $dirty_name);
        }


        return $ciudade ? $ciudade['Ciudade']['id'] : false;
    }

}
