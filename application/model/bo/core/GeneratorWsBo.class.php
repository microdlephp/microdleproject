<?php 
namespace model\bo\core;

//require $_ENV['FRAMEWORK_ROOT'] . '/model/dao/DaoGenerator' . $_ENV['FILE_EXTENSIONS']['class'];

/**
 * Core class to generate DAO classes. To remove in production.
 * 
 * @author Vincent SOYSOUVANH
 * 
 * @version 0.1
 * 
 * @package model.bo.core
 * 
 * @uses https://xxx/core/generator/generate-mysqli-dao?dataSourceName=adventyDs
 * @uses https://xxx/core/generator/generate-mysqli-dao?dataSourceName=adventyDs&tableName=myTable
 */
class GeneratorWsBo extends \com\microdle\model\bo\AbstractBo {
	/**
	 * Business check before ::generateDaoAction.
	 * 
	 * @throws \com\microdle\exception\DatabaseConnectionException
	 */
	/*public function generateDaoCheck() {
		//Retrieve parameters
		$parameters = &$this->_parameters;
		
		//Load data sources configuration: $_dataSources
		require $dataSourceFile = $_ENV['ROOTS']['configuration'] . '/' . $_SERVER['HTTP_HOST'] . $_ENV['FILE_EXTENSIONS']['dataSource'];
		
		//Check data source configuration
		if(!isset($_dataSources[$parameters['dataSourceName']])) {
			throw new \com\microdle\exception\DatabaseConnectionException('Data source not found in ' . $dataSourceFile . ': ' . $parameters['dataSourceName']);
		}
		
		//Create data source instance
		//$dsClassName = '\\org\\adventy\\model\\ds\\' . ucfirst($_dataSources[$className]['type']) . 'Ds';
		//$this->_dataSources[$className] = new $dsClassName($_dataSources[$className]);
		$this->_dataSources = &$_dataSources;
	}*/
	
	/**
	 * Web service to generate DAO files.
	 * Inputs:
	 *	- string dataSourceName Data source name. See /applcation/configuration/*.loc.datasource.cfg.php.
	 *	- string tableName (optional) Table name. If set, generate DAO only for this table, otherwise generate all DAO.
	 * 
	 * @return void
	 * 
	 * @uses https://xxx/core/generator/generate-dao?dataSourceName=adventyDs
	 * @uses https://xxx/core/generator/generate-dao?dataSourceName=adventyDs&tableName=myTable
	 */
	public function generateDaoAction() {
		//Check data source folder
		$dsFolder = $_ENV['ROOTS']['dao'] . '/' . $this->_parameters['dataSourceName'];
		if(!is_dir($dsFolder) && !mkdir($dsFolder)) {
			throw new \com\microdle\exception\FolderCreationException('Create data source folder impossible: ' . $dsFolder);
		}
		
		//Generate DAO
		$methodName = 'generate' . ucfirst($this->_dataSources[$this->_parameters['dataSourceName']]->type) . 'DaoAction';
		$this->$methodName();
	}
	
	/**
	 * Web service to generate DAO files.
	 * Inputs:
	 *	- string dataSourceName Data source name. See /applcation/configuration/*.loc.datasource.cfg.php.
	 *	- string tableName (optional) Table name. If set, generate DAO only for this table, otherwise generate all DAO.
	 *	- bool archive (optional) if true, archive the current dao file before genarating a new one. true by default.
	 * 
	 * @return void
	 * 
	 * @uses https://xxx/core/generator/generate-mysqli-dao?dataSourceName=adventyDs
	 * @uses https://xxx/core/generator/generate-mysqli-dao?dataSourceName=adventyDs&tableName=myTable
	 */
	public function generateMysqliDaoAction() {
		//Retrieve parameters
		$parameters = &$this->_parameters;
		$dataSourceName = &$parameters['dataSourceName'];
		
		//Generate DAO and retrieve $generatedTables
		$daoGenerator = $this->$dataSourceName->mysqliGeneratorDao;
		$generatedTables = $daoGenerator->generateSource($dataSourceName, empty($parameters['tableName']) ? null : $parameters['tableName'], isset($parameters['archive']) && $parameters['archive'] === true);
		$tables = $daoGenerator->getTables();

		//Set view data
		$this->_viewData = array(
			'code' => 0,
			'message' => 'OK',
			'tables' => $tables,
			'generatedTables' => $generatedTables
		);
	}
	
	/**
	 * Web service to generate reference source in "/application/refrence/" folder.
	 * Inputs:
     *  - string datasource Data source.
	 *	- string tableName Table name.
	 *	- string orderBy (optional) field name.
	 * 
	 * @return void
	 * 
     * @uses https://xxx/core/generator/generate-reference-dao?datasource=adventyDs
	 * @uses https://xxx/core/generator/generate-reference-dao?datasource=adventyDs&tableName=reference_civility
	 * @uses https://xxx/core/generator/generate-reference-dao?datasource=adventyDs&tableName=reference_civility&orderBy=label
	 */
	public function generateReferenceDaoAction() {
		//Retrieve parameters
		$parameters = &$this->_parameters;
        $dataSourceName = &$parameters['dataSourceName'];
		$tableName = empty($parameters['tableName']) ? null : $parameters['tableName'];
		$orderBy = empty($parameters['orderBy']) ? null : $parameters['orderBy'];
		
		//Generate reference source
		if ($tableName !== null) {
			//Determine primary key field name
            $daoGenerator = $this->$dataSourceName->referenceGeneratorDao;
			$keys = $daoGenerator->getKeys($tableName);
			if (empty($keys['PRI'])) {
				throw new \com\microdle\exception\SqlException('Primary key required on table: ' . $tableName);
			}
			
			//Retrieve all rows
			$rows = $daoGenerator->getAllByTable($tableName, null, $orderBy);
			$tableUri = \library\core\StringConversion::toCamelCase($tableName);
			$ids = [];
			$uniques = [];
			if (!empty($rows)) {
				//Build reference by primary key
				foreach ($rows as &$row) {
					$ids[$row[$keys['PRI'][0]]] = &$row;
				}
				
				//Build reference by unique key: only the first unique key
				if(!empty($keys['UNI'])) {
					foreach ($rows as &$row) {
						$uniques[$row[$keys['UNI'][0]]] = '&$_ENV[\'' . $tableUri . 'IdsReference\'][' . $row[$keys['PRI'][0]] . ']';
					}
				}
			}
			
			//Save data in reference file
			$fileName = $_ENV['ROOTS']['reference'] . '/' . \library\core\StringConversion::toUrl($tableName) . '.' . $_ENV['LANGUAGE_ISO_CODE'] . $_ENV['FILE_EXTENSIONS']['reference'];
			file_put_contents(
				$fileName,
				'<?php '
				. "\n" . \com\microdle\library\core\FileManager::toPHPVariable('_ENV[\'' . $tableUri . 'IdsReference\']', $ids)
				. "\n" . str_replace(array('=>\'&', '\',\'', '\\\'', '\'];'), array('=>&', ',\'', '\'', '];'), \com\microdle\library\core\FileManager::toPHPVariable('_ENV[\'' . $tableUri . ucfirst($keys['UNI'][0]) . 'sReference\']', $uniques))
				. "\n" . '?>'
			);
		}
		
		// Retrieve source generated
		$source = isset($fileName) ? file_get_contents($fileName) : null;
		
		//Set view data
		$this->_viewData = array(
			'response' => array(
				'code' => 0,
				'message' => $tableName === null || empty($source) ? 'KO' : 'OK',
				'tableName' => $tableName,
				'source' => $source
			)
		);
	}
}
?>