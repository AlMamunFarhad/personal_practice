'use strict' ;
$('#social-media-links').on('submit', function (event){
    event.preventDefault();
    let getData = $('#get-social-media-links-data');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    $.ajax({
        url: $(this).attr('action'),
        method: $(this).attr('method'),
        data: $(this).serialize(),
        success: function (response) {
            if (response.status === 'success') {
                toastr.success(getData.data('success'));
            }else if (response.status === 'update') {
                toastr.success(getData.data('info'));
            }
            $('#name').val('');
            $('#link').val('');
            $('#icon').val('');
            $('#id').val('');
            $('#actionBtn').html(getData.data('save'));
            $('#social-media-links').attr('action',getData.data('action'));
            fetchSocialMedia();
        },
        error: function (xhr, status, error) {
            let errorMessage = 'An error occurred';
            if (xhr.responseJSON && xhr.responseJSON.message) {
                errorMessage = xhr.responseJSON.message;
            } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                // Handle validation errors
                let errors = xhr.responseJSON.errors;
                errorMessage = Object.values(errors).flat().join(', ');
            } else if (xhr.status === 422) {
                errorMessage = 'Validation error. Please check your input.';
            }
            toastr.error(errorMessage);
            console.error('Update error:', xhr.responseJSON || error);
        },
    });
})

$('.social-media-status-form').on('submit', function(event){
    event.preventDefault();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    $.ajax({
        url: $(this).attr('action'),
        method: $(this).attr('method'),
        data: $(this).serialize(),
        success: function () {
            toastr.success($('#get-update-status-message').data('success'));
        }
    });
});

