<?php 

class Database extends Config {
    
    public $db;
    
    function __construct(){
        
        //connect to the database
        $dns = 'mysql:host='.$this->host.';dbname='.$this->database;
        $this->db = new PDO($dns, $this->username, $this->password);
        //adds sql errors
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        //sets the sql fetch mode to only key names
        $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }    
    
    /**
     * Binds values to the sql string to prevent sql injection.
     * @param  [object] $query [PDO object]
     * @param  [array] $vars  
     * @return void
     */
    private function arrayBinder(&$query, $vars){
        foreach ($vars as $key => $value) {
            $query->bindValue(':'.$key, htmlspecialchars($value));
        }
    }
    
    /**
     * Do a sql query with args
     * @param  [string] $sql  [SQL string]
     * @param  [array] $vars [variables, key valye pair]
     * @return [object]       [sql result]
     */
    // $db->query('SELECT * FROM users WHERE id = :id', ['id' => 1])->fetchAll();
    public function query($sql, $vars = null){
        $query = $this->db->prepare($sql);
        
        if($vars != null) $this->arrayBinder($query, $vars);
        
        $query->execute();
        
        return $query;
    }
}