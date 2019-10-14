<?php 

       if( !function_exists('is_already_in_use')) {
        function is_already_in_use($field, $value, $table) {
            
            global $bdd ; 
            $q = $bdd-> prepare("select id from $table where $field = ?");
            $q -> execute([$value]) ; 
            
            $count = $q -> rowcount();
            $q-> closeCursor() ;
            return $count;
            

        }
        
    }
?>    