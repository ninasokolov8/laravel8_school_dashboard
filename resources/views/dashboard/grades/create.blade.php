@extends('layouts.dashboardl')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.grades.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("dashboard.grades.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="required" for="class_id">{{ trans('cruds.grades.fields.class') }}</label>
                    <select class="form-control select2 {{ $errors->has('class') ? 'is-invalid' : '' }}" name="class_id"
                            id="class_id" required>
                        @foreach($classes as  $class)
                            <option value="{{ $class->id }}" >{{ $class->name }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('class'))
                        <div class="invalid-feedback">
                            {{ $errors->first('class') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.grades.fields.class_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="required" for="user_id">{{ trans('cruds.grades.fields.student') }}</label>

                    <select class="form-control select2 " name="user_id" id="user_id" required>
                        @foreach($classes as  $class)
                            @foreach($class->classUsers as  $student)

                                <option value="{{ $student->id }}" >{{  $student->name }}</option>

                            @endforeach
                        @endforeach
                    </select>
                    @if($errors->has('student'))
                        <div class="invalid-feedback">
                            {{ $errors->first('student') }}
                        </div>
                    @endif

                    <span class="help-block">{{ trans('cruds.grades.fields.student_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="required" for="lesson_id">{{ trans('cruds.grades.fields.lesson') }}</label>
                    <select class="form-control select2 " name="lesson_id" id="lesson_id" required>
                        @foreach($classes as  $class)
                            @foreach($class->classLessons as  $lesson)
                                <option value="{{ $lesson->id }}_{{$lesson->teacher_id}}" >{{$weekDays[$lesson->weekday]}}- {{$lesson->start_time}} - {{$lesson->end_time}}</option>
                            @endforeach
                        @endforeach
                    </select>
                    @if($errors->has('lesson'))
                        <div class="invalid-feedback">
                            {{ $errors->first('lesson') }}
                        </div>
                    @endif

                    <span class="help-block">{{ trans('cruds.grades.fields.lesson_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="required" for="end_time">{{ trans('cruds.grades.fields.grade') }}</label>
                    <input class="form-control {{ $errors->has('grade') ? 'is-invalid' : '' }}" type="text" name="grade" id="grade"  required>
                    @if($errors->has('grade'))
                        <div class="invalid-feedback">
                            {{ $errors->first('grade') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.grades.fields.grade_helper') }}</span>
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