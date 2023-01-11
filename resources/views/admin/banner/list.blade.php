@extends('admin.layouts.main')

@section('title', 'Banner List')
@section('styles')
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/jquery-datatables-bs3/assets/css/datatables.css') }}" />
@endsection

@section('content')

<section class="panel">
        <header class="panel-heading">
        <div class="panel-actions">
            <a href="{{ route('admin.banner.create') }}" class="btn btn-primary">Add New</a> 
        </div>
    
            <h2 class="panel-title">Banner List</h2>
        </header>
        <div class="panel-body">
               
            <table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="{{ asset('admin/assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf') }}">
                <thead>
                    <tr>
                            
                        <th>Sl No</th>
                        <th>Title</th>
                        <th>Banner</th>
                        <th>Mobile Banner </th>
                        <th>Status</th>
                        <th>Edit</th>
                        <th>Delete</th>
                        <th style="border:0;width:35px;">
                                   
                        </th>
                      
                    </tr>
                </thead>
                <tbody>
                    @foreach ($banners as $key => $banner)
                        <tr>                            
                            <td>{{ $key+1 }}</td>
                            <td>{{ $banner->name }}</td>
                            <td><img src="{{ asset('storage/app/public/banner/'.$banner->large_image)}}" alt="" width="200px"></td>
                            <td><img src="{{ asset('storage/app/public/banner/'.$banner->large_image_mobile)}}" alt="" width="200px" height="200px"></td>
                            <td><a href="{{ route('admin.banner.status', $banner->id) }}" ><i class="fa fa-{{ $banner->status ? 'check' : 'times'}}"></i></a></td>
                            <td><a href="{{ route('admin.banner.edit', $banner->id) }}" ><i class="fa fa-edit"></i></a></td>
                            <td>
                                <form action="{{ route('admin.banner.destroy', $banner->id) }}" method="post">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button type="submit" onclick="return confirm('Are you sure you want to delete?')"><i class="fas fa-trash-alt" aria-hidden="true"></i></button>
                                </form>
                            </td>
                            <td>
                                <div style="float: right"><input type="checkbox" value="{{ $banner->id }}" class="checkbox1" name="check"></div>      
                            </td>                         
                               
                        </tr>
                     @endforeach 
                 
                </tbody>
            </table>
            @if(!empty($banners[0]))
       <div class="data-slct-al">
            <label class="all_lab inline">Select All&nbsp;&nbsp;<input type="checkbox" id="selectall"></label>
            <button class="btn btn-danger padding2 inline" type="button" id="removeall">Remove</button>
       </div>
       @endif
        </div>
       
    </section>

    <div id="deleteModel" class="modal-block mfp-hide">
            <section class="panel">
                <div class="panel-body">
                    <div class="modal-wrapper">
                        <div class="modal-text">
                            <p>Are you sure  want to delete this image ?</p>
                        </div>
                    </div>
                </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <form  method="POST" id="delete-form">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-primary modal-confirm">Confirm</button>
                                <button class="btn btn-default modal-dismiss">Cancel</button>
                            </form>
                        </div>
                    </div>
                </footer>
            </section>
        </div>

@endsection

@section('scripts')
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
            var delete_route = '{{ route('admin.banner.destroy') }}'+'/'+target_id;
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
            var url='{{ route('admin.banner.destroy') }}';
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
