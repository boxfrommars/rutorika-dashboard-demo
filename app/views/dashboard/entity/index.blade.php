@section('content')

<ol class="breadcrumb">
    <li class="active">Пример</li>
</ol>

<div class="row">
    <div class="col-md-9">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Заголовок</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($entities as $entity)
                <tr>
                    <td><a href="{{ route(".{$name}.view", $entity->id) }}">{{ $entity->title }}</a></td>
                    <td class="grid-actions">
                        {{ grid_link($name, 'view', $entity->id) }}
                        {{ grid_link($name, 'destroy', $entity->id) }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <p>
            {{ add_link($name) }}
        </p>

    </div>
    <div class="col-md-3">
    </div>
</div>
@endsection