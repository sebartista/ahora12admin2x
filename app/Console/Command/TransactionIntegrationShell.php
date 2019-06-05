<?php

App::uses('Folder', 'Utility');
App::uses('File', 'Utility');

class TransactionIntegrationShell extends AppShell {
    
    public $uses = array('Comercio');
    
    public function check_existing_records() {
        $this->stdout->styles('flashy', array('text' => 'magenta', 'blink' => true));
// Condiciones insert
        //si no existe el cuit
    //si existe
        // revisar rubro    
        // revisar direccion
        // revisar codigo postal
        //si direccion y codigopostal y rubro
            //no  hacer nada
        //si direccion y codigo postal
            //agregar rubro
        //si codigo postal (significa que es el mismo rubro en misma ubicacion)
            //ignorar
        //si diferente codigopostal 
            //nueva direccion


        $this->out('<flashy>working</flashy>');
        $dir = new Folder('C:\Users\sebar\Downloads\ahora12', false);        
        $file = new File($dir->pwd().'\comercios_junio2018-2019.csv', false);
        
        $file->open('r');
        //$contents = $file->read();
        $this->out('file opened');
        $find_counter = 0;
        while (($line = fgets($file->handle)) !== false) {
            $exploded = explode("|", $line);
            $cuit = $exploded[0];
            $first = $this->Comercio->find('first', array(
                'conditions' => array('Comercio.cuit' => $cuit, 'Comercio.activo' => 't')
            ));
            if($first){
                $this->out("encontre comercio ".$cuit. " - total ".$find_counter);
                $find_counter++;
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
}