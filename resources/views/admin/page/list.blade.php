@extends('admin.layouts.main') 
@section('title') List Pages
@endsection
 
@section('styles')
<link rel="stylesheet" href="{{ asset('admin/assets/vendor/select2/select2.css') }}" />
<link rel="stylesheet" href="{{ asset('admin/assets/vendor/jquery-datatables-bs3/assets/css/datatables.css') }}" />
<!-- Specific Page Vendor CSS -->

<style>
    .custom-panel {
        padding: 5px;
        padding-bottom: 0px;
        padding-top: 0px;
        margin-bottom: 10px;
        width: 100%;
    }

    .custom-panel .title {
        line-height: 8px !important;
    }

    .slide {
        z-index: 5;
    }

    .slide:hover {
        cursor: grab !important;
    }

    /* show above others */

    .is-dragging {
        z-index: 10;
    }


    .ui-sortable-helper {
        transition: none !important;
        animation: pulse 0.4s alternate infinite;
    }

    .sortable-placeholder {
        height: 60px;
        width: 5px;
        border-left: 2px solid #4999DA;
        margin: 0 0 0.75rem 0;
        position: relative;
        z-index: 6;
    }

    @keyframes pulse {
        100% {
            transform: scale(1.1);
        }
    }

    .cloned-slides .slide {
        position: absolute;
        z-index: 1;
    }

    .cloned-slides .slide:before {
        content: attr(data-pos);
    }

    .is-pointer-down {
        cursor: move !important;
        ;
    }
</style>
@endsection
 
@section('content')


<section class="panel">
    <header class="panel-heading">
        <div class="panel-actions">
            {{-- <a href="{{ route('admin.page.create') }}" class="btn btn-primary">Add New</a> --}}
        </div>

        <h2 class="panel-title">Page List</h2>
    </header>
    <div class="panel-body">
        <table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="{{ asset('admin/assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf') }}">
            <thead>
                <tr>

                    <th>Sl No</th>
                    <th>Page Position</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @if(empty($page[0])) @php $i=1; 
@endphp @foreach($pages as $page)
                <tr>

                    <td>{{$i}}</td>
                    <td>{{ $page->position_id }}</td>
                    <td>{{ $page->name }}</td>

                    <td><a href="{{ route('admin.page.status', $page->id) }}"><i class="fa fa-{{ $page->status ? 'check' : 'times'}}"></i></a></td>

                    <td>
                        <a href="{{route('admin.page.edit',$page->id) }}"><i class="fa fa-edit fa-size"></i></a>
                    </td>

                    <td>
                        <form action="{{ route('admin.page.destroy', $page->id) }}" method="post">
                            {{ method_field('DELETE') }} {{ csrf_field() }}
                            <button type="submit" onclick="return confirm('Are you sure you want to delete?')"><i class="fas fa-trash-alt" aria-hidden="true"></i></button>
                        </form>
                    </td>
                    <td>
                        <div style="float: right"><input type="checkbox" value="{{  $page->id}}" class="checkbox1" name="check"></div>
                    </td>
                </tr>
                @php $i++; 
@endphp @endforeach @endif
            </tbody>
        </table>
        <div class="data-slct-al">
            <label class="all_lab inline">Select All&nbsp;&nbsp;<input type="checkbox" id="selectall"></label>
            <button class="btn btn-danger padding2 inline" type="button" id="removeall">Remove</button>
        </div>
    </div>
@endsection
 
@section('scripts')

    <script src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/packery.pkgd.js'></script>
    <script src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/draggabilly.pkgd_copy.js'></script>

    {{--
    <script src="{{ asset('admin/assets/vendor/jquery.gridly/javascripts/jquery.gridly.js') }}"></script> --}}
    <script src="{{ asset('admin/assets/vendor/select2/select2.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/jquery-datatables/media/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/jquery-datatables-bs3/assets/js/datatables.js') }}"></script>

    <script>
        (function( $ ) {

        'use strict';

        var datatableInit = function() {
            var $table = $('#datatable-tabletools');

            $table.dataTable();

        };

        $(function() {
            datatableInit();
        });

    }).apply( this, [ jQuery ]);
    $(function() {
        $('.delete-model').on('click', function(){
            var target_id = $(this).data('id');
            var delete_route = '{{ route('admin.page.index') }}'+'/'+target_id;
            var delete_form = $('#delete-form');

            delete_form.attr("action", delete_route);
        });

        $(document).on('click', '.modal-dismiss', function (e) {
            var delete_form = $('#delete-form');
            delete_form.removeAttr("action");
        });

        var slidesElem = document.getElementsByClassName('slides');
        // var pckry = [];

        function orderModules(){
            
            
            for ( var i=0, len = slidesElem.length; i < len; i++ ) {
                var itemElems = pckry[i].getItemElements();
                $( itemElems ).each( function( i, itemElem ) {
                    itemElems[i].children[0].value = i+1;
                });
            }
        }


        pckry = Array();

        for (let index = 0; index < slidesElem.length; index++) {
            
            var slideSize = getSize( document.querySelector('.slide'));
            pckry[index] = new Packery( slidesElem[index], {
                rowHeight: slideSize.outerHeight
            });
            // get item elements
            var itemElems = pckry[index].getItemElements();
    
    
                // for each item...
            for ( var i=0, len = itemElems.length; i < len; i++ ) {
                var elem = itemElems[i];
                // make element draggable with Draggabilly
                var draggie = new Draggabilly( elem, {
                    axis: 'y'
                });
                // bind Draggabilly events to Packery
                pckry[index].bindDraggabillyEvents( draggie );

            }
            pckry[index].on('dragItemPositioned', orderModules);
            
        }
                
        


        


    });
    </script>
    <script>
        $(document).ready(function() {
         
            $('#selectall').click(function(event) { //on click
                if(this.checked) { // check select status
                    $('.checkbox1').each(function() { //loop through each checkbox
                        this.checked = true;  //select all checkboxes with class "checkbox1"              
                    });
                }else{
                    $('.checkbox1').each(function() { //loop through each checkbox
                        this.checked = false; //deselect all checkboxes with class "checkbox1"                      
                    });        
                }
            });
    
            /*Remove All*/
            $( "#removeall" ).click(function() {
    
            
                var selectedVal = new Array();
                       $('input[name="check"]:checked').each(function() {
                    selectedVal.push(this.value);
                });
                
            
                var values= selectedVal;
              
                var valC=selectedVal.length;
                var url='{{ route('admin.page.destroy') }}';
                if(valC != 0){
                    if(confirm('Are you sure you want to delete?')){
                        $.ajax({
                            type: "DELETE",
                             url: url+'/'+values,
    
                             success: function(data){
                                
                                 location.reload();      
                                 }
                        
                             });
                    }
                    else{
                        //alert("fg");
                    }
                }else{
                    $('#msg').html("Please select at least one record").show().delay(600000000).hide('slow');
                }
            });
            /*End*/
           
        });
    </script>
@endsection