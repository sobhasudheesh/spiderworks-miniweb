@extends('spiderworks.miniweb.app')

@section('content')
    <div class="container-fluid">
        <div class="container">
            <!-- START card -->
            <div class="col-md-12" style="margin-bottom: 20px;" align="right">
                <span class="page-heading">All Categories</span>
                <div >
                    <div class="btn-group">
                        <a href="{{route($route.'.create')}}" class="btn btn-success"><i class="fa fa-pencil"></i> Create new
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="card card-borderless padding-15">
                        <table class="table table-hover demo-table-search table-responsive-block" id="datatable"
                               data-datatable-ajax-url="{{ route($route.'.index') }}" >
                            <thead id="column-search">
                            <tr>
                                <th class="table-width-10">ID</th>
                                <th class="table-width-120">Slug</th>
                                <th class="table-width-120">Category name</th>
                                <th class="table-width-120">Browser title</th>
                                <th class="table-width-120">Meta Keywords</th>
                                <th class="nosort nosearch table-width-10">Status</th>
                                <th class="nosort nosearch table-width-10">Edit</th>
                                <th class="nosort nosearch table-width-10">Delete</th>
                            </tr>

                            <tr>
                                <th class="table-width-10 nosort nosearch"></th>
                                <th class="table-width-10 searchable-input">Slug</th>
                                <th class="table-width-120 searchable-input">Category name</th>
                                <th class="table-width-120 searchable-input">Browser title</th>
                                <th class="table-width-120 searchable-input">Meta Keywords</th>
                                <th class="nosort nosearch table-width-10"></th>
                                <th class="nosort nosearch table-width-10"></th>
                                <th class="nosort nosearch table-width-10"></th>
                            </tr>

                            </thead>

                            <tbody>
                            </tbody>

                        </table>
                </div>
            </div>
            <!-- END card -->
        </div>
    </div>
@endsection
@section('bottom')

    <script>
        var my_columns = [
            {data: null, name: 'id'},
            {data: 'slug', name: 'slug'},
            {data: 'name', name: 'name'},
            {data: 'browser_title', name: 'browser_title'},
            {data: 'meta_keywords', name: 'meta_keywords'},
            {data: 'status', name: 'status'},
            {data: 'action_edit', name: 'action_edit'},
            {data: 'action_delete', name: 'action_delete'}
        ];
        var slno_i = 0;
        var order = [4, 'desc'];
    </script>
    @parent
@endsection