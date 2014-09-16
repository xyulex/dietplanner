<?php
/**
 * User: Raúl
 * Date: 15/09/14
 * Time: 20:52
 */
define('KCAL', 460); // #kcal daily (LUNCH + DINNER).
define('DAYS', 7);   // DÍAS a realizar la dieta.

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
        $week[] = array();
        $week[][] = array();

        $primeros2 = array_rand($primeros, DAYS);
        $segundos2 = array_rand($segundos, DAYS);

            foreach($primeros2 as $id){
                $week[$dias]['comida']['primero'] = $primeros[$id];
                ++$dias;
            }

            $dias = 0;
            foreach($segundos2 as $id){
                $week[$dias]['comida']['segundo'] = $segundos[$id];
                ++$dias;
            }
        return $week;
    }

    // Grabar dietas en BD.
    public function saveWeek() {

    }
}