<?php

namespace Spiderworks\MiniWeb\Models;

use Spiderworks\MiniWeb\Models\BaseModel;
use Spiderworks\MiniWeb\Traits\ValidationTrait;

class Type extends BaseModel
{
	use ValidationTrait {
        ValidationTrait::validate as private parent_validate;
    }
    
    public function __construct() {
        
        parent::__construct();
        $this->__validationConstruct();
    }

    protected $table = 'types';

    protected $fillable = [
        'name', 'status'
    ];

    protected $dates = ['created_at','updated_at'];

    protected function setRules() {

        $this->val_rules = array(
            'name' => 'required|unique:types,name,ignoreId',
        );
    }

    protected function setAttributes() {
        $this->val_attributes = array(
        );
    }

    public function validate($data = null, $ignoreId = 'NULL') {
        if( isset($this->val_rules['name']) )
        {
            $this->val_rules['name'] = str_replace('ignoreId', $ignoreId, $this->val_rules['name']);
        }
        return $this->parent_validate($data);
    }
}
