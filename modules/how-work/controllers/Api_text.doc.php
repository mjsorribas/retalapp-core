<?php
return array(
	array(
		'url'=>'how_work/api_text/',
		'method'=>'GET',
		'action'=>'This action retrive all HowWorkText resources, you can also filter according to sended params.',
		'params'=>array(
			array(
		    	"name"=>"id",
		    	"description"=>"ID is integer(11) input type",
		    	"defaultValue"=>null,
				"required"=>false,
			),
			array(
		    	"name"=>"title",
		    	"description"=>"Title is string(255) input type",
		    	"defaultValue"=>null,
				"required"=>false,
			),
			array(
		    	"name"=>"text",
		    	"description"=>"Text is text input type",
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
		    	"title" => "string(255)",
		    	"text" => "text",
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
		'url'=>'how_work/api_text/view/{id}',
		'method'=>'GET',
		'action'=>'This action retrive a HowWorkText selected.',
		'params'=>array(),
		"success_response"=>array(
			"status"=>200,
			"success"=>"true",
			"message"=>"Some summary message",
			"data"=>array(
		    "id" => "integer(11)",
		    "title" => "string(255)",
		    "text" => "text",
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
		'url'=>'how_work/api_text/update/{id}',
		'method'=>'POST',
		'action'=>'Update a HowWorkText',
		'params'=>array(
			array(
		    	"name"=>"title",
		    	"description"=>"Title is string(255) input type",
		    	"defaultValue"=>null,
				"required"=>true,
			),
			array(
		    	"name"=>"text",
		    	"description"=>"Text is text input type",
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
		    "title" => "string(255)",
		    "text" => "text",
			)
		),
		"error_response"=>array(
		    "status"=> 422,
		    "success"=> false,
		    "error"=> "unprocessable_entity",
		    "message"=> "Validations errors",
		    "data"=> array(
			"title"=>array(
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
		    ),
		),
	),
	// ....
	array(
		'url'=>'how_work/api_text/create',
		'method'=>'POST',
		'action'=>'Create a new HowWorkText',
		'params'=>array(
			array(
		    	"name"=>"title",
		    	"description"=>"Title is string(255) input type",
		    	"defaultValue"=>null,
				"required"=>true,
			),
			array(
		    	"name"=>"text",
		    	"description"=>"Text is text input type",
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
		    "title" => "string(255)",
		    "text" => "text",
			)
		),
		"error_response"=>array(
			"status"=>422,
			"success"=>"false",
		    "error"=> "unprocessable_entity",
		    "message"=> "Validations errors",
		    "data"=> array(
			"title"=>array(
				array(
					"Reason error eg. Nombre no puede ser nulo.",
				)
			),
			"text"=>array(
				array(
					"Reason error eg. Nombre no puede ser nulo.",
				)
			),
		    ),
		),
	),
);