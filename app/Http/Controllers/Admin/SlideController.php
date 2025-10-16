<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slide;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class SlideController extends Controller
{
    public function slides()
    {
        $slides = Slide::orderBy('created_at', 'DESC')->paginate(5);
        return view('admin.slides.slides', ['slides' => $slides]);
    }

    public function slide_add()
    {
        return view('admin.slides.slide-add');
    }


    public function slide_store(Request $request)
    {
        try {
            $data = [
                'tagline' => 'required|string|max:255',
                'title' => 'required|string|max:255',
                'subtitle' => 'required',
                'link' => 'required|url',
                'image' => ['required', 'mimes:jpeg,png,jpg'],
                'status' => 'required'
            ];

            $validator = validator($request->all(), $data);

            if ($validator->fails()) {
                $validator->errors();
                return Redirect::back()->withErrors($validator)->withInput()->with('error', $validator->errors()->first());
            }

            // Initialize imageName as null for cases where no image is provided
            $imageName = null;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('uploads/slides', $imageName, 'public');
            }

            // Create the brand, image will be null if no image is uploaded
            Slide::create([
                'tagline' => $request->tagline,
                'title' => $request->title,
                'subtitle' => $request->subtitle,
                'link' => $request->link,
                'image' => $imageName,
                'status' => $request->status
            ]);

            return redirect()->route('admin.slides')->with('success', 'Slide added successfully!');
        } catch (\Exception $e) {
            return redirect()->route('admin.slides')->with('error', $e->getMessage());
        }
    }

    public function slide_edit($id)
    {

        $slide = Slide::findOrFail($id);

        return view('admin.slides.slide-edit', ['slide' => $slide]);
    }


    public function slide_update(Request $request, $id)
    {
        $data = [
            'tagline' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'link' => 'required|url',
            'image' => ['nullable', 'mimes:jpeg,png,jpg'],
            'status' => 'nullable|boolean'
        ];

        $validator = validator($request->all(), $data);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput()->with('error', $validator->errors()->first());
        }

        $slide = Slide::findOrFail($id);


        $updateData = [
            'tagline' => $request->tagline,
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'link' => $request->link,
            'status' => $request->status
        ];


        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('uploads/slides', $imageName, 'public');

            if ($slide->image && Storage::disk('public')->exists('uploads/slides/' . $slide->image)) {
                Storage::disk('public')->delete('uploads/slides/' . $slide->image);
            }



            $updateData['image'] = $imageName;
        }


        $slide->update($updateData);

        return redirect()->route('admin.slides')->with('success', 'Slide updated successfully!');
    }

    public function destroySlide(Request $request)
    {
        $slide = Slide::findOrFail($request->id);
        if ($slide->image && Storage::disk('public')->exists('uploads/slides/' . $slide->image)) {
            Storage::disk('public')->delete('uploads/slides/' . $slide->image);
        }

        $slide->delete();
        return redirect()->route('admin.slides')->with('success', 'Slide deleted successfully!');
    }
}
