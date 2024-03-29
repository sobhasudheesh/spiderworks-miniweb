@extends('spiderworks.miniweb.app')

@section('content')
    <div class="container-fluid">
        <div class="container">

            <div class="col-md-12 p-0"  align="right" style="margin-bottom: 20px; ">
              <span class="page-heading">All Types</span>
              <div >
                  <div class="btn-group">
                      <a href="{{route($route.'.create')}}" class="btn btn-success miniweb-open-ajax-popup" title="Create new type"><i class="fa fa-pencil"></i> Create new type</a>
                  </div>
              </div>
            </div>
            <!-- START card -->
            <div class="card card-borderless padding-15">
                    <table class="table table-hover demo-table-search table-responsive-block" id="datatable"
                           data-datatable-ajax-url="{{ route($route) }}" >
                        <thead id="column-search">
                        <tr>
                            <th class="table-width-10 text-center">ID</th>
                            <th class="table-width-120">Name</th>
                            <th class="nosort nosearch table-width-10 text-center">Status</th>
                            <th class="nosort nosearch table-width-10 text-center">Edit</th>
                            <th class="nosort nosearch table-width-10 text-center">Delete</th>
                        </tr>

                        <tr>
                            <th class="table-width-10 nosort nosearch"></th>
                            <th class="searchable-input">Name</th>
                            <th class="nosort nosearch table-width-10"></th>
                            <th class="nosort nosearch table-width-10"></th>
                            <th class="nosort nosearch table-width-10"></th>
                        </tr>

                        </thead>

                        <tbody>
                        </tbody>

                    </table>
            </div>
            <!-- END card -->
        </div>
    </div>
@endsection
@section('bottom')

    <script>
        var my_columns = [
            {data: null, name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'status', name: 'status'},
            {data: 'action_edit', name: 'action_edit'},
            {data: 'action_delete', name: 'action_delete'}
        ];
        var slno_i = 0;
        var order = [0, 'desc'];

        function validate()
        {
            var validator = $('#TypeFrm').validate({
              rules: {
                "name": "required",
              },
              messages: {
                "name": "Type name cannot be blank",
              },
            });
        }
    </script>
    @parent
@endsection