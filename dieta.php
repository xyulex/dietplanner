<?php
/**
 * User: Raúl
 * Date: 15/09/14
 * Time: 20:52
 */
define('KCAL', 460); // #kcal daily (LUNCH + DINNER).
define('DAYS', 2);   // DÍAS a realizar la dieta.

class Dieta {

    public function connect() {
        $connection = mysqli_connect("localhost","root","","diet");

        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            return false;
        }
        return $connection;
    }


    // Grabar platos.
    public function setDish($name, $kcal, $type){
        $connection = $this->connect();
        if ($connection) {
            $sql = "INSERT INTO dishes(name,kcal,type) VALUES(".$name.",".$kcal.",".$type.")";
            $result = mysqli_query($connection,$sql);
            return true;
        }
    }

    // Obtener platos de un tipo.
    public function getDishes($type){
        $dishes = array(); // Array de los platos de cada tipo

        $connection = $this->connect();

        if ($connection) {
            $sql = "SELECT * FROM dishes WHERE type=" . $type;
            $result = mysqli_query($connection,$sql);

            if ($result) {
                while($row = mysqli_fetch_array($result)){
                    $currentdish = array();
                    $currentdish['name'] = $row['name'];
                    $currentdish['kcal'] = $row['kcal'];
                    $dishes[] = $currentdish;
                    unset($currentdish);
                }

                return $dishes;
            }
            return false;
        }
    }

    // Realizar dieta semanal.
    public function combineDishes() {
        $firsts = $this->getDishes(1); // first platos
        $seconds = $this->getDishes(2); // Ligeros
        $dias = 0;
        $week = array(); // Array de toda la semana
        
        $idfirsts = array_rand($firsts, DAYS);
        $idseconds = array_rand($seconds, DAYS);

            // Comida
            foreach($idfirsts as $idfirst){
                $week[$dias]['lunch']['first'] = $firsts[$idfirst];
                unset($first[$idfirst]); // Borrar platos
                ++$dias;

            }

            $dias = 0;
            foreach($idseconds as $idsecond){
                $week[$dias]['lunch']['second'] = $seconds[$idsecond];
                unset($seconds[$idsecond]); // Borrar platos
                ++$dias;
            }
           
            //Dinners
            $first = array_values($first);
            $segundos = array_values($seconds);

            for ($i=0; $i<DAYS; $i++) {
                $week[$i]['dinner']['first'] = $firsts[$i];
                $week[$i]['dinner']['second'] = $seconds[$i];
            }
        return $week;
    }

    // Grabar dietas en BD.
    public function saveWeek() {

    }

    // Introducir ingredientes.
    public function saveIng($dishid) {

    }

    public function getIng($dishid) {

    }

    // Generar lista de la compra.
    public function generateList() {
        
    }
}