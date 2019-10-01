<?php

Route::group(['middleware' => ['web']], function () {
	$prefix = 'admin';
	if(config()->has('miniweb.url_prefix'))
		$prefix = config()->get('miniweb.url_prefix');
	Route::group(['prefix' => $prefix, 'namespace' => 'Spiderworks\MiniWeb\Controllers', 'middleware' => 'auth'], function(){
		//js plugin
		Route::get('select2/categories', 'PluginController@select2_categories')->name('spiderworks.miniweb.select2.categories');
		Route::get('select2/types', 'PluginController@select2_types')->name('spiderworks.miniweb.select2.types');

		Route::get('unique/category-slug', 'PluginController@unique_category_slug')->name('spiderworks.miniweb.unique.category-slug');
		Route::get('unique/page-slug', 'PluginController@unique_page_slug')->name('spiderworks.miniweb.unique.page-slug');

		Route::post('summernote/image', 'PluginController@summernote_image_upload')->name('spiderworks.miniweb.summernote.image');

		//types
		Route::get('types', 'TypeController@index')->name('spiderworks.miniweb.types');
		Route::get('types/edit/{id}', 'TypeController@edit')->name('spiderworks.miniweb.types.edit');
		Route::get('types/destroy/{id}', 'TypeController@destroy')->name('spiderworks.miniweb.types.destroy');
		Route::get('types/create', 'TypeController@create')->name('spiderworks.miniweb.types.create');
		Route::post('types/update', 'TypeController@update')->name('spiderworks.miniweb.types.update');
		Route::post('types/store', 'TypeController@store')->name('spiderworks.miniweb.types.store');
		Route::get('types/change-status/{id}', 'TypeController@changeStatus')->name('spiderworks.miniweb.types.change-status');

		//media
		Route::get('/media', 'MediaController@index')->name('spiderworks.miniweb.media.index');
		Route::post('/media', 'MediaController@index')->name('spiderworks.miniweb.media.index.post');
	    Route::get('/media/popup/{popup_type?}/{type?}/{holder_attr?}/{related_id?}', 'MediaController@popup')->name('spiderworks.miniweb.media.popup');
	    Route::post('/media/save', 'MediaController@save')->name('spiderworks.miniweb.media.save');
	    Route::get('/media/edit/{id}', 'MediaController@edit')->name('spiderworks.miniweb.media.edit');
	    Route::post('/media/store-extra/{id}', 'MediaController@storeExtra')->name('spiderworks.miniweb.media.store-extra');

	    //category
	    Route::get('categories', 'CategoryController@index')->name('spiderworks.miniweb.category.index');
        Route::get('categories/create', 'CategoryController@create')->name('spiderworks.miniweb.category.create');
        Route::get('categories/edit/{id}', 'CategoryController@edit')->name('spiderworks.miniweb.category.edit');
        Route::get('categories/destroy/{id}', 'CategoryController@destroy')->name('spiderworks.miniweb.category.destroy');
        Route::get('categories/change-status/{id}', 'CategoryController@changeStatus')->name('spiderworks.miniweb.category.change-status');
        Route::post('categories/store', 'CategoryController@store')->name('spiderworks.miniweb.category.store');
        Route::post('categories/update', 'CategoryController@update')->name('spiderworks.miniweb.category.update');

        //page
	    Route::get('pages', 'PageController@index')->name('spiderworks.miniweb.pages.index');
        Route::get('pages/create', 'PageController@create')->name('spiderworks.miniweb.pages.create');
        Route::get('pages/edit/{id}', 'PageController@edit')->name('spiderworks.miniweb.pages.edit');
        Route::get('pages/destroy/{id}', 'PageController@destroy')->name('spiderworks.miniweb.pages.destroy');
        Route::get('pages/change-status/{id}', 'PageController@changeStatus')->name('spiderworks.miniweb.pages.change-status');
        Route::post('pages/store', 'PageController@store')->name('spiderworks.miniweb.pages.store');
        Route::post('pages/update', 'PageController@update')->name('spiderworks.miniweb.pages.update');

        //menus
        Route::get('/menus/edit/{id}', 'MenuController@edit')->name('spiderworks.miniweb.menus.edit');
		Route::get('/menus/destroy/{id}', 'MenuController@destroy')->name('spiderworks.miniweb.menus.destroy');
		Route::get('/menus/create', 'MenuController@create')->name('spiderworks.miniweb.menus.create');
		Route::post('/menus/update', 'MenuController@update')->name('spiderworks.miniweb.menus.update');
		Route::post('/menus/store', 'MenuController@store')->name('spiderworks.miniweb.menus.store');
		Route::get('/menus/change-status/{id}', 'MenuController@changeStatus')->name('spiderworks.miniweb.menus.change-status');
		Route::get('/menus', 'MenuController@index')->name('spiderworks.miniweb.menus.index');

		//frontend page
	    Route::get('frontend-pages', 'FrontendPageController@index')->name('spiderworks.miniweb.frontend-pages.index');
	    Route::get('frontend-pages/destroy/{id}', function(){
	    	echo "Not possible";
	    })->name('spiderworks.miniweb.frontend-pages.destroy');
        Route::get('frontend-pages/edit/{id}', 'FrontendPageController@edit')->name('spiderworks.miniweb.frontend-pages.edit');
        Route::post('frontend-pages/update', 'FrontendPageController@update')->name('spiderworks.miniweb.frontend-pages.update');
	});
});