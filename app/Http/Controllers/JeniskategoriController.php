<?php

namespace App\Http\Controllers;

use App\Models\Jeniskategori;
use Illuminate\Http\Request;
use App\Http\Resources\JeniskategoriResource;
use Illuminate\Support\Facades\Validator;

class JeniskategoriController extends Controller
{
     //
     /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get posts
        $jeniskategoris = Jeniskategori::latest()->get();

        //return collection of posts as a resource
        return new JeniskategoriResource(true, 'List Data jeniskategoris', $jeniskategoris);
    }

     /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'kategori'   => 'required',
            'nama'       => 'required',
            'status'     => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //upload image
        // $image = $request->file('image');
        // $image->storeAs('public/posts', $image->hashName());

        //create jeniskategoriuuuuu bukan posttt!!!
        $jeniskategori = Jeniskategori::create([
            'kategori'      => $request->kategori,
            'nama'     => $request->nama,
            'status'    => $request->status,
            
        ]);

        //return response
        return new JeniskategoriResource(true, 'Data jeniskategori Berhasil Ditambahkan!', $jeniskategori);
    }
    /**
     * show
     *
     * @param  mixed $post
     * @return void
     */
    public function show(Jeniskategori $jeniskategori)
    {
        //return single post as a resource
        return new JeniskategoriResource(true, 'Data jeniskategori Ditemukan!', $jeniskategori);
    }

     /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $post
     * @return void
     */
    public function update(Request $request, Jeniskategori $jeniskategori)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'kategori'   => 'required',
            'nama'       => 'required',
            'status'     => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //check if image is not empty
        if ($request->hasFile('id')) {

            //upload image
            $id = $request->file('id');
            $id->storeAs('public/jeniskategoris', $id->hashName());

            //delete old image
            Storage::delete('public/jeniskategoris/'.$jeniskategori->id);
             
            //update post with new image
            $jeniskategori->update([
            'id'           => $id->hashName(),
            'kategori'     => $request->kategori,
            'nama'         => $request->nama,
            'status'       => $request->status,
            ]);

        } else {

            //update post without image
            $jeniskategori->update([
            'kategori'     => $request->kategori,
            'nama'         => $request->nama,
            'status'       => $request->status,
            ]);
        }

        //return response
        return new JeniskategoriResource(true, 'Data jeniskategori Berhasil Diubah!', $jeniskategori);
    }

    /**
     * destroy
     *
     * @param  mixed $post
     * @return void
     */
    public function destroy(Jeniskategori $jeniskategori)
    {
        //delete image
        // Storage::delete('public/jeniskategoris/'.$jeniskategori->id);

        //delete post
        $jeniskategori->delete();

        //return response
        return new JeniskategoriResource(true, 'Data jeniskategori Berhasil Dihapus!', null);
    }
}
