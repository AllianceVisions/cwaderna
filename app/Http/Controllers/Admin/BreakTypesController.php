<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBreakTypeRequest;
use App\Http\Requests\StoreBreakTypeRequest;
use App\Http\Requests\UpdateBreakTypeRequest;
use App\Models\BreakType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BreakTypesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('break_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $breakTypes = BreakType::all();

        return view('admin.breakTypes.index', compact('breakTypes'));
    }

    public function create()
    {
        abort_if(Gate::denies('break_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.breakTypes.create');
    }

    public function store(StoreBreakTypeRequest $request)
    {
        $breakType = BreakType::create($request->all());

        return redirect()->route('admin.break-types.index');
    }

    public function edit(BreakType $breakType)
    {
        abort_if(Gate::denies('break_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.breakTypes.edit', compact('breakType'));
    }

    public function update(UpdateBreakTypeRequest $request, BreakType $breakType)
    {
        $breakType->update($request->all());

        return redirect()->route('admin.break-types.index');
    }

    public function show(BreakType $breakType)
    {
        abort_if(Gate::denies('break_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.breakTypes.show', compact('breakType'));
    }

    public function destroy(BreakType $breakType)
    {
        abort_if(Gate::denies('break_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $breakType->delete();

        return back();
    }

    public function massDestroy(MassDestroyBreakTypeRequest $request)
    {
        BreakType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
