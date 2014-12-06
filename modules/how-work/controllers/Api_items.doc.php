<?php
return array(
	array(
		'url'=>'how_work/api_items/',
		'method'=>'GET',
		'action'=>'This action retrive all HowWorkItems resources, you can also filter according to sended params.',
		'params'=>array(
			array(
		    	"name"=>"id",
		    	"description"=>"ID is integer(11) input type",
		    	"defaultValue"=>null,
				"required"=>false,
			),
			array(
		    	"name"=>"label",
		    	"description"=>"Label is string(255) input type",
		    	"defaultValue"=>null,
				"required"=>false,
			),
			array(
		    	"name"=>"text",
		    	"description"=>"Text is text input type",
		    	"defaultValue"=>null,
				"required"=>false,
			),
			array(
		    	"name"=>"orden_id",
		    	"description"=>"Orden is integer(11) input type",
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
		    	"label" => "string(255)",
		    	"text" => "text",
		    	"orden_id" => "integer(11)",
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
		'url'=>'how_work/api_items/view/{id}',
		'method'=>'GET',
		'action'=>'This action retrive a HowWorkItems selected.',
		'params'=>array(),
		"success_response"=>array(
			"status"=>200,
			"success"=>"true",
			"message"=>"Some summary message",
			"data"=>array(
		    "id" => "integer(11)",
		    "label" => "string(255)",
		    "text" => "text",
		    "orden_id" => "integer(11)",
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
		'url'=>'how_work/api_items/update/{id}',
		'method'=>'POST',
		'action'=>'Update a HowWorkItems',
		'params'=>array(
			array(
		    	"name"=>"label",
		    	"description"=>"Label is string(255) input type",
		    	"defaultValue"=>null,
				"required"=>true,
			),
			array(
		    	"name"=>"text",
		    	"description"=>"Text is text input type",
		    	"defaultValue"=>null,
				"required"=>true,
			),
			array(
		    	"name"=>"orden_id",
		    	"description"=>"Orden is integer(11) input type",
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
		    "label" => "string(255)",
		    "text" => "text",
		    "orden_id" => "integer(11)",
			)
		),
		"error_response"=>array(
		    "status"=> 422,
		    "success"=> false,
		    "error"=> "unprocessable_entity",
		    "message"=> "Validations errors",
		    "data"=> array(
			"label"=>array(
				array(
					"Reason error eg. Nombre no puede ser nulo.",
					"Reason 2 error eg. numer value is required.",
				)
			),
			"text"=>array(
				array(
					"Reason error eg. Nombre no puede ser nulo.",
					"Reason 2 error eg. numer value is required.",
				)
			),
			"orden_id"=>array(
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
		'url'=>'how_work/api_items/create',
		'method'=>'POST',
		'action'=>'Create a new HowWorkItems',
		'params'=>array(
			array(
		    	"name"=>"label",
		    	"description"=>"Label is string(255) input type",
		    	"defaultValue"=>null,
				"required"=>true,
			),
			array(
		    	"name"=>"text",
		    	"description"=>"Text is text input type",
		    	"defaultValue"=>null,
				"required"=>true,
			),
			array(
		    	"name"=>"orden_id",
		    	"description"=>"Orden is integer(11) input type",
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
		    "label" => "string(255)",
		    "text" => "text",
		    "orden_id" => "integer(11)",
			)
		),
		"error_response"=>array(
			"status"=>422,
			"success"=>"false",
		    "error"=> "unprocessable_entity",
		    "message"=> "Validations errors",
		    "data"=> array(
			"label"=>array(
				array(
					"Reason error eg. Nombre no puede ser nulo.",
				)
			),
			"text"=>array(
				array(
					"Reason error eg. Nombre no puede ser nulo.",
				)
			),
			"orden_id"=>array(
				array(
					"Reason error eg. Nombre no puede ser nulo.",
				)
			),
		    ),
		),
	),
);