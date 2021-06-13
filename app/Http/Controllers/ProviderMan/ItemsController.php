<?php

namespace App\Http\Controllers\ProviderMan;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait; 
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Category;
use App\Models\Item;
use App\Models\ProviderMan; 
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ItemsController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    { 

        $items = Item::with(['category', 'provider_man.user', 'media'])->where('provider_man_id',auth()->user()->provider_man->id)->get();

        return view('provider_man.items.index', compact('items'));
    }

    public function create()
    { 

        $categories = Category::all()->pluck('name_'.app()->getLocale(), 'id')->prepend(trans('global.pleaseSelect'), ''); 

        return view('provider_man.items.create', compact('categories'));
    }

    public function store(StoreItemRequest $request)
    {
        $item = Item::create($request->all());

        if ($request->input('photo', false)) {
            $item->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $item->id]);
        }

        return redirect()->route('provider-man.items.index');
    }

    public function edit(Item $item)
    { 

        $categories = Category::all()->pluck('name_'.app()->getLocale(), 'id')->prepend(trans('global.pleaseSelect'), ''); 

        $item->load('category', 'provider_man');

        return view('provider_man.items.edit', compact('categories', 'item'));
    }

    public function update(UpdateItemRequest $request, Item $item)
    {
        $item->update($request->all());

        if ($request->input('photo', false)) {
            if (!$item->photo || $request->input('photo') !== $item->photo->file_name) {
                if ($item->photo) {
                    $item->photo->delete();
                }
                $item->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($item->photo) {
            $item->photo->delete();
        }

        return redirect()->route('provider-man.items.index');
    }

    public function show(Item $item)
    {
        abort_if(Gate::denies('item_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $item->load('category', 'provider_man');

        return view('provider_man.items.show', compact('item'));
    }

    public function destroy(Item $item)
    { 

        $item->delete();

        return back();
    } 

    public function storeCKEditorImages(Request $request)
    { 

        $model         = new Item();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}