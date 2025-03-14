@extends('admin.layouts.app')
@section('title')
    Import Records
@endsection

@section('css')

    <link rel="stylesheet" type="text/css" href="{{ admin_styles('plugins/select2/select2.min.css') }}">
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="{{ admin_styles('assets/css/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL STYLES -->
@endsection


@section('content')
    <div class="layout-px-spacing">
        <!-- CONTENT AREA -->
        <div class="row layout-top-spacing">
            <div class="col-lg-12">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4></h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        <form method="post" action="{{ route('admin.customers.import') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-row mb-4">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Organization</label>
                                    <select class="placeholder js-states form-control basic" name="organization_id" id="organization_id" required>
                                        <option value="">Select Organization</option>
                                        @foreach($organizations as $organization)
                                        <option value="{{ $organization->id }}">{{ $organization->id }} - {{ $organization->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Office</label>
                                    <select class="placeholder js-states form-control basic" name="office_id" id="office_id" required>

                                    </select>
                                    @error('office_id')
                                    <div class="customValidate">
                                        {{ $message }}
                                    </div>
                                @enderror
                                </div>
                            </div>

                            <div class="form-row mb-4">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Uplaod File</label>
                                    <div class="custom-file mb-4">
                                        <input accept=".xlsx, .xls, .csv" type="file" class="custom-file-input" id="customFile" name="file" required>
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                    @error('file')
                                        <div class="customValidate">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Upload</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- CONTENT AREA -->
    </div>
@endsection

@section('script')
    <script src="{{ admin_styles('plugins/select2/select2.min.js') }}"></script>

    <script>
        var ss = $(".basic").select2({

        });

        $('#organization_id').change(function(e){
            var organization_id = this.value
            ajaxCall('GET', '{{route('admin.customers.getOffices')}}', {"organization_id": organization_id}, function (e) {
                let result = e.data;
                let select = document.getElementById('office_id');
                select.innerHTML = '';
                let div = document.createElement('div');
                    result.forEach(function (result) {
                        select.innerHTML += `<option value="${result.id}">${result.name}</option>`
                    });
            });
        });

    </script>
@endsection
