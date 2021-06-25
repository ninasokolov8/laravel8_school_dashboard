<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLessonRequest;
use App\Http\Requests\UpdateLessonRequest;
use App\Models\Lesson;
use App\Models\SchoolClass;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LessonsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $lessons = Lesson::all()->toArray();;//->paginate(5);

      /*  return view('dashboard.lessons.index', compact('lessons'))
            ->with('i', (request()->input('page', 1) - 1) * 5);*/

        return response()->json(compact('lessons'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        $classes = SchoolClass::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $teachers = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('dashboard.lessons.create', compact('classes', 'teachers'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(StoreLessonRequest $request)
    {
        $lesson = Lesson::create($request->all());

        return redirect()->route('dashboard.lessons.index')
            ->with('success', 'User created successfully.');


    }

    /**
     * Display the specified resource.
     *
     * @param Lesson $lesson
     * @return Application|Factory|View|Response
     */
    public function show(Lesson $lesson)
    {


        $lesson->load('class', 'teacher');

        return view('dashboard.lessons.show', compact('lesson'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Lesson $lesson
     * @return Application|Factory|View|Response
     */
    public function edit(Lesson $lesson)
    {
        $classes = SchoolClass::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $teachers = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lesson->load('class', 'teacher');

        return view('dashboard.lessons.edit', compact('classes', 'teachers', 'lesson'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */

    public function update(UpdateLessonRequest $request, Lesson $lesson)
    {
        $lesson->update($request->all());

        return redirect()->route('dashboard.lessons.index');
    }


    public function destroy(Lesson $lesson)
    {


        $lesson->delete();

        return back();
    }
}
