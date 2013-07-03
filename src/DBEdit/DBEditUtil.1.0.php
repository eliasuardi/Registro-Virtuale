<?php

/**
 * Find if key exists in multi dimensional array
 * @return bool true if found false if not found
 */
function util_array_key_exists( $key, $array)
{
       if( !is_array( $array))
       {
           return false;
       }

       if(array_key_exists( $key, $array))
       {
           return true;
       }

       foreach( $array as $row )
       {
           // recursively search internal arrays
           if(util_array_key_exists( $key, $row))
           {
               return true;
           }
       }

       return false;
}


?>
