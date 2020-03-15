<?php

namespace Tupy\Contacts\Traits;

use Illuminate\Support\Facades\Validator;
use Tupy\Contacts\Models\Person;
use Yajra\DataTables\Facades\DataTables;

trait CrudPeoplesTrait
{
    public function search()
    {
        $model = Person::query();

        $model->with(['peopleable']);

        $response = Datatables::of($model)
            ->addColumn('actions', function ($model) {
                $html = '';
                // $html = '<a href="#" class="btn btn-xs btn-default"><i class="fa fa-eye"></i> Visualizar</a>';

                $html .= '<a href="#" class="action-icon" data-id="' . $model->id . '" data-button-type="edit" onclick="editEntry(this)"><i class="mdi mdi-square-edit-outline"></i></a>';

                $html .= '<a href="javascript:void(0)" data-route="#" data-id="' . $model->id . '" class="action-icon" data-button-type="delete" onclick="deleteEntry(this)"><i class="mdi mdi-delete"></i></a>';

                return $html;
            })
            ->rawColumns(['actions'])
            ->make();

        $data = $response->getData(true);

        return response()->json($data, 200);
    }

    public function store()
    {
        $dataForm = request()->all();
        $validator = self::validator($dataForm);

        if ($validator->fails()) {
            return  response()->json(['errors' => $validator->errors()], 401);
        }

        $people = Person::create($dataForm);

        foreach ($dataForm['contacts'] as $key => $contact) {
            \Log::info('contact', $contact);
            $people->contacts()->create($contact);
        }

        $data = [
            'people' => $people,
            'redirect' => '',
        ];

        return response()->json($data, 200);
    }

    public function show()
    {

    }

    public function update(Person $people)
    {
        $dataForm = request()->all();
        $validator = self::validator($dataForm['people']);

        if ($validator->fails()) {
            return  response()->json(['errors' => $validator->errors()], 401);
        }

        $people->update($dataForm['people']);

        foreach ($dataForm['contacts'] as $key => $contact) {
            $people->contacts()->updateOrCreate([
                'type' => $contact['type'],
            ], $contact);
        }

        $data = [
            'people' => $people,
            'redirect' => '',
        ];

        return response()->json($data, 200);
    }

    public function destroy(Person $people)
    {
        try {
            $people->delete();
            return response()->json('Apagado', 200);
        } catch (\Exception $e) {
            return response()->json('Erro ao apagar', 200);
        }
    }

    public function destroyContact($id)
    {
        $contact = Contact::findOrFail($id);
        try {
            $contact->delete();
            return response()->json('Contacto apagado', 200);
        } catch (\Exception $e) {
            return response()->json('Error ao apagar o contacto', 403);
        }

    }

    public function types()
    {
        return response()->json(Contacts::types(), 200);
    }

    protected function validator(array $data, $id = null)
    {
        return Validator::make($data, [
            'name' => 'required|string',
        ]);
    }
}
