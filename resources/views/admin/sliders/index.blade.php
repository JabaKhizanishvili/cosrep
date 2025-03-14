@extends('admin.layouts.app')
@section('title')
Sliders
@endsection

@section('css')
{{-- <link href="{{ admin_styles('assets/css/scrollspyNav.css') }}" rel="stylesheet" type="text/css"> --}}
<link rel="stylesheet" href="{{ admin_styles('plugins/font-icons/fontawesome/css/regular.css') }}">
<link rel="stylesheet" href="{{ admin_styles('plugins/font-icons/fontawesome/css/fontawesome.css') }}">
<link href="{{ admin_styles('assets/css/elements/custom-pagination.css') }}" rel="stylesheet" type="text/css" />

    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="{{ admin_styles('plugins/drag-and-drop/dragula/dragula.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ admin_styles('plugins/drag-and-drop/dragula/example.css') }}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL STYLES -->

<style>
    .recordTr{
        transition:0.5s;
        background:unset !important;

    }

    .parent.ex-5 .dragula div, .parent.ex-5 .dragula .gu-transit{
        /* background:unset !important; */
        transition:0.5s;
    }

    .parent.ex-5 .dragula div, .parent.ex-5 .dragula .gu-transit:hover{
        /* background:unset !important; */
        transition:0.5s;

    }
    .recordTr:hover{
        background:#1e272e !important;
        color: #fff !important;
        cursor: move !important;
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

</style>

@endsection


@section('content')
<div class="row layout-top-spacing">

    <div class="col-lg-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                        <h4 style="display: inline-block">Number Of Records : {{ $objects->count() }}</h4>
                    </div>
                    <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                        <a href="{{route('admin.sliders.create')}}" class="btn btn-success mb-2 mt-3 mr-2 float-right">
                            <i data-feather="plus"></i>
                            Add
                        </a>
                    </div>


                </div>
            </div>
            <div class="widget-content widget-content-area">

                <div class='parent ex-5'>
                    <div class='row'>

                        <div class="col-md-12">
                            <div id='left-lovehandles' class='dragula ui-sortable'>
                                @foreach ($objects as $key =>  $object)


                                <div class="media  d-block d-xl-flex recordTr singleSort" id="{{ $object->id }}">
                                    <ul class="list-inline people-liked-img text-center text-sm-left">
                                        <li class="list-inline-item badge-notify mr-0" style="color:#2196f3">
                                           # {{ $key + 1 }}
                                            <div class="notification">
                                                <span class="badge badge-new"></span>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="media-body">
                                        <div class="d-sm-flex d-block justify-content-between text-sm-left text-center">
                                            <div class="" style="width: 80%">
                                                <h5 class="">{{ \Str::limit($object->name),100, '...' }}</h5>
                                            </div>
                                            {{-- <div  style="color:#2196f3" class="mr-1">
                                                10
                                            </div> --}}

                                            <div>
                                                @if($object->status == 1)
                                                <span class="badge badge-success">Active</span></td>
                                                @else
                                                <span class="badge badge-danger">Inactive</span></td>
                                                @endif
                                            </div>
                                            <div>

                                                <span class="">
                                                    <a href="{{route('admin.sliders.edit', $object)}}" class=""><i data-feather="edit" style="color: #8dbf42"></i></a>
                                                    <span>&nbsp; &nbsp;</span>
                                                    <a href="javascript:void(0);" data-toggle="modal"
                                                    data-target="#exampleModalCenter"
                                                    data-id="{{ $object->id }}"
                                                    data-name="{{ $object->name }}"
                                                    class="deleteBtn"
                                                    ><i data-feather="trash" style="color:#e7515a"></i></a>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @endforeach



                            </div>
                        </div>



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
@endsection



@section('script')




<script src="{{ admin_styles('assets/js/scrollspyNav.js') }}"></script>
<script src="{{ admin_styles('plugins/font-icons/feather/feather.min.js') }}"></script>

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{ admin_styles('plugins/drag-and-drop/dragula/dragula.min.js') }}"></script>
    <script src="{{ admin_styles('plugins/drag-and-drop/dragula/custom-dragula.js') }}"></script>
    <!-- END PAGE LEVEL SCRIPTS -->


<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

<script type="text/javascript">
    feather.replace();

    $( ".ui-sortable" ).sortable({
      delay: 150,
      stop: function() {
          var selectedData = new Array();
          $('.ui-sortable>.singleSort').each(function() {

              selectedData.push($(this).attr("id"));
          });
          updateOrder(selectedData);

      }
  });


  function updateOrder(data) {
    ajaxCall('POST', '{{route('admin.sliders.position')}}', {"position": data}, function (e) {
        Snackbar.show({
            text: 'Position Updated successfully',
            actionTextColor: '#fff',
            backgroundColor: '#8dbf42',
            pos: 'bottom-right'
        });
    });
  }
</script>

<script type="text/javascript">
    feather.replace();

    document.addEventListener("DOMContentLoaded", function() {

    @if(count($objects) > 0)
    function fetchDeleteBtn(){
        var deleteBtn = document.querySelectorAll('.deleteBtn');
        deleteBtn.forEach(element => {
            element.addEventListener('click', function(){
                var id = element.getAttribute('data-id');
                var name = element.getAttribute('data-name');
                var modalName = document.getElementById('modalName');
                modalName.innerHTML = `<p><span  class="text-danger">ID:</span> ${id}</p> <p><span  class="text-danger">Country:</span> ${name} </p>`;
                var delete_form = document.getElementById('delete_form');
                var route = '{{ route("admin.sliders.destroy", ":id") }}';
                route = route.replace(':id',id);
                delete_form.setAttribute('action', route);

            })
        });
        }




        fetchDeleteBtn();
        document.getElementById('lastDelete').addEventListener('click', function () {
            delete_form.submit();
        })
        @endif
    });



</script>
@endsection
