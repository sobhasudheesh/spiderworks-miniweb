<?php

namespace Spiderworks\MiniWeb\Controllers;

use Illuminate\Http\Request;
use Spiderworks\MiniWeb\Controllers\BaseController;
use DB, URL;
use Spiderworks\MiniWeb\Models\MediaLibrary as Media;
use Illuminate\Support\Facades\Auth;

class PluginController extends BaseController
{

    public function select2_categories(Request $r){
        $items = DB::table('categories')->where('name', 'like', $r->q.'%')->orderBy('name')
            ->get();
        $json = [];
        foreach($items as $c){
            $json[] = ['id'=>$c->id, 'text'=>$c->name];
        }
        return \Response::json($json);
    }

    public function select2_types(Request $r){
        $items = DB::table('types')->where('name', 'like', $r->q.'%')->orderBy('name')
            ->get();
        $json = [];
        foreach($items as $c){
            $json[] = ['id'=>$c->id, 'text'=>$c->name];
        }
        return \Response::json($json);
    }

    public function unique_category_slug(Request $r)
    {
        $id = $r->id;
        $slug = $r->slug;
         
         $where = "slug='".$slug."'";
         if($id)
            $where .= " AND id != ".decrypt($id);
         $result = DB::table('categories')
                    ->whereRaw($where)
                    ->get();
         
         if (count($result)>0) {  
             echo "false";
         } else {  
             echo "true";
         }
    }

    public function unique_page_slug(Request $r)
    {
        $id = $r->id;
        $slug = $r->slug;
         
         $where = "slug='".$slug."'";
         if($id)
            $where .= " AND id != ".decrypt($id);
         $result = DB::table('pages')
                    ->whereRaw($where)
                    ->get();
         
         if (count($result)>0) {  
             echo "false";
         } else {  
             echo "true";
         }
    }

    public function summernote_image_upload(Request $request){
        $upload = $this->uploadFile($request->file('file'), 'uploads/summernote/');
        if($upload['success']) {
            $media = new Media;
            $media->file_name = $upload['filename'];
            $media->file_path = $upload['filepath'];
            $media->thumb_file_path = $upload['mediathumb'];
            $media->file_type = $upload['filetype'];
            $media->file_size = $upload['filesize'];
            $media->dimensions = $upload['filedimensions'];
            $media->media_type = $upload['mediatype'];
            $media->related_type = 'summernote';
            $media->created_by = Auth::user()->id;
            $media->updated_by = Auth::user()->id;
            $media->save();
                
            echo URL::asset($media->file_path);
        }

    }
}
