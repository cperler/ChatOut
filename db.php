<?php
	class DB
	{
		private static function getInstance()
		{
			$DB = mysql_connect('127.0.0.1', 'root', '');
			mysql_select_db('chatout');
			return $DB;
		}

		static function exec($sql)
		{
			$DB = self::getInstance();

			$results = mysql_query($sql);
			
			if (strtolower(substr($sql, 0, 1)) != 's') {
				return $results;
			}
			
			$list = array();			
			
			if (mysql_affected_rows($DB) > 0)
			{
				mysql_data_seek($results, 0);
				while ($row = mysql_fetch_assoc($results))
				{					
					$list[] = $row;					
				}
				mysql_free_result($results);
			}
			mysql_close($DB);
			
			
			return $list;
		}
	}
?>