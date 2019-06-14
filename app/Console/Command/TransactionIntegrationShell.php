<?php

App::uses('Folder', 'Utility');
App::uses('File', 'Utility');

class TransactionIntegrationShell extends AppShell {

    public $uses = array('Comercio');
    private $rubros_reference = array();
    private $provincias_reference = array();       
    
    public function main() {
        $this->populateRubros();
        $this->populateProvinces();
        $this->processComerces();
        
    }
    private function processComerces(){
        $this->stdout->styles('flashy', array('text' => 'magenta', 'blink' => true));
// Condiciones insert
        //si no existe el cuit
    //si existe
        // revisar rubro            
        // revisar codigo postal
        //codigopostal y rubro
            //no  hacer nada
        //codigo postal
            //agregar rubro
        //si codigo postal (significa que es el mismo rubro en misma ubicacion)
            //ignorar
        //si diferente codigopostal 
            //nueva direccion



        $this->out('<flashy>working</flashy>');
        $dir = new Folder('C:\Users\sebar\Downloads\ahora12', false);        
        $file = new File('/var/www/html/ahora12admin2x/app/webroot/files/comercios_junio2018_2019.csv', false);
        
        $file->open('r');
        //$contents = $file->read();
        $this->out('file opened');
        $find_counter = 0;
        while (($line = fgets($file->handle)) !== false) {
            $exploded = explode("|", $line);
            $cuit = $exploded[0];
            $comercios = $this->Comercio->find('all', array(
                'conditions' => array('Comercio.cuit' => $cuit)
                ));
            if(!$comercios){
                //no existe cuit
                $this->out("<flashy>no existe comercio</flashy> ".$cuit. " - total ".$find_counter);
                //insert
                $find_counter++;
            } else {
                //"cuit"|"codrubroa12"|"nombre_fantasia"|"direccion"|"cp"|"localidad"|"codprovincia"
                $this->out("existe");
                $founded = false;
                foreach ($comercios as $c) {
                    //debug($c);
                    if(isset($c['Rubro']) && count($c['Rubro'])>0){
                        if($this->getRubroReference($exploded[1]) == $c['Rubro'][0]['id']){
                            if($exploded[4] == $c['Comercio']['codigopostal']){
                                $founded = $c;
                            }
                        }      
                    }

                }
                if($founded){
                    $this->out("encontre ".$founded['Comercio']['nombrefantasia']);
                } else {
                    $this->out("deberia insertar ".$exploded[2]);
                }
                //
            }
        }
        $this->out("encontre ".$find_counter);
        // foreach ($exploded as $cid){
        
        //     $this->out(' comercio: '.$cuit);
        //     $this->out('desactivando comercio: '.$cid);
        //     $this->Comercio->read(null, $cid);
        //     $this->Comercio->set('activo', 'f');
        //     $this->Comercio->save();
        //     $this->out('<flashy>desactivado</flashy>');
        // }
        // $file->close();
    }

    private function populateRubros(){
        $this->rubros_reference[180]= 7;
        $this->rubros_reference[130]= 2;
        $this->rubros_reference[610]= 18;
        $this->rubros_reference[150]= 3;
        $this->rubros_reference[710]= 17;
        $this->rubros_reference[410]= 13;
        $this->rubros_reference[140]= 1;
        $this->rubros_reference[170]= 5;
        $this->rubros_reference[165]= 8;
        $this->rubros_reference[160]= 4;
        $this->rubros_reference[810]= 0;
        $this->rubros_reference[110]= 8;
        $this->rubros_reference[310]= 14;
        $this->rubros_reference[230]= 11;
        $this->rubros_reference[220]= 12;
        $this->rubros_reference[210]= 9;
        $this->rubros_reference[240]= 10;
        $this->rubros_reference[120]= 6;
        $this->rubros_reference[510]= 16;
    }

    private function populateProvinces(){
        $this->provincias_reference[1]= 5;
        $this->provincias_reference[2]= 1;
        $this->provincias_reference[3]= 2;
        $this->provincias_reference[4]= 3;
        $this->provincias_reference[5]= 4;
        $this->provincias_reference[6]= 6;
        $this->provincias_reference[7]= 7;
        $this->provincias_reference[8]= 8;
        $this->provincias_reference[9]= 9;
        $this->provincias_reference[10]= 10;
        $this->provincias_reference[11]= 11;
        $this->provincias_reference[12]= 12;
        $this->provincias_reference[13]= 13;
        $this->provincias_reference[14]= 14;
        $this->provincias_reference[15]= 15;
        $this->provincias_reference[16]= 16;
        $this->provincias_reference[17]= 17;
        $this->provincias_reference[18]= 18;
        $this->provincias_reference[19]= 19;
        $this->provincias_reference[20]= 20;
        $this->provincias_reference[21]= 21;
        $this->provincias_reference[22]= 22;
        $this->provincias_reference[23]= 23;
        $this->provincias_reference[24]= 24;
    }
    private function getRubroReference($external_id){
        return $this->rubros_reference[$external_id];
    }
}