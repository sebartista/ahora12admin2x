<?php

App::uses('Folder', 'Utility');
App::uses('File', 'Utility');
App::uses('HttpSocket', 'Network/Http');

class SecondStepNormalizeAddressShell extends AppShell {

    private $data_to_process;
    private $data_with_aggregated;

    public function main() {

        
        
        $this->stdout->styles('flashy', array('text' => 'green', 'blink' => true));
        $this->stdout->styles('errory', array('text' => 'red', 'blink' => true));
        $this->out('<flashy>working</flashy>');

        //$file = new File('/var/www/html/ahora12admin2x/app/webroot/files/toprocess_2020-07-26-02-01-04.csv'. '', false);
        $file = new File('/var/www/html/ahora12admin2x/app/webroot/files/test-georef-calles.csv', false);
        $file->open('r');

        $this->out('read file opened');
        $find_counter = 0;
        //abro archivo a guardar
        $this->data_with_aggregated = new File('/var/www/html/ahora12admin2x/app/webroot/files/aggregated'.date("Y-m-d-h-i-s").'.csv', true);
        $this->out('write file opened');
        $this->data_with_aggregated->open("w");

        $HttpSocket = new HttpSocket();

        while (($line = fgets($file->handle)) !== false) {
            $exploded = explode("|", $line);
            if ($exploded[0] != '"cuit"') {
                $CUIT = $exploded[0];
                $nombre_de_fantasía = $exploded[1];
                $rubro_a12 = $exploded[2];
                $direccion = $exploded[3];
                $localidad = $exploded[4];
                $provincia = rtrim($exploded[5]);

                //$this->out('https://apis.datos.gob.ar/georef/api/direcciones'. '?direccion=' . rawurlencode($direccion) . '&provincia=' . rawurlencode($provincia) . '&localidad=' . rawurlencode($localidad) . '&cantidad=1');
                $this->out('http query');
                $results = $HttpSocket->get('https://apis.datos.gob.ar/georef/api/direcciones', '?direccion=' . rawurlencode($direccion) . '&max=1' . '&provincia=' . rawurlencode($provincia));
                
                $thedata = json_decode($results['body']);
                if($thedata->cantidad > 0){
                    //var_dump($thedata->direcciones);
                    $this->out('<flashy> Encontre datos </flashy>' );
                    
                    $exploded[6] = $thedata->direcciones[0]->altura->valor;
                    $exploded[7] =$thedata->direcciones[0]->calle->nombre;
                    $exploded[8] =$thedata->direcciones[0]->departamento->nombre;
                    $exploded[9] =$thedata->direcciones[0]->localidad_censal->nombre;
                    $exploded[10] =$thedata->direcciones[0]->provincia->nombre;
                    $exploded[11] =$thedata->direcciones[0]->ubicacion->lat;
                    $exploded[12] =$thedata->direcciones[0]->ubicacion->lon;
                    
                    //fix enter exploded[5]
                    $exploded[5] = rtrim($exploded[5]);
                    
                } else {
                    $this->out('<errory> No Encontre datos </errory>' );
                    $exploded[6] = "";
                    $exploded[7] = "";
                    $exploded[8] = "";
                    $exploded[9] = "";
                    $exploded[10] = "";
                    $exploded[11] = "";
                    $exploded[12] = "";
                    $exploded[5] = rtrim($exploded[5]);
                    
                }
                $this->out('writing');
                $this->data_with_aggregated->append(trim(implode("|", $exploded) )."\r\n");
            
            }
            
            
        }
        
        $this->data_with_aggregated->close();
        $file->close();
    }

}
