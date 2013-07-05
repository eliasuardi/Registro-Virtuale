<?php
/*
 * TO DO LIST DBEManagerFilter:
 * 
 * -aggiungere i commenti
 * -gestione dei fields html
 * -gestione dei hidden fields
 * -generazione sql delegata al DBEManagerSql
 * -usare filter_manager in DBEdit
 * -spostare le funzioni di task_manager al task manager
 * -aggiungere reference al sql manager
 * -spostare util_array_key_exists in un modulo comune
 */

class ManagerFilter
{
    private $config;
    
    private $sql_mgr;
    
    public function __construct( & $config)
    {
        $this->config = $config;
        
        $this->sql_mgr = new ManagerSql( $this->config);
    }



    /**
     * Genera l'html per gestione filtri da iniettare nel toolbar
     *
     * @return string javascript HTML tag
     */
    public function html_input_controls()
    {
        $html = '';
        if (util_array_key_exists("filter", $this->config))
        {
            $html .= '<TD class="'.DBE_STYLE_TOOLBAR.'" width="100%">'."\n";
            foreach( $this->config["column"] as $col_name => $col_info)
            {
                if (isset($col_info["filter"]))
                {
                    $request_name = $this->config["prefix"] . $col_info["name"];
                    $request_value = isset($_REQUEST[$request_name]) ? $_REQUEST[$request_name] : "";

                    // quando l'utente clicca un filtro resettiamo azione e chiavi
                    $html .= ucfirst(strtolower($col_info["name"]))
                            . ' <INPUT NAME="'. $request_name
                            . '" TYPE="text" VALUE="'. $request_value
                            . '" STYLE="font-size:10px;" SIZE=10 '
                            . ' ONCLICK="filter_onclick();" '
                            . ' ONCHANGE="filter_onchange();" '
                            . ' >'
                            . "\n"
                            ;
                }
            }
            $html .= '</TD>'."\n";
        }
        return $html;
    }
    
    
    
    /**
     * Genera javascript per gestione filtri da iniettare prima del form DBEdit
     *
     * @return string javascript HTML tag
     */
    public function html_filter_javascript()
    {
        if (util_array_key_exists("filter", $this->config))
        {
            return '
                    <script>
                        function filter_onclick( )
                        {
                            var azione = document.getElementById("azione");
                            var pk_values = document.getElementById("pk_values");
                            var offset = document.getElementById("offset");

                            if (azione)
                                azione.value = 0;

                            if (pk_values)
                                pk_values.value = null;

                            if (offset)
                                offset.value = 0;
                        }
                        function filter_onchange( )
                        {
                            var dbef = document.getElementById("'.$this->config["form_name"].'");
                            var azione = document.getElementById("azione");
                            var pk_values = document.getElementById("pk_values");
                            var offset = document.getElementById("offset");

                            if (azione)
                                azione.value = 0;

                            if (pk_values)
                                pk_values.value = null;

                            if (offset)
                                offset.value = 0;

                            // submit form
                            dbef.submit();
                        }
                    </script>
            ';
        }
        return "";
    }
    
    
    
    /**
     * Add filter to an enum SQL query
     * @return string the modified SQL
     */
    public function sql_add_filter_enum( $sql, $col_name)
    {
        // aggiungi filtro
        if (isset($this->config["column"][$col_name]["filter"]))
        {
            // extract the SELECT clause
            $sql_select = $this->sql_mgr->sql_split_select($sql);

            // append filter
            $request_name = $this->config["prefix"] . $col_name;
            $request_value = isset($_REQUEST[$request_name]) ? $_REQUEST[$request_name] : "";
            if (strlen($request_value))
            {
                $sql = $this->sql_mgr->sql_select_filter($sql, $sql_select, $request_value);
            }
        }

        return $sql;
    }


    
    public function sql_add_filter( $sql, $requested_col_name = null)
    {
        // append WHERE filters
        foreach( $this->config["column"] as $col_name => $col_info)
        {
            if (isset($col_info["filter"])
            &&  (is_null($requested_col_name) || ($requested_col_name == $col_name)))
            {
                $request_name = $this->config["prefix"] . $col_info["name"];
                $request_value = isset($_REQUEST[$request_name]) ? $_REQUEST[$request_name] : "";
                if (strlen($request_value))
                {
                    $sql = $this->sql_mgr->sql_select_filter($sql, $col_info["filter"], $request_value);
                }
            }
        }
        return $sql;
    }



    /*
     *
     *
     */
    public function html_hidden_fields()
    {
        $html = '';
        if (isset($this->config["column"]))
        {
            foreach( $this->config["column"] as $col_name => $col_info)
            {
                if (isset($col_info["filter"]))
                {
                    $request_name = $this->config["prefix"] . $col_info["name"];
                    $request_value = isset($_REQUEST[$request_name]) ? $_REQUEST[$request_name] : "";

                    // propaghiamo valori in hidden fields
                    $html .= ' <INPUT NAME="'. $request_name
                            . '" TYPE="hidden" VALUE="'. $request_value
                            . '">'
                            . "\n"
                            ;
                }
            }
        }
        return $html;
    }


    
}//end of DBEManagerFilter



?>
