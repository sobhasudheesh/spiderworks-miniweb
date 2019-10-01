@foreach($files as $file)

	<div class="col-md-3 media-preview-wrap parent">
		<input type="checkbox" name="ids[]" class="bulk-selet-media"  value="{{$file->id}}">
		@if($file->media_type == "Image")
			<a href="{{route($route.'.edit', [encrypt($file->id)])}}" class="miniweb-open-ajax-popup" title="Edit Image Details" data-popup-size="large"><img src="{{ asset('public/'.$file->thumb_file_path) }}"></a>
		@else
			<div class="attachment-preview">
				<div class="thumbnail_new">
					<div class="centered">
						<a href="{{route($route.'.edit', [encrypt($file->id)])}}" class="miniweb-open-ajax-popup icon" title="Edit Document Details" data-popup-size="large"><img src="{{ asset('public/'.$file->thumb_file_path) }}" class="icon"></a>
					</div>
					<div class="filename">
						<a href="{{route($route.'.edit', [encrypt($file->id)])}}" class="miniweb-open-ajax-popup" title="Edit Document Details" data-popup-size="large">{{$file->file_name}}</a>
					</div>
				</div>
			</div>
		@endif
		<a href="{{route($route.'.index.post')}}" data-id="{{$file->id}}" class="btn btn-danger delete-btn media-delete">X</a>
	</div>
@endforeach
<div class="col-md-12 media-nav text-right">
	<input type="hidden" id="currentPage" value="{{$page}}">
	{{ $files->appends(['req' => $req])->links() }}
</div>