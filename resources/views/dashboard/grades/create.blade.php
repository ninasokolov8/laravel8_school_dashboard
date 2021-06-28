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
                        <option> Please select</option>
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
                        <option> Please select</option>
                    </select>


                </div>

                <div class="form-group">
                    <label class="required" for="lesson_id">{{ trans('cruds.grades.fields.lesson') }}</label>
                    <select class="form-control select2 " name="lesson_id" id="lesson_id" required>
                        <option> Please select</option>
                    </select>

                </div>
                <div class="form-group">
                    <label class="required" for="teacher_id">{{ trans('cruds.grades.fields.teacher') }}</label>
                    <select class="form-control select2 " name="teacher_id" id="teacher_id" required>
<option> Please select</option>
                    </select>

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
    <script type="text/javascript">
        var weekDays ={
            1:'Sunday',
            2:'Monday',
            3:'Tuesday',
            4:'Wednsday',
            5:'Thirsday',
            6:'Friday',
            7:'Saturday',
        }
        $('#class_id').on('change', function() {
            $.ajax({
                type:'get',
                url:'/dashboard/grades/getbyfilter',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data:{
                    val:$(this).val(),
                    param:'id',
                    m:'SchoolClass'
                },
                success:function(data){
                    var sel = $("#user_id");
                    sel.empty();
                    for (var i=0; i<data.data[0].class_users.length; i++) {
                        sel.append('<option value="' + data.data[0].class_users[i].id + '">' + data.data[0].class_users[i].name + '</option>');
                    }

                    var sel2 = $("#lesson_id");
                    sel2.empty();
                    for (var i=0; i<data.data[0].class_lessons.length; i++) {
                        sel2.append('<option value="' + data.data[0].class_lessons[i].id + '">' +weekDays[data.data[0].class_lessons[i].weekday] +'-'+ data.data[0].class_lessons[i].start_time +data.data[0].class_lessons[i].end_time + '</option>');
                    }
                }
            });
        });
        $('#lesson_id').on('change', function() {
            $.ajax({
                type:'get',
                url:'/dashboard/grades/getbyfilter',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data:{
                    val:$(this).val(),
                    param:'id',
                    m:'Lesson'
                },
                success:function(data){
                    var sel = $("#teacher_id");
                    sel.empty();

                        sel.append('<option value="' + data.data[0].teacher.id + '">' + data.data[0].teacher.name + '</option>');

                }
            });
        });

    </script>

@endsection