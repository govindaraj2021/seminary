/* Add here all your JS customizations */




//fucntions used by 'page' page
$( document ).ready(function() {

    $('.modal-basic').magnificPopup({
        type: 'inline',
        preloader: false,
        modal: true
    })
    
    $(document).on('click', '.modal-dismiss', function (e) {
        e.preventDefault();
        $.magnificPopup.close();
    });

//helper functions 


function convertToSlug(Text)
{
    return Text
    .toString()
    .trim()
    .toLowerCase()
    .replace(/\s+/g, "-")
    .replace(/[^\w\-]+/g, "")
    .replace(/\-\-+/g, "-")
    .replace(/^-+/, "")
    .replace(/-+$/, "")
    ;
}

    let page_name_el = $('#admin-page #page-name');
    let page_url_el = $('#admin-page #page-url');

    function generateUrlSlugForPage(){
        var page_name;

        $this = $(this);
        page_name = $this.val();
        page_url = convertToSlug(page_name);
        page_url_el.val(page_url);
    }

    page_name_el.on('input', generateUrlSlugForPage)
    page_url_el.on('blur', generateUrlSlugForPage)



    // spesific for [page]
    const page_module_container = $('#page-module');
    const add_btn = $('.add-module');
    const remove_btn = $('.remove-module');

    

    function add_module_widget(){
        var module = $('select[name=module_select]');
        
        var module_val = module.val().split('#');
        var module_name = module_val[0];
        var module_id = module_val[1]

        if(!module_name && !module_id){
            return;
        }
        $('.empty-element').remove();
        let clone_data = `
                <div class="slide">
                    <input type="hidden" name="modules_ord[]" value="">
                    <input type="hidden" name="modules[]" value="${module_id}">
                    <section class="panel panel-featured-left panel-featured-primary">
                        <div class="panel-body">
                            <div class="widget-summary widget-summary-xs">
                                <div class="widget-summary-col">
                                    <div class="summary">
                                        <h4 class="title">${module_name}</h4>
                                    </div>
                                </div>
                                <button type="button" class="mb-xs mt-xs mr-xs btn btn-danger form-control col-md-2 remove-module dragable"><i class="fa fa-times"></i></button>
                            </div>
                            </div>
                    </section>
                </div>`;
        
        

        page_module_container.append(clone_data);
        module.val('');
        module.focus();
    }


    function remove_module_widget(e){
        var $this = $(this);
        var parant = $this.parent().parent().parent().parent();
        var permission_id = parant.find('.permission_id').val();
        console.log(permission_id);
        
        if(permission_id){
            page_module_container.parent().prepend(`<input type="hidden" name="remove[]" value="${ permission_id }">`)
        }
        parant.remove()
    }

    add_btn.on('click', add_module_widget);

    $('body').on('click', '.remove-module',remove_module_widget);


    

});

