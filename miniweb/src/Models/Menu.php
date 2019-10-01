<?php

namespace Spiderworks\MiniWeb\Models;

use Spiderworks\MiniWeb\Models\BaseModel;
use Spiderworks\MiniWeb\Traits\ValidationTrait;

class Menu extends BaseModel
{
	use ValidationTrait {
        ValidationTrait::validate as private parent_validate;
    }
    
    public function __construct() {
        
        parent::__construct();
        $this->__validationConstruct();
    }

    protected $table = 'menus';

    protected $fillable = array('name', 'position', 'status');

    protected $dates = ['created_at','updated_at'];

    protected function setRules() {

        $this->val_rules = array(
            'name' => 'required|max:250',
            'position' => 'required',
        );
    }

    protected function setAttributes() {
        $this->val_attributes = array(
            'name' => 'menu name',
            'position' => 'menu position',
        );
    }

    public function menu_items()
    {
        return $this->hasMany('Spiderworks\MiniWeb\Models\MenuItem');
    }

    public function parent_menu_items()
    {
        return $this->menu_items()->where('parent_id',0);
    }

}
