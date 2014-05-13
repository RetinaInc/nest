<?php

class Base
{
    protected $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function find()
    {
        $objects = array();

        $result = mysql_query("select * from {$this->name}");
        while ($row = mysql_fetch_object($result)) 
        {
            $objects[$row->id] = $row;
        }
        mysql_free_result($result);

        return $objects;
    }

    function findBy($col, $id) 
    {
        $objects = array();
    
        $result = mysql_query("select * from {$this->name} where {$col} = '{$id}';");
        while ($row = mysql_fetch_object($result)) 
        {
            $objects[$row->id] = $row;
        }
        mysql_free_result($result);
    
        return $objects;
    }
    
    // UPDATE mytable SET used=1 WHERE id < 10
    public function create($obj)
    {
        $mem = array();
        $val = array();
        
        foreach ($obj as $k => $v)
        {
            $mem[] = "{$k}";
            $val[] = "{$v}";
        }

        $mems = implode(",", $mem);
        $vals = "'" . implode("','", $val) . "'";

        $sql = "INSERT INTO {$this->name} ({$mems}) VALUES ({$vals});";

        mysql_query($sql) or die(mysql_error());        
    }

    function delete($id)
    {
        $objects = array();

        $result = mysql_query("delete from {$this->name} where id = '{$id}';");

        mysql_free_result($result);

        return $objects;
    }

    public function inject($sql = null)
    {
        $objects = array();

        $result = mysql_query("{$sql}");

        while ($row = mysql_fetch_object($result)) 
        {
            $objects[] = $row;
        }
        mysql_free_result($result);

        return $objects;
    }
    
}