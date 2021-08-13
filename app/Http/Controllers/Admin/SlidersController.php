<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; 
use App\Http\Requests\StoreSliderRequest;
use App\Http\Requests\UpdateSliderRequest;
use Spatie\MediaLibrary\Models\Media;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Models\Slider;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Alert;

class SlidersController extends Controller
{ 
    use MediaUploadingTrait;

    public function index()
    { 

        $sliders = Slider::all();

        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    { 

        return view('admin.sliders.create');
    }

    public function store(StoreSliderRequest $request)
    {
        $slider = Slider::create($request->all()); 


        if ($request->input('slider', false)) {
            $slider->addMedia(storage_path('tmp/uploads/' . basename($request->input('slider'))))->toMediaCollection('slider');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $slider->id]);
        }

        Alert::success( trans('global.flash.created'));
        return redirect()->route('admin.sliders.index');
    }

    public function edit(Slider $slider)
    { 

        return view('admin.sliders.edit', compact('slider'));
    }

    public function update(UpdateSliderRequest $request, Slider $slider)
    {
        $slider->update($request->all());

        if ($request->input('slider', false)) {
            if (!$slider->slider || $request->input('slider') !== $slider->slider->file_name) {
                if ($slider->slider) {
                    $slider->slider->delete();
                }

                $slider->addMedia(storage_path('tmp/uploads/' . $request->input('slider')))->toMediaCollection('slider');
            }
        } elseif ($slider->slider) {
            $slider->slider->delete();
        }

        Alert::success( trans('global.flash.updated'));
        return redirect()->route('admin.sliders.index');
    }

    public function show(Slider $slider)
    { 

        return view('admin.sliders.show', compact('slider'));
    }

    public function destroy(Slider $slider)
    { 

        $slider->delete();

        Alert::success( trans('global.flash.deleted'));
        return 1;
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
