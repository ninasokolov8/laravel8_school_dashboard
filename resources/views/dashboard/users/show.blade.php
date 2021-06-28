@extends('layouts.dashboardl')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.user.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('dashboard.users.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>

                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.id') }}
                        </th>
                        <td>
                            {{ $user->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <td>
                            {{ $user->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <td>
                            {{ $user->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.email_verified_at') }}
                        </th>
                        <td>
                            {{ $user->email_verified_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.roles') }}
                        </th>
                        <td>
                            @foreach($user->roles as $key => $roles)
                                <span class="label label-info">{{ $roles->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.class') }}
                        </th>
                        <td>
                            {{ $user->class->name ?? '' }}
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('dashboard.users.index') }}">
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

        @foreach($user->roles as $key => $roles)
            @if($roles->id ==4)
                <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
                    <li class="nav-item">
                        <a class="nav-link" href="#lessons" role="tab" data-toggle="tab">
                            {{ trans('cruds.lesson.title') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="lessons">
                        @includeIf('dashboard.users.relationships.studentLessons', ['lessons' => $user->lessons])
                    </div>
                </div>
            @else
                <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
                    <li class="nav-item">
                        <a class="nav-link" href="#teacher_lessons" role="tab" data-toggle="tab">
                            {{ trans('cruds.lesson.title') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#class_users" role="tab" data-toggle="tab">
                            {{ trans('cruds.user.title') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="teacher_lessons">
                        @includeIf('dashboard.users.relationships.teacherLessons', ['lessons' => $user->teacherLessons])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="class_users">
		                <?php $students = []; ?>
                        @foreach($user->teacherLessons as $class)
                            @foreach($class->class->classUsers as $student)
                                <span style="display:none;"> {{array_push($students,$student)}}</span>
                            @endforeach
                        @endforeach
                        @includeIf('dashboard.users.relationships.classUsers', ['users' => $students])
                    </div>
                </div>

            @endif
        @endforeach

    </div>

@endsection
