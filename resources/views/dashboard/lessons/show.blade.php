@extends('layouts.dashboardl')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.lesson.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('dashboard.lessons.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.lesson.fields.id') }}
                        </th>
                        <td>
                            {{ $lesson->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lesson.fields.class') }}
                        </th>
                        <td>
                            {{ $lesson->class->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lesson.fields.teacher') }}
                        </th>
                        <td>
                            {{ $lesson->teacher->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lesson.fields.weekday') }}
                        </th>
                        <td>
                            {{ $lesson->weekday }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lesson.fields.start_time') }}
                        </th>
                        <td>
                            {{ $lesson->start_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lesson.fields.end_time') }}
                        </th>
                        <td>
                            {{ $lesson->end_time }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('dashboard.lessons.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>

        </div>

    </div>


</div>
<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">

        <li class="nav-item">
            <a class="nav-link" href="#class_users" role="tab" data-toggle="tab">
                {{ trans('cruds.user.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="class_users">
            @includeIf('dashboard.lessons.relationships.classUsers', ['users' => $lesson->class->classUsers])
        </div>
    </div>
</div>



@endsection