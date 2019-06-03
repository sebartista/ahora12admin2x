<?php

App::uses('Folder', 'Utility');
App::uses('File', 'Utility');

class TransactionIntegrationShell extends AppShell {
    
    public $uses = array('Comercio');
    
    public function check_existing_records() {
        $this->stdout->styles('flashy', array('text' => 'magenta', 'blink' => true));


        $this->out('<flashy>working</flashy>');
        $dir = new Folder('C:\Users\SEBA\Downloads\Ahora12', false);        
        $file = new File($dir->pwd().'\comercios2018-2019.csv', false);
        
        $file->open('r');
        //$contents = $file->read();
        $this->out('file opened');
        $find_counter = 0;
        while (($line = fgets($file->handle)) !== false) {
            $exploded = explode("|", $line);
            $cuit = $exploded[0];
            $first = $this->Comercio->find('first', array(
                'conditions' => array('Comercio.cuit' => $cuit)
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