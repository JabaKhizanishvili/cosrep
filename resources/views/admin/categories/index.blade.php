@extends('admin.layouts.app')
@section('title')
Categories
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

                        <a href="{{route('admin.categories.create')}}" class="btn btn-success mb-2 mt-3 mr-2 float-right">
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

                            <div class="media  d-block d-xl-flex recordTr">
                                <ul class="list-inline people-liked-img text-center text-sm-left">
                                    <li class="list-inline-item badge-notify mr-0" style="color:#2196f3">

                                        <div class="notification">

                                        </div>
                                    </li>
                                </ul>
                                <div class="media-body">

                                </div>
                            </div>






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

                                            <div style="color: #000">
                                               Trainings:  {{ $object->trainings_count }}
                                            </div>
                                            <div>

                                                <span class="">
                                                    <a href="{{route('admin.categories.edit', $object->id)}}" class=""><i data-feather="edit" style="color: #8dbf42"></i></a>
                                                    <span>&nbsp; &nbsp;</span>
                                                    <a href="javascript:void(0);" data-toggle="modal"
                                                    data-target="#exampleModalCenter"
                                                    data-id="{{ $object->id }}"
                                                    data-num="{{ $key + 1 }}"

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

    ajaxCall('POST', '{{route('admin.categories.position')}}', {"position": data}, function (e) {


                Snackbar.show({
                    text: 'Position Updated successfully',
                    actionTextColor: '#fff',
                    backgroundColor: '#8dbf42',
                    pos: 'bottom-right'
                });




    });

  }


    document.addEventListener("DOMContentLoaded", function() {

    function fetchDeleteBtn(){

        var deleteBtn = document.querySelectorAll('.deleteBtn');

        deleteBtn.forEach(element => {
            element.addEventListener('click', function(){
                var id = element.getAttribute('data-id');
                var num = element.getAttribute('data-num');
                var name = element.getAttribute('data-name');
                var modalName = document.getElementById('modalName');
                modalName.innerHTML = `<p><span  class="text-danger">NUM:</span> #${num}</p> <p><span  class="text-danger">NAME:</span> ${name} </p>`;
                var delete_form = document.getElementById('delete_form');
                var route = '{{ route("admin.categories.destroy", ":id") }}';
                route = route.replace(':id',id);
                delete_form.setAttribute('action', route);

            })
        });
        }




        function tableContent(data) {
            var status = '';
            let route_rul = '{{route('admin.categories.edit', ":id")}}';
            route_rul = route_rul.replace(':id', data.id);
            var date = data.created_at;
            date =  moment(date).format('YYYY-M-D HH:mm:ss');

            if(data.status == 1){
                status =  ` <span class="badge badge-success">Active</span></td>`
            }else{
                status = '<span class="badge badge-danger">Inactive</span></td>';
            }

            var content =  `
                <tr class="recordTr">
                <td>${data.id}</td>
                <td>${data.name}</td>
                <td class="text-center">${status}</td>
                <td class="text-center">
                    <a href="${route_rul}" class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit" style="color: #8dbf42"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                    </a>
                <span>&nbsp; &nbsp;</span>
                <a href="javascript:void(0);" data-toggle="modal"
                data-target="#exampleModalCenter"
                data-id="${data.id}"
                data-name="${data.name}"
                class="deleteBtn">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash" style="color:#e7515a"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                </a>
                </td>
            </tr>`;

            return content;
        }






        fetchDeleteBtn();



        document.getElementById('lastDelete').addEventListener('click', function () {
            delete_form.submit();
        })
    });



</script>
@endsection
