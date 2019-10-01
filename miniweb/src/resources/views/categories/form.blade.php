@extends('spiderworks.miniweb.fileupload')

@section('head')

@endsection

@section('content')
    <div class="container-fluid">

        <div class="col-md-12" style="margin-bottom: 20px;" align="right">
            @if($obj->id)
                <span class="page-heading">EDIT Category</span>
            @else
                <span class="page-heading">Create Category</span>
            @endif
            <div >
                <div class="btn-group">
                    <a href="{{route($route.'.index')}}"  class="btn btn-success"><i class="fa fa-list"></i> List
                    </a>
                    @if($obj->id)
                    <a href="{{route($route.'.create')}}" class="btn btn-success"><i class="fa fa-pencil"></i> Create new
                    </a>
                    <a href="{{route($route.'.destroy', [encrypt($obj->id)])}}" class="btn btn-success miniweb-btn-warning-popup" data-message="Are you sure to delete?  Associated data will be removed if it is deleted." data-redirect-url="{{route($route.'.index')}}"><i class="fa fa-trash"></i> Delete</a>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card card-borderless">
                @if($obj->id)
                    <form method="POST" action="{{ route($route.'.update') }}" class="p-t-15" id="CategoryFrm" data-validate=true>
                @else
                    <form method="POST" action="{{ route($route.'.store') }}" class="p-t-15" id="CategoryFrm" data-validate=true>
                @endif
                @csrf
                <input type="hidden" name="id" @if($obj->id) value="{{encrypt($obj->id)}}" @endif id="inputId">

                <ul class="nav nav-tabs nav-tabs-simple d-none d-md-flex d-lg-flex d-xl-flex" role="tablist" data-init-reponsive-tabs="dropdownfx">
                    <li class="nav-item">
                        <a class="active show" data-toggle="tab" role="tab"
                           data-target="#tab1Basic"
                        href="#" aria-selected="true">Basic Details</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" data-toggle="tab" role="tab"
                           data-target="#tab2Content"
                        class="" aria-selected="false">Content</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" data-toggle="tab" role="tab"
                           data-target="#tab3SEO"
                        class="" aria-selected="false">SEO</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" data-toggle="tab" role="tab"
                           data-target="#tab4Media"
                           class="" aria-selected="false">Media</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active show" id="tab1Basic">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row column-seperation padding-5">
                                    <div class="form-group form-group-default required">
                                        <label>Category name</label>
                                        <input type="text" name="name" class="form-control" value="{{$obj->name}}" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row column-seperation padding-5">
                                    <div class="form-group form-group-default required">
                                        <label class="">Category slug (for url)</label>
                                        <input type="text" name="slug" class="form-control" value="{{$obj->slug}}" id="slug">
                                    </div>
                                    <p class="hint-text small">The “slug” is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.</p>
                                </div>
                            </div>
                            @if(config('miniweb.category_types'))
                                <div class="col-md-6">
                                    <div class="row column-seperation padding-5">
                                        <div class="form-group form-group-default form-group-default-select2">
                                            <label class="">Category Type</label>
                                            <select name="types_id" class="full-width miniweb-select2-input" data-select2-url="{{route('spiderworks.miniweb.select2.types')}}" data-placeholder="Select Category Type">
                                                @if($obj->type)
                                                    <option value="{{$obj->types_id}}" selected="selected">{{$obj->type->name}}</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="col-md-6">
                                <div class="row column-seperation padding-5">
                                    <div class="form-group form-group-default">
                                        <label>Title</label>
                                        <input type="text" name="page_title" class="form-control" value="{{$obj->page_title}}" id="page_title">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row column-seperation padding-5">
                                    <div class="form-group form-group-default">
                                        <label>Category tagline</label>
                                        <textarea name="description" class="form-control" rows="3" id="description">{{$obj->description}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row column-seperation padding-5">
                                    <div class="form-group form-group-default form-group-default-select2">
                                        <label class="">Parent Category</label>
                                        <select name="parent_id" class="full-width miniweb-select2-input" data-select2-url="{{route('spiderworks.miniweb.select2.categories')}}" data-placeholder="Select Parent Category">
                                            @if($obj->parent)
                                                <option value="{{$obj->parent_id}}" selected="selected">{{$obj->parent->name}}</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab2Content">
                        <div class="row">
                                <div class="col-md-12">
                                    <div class="row column-seperation padding-5">
                                        <div class="form-group form-group-default required">
                                            <label>Top content</label>
                                            <textarea name="top_description" class="form-control richtext" id="top_description" data-image-url="{{route('spiderworks.miniweb.summernote.image')}}">{{$obj->top_description}}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="row column-seperation padding-5">
                                        <div class="form-group form-group-default required">
                                            <label>Bottom content</label>
                                            <textarea name="bottom_description" class="form-control richtext" id="bottom_description" data-image-url="{{route('spiderworks.miniweb.summernote.image')}}">{{$obj->bottom_description}}</textarea>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab3SEO">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="row column-seperation padding-5">
                                    <div class="form-group form-group-default">
                                        <label>Browser title</label>
                                        <input type="text" class="form-control" name="browser_title" id="browser_title" value="{{$obj->browser_title}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row column-seperation padding-5">
                                    <div class="form-group form-group-default">
                                        <label class="">Meta Keywords</label>
                                        <textarea name="meta_keywords" class="form-control" rows="3" id="meta_keywords">{{$obj->meta_keywords}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row column-seperation padding-5">
                                    <div class="form-group form-group-default">
                                        <label class="">Meta description</label>
                                        <textarea name="meta_description" class="form-control" rows="3" id="meta_description">{{$obj->meta_description}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab4Media">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <p class="col-md-12">Banner Image</p>
                                    <div class="default-image-holder padding-5">
                                        <a href="javascript:void(0);" class="image-remove"><i class="fa  fa-times-circle"></i></a>
                                        <a href="{{route('spiderworks.miniweb.media.popup', ['popup_type'=>'single_image', 'type'=>'Image', 'holder_attr'=>'0', 'related_id'=>$obj->id])}}" class="miniweb-open-ajax-popup" title="Media Images" data-popup-size="large" id="image-holder-0">
                                          @if($obj->banner_image_id && $obj->banner_image)
                                            <img class="card-img-top padding-20" src="{{ asset('public/'.$obj->banner_image->thumb_file_path) }}">
                                          @else
                                            <img class="card-img-top padding-20" src="{{asset('miniweb/img/add_image.png')}}">
                                          @endif
                                        </a>
                                        <input type="hidden" name="banner_image_id" id="mediaId0" value="{{$obj->banner_image_id}}">
                                    </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <p class="col-md-12">Primary Image</p>
                                    <div class="default-image-holder padding-5">
                                        <a href="javascript:void(0);" class="image-remove"><i class="fa  fa-times-circle"></i></a>
                                        <a href="{{route('spiderworks.miniweb.media.popup', ['popup_type'=>'single_image', 'type'=>'Image', 'holder_attr'=>'1', 'related_id'=>$obj->id])}}" class="miniweb-open-ajax-popup" title="Media Images" data-popup-size="large" id="image-holder-1">
                                          @if($obj->primary_image_id && $obj->primary_image)
                                            <img class="card-img-top padding-20" src="{{ asset('public/'.$obj->primary_image->thumb_file_path) }}">
                                          @else
                                            <img class="card-img-top padding-20" src="{{asset('miniweb/img/add_image.png')}}">
                                          @endif
                                        </a>
                                        <input type="hidden" name="primary_image_id" id="mediaId1" value="{{$obj->primary_image_id}}">
                                    </div>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" align="right">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('bottom')
    <script type="text/javascript">
        var validator = $('#CategoryFrm').validate({
              rules: {
                "name": "required",
                slug: {
                  required: true,
                  remote: {
                      url: "{{route('spiderworks.miniweb.unique.category-slug')}}",
                      data: {
                        id: function() {
                          return $( "#inputId" ).val();
                      }
                    }
                  }
                },
              },
              messages: {
                "name": "Category name cannot be blank",
                slug: {
                  required: "Slug cannot be blank",
                  remote: "Slug is already in use",
                },
              },
            });
    </script>
@parent
@endsection