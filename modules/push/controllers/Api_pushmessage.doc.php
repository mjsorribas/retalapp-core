<?php
return array(
	array(
		'url'=>'push/api_pushmessage/',
		'method'=>'GET',
		'action'=>'This action retrive all PushMessage resources, you can also filter according to sended params.',
		'params'=>array(
			array(
		    	"name"=>"id",
		    	"description"=>"ID is integer(11) input type",
		    	"defaultValue"=>null,
				"required"=>false,
			),
			array(
		    	"name"=>"mobile_id_from",
		    	"description"=>"Mobile From is integer(11) input type",
		    	"defaultValue"=>null,
				"required"=>false,
			),
			array(
		    	"name"=>"mobile_id_to",
		    	"description"=>"Mobile To is integer(11) input type",
		    	"defaultValue"=>null,
				"required"=>false,
			),
			array(
		    	"name"=>"message",
		    	"description"=>"Message is mediumtext input type",
		    	"defaultValue"=>null,
				"required"=>false,
			),
			array(
		    	"name"=>"date_created",
		    	"description"=>"Date Created is time format (hh:mm:ss)stamp input type",
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
		    	"id" => "integer(11)",
		    	"mobile_id_from" => "integer(11)",
		    	"mobile_id_to" => "integer(11)",
		    	"message" => "mediumtext",
		    	"date_created" => "time format (hh:mm:ss)stamp",
				),
			),
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
		'url'=>'push/api_pushmessage/view/{id}',
		'method'=>'GET',
		'action'=>'This action retrive a PushMessage selected.',
		'params'=>array(),
		"success_response"=>array(
			"status"=>200,
			"success"=>"true",
			"message"=>"Some summary message",
			"data"=>array(
		    "id" => "integer(11)",
		    "mobile_id_from" => "integer(11)",
		    "mobile_id_to" => "integer(11)",
		    "message" => "mediumtext",
		    "date_created" => "time format (hh:mm:ss)stamp",
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
		'url'=>'push/api_pushmessage/update/{id}',
		'method'=>'POST',
		'action'=>'Update a PushMessage',
		'params'=>array(
			array(
		    	"name"=>"mobile_id_from",
		    	"description"=>"Mobile From is integer(11) input type",
		    	"defaultValue"=>null,
				"required"=>true,
			),
			array(
		    	"name"=>"mobile_id_to",
		    	"description"=>"Mobile To is integer(11) input type",
		    	"defaultValue"=>null,
				"required"=>true,
			),
			array(
		    	"name"=>"message",
		    	"description"=>"Message is mediumtext input type",
		    	"defaultValue"=>null,
				"required"=>true,
			),
			array(
		    	"name"=>"date_created",
		    	"description"=>"Date Created is time format (hh:mm:ss)stamp input type",
		    	"defaultValue"=>null,
				"required"=>true,
			),
		),
		"success_response"=>array(
		    "status"=> 200,
			"success"=>"true",
		    "message"=>"Some summary message",
			"data"=>array(
		    "id" => "integer(11)",
		    "mobile_id_from" => "integer(11)",
		    "mobile_id_to" => "integer(11)",
		    "message" => "mediumtext",
		    "date_created" => "time format (hh:mm:ss)stamp",
			)
		),
		"error_response"=>array(
		    "status"=> 422,
		    "success"=> false,
		    "error"=> "unprocessable_entity",
		    "message"=> "Validations errors",
		    "data"=> array(
			"mobile_id_from"=>array(
				array(
					"Reason error eg. Nombre no puede ser nulo.",
					"Reason 2 error eg. numer value is required.",
				)
			),
			"mobile_id_to"=>array(
				array(
					"Reason error eg. Nombre no puede ser nulo.",
					"Reason 2 error eg. numer value is required.",
				)
			),
			"message"=>array(
				array(
					"Reason error eg. Nombre no puede ser nulo.",
					"Reason 2 error eg. numer value is required.",
				)
			),
			"date_created"=>array(
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
		'url'=>'push/api_pushmessage/create',
		'method'=>'POST',
		'action'=>'Create a new PushMessage',
		'params'=>array(
			array(
		    	"name"=>"mobile_id_from",
		    	"description"=>"Mobile From is integer(11) input type",
		    	"defaultValue"=>null,
				"required"=>true,
			),
			array(
		    	"name"=>"mobile_id_to",
		    	"description"=>"Mobile To is integer(11) input type",
		    	"defaultValue"=>null,
				"required"=>true,
			),
			array(
		    	"name"=>"message",
		    	"description"=>"Message is mediumtext input type",
		    	"defaultValue"=>null,
				"required"=>true,
			),
			array(
		    	"name"=>"date_created",
		    	"description"=>"Date Created is time format (hh:mm:ss)stamp input type",
		    	"defaultValue"=>null,
				"required"=>true,
			),
		),
		"success_response"=>array(
			"status"=>200,
			"success"=>"true",
			"message"=>"Some summary message",
			"data"=>array(
		    "id" => "integer(11)",
		    "mobile_id_from" => "integer(11)",
		    "mobile_id_to" => "integer(11)",
		    "message" => "mediumtext",
		    "date_created" => "time format (hh:mm:ss)stamp",
			)
		),
		"error_response"=>array(
			"status"=>422,
			"success"=>"false",
		    "error"=> "unprocessable_entity",
		    "message"=> "Validations errors",
		    "data"=> array(
			"mobile_id_from"=>array(
				array(
					"Reason error eg. Nombre no puede ser nulo.",
				)
			),
			"mobile_id_to"=>array(
				array(
					"Reason error eg. Nombre no puede ser nulo.",
				)
			),
			"message"=>array(
				array(
					"Reason error eg. Nombre no puede ser nulo.",
				)
			),
			"date_created"=>array(
				array(
					"Reason error eg. Nombre no puede ser nulo.",
				)
			),
		    ),
		),
	),
);