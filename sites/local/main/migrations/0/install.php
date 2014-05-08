<?php

/*
 * Copyright © 2011 - 2014 Modernized Media, LLC.
 * All Rights Reserved. No part of this code may be reproduced without Modernized Media's express consent.
 * http://www.modernizedmedia.com
 */
defined('BASEPATH') OR exit('No direct script access allowed');

include_once FCPATH.'/sites/local/main/libraries/includes.php';

class Migration_Main_Install extends MY_Migration
{
    public function up()
    {
		// add the calendar table... Not approved for core yet.
		$queries = "
			DROP TABLE IF EXISTS ints;
			DROP TABLE IF EXISTS calendar;
			
			CREATE TABLE calendar (
				date DATE NOT NULL PRIMARY KEY,
				y SMALLINT NULL,
				q tinyint NULL,
				m tinyint NULL,
				d tinyint NULL,
				dw tinyint NULL,
				month_name VARCHAR(9) NULL,
				day_name VARCHAR(9) NULL,
				w tinyint NULL,
				is_weekday TINYINT(1) NULL,
				is_holiday TINYINT(1) NULL,
				holiday_description VARCHAR(32) NULL
			);
			
			CREATE TABLE ints ( i tinyint );

			INSERT INTO ints VALUES (0),(1),(2),(3),(4),(5),(6),(7),(8),(9);

			INSERT INTO calendar (date)
			SELECT DATE('2010-01-01') + INTERVAL a.i*10000 + b.i*1000 + c.i*100 + d.i*10 + e.i DAY
			FROM ints a JOIN ints b JOIN ints c JOIN ints d JOIN ints e
			WHERE (a.i*10000 + b.i*1000 + c.i*100 + d.i*10 + e.i) <= 11322
			ORDER BY 1;
			
			UPDATE calendar
				SET is_weekday = CASE WHEN dayofweek(date) IN (1,7) THEN 0 ELSE 1 END,
					is_holiday = 0,
					y = YEAR(date),
					q = quarter(date),
					m = MONTH(date),
					d = dayofmonth(date),
					dw = dayofweek(date),
					month_name = monthname(date),
					day_name = dayname(date),
					w = week(date),
					holiday_description = '';
					
			UPDATE calendar SET is_holiday = 1, holiday_description = 'New Year''s Day' WHERE m = 1 AND d = 1;
 
			UPDATE calendar c1
				LEFT JOIN calendar c2 ON c2.date = c1.date + INTERVAL 1 DAY
				SET c1.is_holiday = 1, c1.holiday_description = 'Holiday for New Year''s Day'
				WHERE c1.dw = 6 AND c2.m = 1 AND c2.dw = 7 AND c2.is_holiday = 1;

				UPDATE calendar c1
				LEFT JOIN calendar c2 ON c2.date = c1.date - INTERVAL 1 DAY
				SET c1.is_holiday = 1, c1.holiday_description = 'Holiday for New Year''s Day'
				WHERE c1.dw = 2 AND c2.m = 1 AND c2.dw = 1 AND c2.is_holiday = 1;
				
			UPDATE calendar
				SET is_holiday = 1, holiday_description = 'Martin Luther King Day'
				WHERE m = 1 AND dw = 2 AND d BETWEEN 15 AND 21;
				
			UPDATE calendar
				SET is_holiday = 1, holiday_description = 'President''s Day'
				WHERE m = 2 AND dw = 2 AND d BETWEEN 15 AND 21;
				
			UPDATE calendar
				SET is_holiday = 1, holiday_description = 'Memorial Day'
				WHERE m = 5 AND dw = 2 AND d BETWEEN 25 AND 31;
				
			UPDATE calendar
				SET is_holiday = 1, holiday_description = 'Independence Day'
				WHERE m = 7 AND d = 4;

			UPDATE calendar c1
				LEFT JOIN calendar c2 ON c2.date = c1.date + INTERVAL 1 DAY
				SET c1.is_holiday = 1, c1.holiday_description = 'Holiday for Independence Day'
				WHERE c1.dw = 6 AND c2.m = 7 AND c2.d = 4 AND c2.dw = 7 AND c2.is_holiday = 1;

			UPDATE calendar c1
				LEFT JOIN calendar c2 ON c2.date = c1.date - INTERVAL 1 DAY
				SET c1.is_holiday = 1, c1.holiday_description = 'Holiday for Independence Day'
				WHERE c1.dw = 2 AND c2.m = 7 AND c2.d = 4 AND c2.dw = 1 AND c2.is_holiday = 1;
				
			UPDATE calendar
				SET is_holiday = 1, holiday_description = 'Labor Day'
				WHERE m = 9 AND dw = 2 AND d BETWEEN 1 AND 7;
				
			UPDATE calendar
				SET is_holiday = 1, holiday_description = 'Veteran''s Day'
				WHERE m = 11 AND d = 11;

			UPDATE calendar c1
				LEFT JOIN calendar c2 ON c2.date = c1.date + INTERVAL 1 DAY
				SET c1.is_holiday = 1, c1.holiday_description = 'Holiday for Veteran''s Day'
				WHERE c1.dw = 6 AND c2.m = 11 AND c2.d = 11 AND c2.dw = 7 AND c2.is_holiday = 1;

			UPDATE calendar c1
				LEFT JOIN calendar c2 ON c2.date = c1.date - INTERVAL 1 DAY
				SET c1.is_holiday = 1, c1.holiday_description = 'Holiday for Veteran''s Day'
				WHERE c1.dw = 2 AND c2.m = 11 AND c2.d = 11 AND c2.dw = 1 AND c2.is_holiday = 1;
				
			UPDATE calendar
				SET is_holiday = 1, holiday_description = 'Thanksgiving Day'
				WHERE m = 11 AND dw = 5 AND d BETWEEN 22 AND 28;
				
			UPDATE calendar
				SET is_holiday = 1, holiday_description = 'Friday After Thanksgiving'
				WHERE m = 11 AND dw = 6 AND d BETWEEN 21 AND 29;
				
			UPDATE calendar
				SET is_holiday = 1, holiday_description = 'Christmas Day'
				WHERE m = 12 AND d = 25;

			UPDATE calendar c1
				LEFT JOIN calendar c2 ON c2.date = c1.date + INTERVAL 1 DAY
				SET c1.is_holiday = 1, c1.holiday_description = 'Holiday for Christmas Day'
				WHERE c1.dw = 6 AND c2.m = 12 AND c2.d = 25 AND c2.dw = 7 AND c2.is_holiday = 1;

			UPDATE calendar c1
				LEFT JOIN calendar c2 ON c2.date = c1.date - INTERVAL 1 DAY
				SET c1.is_holiday = 1, c1.holiday_description = 'Holiday for Christmas Day'
				WHERE c1.dw = 2 AND c2.m = 12 AND c2.d = 25 AND c2.dw = 1 AND c2.is_holiday = 1
		";
		
		$queries = explode(';', $queries);
		foreach($queries as $query) {
			$this->db->query($query);
		}
		
		
//		 some useful column types
//		'id' => array('type' => 'CHAR', 'constraint' => 36, 'primary' => true),
//		'bool' => array('type' => 'TINYINT', 'constraint' => 1, 'default'=>1),
//		'created' => array('type' => 'DATETIME', 'default'=>'0000-00-00 00:00:00'),
//		'modified' => array('type' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'),
		
//        $tables = array(
//            
//        );
//        
//        $this->install_tables($tables);
    }
    
    public function down()
    {
        
    }
}