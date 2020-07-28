<?php

App::uses('Folder', 'Utility');
App::uses('File', 'Utility');

class FirstStepFilterDuplicatesShell extends AppShell {

    public $uses = array('Comercio');
    private $datos_enviados;
    private $csv_cuits = [];
    private $cuits = [];
    private $data_to_process;

    public function main() {
        
        $this->loadCuits();
        
                
        //$this->datos_enviados = new File('/var/www/html/ahora12admin2x/app/webroot/files/Ahora12_20200708.csv', true);

        //$this->datos_enviados = new File('/var/www/html/ahora12admin2x/app/webroot/files/test_process.csv', true);
        
        $this->stdout->styles('flashy', array('text' => 'green', 'blink' => true));
        $this->stdout->styles('errory', array('text' => 'red', 'blink' => true));
        $this->out('<flashy>working</flashy>');
        
        $this->out('loaded from database: ' . count($this->cuits));
        
        $dir = new Folder('/var/www/html/ahora12admin2x/app/webroot/files/', false);
        $file = new File('/var/www/html/ahora12admin2x/app/webroot/files/Ahora12_20200708.csv', false);
        //$file = new File('/var/www/html/ahora12admin2x/app/webroot/files/test_process.csv', false);
        $file->open('r');
        
        $this->out('file opened');
        $find_counter = 0;
        //abro archivo a guardar
        $this->data_to_process = new File('/var/www/html/ahora12admin2x/app/webroot/files/toprocess'.date("Y-m-d-h-i-s").'.csv', true);
        $this->data_to_process->open("w");
        while (($line = fgets($file->handle)) !== false) {
            $exploded = explode("|", $line);
            if ($exploded[0] != '"cuit"') {
                
                //si no esta en la db
                if(!in_array($exploded[0], $this->cuits)){
                    $this->out("<flashy>no encontrados - guardando</flashy>");
                    //guardar linea
                    $this->data_to_process->append($line);
                }
                
            }
        
        }
        $this->data_to_process->close();
        //$this->out("encontre " . count($this->csv_cuits));
        $file->close();
        
    }

    //cargar csv
    //cargar todos los cuits
    private function loadCuits() {
        $c = $this->Comercio->find('all', 
                array(                    
                    'fields' => array('Comercio.cuit')                    
                ));
        
        foreach ($c as $comercio ){ 
            $this->cuits[] = $comercio['Comercio']['cuit'];
        }
    }
    //si no existe en db guardar para cargar
    //si no existe en archivo marcar para desactivar
    //si existe en ambos, revisar activo, activar
}
