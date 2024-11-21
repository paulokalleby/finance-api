<?php

namespace App\Repositories;

use App\Models\Moviment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MovimentRepository
{
    protected $wallet;
    protected $moviment;

    public function __construct(Moviment $moviment)
    {
        $this->wallet   = Auth::user()->wallet;
        $this->moviment = $moviment;
    }

    public function all(array $filters = [])
    {
        $query =  $this->moviment
            ->with('category')
            ->when($filters, function (Builder $query) use ($filters) {

                if (isset($filters['type']))
                    $query->where('type', 'LIKE', "%{$filters['type']}%");
            });

        if (
            isset($filters['paginate']) &&
            is_numeric($filters['paginate'])
        )
            return $query->paginate($filters['paginate']);
        else
            return $query->get();
    }

    public function find(string $id)
    {
        return $this->moviment->with('category')->findOrFail($id);
    }

    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            if ($data['type'] === 'Input')
                $this->wallet->revenue += $data['value'];
            elseif ($data['type'] === 'Output')
                $this->wallet->expense -= $data['value'];

            $this->wallet->save();

            return $this->moviment->create($data);
        });
    }

    public function update(array $data, string $id)
    {
        $moviment = $this->moviment->findOrFail($id);

        return DB::transaction(function () use ($data, $moviment) {

            if ($moviment->type == 'Input') {

                if ($data['type'] == 'Input')
                    $this->wallet->value += ($data['value'] - $moviment->value);
                elseif ($data['type'] == 'Output')
                    $this->wallet->value -= ($data['value'] - $moviment->value);
            } elseif ($moviment->type == 'Output') {

                if ($data['type'] == 'Input')
                    $this->wallet->value += ($data['value'] + $moviment->value);
                elseif ($data['type'] == 'Output')
                    $this->wallet->value -= ($data['value'] + $moviment->value);
            }

            $this->wallet->save();

            $moviment->update($data);

            return response()->json([
                'message' => 'success'
            ], 204);
        });
    }

    public function delete(string $id)
    {
        $moviment = $this->moviment->findOrFail($id);


        return DB::transaction(function () use ($moviment) {

            if ($moviment->type == 'Input')
                $this->wallet->value -= $moviment->value;
            elseif ($moviment->type == 'Output')
                $this->wallet->value += $moviment->value;

            $this->wallet->save();

            $moviment->delete();


            return response()->json([
                'message' => 'success'
            ]);
        });
    }
}
