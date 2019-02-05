<?php

App::uses('Folder', 'Utility');
App::uses('File', 'Utility');

class ComercioShell extends AppShell {
    
    public $uses = array('Comercio');
    
    public function bulk_deactivate() {
        $this->stdout->styles('flashy', array('text' => 'magenta', 'blink' => true));
        $dir = new Folder('/xampp7/htdocs/ahora12admin2x/app/webroot/files', false);        
        $file = new File($dir->pwd().'/ids-duplicados.csv', false);
        
        $file->open('r');
        $contents = $file->read();
        $exploded = explode("\r", $contents);
        
        foreach ($exploded as $cid){
            
            $this->out('desactivando comercio: '.$cid);
            $this->Comercio->read(null, $cid);
            $this->Comercio->set('activo', 'f');
            $this->Comercio->save();
            $this->out('<flashy>desactivado</flashy>');
        }
        $file->close();
    }
}