$(document).on('click','.edit' ,function () {
    let update = $('#get-update');
    let updateView = $('#get-update-view');
    $('#actionBtn').html(update.data('text'));
    $('#social-media-links').attr('action', update.data('action'));
    let id = $(this).attr('id');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    $.ajax({
        url: updateView.data('action'),
        method: 'POST',
        data: {id: id},
        success: function (data) {
            $(window).scrollTop(0);
            $('#id').val(data.id);
            $('#name').val(data.name);
            $('#link').val(data.link);
            $('#icon').val(data.icon);
            fetchSocialMedia()
        }
    });
});
$(document).on('click', '.delete', function () {
    let id = $(this).attr('id');
    let deleteData = $('#get-delete');
    if (confirm(deleteData.data('confirm'))) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.ajax({
            url: deleteData.data('action'),
            method: 'POST',
            data: {id: id},
            success: function () {
                fetchSocialMedia();
                toastr.success(deleteData.data('success'));
            }
        });
    }
});
fetchSocialMedia();
function fetchSocialMedia() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    $.ajax({
        url: $('#get-fetch-route').data('action'),
        method: 'GET',
        success: function (data) {
            const getToggleStatusText= $('#get-toggle-status-text');
            // Clear tbody first
            $('tbody').html('');
            if (data.length !== 0) {
                let html = '';
                for (let count = 0; count < data.length; count++) {
                    html += '<tr>';
                    // Column 1: Serial Number
                    html += '<td class="column_name" data-column_name="sl" data-id="' + data[count].id + '">' + (count + 1) + '</td>';
                    // Column 2: Name
                    html += '<td class="column_name" data-column_name="name" data-id="' + data[count].id + '">' + data[count].name + '</td>';
                    // Column 3: Link
                    html += '<td class="column_name" data-column_name="link" data-id="' + data[count].id + '">' + data[count].link + '</td>';
                    
                    // Column 4: Icon - display icon only
                    let iconDisplay = '';
                    let iconClass = '';
                    if (data[count].icon && data[count].icon !== null && data[count].icon !== undefined && String(data[count].icon).trim() !== '') {
                        iconClass = String(data[count].icon).trim();
                        
                        // Convert Font Awesome 4.x/5.x format to 6.x format
                        // Map social media icons to Font Awesome 6 brands
                        const socialIconMap = {
                            'fa fa-facebook': 'fa-brands fa-facebook',
                            'fa fa-twitter': 'fa-brands fa-twitter',
                            'fa fa-instagram': 'fa-brands fa-instagram',
                            'fa fa-linkedin': 'fa-brands fa-linkedin',
                            'fa fa-pinterest': 'fa-brands fa-pinterest',
                            'fa fa-google-plus': 'fa-brands fa-google-plus-g',
                            'fa fa-google-plus-square': 'fa-brands fa-google-plus-g',
                            'fab fa-facebook': 'fa-brands fa-facebook',
                            'fab fa-twitter': 'fa-brands fa-twitter',
                            'fab fa-instagram': 'fa-brands fa-instagram',
                            'fab fa-linkedin': 'fa-brands fa-linkedin',
                            'fab fa-pinterest': 'fa-brands fa-pinterest',
                        };
                        
                        // Check if we have a direct mapping
                        if (socialIconMap[iconClass]) {
                            iconClass = socialIconMap[iconClass];
                        } else {
                            // Convert general formats
                            iconClass = iconClass
                                .replace(/^fab\s+fa-/, 'fa-brands fa-')  // fab fa-facebook -> fa-brands fa-facebook
                                .replace(/^fas\s+fa-/, 'fa-solid fa-')   // fas fa-* -> fa-solid fa-*
                                .replace(/^far\s+fa-/, 'fa-regular fa-')  // far fa-* -> fa-regular fa-*
                                .replace(/^fa\s+fa-([a-z-]+)/, function(match, iconName) {
                                    // For social media icons, use fa-brands, otherwise fa-solid
                                    const socialIcons = ['facebook', 'twitter', 'instagram', 'linkedin', 'pinterest', 'google-plus', 'youtube', 'tiktok', 'snapchat', 'whatsapp'];
                                    if (socialIcons.some(si => iconName.includes(si))) {
                                        return 'fa-brands fa-' + iconName;
                                    }
                                    return 'fa-solid fa-' + iconName;
                                });
                        }
                        
                        iconDisplay = '<div class="d-flex align-items-center justify-content-center" style="min-height: 40px;"><i class="' + iconClass + '" style="font-size: 24px; color: #333;"></i></div>';
                    } else {
                        iconDisplay = '<span class="text-muted">-</span>';
                    }
                    html += '<td class="column_name text-center" data-column_name="icon" data-id="' + data[count].id + '" style="vertical-align: middle; min-width: 80px;">' + iconDisplay + '</td>';

                    // Column 5: Status - toggle switch
                    html += `<td class="column_name text-center" data-column_name="status" data-id="${data[count].id}" style="vertical-align: middle;">
                                <form action="${getToggleStatusText.data('action')}" method="post" id="social-media-status${data[count].id}-form" class="social-media-status-form">
                                <input type="hidden" name="id" value="${data[count].id}">
                                    <label class="switcher mx-auto">
                                        <input type="checkbox" class="switcher_input toggle-switch-message" id="social-media-status${data[count].id}" name="status" value="1" ${data[count].active_status === 1 ? "checked" : ""}
                                           data-modal-id = "toggle-status-modal"
                                           data-toggle-id = "social-media-status${data[count].id}"
                                           data-on-image = "category-status-on.png"
                                           data-off-image = "category-status-off.png"
                                           data-on-title = "${getToggleStatusText.data('turn-on-text')+' '+data[count].name+' '+getToggleStatusText.data('status')}"
                                           data-off-title = "${getToggleStatusText.data('turn-off-text')+' '+data[count].name+' '+getToggleStatusText.data('status')}"
                                           data-on-message = "<p>${getToggleStatusText.data('on-message')}</p>"
                                           data-off-message = "<p>${getToggleStatusText.data('off-message')}</p>">
                                        <span class="switcher_control"></span>
                                    </label>
                                </form>
                            </td>`;
                    html += '<td><a type="button" class="btn btn-outline--primary btn-xs edit square-btn" id="' + data[count].id + '"><i class="tio-edit"></i></a> </td></tr>';
                }
                $('tbody').html(html);
                $('.toggle-switch-message').on('click',function (event){
                    event.preventDefault();
                    let rootPath = $('#get-root-path-for-toggle-modal-image').data('path');
                    const modalId = $(this).data('modal-id')
                    const toggleId = $(this).data('toggle-id');
                    const onImage = rootPath +'/'+$(this).data('on-image');
                    const offImage = rootPath +'/'+$(this).data('off-image');
                    const onTitle = $(this).data('on-title');
                    const offTitle = $(this).data('off-title');
                    const onMessage = $(this).data('on-message');
                    const offMessage = $(this).data('off-message');
                    toggleModal(modalId, toggleId, onImage, offImage, onTitle, offTitle, onMessage, offMessage)
                });
            }
        }
    });
}
