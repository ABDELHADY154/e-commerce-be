<?php

namespace App\Http\Livewire;

use App\Category;
use App\Product;
use Kdion4891\LaravelLivewireForms\ArrayField;
use Kdion4891\LaravelLivewireForms\Field;
use Kdion4891\LaravelLivewireForms\FormComponent;

class ProductEditForm extends FormComponent
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
            // Field::make('Photos', 'photos')->file()->multiple()->rules(['required']),
            // Field::make('Sizes', 'sizes')->array([
            //     ArrayField::make('size')->select(['S', 'M', 'L', 'XL'])->rules('required'),
            //     ArrayField::make('quantity')->input('number')->rules('required')
            // ])->rules(['required']),
        ];
    }

    public function success()
    {
        $product = Product::find($this->model->id);
        $product->update([
            'name' => $this->form_data['name'],
            'desc' => $this->form_data['desc'],
            'category_id' => $this->form_data['category_id'],
            'price' => $this->form_data['price'],
            'discount' => $this->form_data['discount'] > 0 ? $this->form_data['discount'] : 0,
            'total_price' => $this->form_data['price'] - ($this->form_data['price'] * ($this->form_data['discount'] / 100)),
            'sale' => $this->form_data['discount'] == 0 ? false : true
        ]);
    }

    public function saveAndStayResponse()
    {
        return redirect(route('product.edit', $this->model));
    }

    public function saveAndGoBackResponse()
    {
        return redirect(route('product.index'));
    }
}
