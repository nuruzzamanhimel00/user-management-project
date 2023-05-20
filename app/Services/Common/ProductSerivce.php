<?php

namespace App\Services\Common;

use Auth;
use App\Models\User;

use App\Models\Product;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;

class ProductSerivce
{
    public $rolesService;
    public function __construct( RolesService $rolesService)
    {
        $this->rolesService = $rolesService;
    }

    public function getLatestProducts(){
        return Product::latest()->get();
    }

    public function createOrUpdate($data, $id=null){
        try {
            if(!is_null($id)){

                $data['updated_by'] = Auth::id();
                    $object = Product::findOrFail($id);

                    if (isset($data['image']) && $data['image'] != null) {
                        $data['image'] = $this->uploadFile($data['image'], $object->image) ;
                    }

                      // Update product
                      $object->update($data);
                      return true;


            }else{
                $data['created_by'] = Auth::id();
                if (isset($data['image']) && $data['image'] != null) {
                    $data['image'] = $data['is_api_image'] ?? $this->uploadFile($data['image']);
                }
                // Store product
                $product = Product::create($data);
                return $product = $product->fresh();
            }
        } catch (\Exception $th) {
            throw $th;
        }

    }

    public function uploadFile($file, $old_name = null, $upload_path = null)
    {
        $path = !is_null($upload_path) ? $upload_path : Product::FILE_STORE_PATH_IMAGE;
        if ($old_name) {
            // Delete and upload
            // Delete old
            $this->delete($path . '/' . $old_name);
            // Upload new
            return $this->upload($file, ($path ?? null));
        } else {
            // Upload
            return $this->upload($file, ($path ?? null));
        }
    }

    public function upload($file, $path = 'others', $use_original_name = false)
    {
        try {
            if (!$use_original_name) {
                $name = time() . rand(1111, 9999) . '.' . $file->getClientOriginalExtension();
            } else {
                $full_name = $file->getClientOriginalName();
                $extract_name = explode('.', $full_name);

                $name = generateSlug($extract_name[0]) . '-' . time() . '.' . $file->getClientOriginalExtension();
            }
            // Store image to public disk
            $file->move($path, $name);
            // $file->storeAs($path, $name);
            return $name ?? '';
        } catch (\Exception $ex) {
            return '';
        }
    }
    public function delete($path = '')
    {
        try {
            // Delete image form public directory

                // Storage::disk('public')->delete($path);
           if (file_exists($path)) unlink($path);
        } catch (\Exception $ex) {
        }
    }

    public function productDelete($product){
        if(!is_null($product->image)){
            $path = Product::FILE_STORE_PATH_IMAGE;
            $this->delete($path . '/' . $product->image);
        }

        $product->delete();
        return true;

    }
}
