<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Node;

class NodeController extends Controller
{
    public function index(Request $r)
    {
        $nodes = Node::paginate();

        return view('nodes.index')
            ->with('nodes', $nodes);
    }

    public function show(Request $r, $id)
    {
        $node = Node::findOrFail($id);

        return view('nodes.details')
            ->with('model', $node);
    }

    public function create(Request $r)
    {
        return view('nodes.edit')
            ->with('method', 'post')
            ->with('model', new Node());
    }

    public function store(Request $r)
    {
        $node = new Node($r->all());
        $node = $node->save();

        return redirect('panel/nodos')
            ->with('message', 'Nodo creado exitosamente');
    }

    public function edit(Request $r, $id)
    {
        $node = Node::findOrFail($id);
        return view('nodes.edit')
            ->with('method', 'put')
            ->with('model', $node);
    }

    public function update(Request $r, $id)
    {
        $node = Node::findOrFail($id);
        $node->fill($r->all());
        $node->save();

        return redirect('panel/nodos')
            ->with('message', 'Nodo actualizado exitosamente');
    }

    public function destroy(Request $r, $id)
    {
        $node = Node::findOrFail($id);
        return $node->delete();
    }
}
