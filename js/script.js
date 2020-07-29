function custom_appearance(elemId, opacity_percent)
{
    document.querySelector('#'+elemId).setAttribute('style', 'opacity: '+opacity_percent+'%;');

    if (opacity_percent < 100) custom_appearance_timer(elemId, opacity_percent + 1);
}

function custom_appearance_timer(elemid, opacity_percent)
{
    setTimeout(custom_appearance, 5, elemid, opacity_percent);
}

function custom_fading(elemId, op_current, op_final)
{
    document.querySelector('#'+elemId).setAttribute('style', 'opacity: '+op_current+'%;');

    if (op_current > op_final) custom_fading_timer(elemId, op_current - 1, op_final);
}

function custom_fading_timer(elemId, op_current, op_final)
{
    setTimeout(custom_fading, 5, elemId, op_current, op_final);
}

function custom_body_init()
{
    custom_resize_cover();
    custom_regroup_contact_form();
    custom_resize_single_thumbnail();
}

function custom_resize_cover()
{
    var cover = document.querySelector('#cover');

    if (cover) {

        var width = document.body.clientWidth;

        if (width < 550) {

            var cover_width = width - 80;

            if (cover_width <= 0) cover_width = width;
            
            cover.setAttribute('style', 'object-fit: cover; height: '+cover_width+'px; width: '+cover_width+'px;');
        
        } else cover.setAttribute('style', 'object-fit: cover; height: 550px; width: 550px;');

    }
}

function custom_regroup_contact_form()
{
    var dynamic = document.querySelector('#dynamic');

    if (dynamic) {

        var width = document.body.clientWidth;

        if (width < 770) dynamic.innerHTML = '<div class="row"><div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><input type="text" class="form-control" name="email" id="e-mail" placeholder="your e-mail" aria-label="your e-mail" aria-describedby="email_sender" oninput="ipcustom_forms_button_onoff(\'letter_send\', (ipcustom_forms_input_validation(\'e-mail\', \'email\') && ipcustom_forms_input_validation(\'sender_name\', \'text\') && ipcustom_forms_input_validation(\'text_message\', \'text\')));" required><br><input type="text" class="form-control" name="name" id="sender_name" placeholder="your name" aria-label="your name" aria-describedby="name_sender" oninput="ipcustom_forms_button_onoff(\'letter_send\', (ipcustom_forms_input_validation(\'e-mail\', \'email\') && ipcustom_forms_input_validation(\'sender_name\', \'text\') && ipcustom_forms_input_validation(\'text_message\', \'text\')));" required></div></div>';
        else dynamic.innerHTML = '<div class="row"><div class="col-xs-12 col-sm-12 col-md-6 col-lg-6"><input type="text" class="form-control" name="email" id="e-mail" placeholder="your e-mail" aria-label="your e-mail" aria-describedby="email_sender" oninput="ipcustom_forms_button_onoff(\'letter_send\', (ipcustom_forms_input_validation(\'e-mail\', \'email\') && ipcustom_forms_input_validation(\'sender_name\', \'text\') && ipcustom_forms_input_validation(\'text_message\', \'text\')));" required></div><div class="col-xs-12 col-sm-12 col-md-6 col-lg-6"><input type="text" class="form-control" name="name" id="sender_name" placeholder="your name" aria-label="your name" aria-describedby="name_sender" oninput="ipcustom_forms_button_onoff(\'letter_send\', (ipcustom_forms_input_validation(\'e-mail\', \'email\') && ipcustom_forms_input_validation(\'sender_name\', \'text\') && ipcustom_forms_input_validation(\'text_message\', \'text\')));" required></div></div>';

    }

}

function custom_resize_single_thumbnail()
{
    var thumbnail = document.querySelector('#post-thumbnail-single');

    if (thumbnail) {

        var width = document.body.clientWidth;

        if (thumbnail.width > width) {
            
            thumbnail.width = width - 80;
            thumbnail.height = thumbnail.width*288/562;
        
        } else {
            
            thumbnail.width = 562;
            thumbnail.height = 288;
        
        }

    }
}