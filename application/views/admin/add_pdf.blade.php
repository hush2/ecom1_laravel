@layout('base')

@section('page_title')
    Add a PDF
@endsection

@section('content')

    @if (Session::has('success'))
        <h4 class='success'>The PDF has been added!</h4>
    @endif

    <h3>Add a PDF</h3>

    {{ Form::open_for_files('add_pdf') }}
        <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
        <fieldset><legend>Fill out the form to add a PDF to the site:</legend>
        <p>
        {{ Form::label('title', 'Title') }}<br />
        {{ Form::create_form_input('text', 'title', $errors); }}
        </p>
        <p>
        {{ Form::label('description', 'Description') }}<br />
        {{ Form::create_form_input('textarea', 'description', $errors, array('rows' => '5', 'cols' => '75')) }}
        </p>
        <p>
        {{ Form::label('pdf', 'PDF') }}<br />
        <input type="file" name="pdf" id="pdf">
            <span class='error'>{{ $errors->first('pdf') }}
                {{ Session::has('failed') ? 'Error uploading PDF file.' : '' }}
            </span>
        <small>PDF only, 1MB Limit</small></p>

        <p>{{ Form::submit('Add This PDF', array('class' => 'formbutton')) }}</p>

        </fieldset>
    {{ Form::close() }}

@endsection