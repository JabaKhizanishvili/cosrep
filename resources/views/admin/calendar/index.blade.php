@extends('admin.layouts.app')

@section('css')
<link href="{{admin_styles('plugins/fullcalendar/fullcalendar.css')}}" rel="stylesheet" type="text/css" />
<link href="{{admin_styles('plugins/fullcalendar/custom-fullcalendar.advance.css')}}" rel="stylesheet" type="text/css" />

<link href="{{admin_styles('plugins/flatpickr/flatpickr.css')}}" rel="stylesheet" type="text/css">
<link href="{{admin_styles('plugins/flatpickr/custom-flatpickr.css')}}" rel="stylesheet" type="text/css">
<link href="{{admin_styles('assets/css/forms/theme-checkbox-radio.css')}}" rel="stylesheet" type="text/css" />

<style>
    .widget-content-area { border-radius: 6px; margin-bottom: 10px; }
    .daterangepicker.dropdown-menu {
        z-index: 1059;
    }

    .fc-event{
        cursor: pointer;
    }


    .fc-event:hover{
        opacity: 0.8;
    }
</style>
@endsection

@section('content')

<div class="row layout-top-spacing" id="cancel-row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area">
                <div class="calendar-upper-section">
                    <div class="row">
                        <div class="col-md-8 col-12">
                            <div class="labels">
                                <p class="label label-warning">ივენთები რომლებიც უნდა განმეორდეს</p>
                                {{-- <p class="label label-warning">Travel</p> --}}
                                {{-- <p class="label label-success"></p> --}}

                                <p class="label label-danger">არსებული ივენთები</p>

                                {{-- <p class="label label-danger">Important</p> --}}
                            </div>
                        </div>

                    </div>
                </div>
                <div id="calendar"></div>
            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div id="addEventsModal" class="modal animated fadeIn">

        <div class="modal-dialog modal-lg modal-dialog-centered">

            <!-- Modal content -->
            <div class="modal-content">

                <div class="modal-body">

                    <span class="close">&times;</span>

                    <div class="add-edit-event-box">
                        <div class="add-edit-event-content">
                            <h5 class="edit-event-title modal-title">დეტალები</h5>

                            <form class="">
                                <hr>

                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="start-date" class="">Appointment Id</label>
                                        <div class="d-flex event-title">
                                            <h5 id="appointment_id"></h5>
                                        </div>
                                        <br>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="start-date" class="">სათაური</label>
                                        <div class="d-flex event-title">
                                            <h5 id="write-e"></h5>
                                        </div>
                                        <br>
                                    </div>



                                    <br>
                                    <div class="col-md-6 col-sm-6 col-12">
                                        <div class="form-group start-date">
                                            <label for="start-date" class="">დაწყების დრო:</label>
                                            <div class="d-flex">
                                                <h6 id="start-date"></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-12">
                                        <div class="form-group end-date">
                                            <label for="end-date" class="">დამთავრების დრო:</label>
                                            <div class="d-flex">
                                                <h6 id="end-date"></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>

                                <div class="row">
                                    <br>
                                    <div class="col-md-6 col-sm-6 col-12">
                                        <div class="form-group start-date">
                                            <label for="start-date" class="">ივენთის ლინკი:</label>
                                            <div class="d-flex">
                                                <a  style="font-weight: 900; color:#1b55e2" target="_blank" id="event_link">

                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <br>
                                <div class="row">

                                </div>

                            </form>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button id="discard" class="btn" data-dismiss="modal">დახურვა</button>
                </div>

            </div>

        </div>

    </div>

</div>

@endsection



@section('script')

<script src="{{ admin_styles('plugins/fullcalendar/moment.min.js') }}"></script>
<script src="{{ admin_styles('plugins/flatpickr/flatpickr.js') }}"></script>
<script src="{{ admin_styles('plugins/fullcalendar/fullcalendar.min.js') }}"></script>
<!-- END PAGE LEVEL SCRIPTS -->

<!--  BEGIN CUSTOM SCRIPTS FILE  -->

