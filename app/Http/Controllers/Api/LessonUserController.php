<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddUserToLessonRequest;
use App\Http\Requests\RemoveUserFromLessonRequest;
use App\Models\Lesson;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LessonUserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AddUserToLessonRequest $request
     * @return JsonResponse
     */
    public function store(AddUserToLessonRequest $request): JsonResponse
    {
        $lesson = Lesson::findOrFail($request->lessonId);
        $user =User::findOrFail($request->userId);
        $user->lessons()->attach($lesson);
        return response()->json('User added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($user)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(int $id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param RemoveUserFromLessonRequest $request
     * @return JsonResponse
     */
    public function destroy(RemoveUserFromLessonRequest $request): JsonResponse
    {
        $user =User::findOrFail($request->userId);
        $user->lessons()->detach($request->lessonId);
        return response()->json('User removed from this lesson');
    }

}
