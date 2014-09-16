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
        $primeros = $this->getDishes(1); // Primeros platos
        $segundos = $this->getDishes(2); // Ligeros
        $dias = 0;
        $week = array(); // Array de toda la semana
        
        $primeros2 = array_rand($primeros, DAYS);
        $segundos2 = array_rand($segundos, DAYS);

            // Comida
            foreach($primeros2 as $id){
                $week[$dias]['comida']['primero'] = $primeros[$id];
                unset($primeros[$id]); // Borrar platos
                ++$dias;

            }

            $dias = 0;
            foreach($segundos2 as $id){
                $week[$dias]['comida']['segundo'] = $segundos[$id];
                unset($segundos[$id]); // Borrar platos
                ++$dias;
            }
           
            //Cenas
            $primeros = array_values($primeros);
            $segundos = array_values($segundos);

            for ($i=0; $i<DAYS; $i++) {
                $week[$i]['cena']['primero'] = $primeros[$i];
                $week[$i]['cena']['segundo'] = $segundos[$i];
            }
        return $week;
    }

    // Grabar dietas en BD.
    public function saveWeek() {

    }

    // Introducir ingredientes.
    public function saveIng() {

    }

    public function getIng() {

    }

    // Generar lista de la compra.
    public function generateList() {
        
    }
}