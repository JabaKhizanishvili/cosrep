@extends('admin.layouts.app')
@section('title')
Training Customers
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
                        <h4 style="display: inline-block">Training</h4>
                        <ul>
                            <li>Id: {{ $object->id }}</li>
                            <li>Name:{{ $object->name }}</li>
                        </ul>
                    </div>

                </div>
            </div>

        </div>
    </div>
           <!-- Modal -->

</div>


<div class="row layout-top-spacing">
    <div class="col-lg-12 col-md-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                        <h4 style="display: inline-block">Number Of Records : {{ $appointmentCustomers->total() }}</h4>
                    </div>
                    <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                        <a target="_blank" href="{{ Request::fullUrl() }}?&generatePdf=1" class="btn btn-info mb-2 mt-3 mr-2 float-right">
                            <i data-feather="printer"></i>
                            Print
                        </a>
                    </div>
                </div>
            </div>
            <div class="widget-header">
                <form action="" method="get">
                <input type="hidden" name="office_id_input" id="office_id_input" value="{{ request('office_id') }}">
                    <div class="row">
                        <div class="form-group col-md-3">
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
                            <label for="inputEmail4">Appointment</label>
                            <select class="placeholder js-states form-control basic" name="appointment_id" id="appointment_id">
                                <option value="">None</option>
                                @foreach ($appointments as $appointment)
                                    <option value="{{ $appointment->id }}" {{ request('appointment_id') == $appointment->id ? 'selected' : '' }}>{{ $appointment->getStartDate() }} / {{ $appointment->getEndDate() }} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="inputEmail4">Organization</label>
                            <select class="placeholder js-states form-control basic" name="organization_id" id="organization_id">
                                <option value="">None</option>
                                @foreach ($organizations as $organization)
                                    <option value="{{ $organization->id }}" {{ request('organization_id') == $organization->id ? 'selected' : '' }}>{{ $organization->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="inputEmail4">Office</label>
                            <select class="placeholder js-states form-control basic" name="office_id" id="office_id">

                            </select>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="inputEmail4">Passed</label>
                            <select class="placeholder js-states form-control basic" name="passed" id="passed">
                                <option value="">None</option>
                                @foreach (\App\Models\Training::FILTER_BY_TEST_STATUS as $key => $status)
                                    <option value="{{ $key }}" {{ request('passed') == $key ? 'selected' : '' }}>{{ $status }}</option>
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
                    <table class="table table-bordered mb-4">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>personal numer</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Company</th>
                                <th>office</th>


                                <th>Additional Info</th>
                                <th class="text-center">Test Details</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                        <div>
                            @foreach ($appointmentCustomers as $customer)
                                <tr class="recordTr">
                                    <td>{{ $customer->id }}</td>
                                    <td>{{ $customer->customer->username }}</td>
                                    <td>{{ limit_words($customer->customer->name, 15) }}</td>
                                    <td>{{ limit_words($customer->customer->email, 15) }}</td>
                                    <td>{{ limit_words($customer->customer->office->organization->name, 15) }}</td>
                                    <td>{{ limit_words($customer->customer->office->name, 15) }}</td>


                                    <td>
                                        <ul>
                                            <li>Point To Pass: {{ $customer->point_to_pass }}</li>
                                            <li>Final Point: {{ $customer->final_point }}</li>
                                            <li>Finished At: {{ $customer->finished_at }}</li>
                                            <li>Start Date: {{ $customer->appointment->getStartDate() }}</li>
                                            <li>End Date: {{ $customer->appointment->getEndDate() }}</li>

                                            <li>
                                                Passed:
                                            @if(!empty($customer->finished_at))
                                                @if($customer->final_point >= $customer->point_to_pass)
                                                    <span class="btn-sm btn-success">Yes</span>
                                                @else
                                                    <span class="btn-sm btn-danger">No</span>
                                                @endif
                                            @endif
                                            </li>


                                        </ul>
                                    </td>

                                    <td class="text-center">


                                        <a href="{{ route('admin.appointments.result', $customer) }}"
                                        ><i data-feather="eye"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </div>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>personal numer</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Company</th>
                                <th>office</th>

                                <th>Additional Info</th>
                                <th class="text-center">Test Details</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>


                <div class="customPagination">
                        {{ $appointmentCustomers->withQueryString()->links('vendor.pagination.bootstrap-4') }}

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
@endsection



@section('script')




<script src="{{ admin_styles('assets/js/scrollspyNav.js') }}"></script>
<script src="{{ admin_styles('plugins/font-icons/feather/feather.min.js') }}"></script>
<script src="{{ admin_styles('plugins/select2/select2.min.js') }}"></script>

<script type="text/javascript">
    feather.replace();

    $(".basic").select2({

        });
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
        })

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

</script>
@endsection
