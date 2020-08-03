<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ThirdStepInsert
 *
 * @author sebartista
 */
class ThirdStepInsertShell extends AppShell {

    public $uses = array('Provincia', 'Rubro', 'Ciudade', 'Comercio');
    private $provincias;
    private $rubros;
    private $mapped_rubros;
    private $errors;

    // try to find provincia

    public function main() {

        $this->provincias = $this->getProvincias();
        $this->rubros = $this->getRubros();
        $this->mapped_rubros = $this->mapRubrosType();

        $this->stdout->styles('flashy', array('text' => 'green', 'blink' => false));
        $this->stdout->styles('errory', array('text' => 'red', 'blink' => false));
        $this->out('<flashy>working</flashy>');
        $file = new File('/var/www/html/ahora12admin2x/app/webroot/files/secondstep_citiesok.csv', false);
        //$file = new File('/var/www/html/ahora12admin2x/app/webroot/files/test-second-step.csv', false);
        $file->open('r');
        while (($line = fgets($file->handle)) !== false) {
            $exploded = explode("|", $line);


            if (in_array(str_replace('"', '', trim($exploded[5])), $this->provincias)) {
                
                
                $rid = $this->getRubroId(str_replace('"', '', trim($exploded[2])));
                if($rid){
                    $this->out("<flashy>Deberia insertar</flashy>");
                    $this->_insertNewComerce($exploded, $rid);
                } else {
                    $this->errors .=$line;
                }
            } else {
                $this->out("<errory>no encontre provincia</errory>");
                $this->errors .=$line;
            }
//
//            if (!in_array(str_replace('"', '', trim($exploded[2])), $this->rubros)) {
//                $this->out("<errory>no encontre rubro</errory>" . " " . $exploded[2]);
//            }
            
            
        }
        $error_file = new File('/var/www/html/ahora12admin2x/app/webroot/files/thirdstep_errors.csv', true);
        $error_file->open("w");
        $error_file->append($this->errors);
        $error_file->close();
        $this->out("<flashy>Finalizado</flashy> ");
    }

    private function _insertNewComerce($data, $rubro_id) {
        $error_file = new File('/var/www/html/ahora12admin2x/app/webroot/files/thirdstep_localidades_errors.csv', true);
        $error_file->open("w");
        $inserted = new File('/var/www/html/ahora12admin2x/app/webroot/files/thirdstep_inserted.csv', true);
        $inserted->open("w");
        
        foreach ($data as &$d) {
            $d = str_replace('"', '', $d);
        }
        
        $localidad = $this->Ciudade->find('first', array(
            'conditions' => array('Ciudade.nombre LIKE' => str_replace('"', '', trim($data[4]))),
            'fields' => array('Ciudade.id'),
            'recursive' => 0
            
        ));
        if($localidad){
            //insert
            $new_comerce = array(
                "cuit" => trim($data[0]),
                "nombrefantasia" => trim($data[1]),
                "razonsocial" => trim($data[1]),
                "direccion" => trim( str_replace(array("-", "LOC"), "", $data[3]) ),
                "codigopostal" => "",                
                "ciudad_id" => $localidad['Ciudade']['id']
            );
            if ($rubro_id > 0) {
                $new_comerce['Rubro']['id'] = $rubro_id;
            }
            
            $this->Comercio->create();
            
            $saved = $this->Comercio->save($new_comerce);
            $inserted->append($this->Comercio->id."\r\n");
            $this->out("<flashy>Insertado</flashy> " . $saved['Comercio']['nombrefantasia']);
            //$this->out("<flashy>Insertado</flashy> ");
        } else {
            
            $error_file->append(implode("|", $data) . "\r\n");
            
        }
        $error_file->close();
        $inserted->close();
            
        
    }

    private function getProvincias() {
        return $this->Provincia->find('list');
    }

    private function getRubros() {
        return $this->Rubro->find('list');
    }

    private function mapRubrosType() {
        $map_rubros[1]['names'][] = "Línea blanca";
        $map_rubros[1]['names'][] = "Línea Blanca";
        $map_rubros[2]['names'][] = "Indumentaria";
        $map_rubros[3]['names'][] = "Materiales para la construcción";
        $map_rubros[3]['names'][] = "Materiales para la construcción";
        $map_rubros[4]['names'][] = "Motocicletas";
        $map_rubros[4]['names'][] = "Motos y Bicicletas";
        $map_rubros[5]['names'][] = "Muebles";
        $map_rubros[7]['names'][] = "Turismo";
        $map_rubros[7]['names'][] = "Balnearios";
        $map_rubros[8]['names'][] = "Bicicletas";
        $map_rubros[8]['names'][] = "Motos y Bicicletas";
        $map_rubros[6]['names'][] = "Calzado y Marroquinería";
        $map_rubros[9]['names'][] = "Anteojos";
        $map_rubros[11]['names'][] = "Colchones";
        $map_rubros[12]['names'][] = "Artículos de Librería";
        $map_rubros[12]['names'][] = "Artí­culos de Librería";
        $map_rubros[10]['names'][] = "Libros";
        $map_rubros[13]['names'][] = "Juguetes y juegos de mesa";
        $map_rubros[13]['names'][] = "Juguetes y Juegos de mesa";
        $map_rubros[14]['names'][] = "Celulares";
        $map_rubros[15]['names'][] = "Artefactos de iluminación";
        $map_rubros[16]['names'][] = "Computadoras, notebooks y tabletas";
        $map_rubros[17]['names'][] = "Instrumentos musicales";
        $map_rubros[18]['names'][] = "Neumáticos, accesorios y repuestos para autos y motos";
        $map_rubros[18]['names'][] = "Neumáticos, accesorios y repuestos";
        $map_rubros[19]['names'][] = "Televisores";
        $map_rubros[21]['names'][] = "Alimentos, bebidas y productos de higiene personal y limpieza";
        $map_rubros[22]['names'][] = "Medicamentos";
        $map_rubros[24]['names'][] = "Perfumería";
        $map_rubros[24]['names'][] = "Perfumeria";
        $map_rubros[25]['names'][] = "Equipamiento médico";
        $map_rubros[26]['names'][] = "Pequeños electrodomésticos";
        $map_rubros[26]['names'][] = "PequeÃ±os electrodomÃ©sticos";
        $map_rubros[27]['names'][] = "Servicios de preparación para el deporte";
        $map_rubros[27]['names'][] = "Servicios de preparacion para el deporte";
        
        return $map_rubros;
    }

    private function getRubroId($rubro){
        $id = false;
        foreach ($this->mapped_rubros as $k => $mr){
            if(in_array($rubro, $mr['names'])){
                $id = $k;
                break;
            }
        }
        return $id;
    }
}
