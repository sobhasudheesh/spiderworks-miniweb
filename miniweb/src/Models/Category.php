<?php

namespace Spiderworks\MiniWeb\Models;

use Spiderworks\MiniWeb\Models\BaseModel;
use Spiderworks\MiniWeb\Traits\ValidationTrait;

class Category extends BaseModel
{
    use ValidationTrait {
        ValidationTrait::validate as private parent_validate;
    }
    
    public function __construct() {
        
        parent::__construct();
        $this->__validationConstruct();
    }

    protected $table = 'categories';

    protected $fillable = [
        'slug', 'name', 'description', 'page_title', 'parent_id', 'types_id', 'banner_image_id', 'primary_image_id', 'browser_title', 'meta_description', 'meta_keywords', 'top_description', 'bottom_description', 'status'
    ];

    protected $dates = ['created_at','updated_at'];

    protected function setRules() {

        $this->val_rules = array(
            'name' => 'required|max:250',
            'slug' => 'required|max:250|unique:categories,slug,ignoreId',
        );
    }

    protected function setAttributes() {
        $this->val_attributes = array(
        );
    }

    public function validate($data = null, $ignoreId = 'NULL') {
        if( isset($this->val_rules['slug']) )
        {
            $this->val_rules['slug'] = str_replace('ignoreId', $ignoreId, $this->val_rules['slug']);
        }
        return $this->parent_validate($data);
    }

    public function type()
    {
    	return $this->belongsTo('Spiderworks\MiniWeb\Models\Type', 'types_id');
    }

    public function parent()
    {
        return $this->belongsTo('Spiderworks\MiniWeb\Models\Category', 'parent_id');
    }

    public function banner_image()
    {
    	return $this->belongsTo('Spiderworks\MiniWeb\Models\MediaLibrary', 'banner_image_id');
    }

    public function primary_image()
    {
    	return $this->belongsTo('Spiderworks\MiniWeb\Models\MediaLibrary', 'primary_image_id');
    }

    public function menu()
    {
        return $this->morphOne('Spiderworks\MiniWeb\Models\MenuItem', 'linkable');
    }
}
