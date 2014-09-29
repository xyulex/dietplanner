<?php
/**
 * User: Raúl
 * Date: 15/09/14
 * Time: 20:52
 */
define('KCAL', 460); // #kcal daily (LUNCH + DINNER).
define('DAYS', 4);   // DÍAS a realizar la dieta.
define('MEALSDAY', 4);
define('MEALS', DAYS *4);
define('DB_SERVER', "localhost");
define('DB_USER', "root");
define('DB_PASS', "");
define('DB_DATABASE', "diet");

require_once('Database.class.php');


class Diet{  

    public function prettyPrint($array) {
       echo '<pre>';
       print_r($array);
       echo '</pre>';
    }
   
    /**** Getters ****/    

    // Get dishes type.
    public function getDishes($type){        
        $db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
        $db->connect();
        $dishes = array();

        $sql = "SELECT * FROM dishes WHERE type=" . $type;
        $rows = $db->query($sql);

            while($row = $db->fetch_array($rows)){
                $currentdish = array();
                $currentdish['id'] = $row['id'];
                $currentdish['name'] = utf8_encode($row['name']);
                $currentdish['kcal'] = $row['kcal'];
                $dishes[] = $currentdish;
                unset($currentdish);
            }
        $db->close();

        return $dishes;     
    }

    // Get total dish number.
    public function getTotalDishes($type = '') {
        $db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
        $db->connect();
        $where = '';
        if ($type){
            $where = " where type =" . $type;
        }

        $sql = "SELECT * FROM dishes" . $where;
        $rows = $db->query($sql);
        
        return $db->affected_rows;
    }

    // Get dish ingredients. Depends on generateList funcion.
    
    public function getIngredients($iddish) {
        $db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
        $db->connect();

        $sql = "SELECT weight,i.name from dishes d, ingredients i where d.id = i.iddishes and i.iddishes = ". $iddish;
        $rows = $db->query($sql);
                
        if ($rows->affected_rows == 0) {
            return 'No existen ingredientes para este plato';
        } else {
            while($row = $db->fetch_array($rows)){
                $currentingredient = array();
                $currentingredient['name'] = utf8_encode($row['name']);
                $currentingredient['weight'] = $row['weight'];
                $ingredients[] = $currentingredient;
                unset($currentingredient);
            }
            $db->close();
            return $ingredients; 
        }
        $db->close();
        return false;
    }

    

    /**** Setters ****/ 

    // Grabar platos.
    public function setDish($name, $kcal, $type){
        $db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
        $db->connect();
        $data = new stdClass();
        $data->name = utf8_decode($name);
        $data->kcal = $kcal;
        $data->type = $type;
        $idinsert = $db->query_insert("dishes", $data);
        $db->close();
        return $idinsert;       
    }

    // Grabar dietas en BD.
    public function saveWeek() {

    }

    // Introducir ingredientes.
    public function setIngredients($iddish, $ingredientsarray) {
        $db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
        $db->connect();

        $ingredientsarray = explode(',', $ingredientsarray);
        foreach($ingredientsarray as $ingredientarray) {
            $ingredientarray = explode('_', $ingredientarray);

            if ($ingredientarray[0]) {
                $data = new stdClass();
                $data->iddishes = $iddish;
                $data->idingredient = $ingredientarray[1];
                $data->weight = $ingredientarray[0];
                $idinsert = $db->query_insert("ingredients", $data);                
            }

        }
        $db->close();
    }    

    
    // Añadir un ingrediente.
    public function addIngredient($name) {
        $db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
        $db->connect();
        $data = new stdClass();
        $data->name = $name;
        $idinsert = $db->query_insert("ingredients_name", $data);
        $db->close();
    }

    // Generar lista de la compra.
    public function generateList() {
        
    }


    // Get weekly diet.
    public function combineDishes() { 
        $db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
        $db->connect();

        $firsts = $this->getDishes(1); // Main platos
        $seconds = $this->getDishes(2); // Ligeros

        $arraydias = array();
        $kcalarray = array();

        $total = 0;
        $numcomidas = 0;            
        $numdias = 0;

        $i = 0;

        $totalDishes = array_merge($firsts,$seconds);

        foreach($totalDishes as $dish) {

            $kcalarray[$i]['name'] = $dish['name'];
            $kcalarray[$i]['kcal'] = $dish['kcal'];
            $i++;
            shuffle($kcalarray);
        }
       

        foreach($kcalarray as $key => $kcal) { 

           if($total <= (KCAL) && $numdias < DAYS) {
                if ( $numcomidas <= MEALSDAY) {    
                    $total  = $total + $kcal['kcal'];
                    if ($total <= (KCAL)){
                        $arraydias[$numdias][$numcomidas]['name'] = $kcal['name'];                        
                        $arraydias[$numdias][$numcomidas]['kcal'] = $kcal['kcal'];                        
                        $arraydias[$numdias]['totalkcal'] = $total;
                        $numcomidas ++;
                        if ($numcomidas < MEALSDAY) {
                            $arraydias[$numdias][$numcomidas]['name'] = ' ';
                            $arraydias[$numdias][$numcomidas]['kcal'] = ' ';

                        }
                        if ($numcomidas == MEALSDAY || (KCAL - $total) <=120) {
                            $total = 0;
                            $numcomidas = 0;
                            $numdias++;
                        }
                    } else {
                        $numdias++;
                        $numcomidas = 0;
                        $total = 0;
                    }            
                } 
                
            }

        }

        return $arraydias;
    }
}