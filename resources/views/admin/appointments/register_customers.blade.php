@extends('admin.layouts.app')
@section('title')
Register Customers To Appointment
@endsection

@section('css')
<link href="{{ admin_styles('assets/css/scrollspyNav.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="{{ admin_styles('plugins/font-icons/fontawesome/css/regular.css') }}">
<link rel="stylesheet" href="{{ admin_styles('plugins/font-icons/fontawesome/css/fontawesome.css') }}">
<link href="{{ admin_styles('assets/css/elements/custom-pagination.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{ admin_styles('plugins/select2/select2.min.css') }}">


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
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4 style="display: inline-block">Appointment</h4>
                        <ul>
                            <li>Id: {{ $object->id }}</li>
                            <li>Name: {{ $object->name }}</li>
                            <li>Training: {{ $object->training->id }} - {{ $object->training->name }}</li>
                            <li>Start Date: {{ $object->start_date }}</li>
                            <li>End Date: {{ $object->end_date }}</li>
                        </ul>
                    </div>

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
</div>


<div class="row layout-top-spacing">
    <div class="col-lg-12 col-md-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                        <h4 style="display: inline-block">Number Of Customers : {{ $customers->total() }}</h4>
                        <br>
                        <h4 style="display: inline-block">Number Of Registered Customers : {{ $object->customers->count() }}</h4>

                    </div>
                    <div class="col-xl-6 col-md-6 col-sm-6 col-6">

                    </div>
                </div>
            </div>

            <div class="widget-header">
                <form action="" method="get">
                    <input type="hidden" name="office_id_input" id="office_id_input" value="{{ request('office_id') }}">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="inputEmail4">Name, ID</label>
                            <div class="search-input-group-style input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-search">
                                            <circle cx="11" cy="11" r="8"></circle>
                                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                        </svg></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Name, ID"
                                    aria-describedby="basic-addon1" id="liveSearch" name="keyword"
                                    value="{{ request('keyword') }}">
                            </div>
                        </div>


                        <div class="form-group col-md-3">
                            <label for="inputEmail4">Organization</label>
                            <select class="placeholder js-states form-control basic" name="organization_id" id="organization_id">
                                <option value="">None</option>
                                @foreach ($organizations as $organization)
                                    <option value="{{ $organization->id }}"
                                        {{ request('organization_id') == $organization->id ? 'selected' : '' }}>{{ $organization->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="inputEmail4">Office</label>
                            <select class="placeholder js-states form-control basic" name="office_id" id="office_id">
                                <option value="">None</option>
                            </select>
                        </div>

                        <div class="form-group col-md-2">
                            <label for="inputEmail4">Group</label>
                            <select class="placeholder js-states form-control basic" name="group" id="group_id">
                                <option value="">None</option>
                                @foreach ($groups as $group)
                                    <option value="{{ $group }}"
                                        {{ request('group') == $group ? 'selected' : '' }}>{{ $group }}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        <div class="col-12">
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>

                                <div class="form-group col-md-1">
                                    <a class="btn btn-dark" href="{{ Request::url() }}">Clear</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>

            <div class="widget-content widget-content-area">
                <div class="table-responsive">

                    <form action="{{ route('admin.appointments.registerCustomers', $object) }}" method="post">
                    @csrf
                    <table class="table table-bordered mb-4">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Organization</th>
                                <th>office</th>
                                <th>Group</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                        <div>
                            @foreach ($customers as $customer)
                                <tr class="recordTr" style="background: rgba({{ $customer->color }}, 0.2)">
                                    <td>{{ $customer->id }}</td>
                                    <td>{{ limit_words($customer->name, 15) }}</td>
                                    <td>{{ limit_words($customer->email, 15) }}</td>
                                    <td>{{ limit_words($customer->office->organization->name, 15) }}</td>
                                    <td>{{ limit_words($customer->office->name, 15) }}</td>
                                    <td>{{ $customer->group_number }}</td>
                                    <td class="text-center">
                                        <input type="checkbox" style="width:17px; height:17px" class="recordCheck" name="customer_ids[]" value="{{ $customer->id }}">
                                    </td>
                                </tr>
                            @endforeach
                        </div>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Organization</th>
                                <th>office</th>
                                <th>Group</th>
                                <th class="text-center">
                                    <input type="checkbox" class="form-group" id="check-all" style="width:17px; height:17px">
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                    <input type="submit" class="btn btn-success" name="" id="" value="Add Customers" style="float: right">
                    </form>
                </div>


                <div class="customPagination">
                        {{ $customers->appends($_GET)->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



@section('script')




<script src="{{ admin_styles('assets/js/scrollspyNav.js') }}"></script>
<script src="{{ admin_styles('plugins/font-icons/feather/feather.min.js') }}"></script>
<script src="{{ admin_styles('plugins/select2/select2.min.js') }}"></script>

<script type="text/javascript">
    feather.replace();

    $('#check-all').click(function() {
                $('.recordCheck').prop('checked', this.checked);
            });

    $(".basic").select2({

        });

</script>

<script type="text/javascript">
    feather.replace();

    document.addEventListener("DOMContentLoaded", function() {

            var organization_id = $('#organization_id').val()
            var office_id_input = $("#office_id_input").val()
                if(organization_id != ''){
                    ajaxCall('GET', '{{route('admin.customers.getOffices')}}', {"organization_id": organization_id}, function (e) {
                    let result = e.data;
                    let select = document.getElementById('office_id');
                    select.innerHTML = '';
                    let div = document.createElement('div');
                    if(office_id_input == ''){
                        select.innerHTML += `<option value="" selected>None</option>`;
                        }else{
                            select.innerHTML += `<option value="">None</option>`;
                        }
                        result.forEach(function (result) {
                        if(result.id == office_id_input){
                            select.innerHTML += `<option value="${result.id}" selected>${result.name}</option>`;
                        }else{
                            select.innerHTML += `<option value="${result.id}">${result.name}</option>`;
                        }
                        });

                });
            }

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
                select.innerHTML += `<option value="">None</option>`;
        });
    });
    });



</script>
@endsection
