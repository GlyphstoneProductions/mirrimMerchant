<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * Copyright © 2011 - 2014 Modernized Media, LLC.
 * All Rights Reserved. No part of this code may be reproduced without Modernized Media's express consent.
 * http://www.modernizedmedia.com
 */

/* Company management */
$permissions['entity']['company'] = 'Manage all company information';
$permissions['entity']['all-companies'] = 'Administer all companies in the system';
$permissions['action']['delete'] = 'Delete a company record.  This is permanent and deletes all offices and customers for the company!!';

/* pay scales */
$permissions['action']['view_payscale_calculator'] = 'Show pay scale calculator on dashboard card';
$permissions['entity']['payscales'] = 'All Pay scales';

/* Office management */
$permissions['entity']['offices'] = 'Office Information';

/* Events */
$permissions['action']['events'] = 'Access to the Event calendar';
$permissions['entity']['office-events'] = 'Office Events';
$permissions['entity']['company-events'] = 'Company Events';

/* Customers */
$permissions['entity']['customers'] = 'Access to the accounts panel';
$permissions['action']['sale_source'] = 'Ability to edit the sale source when entering an account';
$permissions['action']['cancel-account'] = 'Ability to cancel an account';
$permissions['action']['edit-active-account'] = 'Ability to edit an active account';
$permissions['action']['edit-pending-account'] = 'Ability to edit a pending account';
$permissions['action']['edit-cancelled-account'] = 'Ability to edit a cancelled account';

/* Incentives */
$permissions['entity']['incentives'] = 'Access to the incentives panel';

/* Sales Goals */
$permissions['action']['view_own_sales_goals'] = 'View past sales goals from dashboard card link';
$permissions['entity']['sales_goals'] = 'View and manage all user\'s sales goals';

/* news feed */
$permissions['entity']['news-feed'] = 'News Feed';

/* my stats */
$permissions['action']['my-stats'] = 'View "My Stats" page on admin panel';

/* Goals */
$permissions['entity']['goals'] = 'Goals card and functionality.  Admin can edit default goals for the whole company.';