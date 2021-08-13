<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; 
use Spatie\MediaLibrary\Models\Media;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use Illuminate\Http\Request;
use App\Models\GeneralSettings; 
use Alert;

class GeneralSettingsController extends Controller
{
    use MediaUploadingTrait;
    
    public function index()
    {  
        $general_settings = GeneralSettings::first();

        return view('admin.generalSettings.edit',compact('general_settings'));
    }

    public function update(Request $request)
    {
        $general_settings = GeneralSettings::first();

        $general_settings->update($request->all());

        if ($request->input('logo', false)) {
            if (!$general_settings->logo || $request->input('logo') !== $general_settings->logo->file_name) {
                if ($general_settings->logo) {
                    $general_settings->logo->delete();
                }

                $general_settings->addMedia(storage_path('tmp/uploads/' . $request->input('logo')))->toMediaCollection('logo');
            }
        } elseif ($general_settings->logo) {
            $general_settings->logo->delete();
        }

        Alert::success(trans('global.flash.success'));
        return back();
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('general_setting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new GeneralSettings();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}