@extends('layouts.dashboardl')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.grades.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("dashboard.grades.update", [$grade->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <div class="form-group">
                        <a class="btn btn-default" href="{{ route('dashboard.grades.index') }}">
                            {{ trans('global.back_to_list') }}
                        </a>
                    </div>
                    <table class="table table-bordered table-striped">
                        <tbody>
                        <tr>
                            <th>
                                {{ trans('cruds.grades.fields.id') }}
                            </th>
                            <td>
                                {{ $grade->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.grades.fields.grade') }}
                            </th>
                            <td>
                                <div class="form-group">
                                    <label class="required" for="end_time">{{ trans('cruds.grades.fields.grade') }}</label>
                                    <input class="form-control {{ $errors->has('grade') ? 'is-invalid' : '' }}" type="text" name="grade" id="grade" value="{{ old('end_time', $grade->grade) }}" required>
                                    @if($errors->has('grade'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('grade') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.grades.fields.grade_helper') }}</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.grades.fields.class') }}
                            </th>
                            <td>
                                {{ $grade->classes->name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.grades.fields.student') }}
                            </th>
                            <td>
                                {{ $grade->students->name ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.grades.fields.teacher') }}
                            </th>
                            <td>
                                {{ $grade->teachers->name ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                        <tr>
                            <th>
                                {{ trans('cruds.grades.fields.lesson') }}
                            </th>

                        <tr>
                            <td>
                                {{ trans('cruds.grades.fields.weekDay') }} - {{ $weekDays[$grade->lessons->weekday]  ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                {{ trans('cruds.lesson.fields.start_time') }} -   {{ $grade->lessons->start_time }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                {{ trans('cruds.lesson.fields.end_time') }} -   {{ $grade->lessons->end_time }}
                            </td>

                        </tr>



                        </tbody>
                    </table>
                    <div class="form-group">
                        <a class="btn btn-default" href="{{ route('dashboard.grades.index') }}">
                            {{ trans('global.back_to_list') }}
                        </a>
                    </div>
                </div>
            </div>


            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection