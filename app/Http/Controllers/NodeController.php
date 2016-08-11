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
        $nodes = Node::select(['id', 'name', 'description', 'fake_latitude as latitude', 'fake_longitude as longitude', 'physical_description'])->get();

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
        $data = $r->only([
            'name', 'description', 'physical_description',
            'network_id', 'latitude', 'longitude'
        ]);

        $network = Network::find($data['network_id']);
        if (!$network) {
            return redirect('panel/nodos/crear')
                ->with('error', 'Red inválida')
                ->with('model', new Node($data));
        }

        $user = parent::getUser();
        $node = new Node();
        $node->fill($data);
        if ($r->get('privacy_mode')) {
            $node->privacy_mode = true;
            $node->fake_latitude = $node->latitude + self::getRandomDouble();
            $node->fake_longitude = $node->longitude + self::getRandomDouble();
        }
        $user->nodes()->save($node);

        return redirect('panel/nodos')
            ->with('message', 'Nodo creado exitosamente');
    }

    public function edit(Request $r, $id)
    {
        $user = parent::getUser();
        $networks = Network::all();
        $node = $user->nodes()->findOrFail($id);

        return view('nodes.edit')
            ->with('method', 'put')
            ->with('networks', $networks)
            ->with('model', $node);
    }

    public function update(Request $r, $id)
    {
        $user = parent::getUser();
        $node = $user->nodes()->findOrFail($id);
        $data = $r->only([
            'name', 'description', 'physical_description',
            'network_id', 'latitude', 'longitude'
        ]);
        $network = Network::find($data['network_id']);
        if (!$network) {
            return redirect('panel/nodos/crear')
                ->with('error', 'Red inválida')
                ->with('model', $node);
        }
        $node->fill($data);
        $node->privacy_mode = false;
        $node->fake_latitude = $node->latitude;
        $node->fake_longitude = $node->longitude;
        if ($r->get('privacy_mode')) {
            $node->privacy_mode = true;
            $node->fake_latitude = $node->latitude + self::getRandomDouble();
            $node->fake_longitude = $node->longitude + self::getRandomDouble();
        }
        $node->save();

        return redirect('panel/nodos')
            ->with('message', 'Nodo actualizado exitosamente');
    }

    public function destroy(Request $r, $id)
    {
        $user = parent::getUser();
        $node = $user->nodes()->findOrFail($id);
        $result = $node->delete();

        return response()->json([
            'deleted' => $result,
            'status' => 'ok'
        ]);
    }

    private function getRandomDouble()
    {
        $random = random_int(100, 555);
        return ($random % 2 == 0 ? -1 : 1) * doubleval("0.000$random");
    }
}
