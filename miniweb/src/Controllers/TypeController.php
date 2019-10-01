<?php

namespace Spiderworks\MiniWeb\Controllers;

use Spiderworks\MiniWeb\Controllers\BaseController;
use Illuminate\Http\Request as HttpRequest;
use Spiderworks\MiniWeb\Traits\ResourceTrait;
use Spiderworks\MiniWeb\Models\Type, Input, Request, View, Redirect, DB, Datatables;

class TypeController extends BaseController
{
	use ResourceTrait;
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    	parent::__construct();

        $this->model = new Type;

        $this->route .= '.types';
        $this->views .= '.types';

        $this->resourceConstruct();

    }

    protected function getCollection() {
        return $this->model->select('id', 'name', 'status', 'updated_at');
    }

    protected function setDTData($collection) {
        $route = $this->route;
        return $this->initDTData($collection)
            ->editColumn('status', function($obj) use($route) { 
                if($obj->status == 1)
                {
                    return '<a href="' . route($route.'.change-status', [encrypt($obj->id)]).'" class="btn btn-success btn-sm miniweb-btn-warning-popup" data-message="Are you sure, want to disable this type?"><i class="fa fa-check-circle"></i></a>'; 
                }
                else{
                    return '<a href="' . route($route.'.change-status', [encrypt($obj->id)]) . '" class="btn btn-danger btn-sm miniweb-btn-warning-popup" data-message="Are you sure, want to enable this type?"><i class="fa fa-times-circle"></i></a>';
                }
            })
            ->addColumn('action_edit', function($obj) use ($route) { 
                return '<a href="'.route($route.'.edit', [encrypt($obj->id)]).'" class="btn btn-info miniweb-open-ajax-popup" title="Edit Type" ><i class="fa fa-pencil"></i></a>';
            })
            ->addColumn('action_delete', function($obj) use ($route) { 
                return '<a href="'.route($route.'.destroy', [encrypt($obj->id)]).'" class="btn btn-danger miniweb-btn-warning-popup" data-message="Are you sure to delete?  Associated data will be removed if it is deleted." title="' . ($obj->updated_at ? 'Last updated at : ' . date('d/m/Y - h:i a', strtotime($obj->updated_at)) : ''). '" ><i class="fa fa-trash"></i></a>';
            })
            ->rawColumns(['action_edit', 'action_delete', 'status']);
    }
}
