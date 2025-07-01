<?php

namespace App\Http\Controllers;

use App\Http\Requests\MemberStore;
use App\Http\Requests\MemberUpdate;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Member::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MemberStore $request)
    {
        $validated = $request->validated();
        $member = Member::create($validated);

        if ($member) {
            return response()->json([
                "message" => "Сохранено успешно"
            ], 201);
        } else {
            return response()->json([
                "message" => "Ошибка при сохранении"
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        $data = Member::findOrFail($member->id);
        return $data;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MemberUpdate $request, $id)
    {
        $validated = $request->validated();
        $member = Member::findOrFail($id);
        if ($member) {
            $member->update($validated);
            return response()->json([
                "message" => "Обновлено успешно"
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $member = Member::findOrFail($id);
        if ($member) {
            $member->delete();
            return response()->noContent();
        }
    }
}
