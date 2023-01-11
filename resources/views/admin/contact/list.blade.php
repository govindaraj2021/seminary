@extends('admin.layouts.main') @php use App\Model\Admin\Contact ;
@endphp
@section('title','Contact Enquiry List')

@section('styles')
<link rel="stylesheet" href="{{ asset('admin/assets/vendor/select2/select2.css') }}" />
<link rel="stylesheet" href="{{ asset('admin/assets/vendor/jquery-datatables-bs3/assets/css/datatables.css') }}" />
<style>
    .new {
        color: #fff;
        background: red;
        padding: 2px;
        border-radius: 0px 11px 6px 8px;
        width: 57px;
        float: left;
        text-align: center;
    }

    .old {
        color: #fff;
        background: green;
        padding: 2px 5px;
        border-radius: 3px;
    }
</style>
@endsection

@section('content')

<section class="panel">
    <header class="panel-heading">
        
        @if(!empty($contacts[0])) @foreach($contacts as $key => $contact)

        <h2 class="panel-title">Contact Enquiry List</h2>

        @break @endforeach @else
        <h2 class="panel-title">Contact Enquiry List</h2>
        @endif

    </header>
    <div class="panel-body">
        <table class="table table-bordered table-striped mb-none" id="datatable-tabletools"
            data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
            <thead>
                <tr>

                    <th>Sl No </th>
                    <th>Seen </th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>View</th>
                    <th>Delete</th>
                    <th style="border:0;width:45px;"></th>
                </tr>
            </thead>
            <tbody>

                @if(!empty($contacts[0]))

                @php $i=1; @endphp

                @foreach($contacts as $key => $contact)
                <tr>

                    <td>{{$i}}</td>
                    <td style="width:20px;">
                        @if(!$contact->seen)
                        <span class="new"><small>Not Seen</small></span> @else
                        <span class="old"><small>Seen</small></span> @endif
                    </td>
                    <td>{{ title_case($contact->name) }}</td>

                    <td>
                        @if($contact->email){{ $contact->email }} @else Not Provided @endif
                    </td>
                    <td>
                        {{ str_limit($contact->message , 60) }}
                    </td>
                    <td>
                        <a href="{{route('admin.contact.show',$contact->id)}}"><i class="fa fa-eye fa-size"></i></a>

                    </td>

                    <td>
                        <form action="{{ route('admin.contact.destroy', $contact->id) }}" method="post">
                            {{ method_field('DELETE') }} {{ csrf_field() }}
                            <button type="submit" onclick="return confirm('Are you sure you want to delete?')"><i
                                    class="fas fa-trash-alt" aria-hidden="true"></i></button>
                        </form>
                    </td>

                    <td>
                        <div style="float: right"><input type="checkbox" value="{{  $contact->id}}" class="checkbox1"
                                name="check"></div>
                    </td>

                </tr>
                @php $i++; @endphp

                @endforeach @endif
            </tbody>

        </table>
        @if(!empty($contacts[0]))
        <div class="data-slct-al">
            <label class="all_lab inline">Select All&nbsp;&nbsp;<input type="checkbox" id="selectall"></label>
            <button class="btn btn-danger padding2 inline" type="button" id="removeall">Remove</button>
        </div>
        @endif
    </div>
    @endsection

    @section('scripts')
    <script src="{{ asset('admin/assets/vendor/select2/select2.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/jquery-datatables/media/js/jquery.dataTables.js') }}"></script>
    <script
        src="{{ asset('admin/assets/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/jquery-datatables-bs3/assets/js/datatables.js') }}"></script>
    <script>
        (function ($) {

            'use strict';

            var datatableInit = function () {
                var $table = $('#datatable-tabletools');

                $table.dataTable();

            };

            $(function () {
                datatableInit();
            });

        }).apply(this, [jQuery]);

        $(function () {
            $('.delete-model').on('click', function () {
                var target_id = $(this).data('id');
                var delete_route = '{{ route('admin.contact.destroy') }}' + '/' + target_id;
                var delete_form = $('#delete-form');

                delete_form.attr("action", delete_route);
            });

            $(document).on('click', '.modal-dismiss', function (e) {
                var delete_form = $('#delete-form');
                delete_form.removeAttr("action");
            });

        });
    </script>
    <script>
        $(document).ready(function () {

            $('#selectall').click(function (event) { //on click
                if (this.checked) { // check select status
                    $('.checkbox1').each(function () { //loop through each checkbox
                        this.checked = true;  //select all checkboxes with class "checkbox1"              
                    });
                } else {
                    $('.checkbox1').each(function () { //loop through each checkbox
                        this.checked = false; //deselect all checkboxes with class "checkbox1"                      
                    });
                }
            });

            /*Remove All*/
            $("#removeall").click(function () {

                var selectedVal = new Array();
                $('input[name="check"]:checked').each(function () {
                    selectedVal.push(this.value);
                });

                var values = selectedVal;
                var valC = selectedVal.length;
                var url = '{{ route('admin.contact.destroy') }}';
                if (valC != 0) {
                    if (confirm('Are you sure you want to delete?')) {
                        $.ajax({
                            type: "DELETE",
                            url: url + '/' + values,

                            success: function (data) {

                                location.reload();
                            }

                        });
                    }
                    else {
                        //alert("fg");
                    }
                } else {
                    $('#msg').html("Please select at least one record").show().delay(600000000).hide('slow');
                }
            });
            /*End*/

        });
    </script>
    @endsection