<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    //

    public function addCategory()
    {
        return view('admin.addcategory');
    }

    public function postAddCategory(Request $request)
    {
        $category = new Category();
        $category->category = $request->category;
        $category->save();
        return redirect()->back()->with('category_message', 'Category added successfully!');
    }

    public function viewCategory()
    {
        $categories = Category::all();
        return view('admin.viewcategory', compact('categories'));
    }

    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->back()->with('deletecategory_message', 'Delete successfully');
    }

    public function updateCategory($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.updatecategory', compact('category'));
    }

    public function postUpdateCategory(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $category->category = $request->category;
        $category->update();
        return redirect()->back()->with('category_updated_message', 'Category Updated successfully!');

    }

    public function addProduct()
    {
        $categories = Category::all();
        return view('admin.addproduct', compact('categories'));
    }

    public function postAddProduct(Request $request)
    {
        $product = new Product();
        $product->product_title = $request->product_title;
        $product->product_description = $request->product_description;
        $product->product_quantity = $request->product_quantity;
        $product->product_price = $request->product_price;
        $product->product_category = $request->product_category;

        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $imagename = time() . '.' . $image->extension();
            $image->move(public_path('products'), $imagename);
            $product->product_image = $imagename;
        }

        $product->save();

        return redirect()->back()->with('product_message', 'prodcut added successfully!');


    }

    public function viewProduct()
    {

        $products = Product::paginate(5);
        return view('admin.viewproduct', compact('products'));
    }

    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        if ($product->product_image && File::exists(public_path('products/' . $product->product_image))) {
            File::delete(public_path('products/' . $product->product_image));
        }
        $product->delete();
        return redirect()->back()->with('deleteproduct_message', 'product deleted successfully');
    }


    public function UpdateProduct($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.updateproduct', compact('product', 'categories'));
    }

    public function postUpdateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->product_title = $request->product_title;
        $product->product_description = $request->product_description;
        $product->product_quantity = $request->product_quantity;
        $product->product_price = $request->product_price;
        $product->product_category = $request->product_category;

        if ($request->hasFile('product_image')) {
            $oldPath = public_path('products/' . $product->product_image);
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }
            $image = $request->file('product_image');
            $imagename = time() . '.' . $image->extension();
            $image->move(public_path('products/'), $imagename);

            $product->product_image = $imagename;
            $product->save();
            return redirect()->back()->with('updateproduct_message', 'product update successfully');

        }
    }

    public function searchProduct(Request $request)
    {
        $searchterm = $request->search;
        $products = product::where('product_title', 'LIKE', '%' . $searchterm . '%')
            ->orWhere('product_description', 'LIKE', '%' . $searchterm . '%')
            ->paginate(5);

        return view('admin.viewproduct', compact('products'));
    }
}
