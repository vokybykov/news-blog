<?php
	$routes = [
		'' => 'ArticleController@index',
        'article/create' => 'ArticleController@create',
        'article/edit' => 'ArticleController@edit',
        'article/delete' => 'ArticleController@delete'
	];
	
	return $routes;
