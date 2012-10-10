@layout('base')

@section('page_title')
    Add a Site Content Page
@endsection

@section('content')

    <h3>Add a Site Content Page</h3>

    {{ Form::open('add_page') }}
        @if (Session::has('success'))
            <h4 class='success'>The page has been added!</h4>
        @endif

        <fieldset><legend>Fill out the form to add a page of content:</legend>
        <p>
        {{ Form::label('title', 'Title') }}<br />
        {{ Form::create_form_input('text', 'title', $errors) }}</p>
        <p>
        {{ Form::label('category_id', 'Category') }}<br />
        <?php
        $options = array('none' => 'Select One');
        foreach (Category::all() as $category)
        {
            $options[$category->id] = $category->category;
        }
        $selected = isset($this->success) ? 'none' : Input::old('category_id');

        $attr['class'] = $errors->first('category_id') ? 'error' : '';
        echo Form::select('category_id', $options, $selected, $attr);
        echo "<span class='error'> " . $errors->first('category_id') . "</span>";
        ?>
        </p>
        <p>
        {{ Form::label('description', 'Description') }}<br/>
        {{ Form::create_form_input('textarea', 'description', $errors, array('rows' => '5', 'cols' => '75')) }}
        </p>
        <p>
        {{ Form::label('content', 'Content') }}<br/>
        {{ Form::create_form_input('textarea', 'content', $errors, array('rows' => '5', 'cols' => '75', 'id' => 'tinyeditor')) }}
        </p>
        <p>
        {{ Form::submit('Add This Page', array('class' => 'formbutton', 'id' => 'submit')) }}

    {{ Form::close() }}

    @include('admin/_editor')

@endsection
