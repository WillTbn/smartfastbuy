<?php

namespace Tests\Feature\Adm;

use App\Models\Category;
use App\Models\Condominia;
use App\Models\Product;
use App\Models\ProductBarcodes;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    // TESTE TEM QUE SER REFEITO DA FORMA CORRETA
    // public function test_index_page_shows_products_with_total_quantity()
    // {
    //     $user = User::factory()->create();
    //     $cond = Condominia::factory()->create();
    //     $resp = User::factory()->create();
    //     $resp->account()->create([
    //         'person' => fake('pt_BR')->cpf(),
    //         'telephone' => fake('pt_BR')->phoneNumber(),
    //         'phone' => fake('pt_BR')->cellphone(),
    //         'birthday' => fake()->date('Y-m-d'),
    //         'notifications' => 'accepted',
    //         'condominia_id' => $cond->id
    //     ]);


    //     $cond2 = Condominia::factory()->create();
    //     $cate = Category::factory()->create();
    //     // crie
    //     $product1 = Product::factory()->create([
    //         'name' => 'Império 473ml',
    //         'value' => 2.99,
    //         'sku' => 'IMPMAL473',
    //         'description' => 'Pilsen Puro malte',
    //         'category_id'=>$cate->id,
    //         'type'=> 'PuroMalte',
    //         'user_id' =>$user->id
    //     ]);
    //     $product2 = Product::factory()->create([
    //         'name' => 'Brahma 473ml',
    //         'sku' => 'BRAPIL473',
    //         'value' => 2.99,
    //         'description' => 'cerveja pilsen',
    //         // 'account_id'=> 1,
    //         'category_id'=>$cate->id,
    //         'type'=> 'Pilsen',
    //         'user_id' =>$user->id
    //     ]);
    //     ProductBarcodes::factory()->create([
    //         'product_id' => $product1->id,
    //         'barcode' =>   random_int(100000000000, 1999999999999),
    //         'condominia_id'=> $cond->id,
    //         'quantity' =>  10,
    //     ]);
    //     ProductBarcodes::factory()->create([
    //         'product_id' => $product2->id,
    //         'barcode' =>   random_int(100000000000, 1999999999999),
    //         'condominia_id'=> $cond->id,
    //         'quantity' =>   random_int(0, 50),
    //     ]);
    //     ProductBarcodes::factory()->create([
    //         'product_id' => $product1->id,
    //         'barcode' =>   random_int(100000000000, 1999999999999),
    //         'condominia_id'=> $cond->id,
    //         'quantity' =>   30,
    //     ]);
    //     ProductBarcodes::factory()->create([
    //         'product_id' => $product2->id,
    //         'barcode' =>   random_int(100000000000, 1999999999999),
    //         'condominia_id'=> $cond2->id,
    //         'quantity' =>   random_int(0, 50),
    //     ]);
    //     ProductBarcodes::factory()->create([
    //         'product_id' => $product1->id,
    //         'barcode' =>   random_int(100000000000, 1999999999999),
    //         'condominia_id'=> $cond2->id,
    //         'quantity' =>   30,
    //     ]);

    //     $response = $this->actingAs($resp)->get(route('products.index'));

    //     // $response->assertRedirect('products');

    //     // dd($response);
    //     $response->assertSee('products');
    //     // $response->assertSee($products[0]['Império 473ml']);
    //     // $response->assertSee('Brahma 473ml');
    //     // $response = $this->actingAs($user)->get(route('products.index'));
    //     // $response->assertSee($product2->name);
    //     // $response = $this->actingAs($user)->get(route('products.index'));
    //     // $response->assertSee(['products' => 'Império 473ml']);



    // }

    // public function test_get_one_product()
    // {
    //     $user = User::factory()->create();

    //     $cond = Condominia::factory()->create();
    //     $cate = Category::factory()->create();
    //     // crie
    //     $product1 = Product::factory()->create([
    //         'name' => 'Império 473ml',
    //         'value' => 2.99,
    //         'sku' => 'IMPMAL473',
    //         'description' => 'Pilsen Puro malte',
    //         'category_id'=>$cate->id,
    //         'type'=> 'PuroMalte',
    //         'user_id' =>$user->id
    //     ]);
    //     $barcode1 = ProductBarcodes::factory()->create([
    //         'product_id' => $product1->id,
    //         'barcode' =>   random_int(100000000000, 1999999999999),
    //         'quantity' =>  10,
    //     ]);
    //     $response = $this->actingAs($user)->get(route('products.oneproduct', $product1->id));

    //     // dd($response);
    // }
}
