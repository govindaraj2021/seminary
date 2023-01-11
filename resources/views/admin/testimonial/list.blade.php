<?php use \Illuminate\Support\Str ; ?>

@extends('admin.layouts.main')
@section('title', 'Testimonial List')
@section('styles')
<link rel="stylesheet" href="{{ asset('admin/assets/vendor/select2/select2.css') }}" />
<link rel="stylesheet" href="{{ asset('admin/assets/vendor/jquery-datatables-bs3/assets/css/datatables.css') }}" />
@endsection

@section('content')

<section class="panel">
    <header class="panel-heading">
        <div class="panel-actions">

            <a href="{{ route('admin.testimonial.create') }}" class="btn btn-primary">Add New</a>
        </div>

        <h2 class="panel-title">Testimonial List</h2>
    </header>
    <div class="panel-body">
        <table class="table table-bordered table-striped mb-none" id="datatable-tabletools"
            data-swf-path="{{ asset('admin/assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf') }}">
            <thead>
                <tr>
                    <th></th>
                    <th>Sl No</th>
                    <th>Name</th>
                    <th>Testimonial</th>

                    <th>Status</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($testimoniales[0])) @php $i=1;
                @endphp
                @foreach($testimoniales as $testimonial)
                <tr>
                    <td>
                        <div style="float: right"><input type="checkbox" value="{{$testimonial->id}}"
                                class="checkbox1" name="check"></div>
                    </td>
                    <td>{{$i}}</td>
                    <td>{{ $testimonial->name }}</td>


                    <td>
                    @if($testimonial->is_video == 1)
                        <button type="button" class="btn btn-primary video-btn" data-toggle="modal"
                        data-src="https://www.youtube.com/embed/{{$testimonial->link}}" data-target="#myModal">
                        Play Video 
                      </button>
                    @else 
                        {!! \Illuminate\Support\Str::limit($testimonial->testimonial, 200) !!}
                        @endif
                    </td>


                    <td><a href="{{ route('admin.testimonial.status', ['id' => $testimonial->id]) }}"><i
                                class="fa fa-{{ $testimonial->status ? 'check' : 'times'}}"></i></a></td>
                    <td>
                        <a href="{{route('admin.testimonial.edit',$testimonial->id) }}"><i
                                class="fa fa-edit fa-size"></i></a>
                    </td>
                    <td>
                        <form action="{{ route('admin.testimonial.destroy', $testimonial->id) }}" method="post">
                            {{ method_field('DELETE') }} {{ csrf_field() }}
                            <button type="submit" onclick="return confirm('Are you sure you want to delete?')"><i
                                    class="fa fa-trash" aria-hidden="true"></i></button>
                        </form>
                    </td>
                </tr>
                @php $i++;
                @endphp @endforeach @endif
            </tbody>
        </table>
        <div class="data-slct-al" style="padding-top:10px;">
            <label class="all_lab inline">Select All&nbsp;&nbsp;<input type="checkbox" id="selectall"></label>
            <button class="btn btn-danger padding2 inline" type="button" id="removeall">Remove</button>
        </div>
    </div>






<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-body">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <!-- 16:9 aspect ratio -->
        <div class="embed-responsive embed-responsive-16by9">
          <iframe class="embed-responsive-item" src="" id="video"
            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>

      </div>

    </div>
  </div>
</div>



    @endsection

    @section('scripts')


    <script src="{{ asset('admin/assets/vendor/select2/select2.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/jquery-datatables/media/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js') }}"></script>
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

//    
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
                var url = '{{ route('admin.testimonial.destroys') }}';
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



        $(document).ready(function() {
        // Gets the video src from the data-src on each button
        var $videoSrc;
        $(".video-btn").click(function() {
          $videoSrc = $(this).attr("data-src");
          console.log("button clicked" + $videoSrc);
        });
      
        // when the modal is opened autoplay it
        $("#myModal").on("shown.bs.modal", function(e) {
          console.log("modal opened" + $videoSrc);
          // set the video src to autoplay and not to show related video. Youtube related video is like a box of chocolates... you never know what you're gonna get
          $("#video").attr(
            "src",
            $videoSrc + "?autoplay=1&showinfo=0&modestbranding=1&rel=0&mute=1"
          );
        });
      
        // stop playing the youtube video when I close the modal
        $("#myModal").on("hide.bs.modal", function(e) {
          // a poor man's stop video
          $("#video").attr("src", $videoSrc);
        });
      
        // document ready
      });



    </script>
    @endsection