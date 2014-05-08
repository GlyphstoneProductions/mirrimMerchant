<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * Copyright © 2011 - 2014 Modernized Media, LLC.
 * All Rights Reserved. No part of this code may be reproduced without Modernized Media's express consent.
 * http://www.modernizedmedia.com
 */

/**
 * Used by smart-user-picker.js
 *
 * @author Lea
 */
class User_search_model extends MY_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function smart_user_search($q, $limit=false, $page=false) {
     
        $search = $this->db->escape('*'.$q.'*');
        
        $sizer = "
			SELECT COUNT(*) AS count 
            FROM users AS u 
			WHERE (MATCH(u.first_name, u.last_name, u.email) AGAINST ($search IN BOOLEAN MODE))
		";
            
            
        $query = "
			SELECT u.id, u.first_name, u.last_name, u.email,
            ( 
                (1.2 * MATCH(u.first_name) AGAINST ($search IN BOOLEAN MODE)) + 
                (1.0 * MATCH(u.last_name) AGAINST ($search IN BOOLEAN MODE)) + 
                (0.8 * MATCH(u.email) AGAINST ($search IN BOOLEAN MODE)) 
            ) as relevance 
            FROM users AS u 
            LEFT JOIN usermeta AS um ON um.user_id = u.id AND um.key = 'searchable' 
            WHERE (MATCH(u.first_name, u.last_name, u.email) AGAINST ($search IN BOOLEAN MODE)) 
            AND (um.value = 1 OR um.value IS NULL)
			HAVING relevance > 0
            ORDER BY relevance DESC
		";
        
        if($limit != false) {
            if($page == false) {
                $query .= "LIMIT ".(int)$limit;
            } else {
                $query .= "LIMIT ".(int)(($page-1)*$limit)." ".(int)$limit;
            }
        }
        
        $results = array();
        $test = $this->db->query($sizer)->row();
        $results['sizer'] = $this->db->last_query();
        $results['total'] = $test->count;
        
        
        $test = $this->db->query($query)->result();
        $results['query'] = $this->db->last_query();
        $results['users'] = $test;
        
        return $results;
    }
    
    
    
}

