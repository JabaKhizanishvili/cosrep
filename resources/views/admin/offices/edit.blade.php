@extends('admin.layouts.app')
@section('title')
Edit Office
@endsection

@section('css')

<link rel="stylesheet" type="text/css" href="{{ admin_styles('assets/css/forms/switches.css') }}">

    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="{{ admin_styles('assets/css/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ admin_styles('plugins/select2/select2.min.css') }}">


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
                    <form method="post" action="{{ route('admin.offices.update', $object) }}"  enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <input type="hidden" name="page" value="{{ request('page') }}">

                        <div class="form-row mb-4">

                            <div class="form-group col-md-6">
                                <label for="inputEmail4">organization</label>
                                <select class="placeholder js-states form-control basic" name="organization_id" id="organization_id">
                                    <option value="">None</option>
                                    @foreach ($organizations as $organization)
                                        <option value="{{ $organization->id }}"
                                            {{ $object->organization_id == $organization->id ? 'selected' : '' }}>{{ $organization->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('organization_id')
                                    <div class="customValidate">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Name</label>
                                <input type="text" class="form-control @error('name') invalideInput @enderror" id="name" placeholder="Name" name="name" value="{{$object->name}}" required>
                                @error('name')
                                    <div class="customValidate">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Address</label>
                                <input type="text" class="form-control @error('name') invalideInput @enderror" id="address" placeholder="Address" name="address" value="{{$object->address}}" required>
                                @error('address')
                                    <div class="customValidate">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                        </div>
                      <button type="submit" class="btn btn-primary mt-3">Update</button>
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
    document.addEventListener("DOMContentLoaded", function() {
        $(".basic").select2({

        });
    });
</script>

@endsection


