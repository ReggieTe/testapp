<?php 
namespace TestApp\Core; 
use \PDO;

class Database extends PDO
{
	
private $DB_TYPE= 'mysql';
private $DB_HOST=DB_HOST;
private $DB_NAME= DB_NAME;
private $DB_USER=  DB_USER;
private $DB_PASS=  DB_PASS;
private $currentTable;
	
	public function __construct($table="null")
	{
		$this->currentTable = $table;
		parent::__construct($this->DB_TYPE.':host='.  $this->DB_HOST.';dbname='.  $this->DB_NAME, $this->DB_USER, $this->DB_PASS);
		
		//parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTIONS);
	}
	
        /**
         * select
         * @param  $sql an SQL string
         * @param  array $array Parameter to bind
         * @return array mixed
         */
        public function select($sql,$array=array(),$fetchMode=PDO::FETCH_ASSOC) 
        {
            $stmt=  $this->prepare($sql);
            foreach ($array as $key => $value) {
                $stmt->bindValue("$key", $value);
            }
            $stmt->execute();
            return $stmt->fetchAll($fetchMode);
            
        }
        
	/**
	 * insert
	 * @param string $this->currentTable A name of table to insert into
	 * @param string $data An associative array
	 */
	public function insert($data=array())
	{
		ksort($data);		
		$fieldNames = implode('`, `', array_keys($data));
		$fieldValues = ':' . implode(', :', array_keys($data));
		$sth = $this->prepare("INSERT INTO $this->currentTable (`$fieldNames`) VALUES ($fieldValues)");
		
		foreach ($data as $key => $value) {
			$sth->bindValue(":$key", $value);
		}
		
		return $sth->execute();
	}
	
	/**
	 * update
	 * @param string $this->currentTable A name of table to insert into
	 * @param string $data An associative array
	 * @param string $where the WHERE query part
	 */
	public function update($data, $where)
	{
		if(is_array($data))
		{
			ksort($data);
		
			$fieldDetails = NULL;
			foreach($data as $key=> $value) {
				$fieldDetails .= "`$key`=:$key,";
			}
			$fieldDetails = rtrim($fieldDetails, ',');
			
			$sth = $this->prepare("UPDATE $this->currentTable SET $fieldDetails WHERE $where");
			
			foreach ($data as $key => $value) {				
				$sth->bindValue(":$key", $value["value"]);
			}
			
			return $sth->execute();
		}
		return false;
		
	}
        /**
         * delete
         * 
         * @param string $this->currentTable
         * @param string $where
         * @param integer $limit
         * @return integer
         */
        public function delete($where,$limit=1) 
         {
            return $this->exec("DELETE FROM $this->currentTable WHERE $where LIMIT $limit");
            
        }
	
}