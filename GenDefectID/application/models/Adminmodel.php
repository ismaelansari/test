<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Adminmodel extends CI_Model
{
	#Define varaiables.
	private $result = '';
	private $query = '';
	
	public function __construct() {
		parent::__construct();
	}
	
	
	
	#Select data from database.
	public function getDetails($table, $where='',$fields=array('*'),$query=false,$minLimit='all', $maxLimit='all') {
		
        if($query !=false)
        {
        	$statement = $this->db->prepare($query);
            $statement ->execute();
            $statement ->setFetchMode(PDO::FETCH_ASSOC);
            if($statement->rowCount())
			{				
              $this->result = $statement ->fetchAll();
              return $this->result;
            }
            return false;
		}else
		{
			$columns = '';
			$whereArr = array();
			$whereStr = '';
			$this->query = 'SELECT ';
			
			#Check fileds
			if(is_array($fields) && !empty($fields)) {
				foreach($fields as $col) {
					$columns .= $col.',';
				}
				$columns = substr($columns, 0, strlen($columns)-1);
				$this->query .= $columns;
			} else {
				die('Please provide valid fields for SELECT Query!');
			}
			
			#Set table name.
			if(isset($table) && !empty($table)) {
				$this->query .= ' FROM '. $table;
			} else {
				die('Please provide table name!');
			}
			
			#Set where clause
			if(is_array($where) && !empty($where) && $where != '') {
				$this->query .= ' WHERE ';
				foreach($where as $key => $val) {
					$whereStr .= $key .' = :'. $key. ' AND ';
					$whereArr[':'. $key] = $val;
				}
				$whereStr = substr($whereStr, 0, strlen($whereStr)-5);
				$this->query .= $whereStr;
			}
			if($maxLimit == 'all' || $maxLimit == 'All') {}
			else {
				$whereArr[':start'] = $minLimit;
				$whereArr[':end'] = $maxLimit;
				
				#Set limit.
				$this->query .= ' LIMIT :start, :end';
			}
			
			#Execute query.
			$this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			$stmt = $this->db->prepare($this->query);
			$stmt->execute($whereArr);
			
			if($stmt->rowCount())
			{
			  return $this->result = $stmt->fetchAll(PDO::FETCH_ASSOC);	
			}
			return false;
			//return $this->result;         
          
		} 

				  
	}
	
	
	#Inser data into database.
	public function insert($table, $data=array(),$query=false ) {
		 
		if($query==false)
		{

			$column = '';
			$value = '';
			$values = '';
			$this->query = 'INSERT INTO '. $table;
			
			#check data
			if(is_array($data) && !empty($data)) {
				$i = 1;
				foreach($data as $key => $val) {
					$column .= $key.',';
					$value .= ':val'.$i.',';
					$values['val'.$i] = $val;
					$i++;
				}
				$column = substr($column, 0, strlen($column)-1);
				$value = substr($value, 0, strlen($value)-1);
				$this->query .= ' ('.$column.') VALUES('.$value.')';
			} else {
				die('Please provide valid data array for insert!');
			}
			 #Execute query.
			$this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			$stmt = $this->db->prepare($this->query);
			$stmt->execute($values);
			$this->result = $this->db->lastInsertId();
			return $this->result;

		} 
		
		
	}
	
	#Update data from database.
	public function update($table, $data=array(), $where=array()) {
		$column = '';
		$columnVal = array();
		$wheres = '';
		$whereArr = array();
		$this->query = 'UPDATE '. $table .' SET ';
		
		#check data.
		if(is_array($data) && !empty($data)) {
			foreach($data as $key => $val) {
				$column .= $key. ' = :'.$key.', ';
				$columnVal[':'.$key] = $val;
			}
			$column = substr($column, 0, strlen($column)-2);
			$this->query .= $column;
		} else {
			die('Please provide valid data array for update!');
		}
		
		#Check where.
		if(is_array($where) && !empty($where)) {
			foreach($where as $key => $val) {
				$wheres .= $key .' = :'. $key .', ';
				$whereArr[':'.$key] = $val;
			}
			$wheres = substr($wheres, 0, strlen($wheres)-2);
			$this->query .= ' WHERE '. $wheres;
		} else {
			die('Please provide valid where array for update!');
		}
		$dataArr = array_merge($columnVal, $whereArr);
		
		#Execute query.
		$this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$stmt = $this->db->prepare($this->query);
		$this->result = $stmt->execute($dataArr);
		return $this->result;
	}
	
	#Select plan query.
	public function selectQuery($query) {
		
        $statement = $this->db->prepare($query);
        $statement ->execute();
        $statement ->setFetchMode(PDO::FETCH_ASSOC, 'Post');
        $this->result = $statement ->fetchAll();
        return $this->result;
	}

	
	
	
}//End of class.

/* End of application_model.php file */
/* location: application/models/application_model.php */
/* Omit PHP closing tags to help vaoid accidental output */