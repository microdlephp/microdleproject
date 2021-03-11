<?php 
namespace model\bo\core;

/**
 * Database actions.
 * 
 * @author Vincent SOYSOUVANH
 * 
 * @version 0.1
 * 
 * @package org.adventy.model.bo
 * 
 * @uses http://xxx/core/database/clean
 */
class DatabaseWsBo extends \com\microdle\model\bo\AbstractBo {
	/**
	 * Clean tables.
	 * 
	 * @return void
	 * 
	 * @uses https://xxx/core/database/clean-tables
	 */
	public function cleanTables(array $tableNames) {
		//Initialize success and error lists
		$okTables = [];
		$koTables = [];
		
		//Loop on tables
		$iaDs = &$this->iaDs;
		foreach($tableNames as &$tableName) {
			try {
				//Convert table name to DAO name
				$dao = \library\core\StringConversion::toCamelCase($tableName) . 'Dao';
				
				//Delete all data from table
				$iaDs->$dao->deleteAll();
				
				//Add table name into success list
				$okTables[] = $tableName;
			} catch(\Exception $e) {
				//Add table name into error list
				$koTables[] = $tableName;
			}
		}
		
		//Set view data
		$this->_viewData = [
			'response' => [
				'ok' => &$okTables,
				'error' => &$koTables
			]
		];
	}
}
?>