<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; 
use App\Http\Requests\StoreProviderManRequest;
use App\Http\Requests\UpdateProviderManRequest;
use App\Models\ProviderMan;
use App\Models\User;
use App\Models\City;
use App\Models\Nationality;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProviderManController extends Controller
{
    public function update_approved(Request $request){
        $user = User::find($request->id);
        $user->approved = $request->status;
        if($user->save()){
            return ['message' => trans('global.flash.user.approve') , 'type' => 'success'];
        }
        return ['message' => trans('global.flash.error') , 'type' => 'danger'];
    }
    public function index()
    {
        abort_if(Gate::denies('provider_man_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $providerMen = ProviderMan::with(['user'])->get();

        return view('admin.providerMen.index', compact('providerMen'));
    }

    public function create()
    {
        abort_if(Gate::denies('provider_man_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cities = City::get()->pluck('name_'.app()->getLocale(), 'id')->prepend(trans('global.pleaseSelect'), ''); 
        $nationalites = Nationality::get()->pluck('name_'.app()->getLocale(), 'id')->prepend(trans('global.pleaseSelect'), ''); 


        return view('admin.providerMen.create', compact('cities','nationalites'));
    }

    public function store(StoreProviderManRequest $request)
    {
        $validated_requests = $request->validated();
        $validated_requests['password'] = bcrypt($request->password);
        $validated_requests['user_type'] = 'provider_man';
        $validated_requests['approved'] = 1;
        $user = User::create($validated_requests); 
        $providerMan = ProviderMan::create([
            'user_id' => $user->id,
            'company_name' => $request->company_name,
            'commerical_reg_num' => $request->commerical_reg_num,
            'working_field' => $request->working_field,
            'website' => $request->website,
        ]);

        return redirect()->route('admin.provider-men.index');
    }

    public function edit(ProviderMan $providerMan)
    {
        abort_if(Gate::denies('provider_man_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cities = City::get()->pluck('name_'.app()->getLocale(), 'id')->prepend(trans('global.pleaseSelect'), ''); 
        $nationalites = Nationality::get()->pluck('name_'.app()->getLocale(), 'id')->prepend(trans('global.pleaseSelect'), ''); 

        $providerMan->load('user');

        return view('admin.providerMen.edit', compact('cities', 'providerMan','nationalites'));
    }

    public function update(UpdateProviderManRequest $request, ProviderMan $providerMan)
    {  
        $user = User::findOrFail($providerMan->user_id);
        $user->update($request->all()); 
        $providerMan = ProviderMan::where('user_id',$user->id)->first();
        $providerMan->update($request->all()); 
        
        return redirect()->route('admin.provider-men.index');
    }

    public function show(ProviderMan $providerMan)
    {
        abort_if(Gate::denies('provider_man_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $providerMan->load('user');

        return view('admin.providerMen.show', compact('providerMan'));
    }

    public function destroy(ProviderMan $providerMan)
    {
        abort_if(Gate::denies('provider_man_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $providerMan->delete();

        return back();
    } 
}