<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddUserToLessonRequest;
use App\Http\Requests\RemoveUserFromLessonRequest;
use App\Models\Lesson;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->paginate(5);

        return view('dashboard.admin.users.users', compact('users'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try{
            $data = $request->validate([
                'username' => ['required', 'string', 'max:255'],
                'fullname' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
            $user =  User::create([
                'username' => $data['username'],
                'fullname' => $data['fullname'],
                'email' => $data['email'],
                'password' => \Hash::make($data['password']),
            ]);
            RoleUser::create([
                'user_id' => $user->id,
                'role_id' => $data['role']??2
            ]);

        }catch (\Exception $e){
            dd($e->getMessage());
        }
        return redirect()->route('admin.users')
            ->with('success', 'User created successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($user)
    {
        return view('dashboard.admin.users.user', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user =User::findOrFail($id);
        $user->role = $user->getRoleName($id);
        $message =['username'=>'wrong'];
        $errors =['username'=>'wrong'];
        return view('dashboard.admin.users.edit',compact('user','message','errors') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'fullname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
        $user =User::findOrFail($id);
        $user->update($request->all());

        return redirect()->route('admin.users')
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($user)
    {
        $user->delete();

        return redirect()->route('dashboard.admin.users')
            ->with('success', 'User deleted successfully');
    }






    public function addUserToLesson(AddUserToLessonRequest $request): \Illuminate\Http\JsonResponse
    {
        $lesson = Lesson::findOrFail($request->lessonId);
        $user =User::findOrFail($request->userId);
        $user->lessons()->attach($lesson);
        return response()->json('User added successfully!');
    }
    public function removeUserFromLesson(RemoveUserFromLessonRequest $request): \Illuminate\Http\JsonResponse
    {
        $user =User::findOrFail($request->userId);
        $user->lessons()->detach($request->lessonId);
        return response()->json('User removed from this lesson');
    }
}
