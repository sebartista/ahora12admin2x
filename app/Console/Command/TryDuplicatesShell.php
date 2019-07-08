<?php

class TryDuplicatesShell extends AppShell {

    private $ids_revisados = array();
    public $uses = array('Comercio');
    private $counter = 0;
    
    public function main() {
        $comercios_count = $this->Comercio->find('count');
        while($this->counter < $comercios_count){
            $this->getDuplicates();
            $this->counter++;
        }
        
    }

    private function getDuplicates() {
        $comercio = $this->Comercio->find('first', array(
            'conditions' => array(
                'Comercio.id !=' => $this->ids_revisados,
                'Comercio.activo' => true),
            'order' => array('Comercio.id ASC'),
            'recursive' => 0
        ));
        if ($comercio) {
            
            $duplicates = $this->Comercio->find('all', array(
                'conditions' => array(
                    'Comercio.id !=' => $comercio['Comercio']['id'],
                    'Comercio.ciudad_id' => $comercio['Comercio']['ciudad_id'],
                    'Comercio.codigopostal' => $comercio['Comercio']['codigopostal'],
                    'Comercio.direccion' => $comercio['Comercio']['direccion']
                ),
                'order' => array('Comercio.id ASC')
            ));
            if (count($duplicates) > 1) {
                $this->out('<info> ID principal '.$comercio['Comercio']['id']);
                $this->out('<info>encontre </info>' . count($duplicates));
                $this->desactivarDuplicados($duplicates);
            }

            $this->ids_revisados[] = $comercio['Comercio']['id'];
            
        }
    }

    private function desactivarDuplicados($duplicates) {
        $desactivar = array();
        foreach ($duplicates as &$comercio) {            
            //quedaria desactivado por lo cual salteo la condicion de ids_revisados
            $comercio['Comercio']['activo'] = false;
            $desactivar[] = $comercio;
            $this->out("<warning>Desactivando:</warning> ".$comercio['Comercio']['id']);
        }
        
        //$this->Comercio->saveMany($desactivar, array('validate' => false));
    }

}

?>