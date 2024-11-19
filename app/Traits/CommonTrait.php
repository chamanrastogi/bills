<?php

namespace App\Traits;

use Illuminate\Http\Request;


trait CommonTrait
{
    public function StatusUpdate(Request $request)
    {
        $modelClass = 'App\\Models\\' . (($request->table));
        $table = $modelClass::find($request->id);
        $table->update([
            'status' => ($table->status == 1) ? 0 : 1,
        ]);

        return ($table->status == 0) ? 'active' : 'deactive';
    }
    public function delete(Request $request)
    {
        $modelClass = 'App\\Models\\' . (($request->table));
        if (is_array($request->id)) {
            $table = $modelClass::whereIn('id', $request->id);
        } else {
            $table = $modelClass::find($request->id);
        }        
        $table->delete();
        $notification = array(
            'message' => ''.ucfirst($request->table).' Record Deleted successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function deletewithImage(Request $request)
    {
        $modelClass = 'App\\Models\\' . (($request->table));
        if (is_array($request->id)) {
            $categories = $modelClass::whereIn('id', $request->id);
            foreach ($categories as $categorie) {
                if (file_exists($categorie->image)) {
                    $img = explode('.', $categorie->image);
                    $small_img = $img[0] . "_" . $this->image_preset[0]->name . "." . $img[1];
                    unlink($small_img);
                    unlink($categorie->image);
                }
            }
        } else {
            $categories = $modelClass::find($request->id);
            if (file_exists($categories->image)) {
                $img = explode('.', $categories->image);
                $small_img = $img[0] . "_" . $this->image_preset[0]->name . "." . $img[1];
                unlink($small_img);
                unlink($categories->image);
            }
        }



        $categories->delete();
        $cat = ($categories->type == 1) ? 'Category' : 'Service';
        $notification = array(
            'message' => '' . $cat . ' Deleted successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }
}
