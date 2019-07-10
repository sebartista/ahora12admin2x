<?php

class TryDuplicatesShell extends AppShell {

    private $ids_revisados = array();
    private $ids_desactivar = array();
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
            //'order' => array('Comercio.id ASC'),
            'recursive' => 0
        ));
        if ($comercio) {
            
            $duplicates = $this->Comercio->find('all', array(
                'conditions' => array(
                    'Comercio.id !=' => $comercio['Comercio']['id'],
                    'Comercio.cuit' => $comercio['Comercio']['cuit'],
                    'Comercio.ciudad_id' => $comercio['Comercio']['ciudad_id'],
                    'Comercio.codigopostal' => $comercio['Comercio']['codigopostal'],
                    'Comercio.direccion' => $comercio['Comercio']['direccion']
                ),
                'recursive' => 0
                //'order' => array('Comercio.id ASC')
            ));
            if (count($duplicates) >= 1) {
                //$this->out('<info> ID principal '.$comercio['Comercio']['id']);
                $this->out('<info>encontre </info>' . count($duplicates));
                if(count($this->ids_desactivar) > 1000){
                    $this->out('<info>procesados </info>' . $this->counter);
                    
                    $this->desactivarBulk();
                }
                $this->desactivarDuplicados($duplicates);
            }

            $this->ids_revisados[] = $comercio['Comercio']['id'];
            
        }
    }

    private function desactivarDuplicados($duplicates) {
        
        foreach ($duplicates as $comercio) {            
            //quedaria desactivado por lo cual salteo la condicion de ids_revisados
            
            $this->ids_desactivar[] = $comercio['Comercio']['id'];
            $this->ids_revisados[] = $comercio['Comercio']['id'];
            //$this->out("<warning>Desactivando:</warning> ".$comercio['Comercio']['id']);
        }
        
        //$this->Comercio->saveMany($desactivar, array('validate' => false));
    }
    
    private function desactivarBulk(){
        
        $this->out('desactivando BULK');
        $fields = array('Comercio.activo' => false);
        $conditions = array('Comercio.id' => $this->ids_desactivar);
        $this->Comercio->updateAll($fields, $conditions);
        $comercio_test = $this->Comercio->find('first', 
                array('conditions' => array(
                    'Comercio.id' => $this->ids_desactivar[0]
                )
                    ));
        $this->out('<info>Test desactivar</info> Deberia ser false'. $comercio_test['Comercio']['activo']);
        //debug($comercio_test);
        $this->ids_desactivar = array();
    }

}

?>