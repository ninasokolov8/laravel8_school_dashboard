<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySchoolClassRequest;
use App\Http\Requests\StoreSchoolClassRequest;
use App\Http\Requests\UpdateSchoolClassRequest;
use App\Models\SchoolClass;
use http\Client\Response;
use Illuminate\Http\Request;

class SchoolClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schoolClasses = SchoolClass::all();

        return view('dashboard.schoolClasses.index', compact('schoolClasses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.schoolClasses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSchoolClassRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSchoolClassRequest $request)
    {
        $schoolClass = SchoolClass::create($request->all());

        return redirect()->route('dashboard.school-classes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param SchoolClass $schoolClass
     * @return \Illuminate\Http\Response
     */
    public function show(SchoolClass $schoolClass)
    {
        $schoolClass->load('classLessons', 'classUsers');

        return view('dashboard.schoolClasses.show', compact('schoolClass'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param SchoolClass $schoolClass
     * @return \Illuminate\Http\Response
     */
    public function edit(SchoolClass $schoolClass)
    {
        return view('dashboard.schoolClasses.edit', compact('schoolClass'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSchoolClassRequest $request
     * @param SchoolClass $schoolClass
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSchoolClassRequest $request, SchoolClass $schoolClass)
    {
        $schoolClass->update($request->all());

        return redirect()->route('dashboard.school-classes.index');
    }
    public function destroy(SchoolClass $schoolClass)
    {
        $schoolClass->delete();

        return back();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param MassDestroySchoolClassRequest $request
     * @return \Illuminate\Http\Response
     */
    public function massDestroy(MassDestroySchoolClassRequest $request)
    {
        SchoolClass::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
