<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Network;
use App\Models\User;


class NetworkController extends Controller
{
    public function index()
    {
        $networks = Network::paginate(10);

        return view('networks.index')
            ->with('networks', $networks);
    }

    public function create()
    {
        $users = User::all();

        return view('networks.edit')
            ->with('method', 'post')
            ->with('model', new Network())
            ->with('users', $users);
    }

    public function store(Request $r)
    {
        \DB::beginTransaction();
        $network = new Network();

        try {
            $user = User::findOrFail($r->get('owner'));
            $network->fill($r->only(['name', 'description', 'features']));
            $network->save();

            // Default owner and admin
            $user->networks()->attach($network->id, ['is_admin' => true, 'is_owner' => true]);

            \DB::commit();
        } catch(Exception $e) {
            \DB::rollback();
            abort(500);
        }

        return redirect('/panel/redes')
            ->with('message', 'Red creada exitosamente');
    }

    public function edit($id)
    {
        $user = parent::getUser();
        $network = $user->networks()->findOrFail($id);

        return view('networks.edit')
            ->with('method', 'put')
            ->with('model', $network);
    }

    public function update(Request $r, $id)
    {
        $user = parent::getUser();
        $network = $user->networks()->findOrFail($id);
        $network->fill($r->only(['name', 'description', 'features']));
        $network->save();

        return redirect("/panel/redes/{$id}/editar")
            ->with('message', 'Datos actualizados exitosamente');
    }

    public function destroy(Request $r, $id)
    {
        $user = parent::getUser();
        $network = $user->networks()->findOrFail($id);
        $network->delete();

        return response()->json([
            'status' => 'ok'
        ], 200);
    }
}
