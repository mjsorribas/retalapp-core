<?php
return array(
	array(
		'url'=>'shopping/api_items/',
		'method'=>'GET',
		'action'=>'This action retrive all ShoppingItems resources, you can also filter according to sended params.',
		'params'=>array(
			array(
		    	"name"=>"id",
		    	"description"=>"ID is integer(11) input type",
		    	"defaultValue"=>null,
				"required"=>false,
			),
			array(
		    	"name"=>"image",
		    	"description"=>"Imagen is string(100) input type",
		    	"defaultValue"=>null,
				"required"=>false,
			),
			array(
		    	"name"=>"video_promocional",
		    	"description"=>"Promocional is string(100) input type",
		    	"defaultValue"=>null,
				"required"=>false,
			),
			array(
		    	"name"=>"name",
		    	"description"=>"Nombre is string(60) input type",
		    	"defaultValue"=>null,
				"required"=>false,
			),
			array(
		    	"name"=>"slug",
		    	"description"=>"Slug is string(255) input type",
		    	"defaultValue"=>null,
				"required"=>false,
			),
			array(
		    	"name"=>"description",
		    	"description"=>"Descripción corta is text input type",
		    	"defaultValue"=>null,
				"required"=>false,
			),
			array(
		    	"name"=>"description_detail",
		    	"description"=>"Descripción is text input type",
		    	"defaultValue"=>null,
				"required"=>false,
			),
			array(
		    	"name"=>"price",
		    	"description"=>"Precio is float(9,2) input type",
		    	"defaultValue"=>null,
				"required"=>false,
			),
			array(
		    	"name"=>"free",
		    	"description"=>"Es gratis is boolean(1) input type",
		    	"defaultValue"=>0,
				"required"=>false,
			),
			array(
		    	"name"=>"state",
		    	"description"=>"Estado is boolean(1) input type",
		    	"defaultValue"=>null,
				"required"=>false,
			),
			array(
		    	"name"=>"shopping_categories_id",
		    	"description"=>"Categoría is integer(11) input type",
		    	"defaultValue"=>null,
				"required"=>false,
			),
			array(
		    	"name"=>"temas_relacionados",
		    	"description"=>"Temas Relacionados is text input type",
		    	"defaultValue"=>null,
				"required"=>false,
			),
			array(
		    	"name"=>"shopping_facilitador_id",
		    	"description"=>"Facilitador is integer(11) input type",
		    	"defaultValue"=>null,
				"required"=>false,
			),
			array(
		    	"name"=>"orden_id",
		    	"description"=>"Orden is integer(11) input type",
		    	"defaultValue"=>null,
				"required"=>false,
			),
			array(
		    	"name"=>"created_at",
		    	"description"=>"Created At is datetime format (yyyy-MM-dd hh:mm:ss) input type",
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
		    	"image" => "string(100)",
		    	"video_promocional" => "string(100)",
		    	"name" => "string(60)",
		    	"slug" => "string(255)",
		    	"description" => "text",
		    	"description_detail" => "text",
		    	"price" => "float(9,2)",
		    	"free" => "boolean(1)",
		    	"state" => "boolean(1)",
		    	"shopping_categories_id" => "integer(11)",
		    	"temas_relacionados" => "text",
		    	"shopping_facilitador_id" => "integer(11)",
		    	"orden_id" => "integer(11)",
		    	"created_at" => "datetime format (yyyy-MM-dd hh:mm:ss)",
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
		'url'=>'shopping/api_items/view/{id}',
		'method'=>'GET',
		'action'=>'This action retrive a ShoppingItems selected.',
		'params'=>array(),
		"success_response"=>array(
			"status"=>200,
			"success"=>"true",
			"message"=>"Some summary message",
			"data"=>array(
		    "id" => "integer(11)",
		    "image" => "string(100)",
		    "video_promocional" => "string(100)",
		    "name" => "string(60)",
		    "slug" => "string(255)",
		    "description" => "text",
		    "description_detail" => "text",
		    "price" => "float(9,2)",
		    "free" => "boolean(1)",
		    "state" => "boolean(1)",
		    "shopping_categories_id" => "integer(11)",
		    "temas_relacionados" => "text",
		    "shopping_facilitador_id" => "integer(11)",
		    "orden_id" => "integer(11)",
		    "created_at" => "datetime format (yyyy-MM-dd hh:mm:ss)",
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
		'url'=>'shopping/api_items/update/{id}',
		'method'=>'POST',
		'action'=>'Update a ShoppingItems',
		'params'=>array(
			array(
		    	"name"=>"image",
		    	"description"=>"Imagen is string(100) input type",
		    	"defaultValue"=>null,
				"required"=>true,
			),
			array(
		    	"name"=>"video_promocional",
		    	"description"=>"Promocional is string(100) input type",
		    	"defaultValue"=>null,
				"required"=>true,
			),
			array(
		    	"name"=>"name",
		    	"description"=>"Nombre is string(60) input type",
		    	"defaultValue"=>null,
				"required"=>true,
			),
			array(
		    	"name"=>"slug",
		    	"description"=>"Slug is string(255) input type",
		    	"defaultValue"=>null,
				"required"=>true,
			),
			array(
		    	"name"=>"description",
		    	"description"=>"Descripción corta is text input type",
		    	"defaultValue"=>null,
				"required"=>true,
			),
			array(
		    	"name"=>"description_detail",
		    	"description"=>"Descripción is text input type",
		    	"defaultValue"=>null,
				"required"=>true,
			),
			array(
		    	"name"=>"price",
		    	"description"=>"Precio is float(9,2) input type",
		    	"defaultValue"=>null,
				"required"=>true,
			),
			array(
		    	"name"=>"free",
		    	"description"=>"Es gratis is boolean(1) input type",
		    	"defaultValue"=>0,
				"required"=>false,
			),
			array(
		    	"name"=>"state",
		    	"description"=>"Estado is boolean(1) input type",
		    	"defaultValue"=>null,
				"required"=>false,
			),
			array(
		    	"name"=>"shopping_categories_id",
		    	"description"=>"Categoría is integer(11) input type",
		    	"defaultValue"=>null,
				"required"=>true,
			),
			array(
		    	"name"=>"temas_relacionados",
		    	"description"=>"Temas Relacionados is text input type",
		    	"defaultValue"=>null,
				"required"=>false,
			),
			array(
		    	"name"=>"shopping_facilitador_id",
		    	"description"=>"Facilitador is integer(11) input type",
		    	"defaultValue"=>null,
				"required"=>true,
			),
			array(
		    	"name"=>"orden_id",
		    	"description"=>"Orden is integer(11) input type",
		    	"defaultValue"=>null,
				"required"=>true,
			),
			array(
		    	"name"=>"created_at",
		    	"description"=>"Created At is datetime format (yyyy-MM-dd hh:mm:ss) input type",
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
		    "image" => "string(100)",
		    "video_promocional" => "string(100)",
		    "name" => "string(60)",
		    "slug" => "string(255)",
		    "description" => "text",
		    "description_detail" => "text",
		    "price" => "float(9,2)",
		    "free" => "boolean(1)",
		    "state" => "boolean(1)",
		    "shopping_categories_id" => "integer(11)",
		    "temas_relacionados" => "text",
		    "shopping_facilitador_id" => "integer(11)",
		    "orden_id" => "integer(11)",
		    "created_at" => "datetime format (yyyy-MM-dd hh:mm:ss)",
			)
		),
		"error_response"=>array(
		    "status"=> 422,
		    "success"=> false,
		    "error"=> "unprocessable_entity",
		    "message"=> "Validations errors",
		    "data"=> array(
			"image"=>array(
				array(
					"Reason error eg. Nombre no puede ser nulo.",
					"Reason 2 error eg. numer value is required.",
				)
			),
			"video_promocional"=>array(
				array(
					"Reason error eg. Nombre no puede ser nulo.",
					"Reason 2 error eg. numer value is required.",
				)
			),
			"name"=>array(
				array(
					"Reason error eg. Nombre no puede ser nulo.",
					"Reason 2 error eg. numer value is required.",
				)
			),
			"slug"=>array(
				array(
					"Reason error eg. Nombre no puede ser nulo.",
					"Reason 2 error eg. numer value is required.",
				)
			),
			"description"=>array(
				array(
					"Reason error eg. Nombre no puede ser nulo.",
					"Reason 2 error eg. numer value is required.",
				)
			),
			"description_detail"=>array(
				array(
					"Reason error eg. Nombre no puede ser nulo.",
					"Reason 2 error eg. numer value is required.",
				)
			),
			"price"=>array(
				array(
					"Reason error eg. Nombre no puede ser nulo.",
					"Reason 2 error eg. numer value is required.",
				)
			),
			"free"=>array(
				array(
					"Reason error eg. Nombre no puede ser nulo.",
					"Reason 2 error eg. numer value is required.",
				)
			),
			"state"=>array(
				array(
					"Reason error eg. Nombre no puede ser nulo.",
					"Reason 2 error eg. numer value is required.",
				)
			),
			"shopping_categories_id"=>array(
				array(
					"Reason error eg. Nombre no puede ser nulo.",
					"Reason 2 error eg. numer value is required.",
				)
			),
			"temas_relacionados"=>array(
				array(
					"Reason error eg. Nombre no puede ser nulo.",
					"Reason 2 error eg. numer value is required.",
				)
			),
			"shopping_facilitador_id"=>array(
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
			"created_at"=>array(
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
		'url'=>'shopping/api_items/create',
		'method'=>'POST',
		'action'=>'Create a new ShoppingItems',
		'params'=>array(
			array(
		    	"name"=>"image",
		    	"description"=>"Imagen is string(100) input type",
		    	"defaultValue"=>null,
				"required"=>true,
			),
			array(
		    	"name"=>"video_promocional",
		    	"description"=>"Promocional is string(100) input type",
		    	"defaultValue"=>null,
				"required"=>true,
			),
			array(
		    	"name"=>"name",
		    	"description"=>"Nombre is string(60) input type",
		    	"defaultValue"=>null,
				"required"=>true,
			),
			array(
		    	"name"=>"slug",
		    	"description"=>"Slug is string(255) input type",
		    	"defaultValue"=>null,
				"required"=>true,
			),
			array(
		    	"name"=>"description",
		    	"description"=>"Descripción corta is text input type",
		    	"defaultValue"=>null,
				"required"=>true,
			),
			array(
		    	"name"=>"description_detail",
		    	"description"=>"Descripción is text input type",
		    	"defaultValue"=>null,
				"required"=>true,
			),
			array(
		    	"name"=>"price",
		    	"description"=>"Precio is float(9,2) input type",
		    	"defaultValue"=>null,
				"required"=>true,
			),
			array(
		    	"name"=>"free",
		    	"description"=>"Es gratis is boolean(1) input type",
		    	"defaultValue"=>0,
				"required"=>false,
			),
			array(
		    	"name"=>"state",
		    	"description"=>"Estado is boolean(1) input type",
		    	"defaultValue"=>null,
				"required"=>false,
			),
			array(
		    	"name"=>"shopping_categories_id",
		    	"description"=>"Categoría is integer(11) input type",
		    	"defaultValue"=>null,
				"required"=>true,
			),
			array(
		    	"name"=>"temas_relacionados",
		    	"description"=>"Temas Relacionados is text input type",
		    	"defaultValue"=>null,
				"required"=>false,
			),
			array(
		    	"name"=>"shopping_facilitador_id",
		    	"description"=>"Facilitador is integer(11) input type",
		    	"defaultValue"=>null,
				"required"=>true,
			),
			array(
		    	"name"=>"orden_id",
		    	"description"=>"Orden is integer(11) input type",
		    	"defaultValue"=>null,
				"required"=>true,
			),
			array(
		    	"name"=>"created_at",
		    	"description"=>"Created At is datetime format (yyyy-MM-dd hh:mm:ss) input type",
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
		    "image" => "string(100)",
		    "video_promocional" => "string(100)",
		    "name" => "string(60)",
		    "slug" => "string(255)",
		    "description" => "text",
		    "description_detail" => "text",
		    "price" => "float(9,2)",
		    "free" => "boolean(1)",
		    "state" => "boolean(1)",
		    "shopping_categories_id" => "integer(11)",
		    "temas_relacionados" => "text",
		    "shopping_facilitador_id" => "integer(11)",
		    "orden_id" => "integer(11)",
		    "created_at" => "datetime format (yyyy-MM-dd hh:mm:ss)",
			)
		),
		"error_response"=>array(
			"status"=>422,
			"success"=>"false",
		    "error"=> "unprocessable_entity",
		    "message"=> "Validations errors",
		    "data"=> array(
			"image"=>array(
				array(
					"Reason error eg. Nombre no puede ser nulo.",
				)
			),
			"video_promocional"=>array(
				array(
					"Reason error eg. Nombre no puede ser nulo.",
				)
			),
			"name"=>array(
				array(
					"Reason error eg. Nombre no puede ser nulo.",
				)
			),
			"slug"=>array(
				array(
					"Reason error eg. Nombre no puede ser nulo.",
				)
			),
			"description"=>array(
				array(
					"Reason error eg. Nombre no puede ser nulo.",
				)
			),
			"description_detail"=>array(
				array(
					"Reason error eg. Nombre no puede ser nulo.",
				)
			),
			"price"=>array(
				array(
					"Reason error eg. Nombre no puede ser nulo.",
				)
			),
			"free"=>array(
				array(
					"Reason error eg. Nombre no puede ser nulo.",
				)
			),
			"state"=>array(
				array(
					"Reason error eg. Nombre no puede ser nulo.",
				)
			),
			"shopping_categories_id"=>array(
				array(
					"Reason error eg. Nombre no puede ser nulo.",
				)
			),
			"temas_relacionados"=>array(
				array(
					"Reason error eg. Nombre no puede ser nulo.",
				)
			),
			"shopping_facilitador_id"=>array(
				array(
					"Reason error eg. Nombre no puede ser nulo.",
				)
			),
			"orden_id"=>array(
				array(
					"Reason error eg. Nombre no puede ser nulo.",
				)
			),
			"created_at"=>array(
				array(
					"Reason error eg. Nombre no puede ser nulo.",
				)
			),
		    ),
		),
	),
);