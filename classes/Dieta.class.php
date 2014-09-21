<?php
/**
 * User: Raúl
 * Date: 15/09/14
 * Time: 20:52
 */
define('KCAL', 460); // #kcal daily (LUNCH + DINNER).
define('DAYS', 7);   // DÍAS a realizar la dieta.

define('DB_SERVER', "localhost");
define('DB_USER', "root");
define('DB_PASS', "");
define('DB_DATABASE', "diet");

//smart to define your table names also
define('TABLE_USERS', "users");
define('TABLE_NEWS', "news");

require_once('Database.class.php');


class Dieta{    
   
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
                $currentdish['name'] = $row['name'];
                $currentdish['kcal'] = $row['kcal'];
                $dishes[] = $currentdish;
                unset($currentdish);
            }
        $db->close();
        return $dishes;
       
        return false;        
    }

    // Get weekly diet.
    public function combineDishes() {
        $firsts = $this->getDishes(1); // Main platos
        $seconds = $this->getDishes(2); // Ligeros
        $numdays = 0;
        $week = array(); // Array de toda la semana        
               
        shuffle($firsts);        
        shuffle($seconds);        

        for($i=0;$i<DAYS;$i++){
            $week[$i]['lunch']['first'] = $firsts[$i];            
            $week[$i]['lunch']['second'] = $seconds[$i];
        }

        $cont = 0;

        for($i=DAYS;$i<=(DAYS*2)-1;$i++){
            $week[$cont]['dinner']['first'] = $firsts[$i];            
            $week[$cont]['dinner']['second'] = $seconds[$i];
            ++$cont;
        }

        return $week;
    }

    // Get dish ingredients. Depends on generateList funcion.
    
    public function getIngredients($iddish) {
        $db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
        $db->connect();

        $sql = "SELECT weight,i.name from dishes d, ingredients i where d.id = i.iddishes and i.iddishes = ". $iddish;
        $rows = $db->query($sql);
                
        if ($rows->affected_rows == 0) {
            return 'No ingredients yet for this dish';
        } else {
            while($row = $db->fetch_array($rows)){
                $currentingredient = array();
                $currentingredient['name'] = $row['name'];
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
        $data->name = $name;
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

    // Generar lista de la compra.
    public function generateList() {
        
    }
}