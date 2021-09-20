<?php

namespace App\Http\Livewire;

use App\Brand;
use App\Category;
use App\Product;
use App\ProductImage;
use App\ProductSize;
use Illuminate\Support\Facades\Storage;
use Kdion4891\LaravelLivewireForms\ArrayField;
use Kdion4891\LaravelLivewireForms\Field;
use Kdion4891\LaravelLivewireForms\FormComponent;

class ProductCreateForm extends FormComponent
{

    public function fields()
    {
        $catSelect = [];
        $categories = Category::all();
        foreach ($categories as  $cat) {
            $array = array($cat->brand->gender->gender_name . ' | ' . $cat->brand->brand . ' | ' . $cat->category => $cat->id);
            $catSelect +=  $array;
        }
        return [
            Field::make('Name', 'name')->input()->rules(['required', 'string']),
            Field::make('Description', 'desc')->textarea()->rules(['nullable', 'string']),
            Field::make('Category', 'category_id')->select($catSelect)->rules(['required', 'exists:categories,id']),
            Field::make('Price', 'price')->input('number')->rules(['required', 'integer']),
            Field::make('Discount %', 'discount')->input('float')->rules(['nullable', 'numeric'])->placeholder('30'),
            Field::make('Photos', 'photos')->file()->multiple()->rules(['required']),
            Field::make('Sizes', 'sizes')->array([
                ArrayField::make('size')->select(['XS', 'S', 'M', 'L', 'XL', 'XXL'])->rules('required'),
                ArrayField::make('quantity')->input('number')->rules('required')
            ])->rules(['required']),
        ];
    }

    public function success()
    {
        $quantity = 0;
        foreach ($this->form_data['sizes'] as $size) {
            $quantity += $size['quantity'];
        }
        $product = Product::create([
            'name' => $this->form_data['name'],
            'desc' => $this->form_data['desc'],
            'category_id' => $this->form_data['category_id'],
            'price' => $this->form_data['price'],
            'quantity' => $quantity,
            'discount' => $this->form_data['discount'] > 0 ? $this->form_data['discount'] : 0,
            'total_price' => $this->form_data['price'] - ($this->form_data['price'] * ($this->form_data['discount'] / 100)),
            'sale' => $this->form_data['discount'] == 0 ? false : true
        ]);

        foreach ($this->form_data['photos'] as $photo) {
            Storage::move('public/' . $photo["file"], 'public/products/' . basename($photo["file"]));
            ProductImage::create([
                'image' =>  basename($photo["file"]),
                'product_id' => $product->id,
            ]);
        }
        foreach ($this->form_data['sizes'] as $size) {
            ProductSize::create([
                'size' => $size['size'],
                'quantity' => $size['quantity'],
                'product_id' => $product->id
            ]);
        }

        // Product::create($this->form_data);
    }

    public function saveAndStayResponse()
    {
        // dd($this->form_data);
        return redirect(route('product.create'));
    }

    public function saveAndGoBackResponse()
    {
        // dd($this->form_data);
        return redirect(route('product.index'));
    }
}
