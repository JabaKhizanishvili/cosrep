@extends('admin.layouts.app')
@section('title')
Subscription Plan Fees
@endsection

@section('css')
<link href="{{ admin_styles('assets/css/scrollspyNav.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="{{ admin_styles('plugins/font-icons/fontawesome/css/regular.css') }}">
<link rel="stylesheet" href="{{ admin_styles('plugins/font-icons/fontawesome/css/fontawesome.css') }}">
<link href="{{ admin_styles('assets/css/elements/custom-pagination.css') }}" rel="stylesheet" type="text/css" />

<style>
    .recordTr{
        transition:0.5s;
    }
    .recordTr:hover{
        background:#1e272e;
        color: #fff !important;
    }
    tr:hover td{

        color: #fff !important;
    }
    .table-controls{
        list-style: none;
    }

    .customPagination{
        margin-top: 20px;
        font-size: 18px;
    }
    .hasDevice{
        background: #e0ffe0;
    }

     .recordTr:hover .hasDevice {
        background: unset;
    }

</style>

@endsection


@section('content')
<div class="row layout-top-spacing">
    <div class="col-lg-12 col-md-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                        <h4 style="display: inline-block">Number Of Records : {{ $objects->total() }}</h4>
                        {{-- <div class="search-input-group-style input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Search" aria-label="Username" aria-describedby="basic-addon1" id="liveSearch">
                        </div> --}}
                    </div>



                </div>
            </div>
            <div class="widget-content widget-content-area">
                <div class="table-responsive">
                    <table class="table table-bordered mb-4">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Amount (GEL)</th>
                                <th>Amount ($)</th>
                                <th>Created At</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                        <div>
                            @foreach ($objects as $object)
                                <tr class="recordTr">
                                    <td>{{ $object->id }}</td>
                                    <td>{{ $object->name }}</td>
                                    <td>{{ $object->amount }} (GEL)</td>
                                    <td>{{ convertInUSD($object->amount) }} ($)</td>

                                    <td>{{ $object->created_at }}</td>

                                    <td class="text-center">
                                        <span>&nbsp; &nbsp;</span>
                                        <a href="{{route('admin.fees.edit', $object)}}" class=""><i data-feather="edit" style="color: #8dbf42"></i></a>


                                        {{-- <span>&nbsp; &nbsp;</span>
                                        <a href="javascript:void(0);" data-toggle="modal"
                                        data-target="#exampleModalCenter"
                                        data-id="{{ $object->id }}"
                                        data-name="{{ $object->name }}"
                                        class="deleteBtn"
                                        ><i data-feather="trash" style="color:#e7515a"></i></a> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </div>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Amount (GEL)</th>
                                <th>Amount ($)</th>

                                <th>Created At</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>


                <div class="customPagination">

                    {{ $objects->appends($_GET)->links('vendor.pagination.bootstrap-4') }}


            </div>
        </div>
    </div>

</div>
           <!-- Modal -->
           <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">
                            <i data-feather="alert-circle" style="color:#e7515a"></i>
                           Delete Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h4 class="modal-heading mb-4 mt-2 " id="modalName">Aligned Center</h4>
                            <p class="modal-text"></p>

                    </div>
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                        <form method="post" action="" id="delete_form">
                            @csrf
                            @method('delete')
                            <button type="button" class="btn btn-danger" id="lastDelete">Delete</button >
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection



@section('script')


<script src="{{ admin_styles('assets/js/scrollspyNav.js') }}"></script>
<script src="{{ admin_styles('plugins/font-icons/feather/feather.min.js') }}"></script>
<script type="text/javascript">
    feather.replace();
</script>
@endsection