<script>
    $(document).ready(function () {
        App.init();
            // Get the modal
            var modal = document.getElementById("addEventsModal");

            // Get the button that opens the modal
            var btn = document.getElementById("myBtn");



            // Get the Discard Modal button
            var discardModal = document.querySelectorAll("[data-dismiss='modal']")[0];

            // Get the Edit Event button


            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];

            // Get the all <input> elements insdie the modal
            var input = document.querySelectorAll('input[type="text"]');
            var radioInput = document.querySelectorAll('input[type="radio"]');

            // Get the all <textarea> elements insdie the modal
            var textarea = document.getElementsByTagName('textarea');

                // Clear Data and close the modal when the user clicks on Discard button
    discardModal.onclick = function() {
        modalResetData();
        document.getElementsByTagName('body')[0].removeAttribute('style');
    }

    // Clear Data and close the modal when the user clicks on <span> (x).
    span.onclick = function() {
        modalResetData();
        document.getElementsByTagName('body')[0].removeAttribute('style');
    }



            // Create BackDrop ( Overlay ) Element
            function createBackdropElement () {
                var btn = document.createElement("div");
                btn.setAttribute('class', 'modal-backdrop fade show')
                document.body.appendChild(btn);
            }

            function clearRadioGroup(GroupName) {
            var ele = document.getElementsByName(GroupName);
                for(var i=0;i<ele.length;i++)
                ele[i].checked = false;
            }

            // Reset Modal Data on when modal gets closed
            function modalResetData() {
                modal.style.display = "none";
                $("#write-e").text('');
                $("#start-date").text('');
                $("#appointment_id").text('');
                $("#end-date").text('');
                $("#calendar_link").attr('href', '');
                $("#meet_link").attr('href', '');
                // Get Modal Backdrop
                var getModalBackdrop = document.getElementsByClassName('modal-backdrop')[0];
                document.body.removeChild(getModalBackdrop)
            }

        var SITEURL = "{{ route('admin.calendar.index', app()->getLocale()) }}";

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var calendar = $('#calendar').fullCalendar({

            header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
            },

            editable: false,
            events: SITEURL,
            timeFormat: 'HH:mm',
            displayEventEnd:true,
            slotLabelFormat:"HH:mm",

            displayEventTime: true,


            eventRender: function (event, element, view) {
                if (event.allDay === 'true') {
                    event.allDay = true;
                } else {
                    event.allDay = false;
                }
            },
            eventClick: function(info) {



                    modal.style.display = "block";
                    document.getElementsByTagName('body')[0].style.overflow = 'hidden';
                    createBackdropElement();

                    // Calendar Event Featch
                    var eventTitle = info.title;
                    // Task Modal Input
                    var taskTitle = $('#write-e');
                    var taskTitleValue = taskTitle.text(eventTitle);


                    var taskInputStarttDate = $("#start-date");
                    var taskInputStarttDateValue = taskInputStarttDate.text(info.start.format("YYYY-MM-DD HH:mm:ss"));

                    var appointmentId = $("#appointment_id");
                    appointmentId.text(info.id);

                    var taskInputEndDate = $("#end-date");
                    var taskInputEndtDateValue = taskInputEndDate.text(info.end.format("YYYY-MM-DD HH:mm:ss"));

                    var calendar_link = $("#event_link");
                    var calendar_link_href = calendar_link.attr("href",info.appointment_link);
                    calendar_link.text(info.appointment_link);

                    $('#edit-event').off('click').on('click', function(event) {

                        event.preventDefault();
                        /* Act on the event */
                        var radioValue = $("input[name='marker']:checked").val();

                        var taskStartTimeValue = document.getElementById("start-date").value;
                        var taskEndTimeValue = document.getElementById("end-date").value;

                        info.title = taskTitle.val();
                        info.start = taskStartTimeValue;
                        info.end = taskEndTimeValue;
                        info.className = radioValue;

                        $('#calendar').fullCalendar('updateEvent', info);
                        modal.style.display = "none";
                        modalResetData();
                        document.getElementsByTagName('body')[0].removeAttribute('style');
                    });
                                                    },
            selectable: true,
            selectHelper: true,

        });
    });

    function displayMessage(message) {
        toastr.success(message, 'Event');
    }

</script>




@endsection
