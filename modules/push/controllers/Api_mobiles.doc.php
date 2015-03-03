<?php
return array(
	array(
		'url'=>'push/api_mobiles/',
		'method'=>'GET',
		'action'=>'This action retrive all PushMobiles resources, you can also filter according to sended params.',
		'params'=>array(
			array(
		    	"name"=>"id",
		    	"description"=>"id is integer input type",
		    	"defaultValue"=>null,
				"required"=>false,
			),
			array(
		    	"name"=>"uuid",
		    	"description"=>"uuid is string input type",
		    	"defaultValue"=>null,
				"required"=>false,
			),
			array(
		    	"name"=>"device_type",
		    	"description"=>"device_type is integer input type",
		    	"defaultValue"=>null,
				"required"=>false,
			),
		),
		"success_response"=>array(
		    "status"=> 200,
			"success"=>"true",
			"message"=>"Some summary message",
			"data"=>array(
			array(
		    	"id" => "integer",
		    	"uuid" => "string",
		    	"device_type" => "integer",
				),
				...
				...
			),
		)
		),
		"error_response"=>array(
		    "status"=> 404,
		    "success"=> false,
		    "error"=> "A key (e.g. resource_not_found) for the error",
		    "message"=> "A longer description of the error."
		),
	),
	// ....	
	array(
		'url'=>'push/api_mobiles/view/{id}',
		'method'=>'GET',
		'action'=>'This action retrive a PushMobiles selected.',
		'params'=>array(),
		"success_response"=>array(
			"status"=>200,
			"success"=>"true",
			"message"=>"Some summary message",
			"data"=>array(
		    "id" => "integer",
		    "uuid" => "string",
		    "device_type" => "integer",
			)
		),
		"error_response"=>array(
		    "status"=> 404,
		    "success"=> false,
		    "error"=> "A key (e.g. resource_not_found) for the error",
		    "message"=> "A longer description of the error."
		),
	),
	// ....
	array(
		'url'=>'push/api_mobiles/update/{id}',
		'method'=>'POST',
		'action'=>'Update a PushMobiles',
		'params'=>array(
			array(
		    	"name"=>"uuid",
		    	"description"=>"uuid is string input type",
		    	"defaultValue"=>null,
				"required"=>true,
			),
			array(
		    	"name"=>"device_type",
		    	"description"=>"device_type is integer input type",
		    	"defaultValue"=>null,
				"required"=>true,
			),
		),
		"success_response"=>array(
		    "status"=> 200,
			"success"=>"true",
		    "message"=>"Some summary message",
			"data"=>array(
		    "id" => "integer",
		    "uuid" => "string",
		    "device_type" => "integer",
			)
		),
		"error_response"=>array(
		    "status"=> 422,
		    "success"=> false,
		    "error"=> "unprocessable_entity",
		    "message"=> "Validations errors",
		    "data"=> array(
			"uuid"=>array(
				array(
					"Reason error eg. Nombre no puede ser nulo.",
					"Reason 2 error eg. numer value is required.",
				)
			),
			"device_type"=>array(
				array(
					"Reason error eg. Nombre no puede ser nulo.",
					"Reason 2 error eg. numer value is required.",
				)
			),
		    ),
		),
	),
	// ....
	array(
		'url'=>'push/api_mobiles/create',
		'method'=>'POST',
		'action'=>'Create a new PushMobiles',
		'params'=>array(
			array(
		    	"name"=>"uuid",
		    	"description"=>"uuid is string input type",
		    	"defaultValue"=>null,
				"required"=>true,
			),
			array(
		    	"name"=>"device_type",
		    	"description"=>"device_type is integer input type",
		    	"defaultValue"=>null,
				"required"=>true,
			),
		),
		"success_response"=>array(
			"status"=>200,
			"success"=>"true",
			"message"=>"Some summary message",
			"data"=>array(
		    "id" => "integer",
		    "uuid" => "string",
		    "device_type" => "integer",
			)
		),
		"error_response"=>array(
			"status"=>422,
			"success"=>"false",
		    "error"=> "unprocessable_entity",
		    "message"=> "Validations errors",
		    "data"=> array(
			"uuid"=>array(
				array(
					"Reason error eg. Nombre no puede ser nulo.",
				)
			),
			"device_type"=>array(
				array(
					"Reason error eg. Nombre no puede ser nulo.",
				)
			),
		    ),
		),
	),
);