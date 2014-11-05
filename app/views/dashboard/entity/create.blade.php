@section('content')

<ol class="breadcrumb">
    <li><a href="{{ route(".{$name}.index") }}">Сущности</a></li>
    <li class="active">{{ $entity->id ? $entity->title : 'Добавление' }}</li>
</ol>

<div class="row">
    <div class="col-md-9">

        <?php $url = $entity->id ? route(".{$name}.update", $entity->id) : route(".{$name}.store"); ?>

        {{ Form::model($entity, array('url' => $url, 'class' => 'form-horizontal', 'role' => 'form')) }}
        {{ Form::textField('Заголовок', 'title') }}
        {{ Form::colorField('Цвет', 'color') }}
        {{ Form::numberField('Рост', 'height') }}
        {{ Form::imageField('Картинка', 'image') }}
        {{ Form::fileField('Файл', 'file') }}
        {{ Form::dateField('Дата', 'date1') }}
        {{ Form::datetimeField('Дата и время', 'date2') }}
        {{ Form::timeField('Время', 'date3') }}
        {{ Form::selectField('Дата', 'date3', ['Doctor', 'Master', 'Emmy'], 2) }}
        {{ Form::checkboxField('Одобрен', 'confirmed') }}
        {{ Form::geopointField('Расположение', 'place') }}
        {{ Form::textareaField('Описание', 'description') }}
        {{ Form::submitField() }}
        {{ Form::close() }}
    </div>
</div>

@endsection