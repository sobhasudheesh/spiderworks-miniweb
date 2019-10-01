<?php 
namespace Spiderworks\MiniWeb\Models;

use Illuminate\Database\Eloquent\Model;
use Schema, Auth;
use Illuminate\Http\Request;

class BaseModel extends Model {
    
    public static function boot() {
        parent::boot();
        $input = request()->all();
        static::creating(function ($model) {
            if(Schema::hasColumn($model->getTableName(), 'created_by')) {
                if($user = Auth::user())
                    $model->created_by = $user->id;
            }
        });
        
        static::saving(function ($model) {
            if(Schema::hasColumn($model->getTableName(), 'updated_by')) {
                if($user = Auth::user())
                    $model->updated_by = $user->id;
            }
            if(Schema::hasColumn($model->getTableName(), 'page_heading')) {
                if(isset($data['page_heading']))
                    $model->page_heading = $data['page_heading'];
            }
            if(Schema::hasColumn($model->getTableName(), 'browser_title')) {
                if(isset($data['browser_title']))
                    $model->page_heading = $data['browser_title'];
            }
            if(Schema::hasColumn($model->getTableName(), 'meta_keywords')) {
                if(isset($data['meta_keywords']))
                    $model->page_heading = $data['meta_keywords'];
            }
            if(Schema::hasColumn($model->getTableName(), 'meta_description')) {
                if(isset($data['meta_description']))
                    $model->page_heading = $data['meta_description'];
            }
            // return true;
        });
    }
    
    protected static function setNullWhenEmpty($model) {
        foreach ($model->attributes as $key => $value) {
            if ( trim(strip_tags($value)) == '' && (!is_bool($value)) ) {
                $model->{$key} = null;
            }
        }
    }
    
    public static function getTableName() {
        return with(new static)->getTable();
    }

    public function createdBy() {
        if (isset($this->attributes['created_by'])) return $this->belongsTo('App\Models\Auth\User', 'created_by');
        return null;
    }

    public function updatedBy() {
        if (isset($this->attributes['updated_by'])) return $this->belongsTo('App\Models\Auth\User', 'updated_by');
        return null;
    }

}
