@extends('admin.layouts.app')
@section('title')
    Appointments
@endsection

@section('css')
    <link href="{{ admin_styles('assets/css/scrollspyNav.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ admin_styles('plugins/font-icons/fontawesome/css/regular.css') }}">
    <link rel="stylesheet" href="{{ admin_styles('plugins/font-icons/fontawesome/css/fontawesome.css') }}">
    <link href="{{ admin_styles('assets/css/elements/custom-pagination.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="{{ admin_styles('plugins/select2/select2.min.css') }}">


    <style>
        .recordTr {
            transition: 0.5s;
        }

        .recordTr:hover {
            background: #1e272e;
            color: #fff !important;
        }

        tr:hover td {

            color: #fff !important;
        }

        .table-controls {
            list-style: none;
        }

        .customPagination {
            margin-top: 20px;
            font-size: 18px;
        }

        .hasDevice {
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
                        </div>
                        <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                            <a href="{{route('admin.appointments.create')}}"
                               class="btn btn-success mb-2 mt-3 mr-2 float-right">
                                <i data-feather="plus"></i>
                                Add
                            </a>
                        </div>
                    </div>
                </div>

                <div class="widget-header">
                    <form action="" method="get">
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
                                <label for="inputEmail4">Training</label>
                                <select class="placeholder js-states form-control basic" name="training_id"
                                        id="training_id">
                                    <option value="">None</option>
                                    @foreach ($trainings as $training)
                                        <option value="{{ $training->id }}"
                                            {{ request('training_id') == $training->id ? 'selected' : '' }}>{{ $training->id }}
                                            : {{ limit_words($training->name, 15) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="inputEmail4">Sort</label>
                                <select class="placeholder js-states form-control basic" name="sort" id="sort">
                                    <option value="">None</option>
                                    @foreach (\App\Models\Appointment::SORT_ARRAY as $key =>  $sort)
                                        <option value="{{ $key }}"
                                            {{ request('sort') == $key ? 'selected' : '' }}>{{ $sort }}
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
                        <table class="table table-bordered mb-4">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>start date</th>
                                <th>End Date</th>
                                <th>Training</th>
                                <th>Customers</th>
                                <th>PDF status</th>
                                <th>Created At</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody id="tbody">
                            <div>
                                @foreach ($objects as $object)
                                    <tr class="recordTr">
                                        <td>{{ $object->id }}</td>
                                        <td>{{ limit_words($object->name, 15) }}</td>
                                        <td>{{ $object->start_date }}</td>
                                        <td>{{ $object->end_date }}</td>
                                        <td>{{ limit_words($object->training->name, 15) }}</td>
                                        <td>{{ $object->customers_count }}</td>

                                        <td>
                                            @if($object->reported)

                                                <form action="{{ route('admin.appointments.resend', $object) }}"
                                                      method="POST">
                                                    @csrf
                                                    <input class="btn-sm btn-info" type="submit" name="" id=""
                                                           value="Re-send">
                                                </form>

                                            @else
                                                <p class="btn-sm btn-warning" style="display: inline-block">Pending</p>
                                            @endif


                                        </td>

                                        <td>{{ $object->created_at }}</td>

                                        <td class="text-center">
                                            <a href="{{ route('admin.appointments.registerCustomersView', $object) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                     class="feather feather-user-plus">
                                                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                                    <circle cx="8.5" cy="7" r="4"></circle>
                                                    <line x1="20" y1="8" x2="20" y2="14"></line>
                                                    <line x1="23" y1="11" x2="17" y2="11"></line>
                                                </svg>
                                            </a>
                                            &nbsp;

                                            <a href="{{ route('admin.appointments.registeredCustomers', $object) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                     class="feather feather-users">
                                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                                    <circle cx="9" cy="7" r="4"></circle>
                                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                                </svg>
                                            </a>
                                            &nbsp;

                                            <a href="{{route('admin.appointments.edit', $object)}}?page={{ request('page') }}"
                                               class=""><i data-feather="edit" style="color: #8dbf42"></i></a>


                                            <span>&nbsp; &nbsp;</span>
                                            <a href="javascript:void(0);" data-toggle="modal"
                                               data-target="#exampleModalCenter"
                                               data-id="{{ $object->id }}"
                                               data-name="{{ $object->name }}"
                                               class="deleteBtn"
                                            ><i data-feather="trash" style="color:#e7515a"></i></a>


                                        </td>

                                    </tr>
                                @endforeach
                            </div>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>start date</th>
                                <th>End Date</th>
                                <th>Training</th>
                                <th>Customers</th>
                                <th>PDF status</th>
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
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">
                            <i data-feather="alert-circle" style="color:#e7515a"></i>
                            Delete Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                 stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
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
                            <button type="button" class="btn btn-danger" id="lastDelete">Delete</button>
                        </form>
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

                document.addEventListener("DOMContentLoaded", function () {

                    @if(count($objects) > 0)
                    function fetchDeleteBtn() {
                        var deleteBtn = document.querySelectorAll('.deleteBtn');
                        deleteBtn.forEach(element => {
                            element.addEventListener('click', function () {
                                var id = element.getAttribute('data-id');
                                var name = element.getAttribute('data-name');
                                var modalName = document.getElementById('modalName');
                                modalName.innerHTML = `<p><span  class="text-danger">ID:</span> ${id}</p> <p><span  class="text-danger">NAME:</span> ${name} </p>`;
                                var delete_form = document.getElementById('delete_form');
                                var route = '{{ route("admin.appointments.destroy", ":id") }}';
                                route = route.replace(':id', id);
                                delete_form.setAttribute('action', route);
                            })
                        });
                    }

                    $(".basic").select2({});

                    fetchDeleteBtn();

                    document.getElementById('lastDelete').addEventListener('click', function () {
                        delete_form.submit();
                    })
                    @endif
                });


            </script>
@endsection
