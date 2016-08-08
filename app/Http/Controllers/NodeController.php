<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Node;
use App\Models\Network;

class NodeController extends Controller
{
    public function all()
    {
        $nodes = Node::all();

        return response()->json($nodes, 200);
    }

    public function index(Request $r)
    {
        $user = Auth::user();
        $nodes = $user->nodes()->paginate(15);

        return view('nodes.index')
            ->with('nodes', $nodes);
    }

    public function show(Request $r, $id)
    {
        $user = Auth::user();
        $node = $user->nodes()->findOrFail($id);

        return view('nodes.details')
            ->with('model', $node);
    }

    public function create(Request $r)
    {
        $networks = Network::all();

        return view('nodes.edit')
            ->with('networks', $networks)
            ->with('method', 'post')
            ->with('model', new Node());
    }

    public function store(Request $r)
    {
        $user = Auth::user();
        $node = new Node($r->all());
        $user->nodes()->save($node);

        return redirect('panel/nodos')
            ->with('message', 'Nodo creado exitosamente');
    }

    public function edit(Request $r, $id)
    {
        $user = Auth::user();
        $node = $user->nodes()->findOrFail($id);

        return view('nodes.edit')
            ->with('method', 'put')
            ->with('model', $node);
    }

    public function update(Request $r, $id)
    {
        $user = Auth::user();
        $node = $user->nodes()->findOrFail($id);
        $node->fill($r->all());
        $node->save();

        return redirect('panel/nodos')
            ->with('message', 'Nodo actualizado exitosamente');
    }

    public function destroy(Request $r, $id)
    {
        $user = Auth::user();
        $node = $user->nodes()->findOrFail($id);
        $result = $node->delete();

        return response()->json([
            'deleted' => $result,
            'status' => 'ok'
        ]);
    }
}
