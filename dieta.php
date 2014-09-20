<?php
/**
 * User: Raúl
 * Date: 15/09/14
 * Time: 20:52
 */
define('KCAL', 460); // #kcal daily (LUNCH + DINNER).
define('DAYS', 2);   // DÍAS a realizar la dieta.

class Dieta {

    public function __construct() {        
        $connection = mysqli_connect("localhost","root","","diet");

        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            return false;
        }

        $this->connection = $connection;
        return $connection;
    }

    


    /**** Getters ****/    

    // Get dishes type.
    public function getDishes($type){
        $dishes = array();
            if ($this->connection){
            $sql = "SELECT * FROM dishes WHERE type=" . $type;
            $result = mysqli_query($this->connection,$sql);

            if ($result) {
                while($row = mysqli_fetch_array($result)){
                    $currentdish = array();
                    $currentdish['id'] = $row['id'];
                    $currentdish['name'] = $row['name'];
                    $currentdish['kcal'] = $row['kcal'];
                    $dishes[] = $currentdish;
                    unset($currentdish);
                }

                return $dishes;
            }
            }
            return false;        
    }

    // Get weekly diet.
    public function combineDishes() {
        $firsts = $this->getDishes(1); // Main platos
        $seconds = $this->getDishes(2); // Ligeros
        $numdays = 0;
        $week = array(); // Array de toda la semana
        
        $idfirsts   = array_rand($firsts, DAYS);
        $idseconds  = array_rand($seconds, DAYS);

            // Lunches
            foreach($idfirsts as $idfirst){
                $week[$numdays]['lunch']['first'] = $firsts[$idfirst];
                unset($firsts[$idfirst]); 
                ++$numdays;

            }

            $numdays = 0;
            foreach($idseconds as $idsecond){
                $week[$numdays]['lunch']['second'] = $seconds[$idsecond];                
                ++$numdays;
            }
           
            //Dinners
            $firsts = array_values($firsts);
            $segundos = array_values($seconds);

            for ($i=1; $i<DAYS; $i++) {
                $week[$i]['dinner']['first'] = $firsts[$i];
                $week[$i]['dinner']['second'] = $seconds[$i];
            }
        return $week;
    }

    // Get dish ingredients. Depends on generateList funcion.
    public function getIngredients($iddish) {
        if ($this->connection) {
            $sql = "SELECT weight,i.name from dishes d, ingredients i where d.id = i.iddishes and i.iddishes = ". $iddish;
            $result = mysqli_query($this->connection,$sql);
            
            if ($result->num_rows == 0) {
                return 'No ingredients yet for this dish';
            } else {
                while($row = mysqli_fetch_array($result)){
                    $currentingredient = array();
                    $currentingredient['name'] = $row['name'];
                    $currentingredient['weight'] = $row['weight'];
                    $ingredients[] = $currentingredient;
                    unset($currentingredient);
                }               
                return $ingredients; 
            }
        }
        return false;
    }

    

    /**** Setters ****/ 

    // Grabar platos.
    public function setDish($name, $kcal, $type){
        if ($this->connection) {
            $sql = "INSERT INTO dishes(name,kcal,type) VALUES(".$name.",".$kcal.",".$type.")";
            $result = mysqli_query($this->connection,$sql);
            return true;
        }
    }

    // Grabar dietas en BD.
    public function saveWeek() {

    }

    // Introducir ingredientes.
    public function saveIng($dishid) {

    }

    
    

    // Generar lista de la compra.
    public function generateList() {
        
    }
}