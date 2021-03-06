<?php

namespace App\Http\Controllers;

use App\Events\UserWasCreated;
use App\Events\UserWasUpdated;
use App\Http\Requests\UsersRequest;
use App\Profile;
use App\User;
use App\Role;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
	/**
	 * Middleware user validation
	 */
	public function __construct()
	{
		$this->middleware('auth', ['except' => ['show']]);
		$this->middleware('active', ['except' => ['show']]);
		$this->middleware('profilePerms', ['only' => ['edit', 'update']]);
		$this->middleware('UserPermAccess', ['except' => ['edit', 'update', 'show']]);
		$this->middleware('AvoidDeleteUser', ['only' => ['destroy']]);
	}

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
		$roles = Role::all();
		return View('usuarios.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View('usuarios.create');
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param UsersRequest $request
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
    public function store(UsersRequest $request)
    {
		event(new UserWasCreated($request->all()));
		return redirect('usuarios');
    }

	/**
	 * Display the specified resource.
	 *
	 * @param $slug
	 * @return \Illuminate\Http\RedirectResponse|View
	 */
    public function show($slug)
    {
		$usuario = User::findBySlug($slug);

		if(is_null($usuario->profile)){
			$profiles = Profile::create([
				'user_id'	=> $usuario->id,
				'avatar'	=> 'avatar-001.jpg'
			]);
			$profiles->save();
			return redirect('usuarios')->with('flash_message', 'Perfil creado, intente ingresar de nuevo');
		}

		return View('usuarios.show', compact('usuario'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
		$usuario = User::findOrFail($id);
		return View('usuarios.edit', compact('usuario'));
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param UsersRequest $request
	 * @param $id
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
    public function update(UsersRequest $request, $id)
    {

		$user = User::findOrFail($id);
		event(new UserWasUpdated($request->all(), $id));
		return redirect('usuarios/' . $user->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
		$user = User::findOrFail($id);
		$user->delete();
		return 'done';
    }
}
