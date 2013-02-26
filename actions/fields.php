<?php
// Contact fields for data validation
$fields = array(
	array(
		'name' => 'contact_firstname',
		'type' => 'string',
		'required' => true	
	),
	array(
		'name' => 'contact_lastname',
		'type' => 'string',
		'required' => true
	),
	array(
		'name' => 'contact_email',
		'type' => 'string',
		'required' => true
	),
	array(
		'name' => 'contact_phone',
		'type' => 'numeric',
		'length' => 10,
		'required' => true
	)
);