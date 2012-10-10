<?php

Form::macro('create_form_input', function($type, $name, $errors, $attr = array())
{   
    if ($errors->has($name))
    {
        $attr['class'] = 'error';
    }
    
    switch ($type)
    {    
        case 'password':                        
            $form = Form::password($name, $attr);
            break;

        case 'textarea':
            $form = Form::textarea($name, Input::old($name), $attr);
            break;

        default:
            $form = Form::text($name, Input::old($name), $attr);
            break;
    }
    return $form . $errors->first($name, ' <span class="error">:message</span>');
});


Form::macro('selected', function($path)
{
    return URI::is($path) ? 'class="selected"' : '';
});

function d($value)
{
	return Laravel\HTML::decode($value);
}
