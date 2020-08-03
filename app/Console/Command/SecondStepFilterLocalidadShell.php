<?php

/**
 * Description of SecondStepFilterLocalidadShell
 *
 * @author sebartista
 */
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');

class SecondStepFilterLocalidadShell extends AppShell {

    //put your code here
    private $citiesok;
    private $citiesbad;
    private $ciudades;
    public $uses = array('Ciudade');

    //
    public function main() {

        $this->ciudades = $this->getAllCities();

        $this->stdout->styles('flashy', array('text' => 'green', 'blink' => false));
        $this->stdout->styles('errory', array('text' => 'red', 'blink' => false));
        $this->out('<flashy>working</flashy>');
        $file = new File('/var/www/html/ahora12admin2x/app/webroot/files/toprocess2020-07-26-02-01-04.csv', false);
        //$file = new File('/var/www/html/ahora12admin2x/app/webroot/files/test-second-step.csv', false);
        $file->open('r');

        $this->citiesok = new File('/var/www/html/ahora12admin2x/app/webroot/files/secondstep_citiesok.csv', true);
        $this->citiesok->open("w");

        $this->citiesbad = new File('/var/www/html/ahora12admin2x/app/webroot/files/secondstep_citiesbad.csv', true);
        $this->citiesbad->open("w");

        while (($line = fgets($file->handle)) !== false) {
            $exploded = explode("|", $line);
            if ($exploded[0] != '"CUIT"') {

                if (in_array(str_replace('"', '', trim($exploded[4])), $this->ciudades)) {

                    $this->out("<flashy>encontrado - guardando</flashy>");
                    //guardar linea
                    $this->citiesok->append($line);
                } else {
                    $this->out("<errory>no encontrado - guardando</errory>");
                    $this->citiesbad->append($line);
                }
            }
        }


        $file->close();
        $this->citiesok->close();
        $this->citiesbad->close();
    }

    private function getAllCities() {
        $cities = $this->Ciudade->find('list');
        return array_map('trim', $cities);
    }

}
