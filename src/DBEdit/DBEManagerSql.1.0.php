<?php

// TODO
//
// * remove $query_result and $num_rows

/**
 * Gestione di query SQL
 */
class ManagerSql
{
    // messaggio di errore
    public $errore;

    private $hostname;
    private $user_name;
    private $user_pswd;
    private $user_db;

    // connessione a mysql server
    private $link;

    // query eseguita
    private $sql;

    // risultato della query
    private $query_result;

    private $debug;



    /**
     * Crea nuovo Manager.
     *
     * @param $config configurazione di DBEdit
     */
    public function __construct( & $config )
    {
        $this->hostname = $config["hostname"];
        $this->user_name = $config["user_name"];
        $this->user_pswd = $config["user_pswd"];
        $this->user_db = $config["user_db"];
        $this->debug = @$config["debug"];

        $this->init();
    }



    /**
     * Getters e setters
     */
    public function get_num_fields( $query_result)
    {
        return mysql_num_fields( $query_result);
    }
    public function get_field( $query_result, $i)
    {
        return mysql_fetch_field( $query_result, $i);;
    }
    public function get_row_assoc( $query_result)
    {
        return mysql_fetch_assoc( $query_result);
    }
    public function get_row_array( $query_result)
    {
        return mysql_fetch_array( $query_result);
    }
    public function get_num_rows( $query_result)
    {
        return mysql_num_rows( $query_result);
    }



    /**
     * All information about a table columns
     *
     * @return array di nomi di colonne e relative info in formato mysql
     */
    public function get_table_metadata( $table_name)
    {
        $metadata = null;
        $list_fields = mysql_list_fields($this->user_db, $table_name);
        if (! $list_fields)
        {
            $this->set_error( "DB Error, could not get metadata." );
            return $metadata;
        }
        $num_fields = mysql_num_fields($list_fields);
        for ($i=0; (($i<$num_fields) && ($info_field = mysql_fetch_field($list_fields, $i))); $i++)
        {
            // aggiungi field flags e salva table metadata
            $info_field->field_flags = mysql_field_flags($list_fields, $i);
            $metadata[$info_field->name] = $info_field;
        }

        return $metadata;
    }



    /**
     * Esegui SQL select
     *
     * @return int risultato di mysql_query()
     */
    public function query( $sql)
    {
        $this->errore = null;
        $this->sql = $sql;
        $this->query_result = mysql_query($this->sql, $this->link);
        if (! $this->query_result)
        {
            $this->set_error( "DB Error, could not query the database." );
        }

        if ($this->debug)
        {
            echo "<HR>".$this->sql;
        }

        return $this->query_result;
    }



    /**
     * Esegui SQL select
     *
     * @return array con l'intero risultato
     */
    public function query_all( $sql)
    {
        $this->errore = null;
        $this->sql = $sql;
        $query_result = mysql_query($this->sql, $this->link);
        if (! $query_result)
        {
            $this->set_error( "DB Error, could not query the database." );
            return $query_result;
        }

        // costruisci risultato
        $result_set = array();
        while ($row = mysql_fetch_array( $query_result))
        {
            $result_set[] = $row;
        }

        return $result_set;
    }



    /**
     * Aggiungi LIMIT to SQL
     */
    public function sql_select_limit( $sql, $offset, $row_count)
    {
        if($row_count)
        {
            $this->sql = $sql . " LIMIT ".$offset.",".$row_count;
        }
        return $this->sql;
    }



    /**
     * Aggiungi filtri to SQL
     */
    public function sql_select_filter( $sql, $filter_expression, $filter_value)
    {
        // split sql at the level of main clauses
        $sql_parts = $this->sql_split_at_where_end($sql);

        $sql_parts[0] .= substr_count($sql_parts[0], "WHERE") ? " AND " : " WHERE ";
        $sql_parts[0] .= $filter_expression . " LIKE '%".$filter_value."%'";

        // rebuild full SQL
        $sql = $sql_parts[0] . " " . $sql_parts[1];

        return $sql;
    }



    /**
     * Aggiungi where expression to SQL
     */
    public function sql_select_where( $sql, $where_expression)
    {
        // split sql at the level of main clauses
        $sql_parts = $this->sql_split_at_where_end($sql);

        $sql_parts[0] .= substr_count($sql_parts[0], "WHERE") ? " AND " : " WHERE ";
        $sql_parts[0] .= $where_expression;

        // rebuild full SQL
        $sql = $sql_parts[0] . " " . $sql_parts[1];

        return $sql;
    }



    /**
     * Estrae SELECT clause from SQL
     */
    public function sql_split_select( $sql)
    {
        // extract the SELECT clause
        $sql_upper      = strtoupper($sql);
        $pos_select     = strpos( $sql_upper, "SELECT");
        $pos_from       = strpos( $sql_upper, "FROM");
        $sql_select     = substr( $sql, $pos_select+6, $pos_from-$pos_select-6);

        return $sql_select;
    }



    /**
     * Genera WHERE col IN ( ... )
     */
    public function sql_where_col_in( $col_name, $col_numeric, $value_array)
    {
        $sql = $col_name . " IN (";
        foreach ($value_array as $value)
        {
            $sql .= $col_numeric ? "$value," : "'$value',";
        }
        return rtrim($sql, ",") . ")";
    }



    /**
     * Salva errore.
     *
     * @param $err messaggio di errore
     */
    private function set_error( $err )
    {
        $this->errore = "DBEManagerSql: $err";

        if(mysql_errno())
        {
            $this->errore .= ' [' . mysql_error() . ']';
        }

        if($this->sql)
        {
            $this->errore .= ' [[' . $this->sql . ']]';
        }

        if($this->debug)
        {
            echo $this->errore;
        }
    }



    /**
     * Inizializza connessione a database e metadata
     */
    private function init()
    {
        // connessione al mysql server
        if (!$this->link = mysql_connect( $this->hostname
                                        , $this->user_name
                                        , $this->user_pswd))
        {
            $this->set_error( 'Could not connect to mysql' );
            return;
        }

        // seleziona il database
        if (!mysql_select_db($this->user_db, $this->link))
        {
            $this->set_error( 'Could not select database' );
            return;
        }
    }



    /**
     * Split SQL at WHERE
     */
    private function sql_split_at_where_end( $sql)
    {
        // split sql at the level of main clauses
        $sql_upper      = strtoupper($sql);
        $pos_groupby    = strpos( $sql_upper, "GROUP BY");
        $pos_having     = strpos( $sql_upper, "HAVING");
        $pos_orderby    = strpos( $sql_upper, "ORDER BY");

        $split_pos      = $pos_orderby ? $pos_orderby : 0;
        $split_pos      = $pos_groupby
                        ? ($split_pos > 0 ? min($pos_groupby, $split_pos) : $pos_groupby)
                        : $split_pos
                        ;
        $split_pos      = $pos_having
                        ? ($split_pos > 0 ? min($pos_having, $split_pos)  : $pos_having)
                        : $split_pos
                        ;

        $sql_part1      = $split_pos ? substr( $sql, 0, $split_pos-1) : $sql;
        $sql_part2      = $split_pos ? substr( $sql, $split_pos, strlen($sql)) : "";

        return array($sql_part1, $sql_part2);
    }
}

?>
