<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Unit;
use Exception;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try{
            $categories = Category::all()->toArray();
            $units = Unit::all()->toArray();
            $names = [
                "Smartphone",
                "Laptop",
                "Television",
                "Smartwatch",
                "Tablet",
                "Wireless Earbuds",
                "Fitness Tracker",
                "Dress",
                "Sneakers",
                "Sunglasses",
                "Handbag",
                "Dining Table",
                "Couch",
                "Coffee Maker",
                "Kitchen Knives",
                "Skincare Set",
                "Beard Trimmer",
                "Weightlifting Belt",
                "Hiking Backpack",
                "Mountain Bike",
                "Pet Carrier",
                "Dog Bed",
                "Cat Litter Box",
                "Cookbook",
                "Microphone",
                "Electric Guitar",
                "Drawing Tablet",
                "Sewing Machine",
                "Inkjet Printer",
                "Toaster",
                "Blender",
                "Pots and Pans Set",
                "Plush Toy",
                "Children's Book",
                "Baby Monitor",
                "Diaper Bag",
                "Crib",
                "Playpen",
                "Basketball",
                "Tennis Racket",
                "Golf Balls",
                "Ping Pong Table",
                "Yoga Mat",
                "Wine Glasses",
                "Beer Glasses",
                "Cocktail Shaker",
                "BBQ Grill",
                "Hair Straightener",
                "Curling Iron",
                "Electric Toothbrush",
                "Dehumidifier",
                "Portable Charger",
                "Car Stereo",
                "Windshield Wipers",
                "Flashlight",
                "Tool Set",
                "Clip-on Book Light",
                "Hummingbird Feeder",
                "Garden Shears",
                "Bonsai Tree",
                "Air Fryer",
                "Slow Cooker",
                "Rice Cooker",
                "Waffle Maker",
                "Ice Cream Maker",
                "Popcorn Maker",
                "Cookie Press",
                "Mandoline Slicer",
                "Spiralizer",
                "Nut Milk Bag",
                "Cherry Pitter",
                "Cheese Board",
                "Salad Spinner",
                "Bath Towels",
                "Shower Curtain",
                "Toilet Paper",
                "Laundry Detergent",
                "Multi-Purpose Cleaner",
                "Storage Bins",
                "Felt Hangers",
                "Garment Rack",
                "Drying Rack",
                "Ironing Board",
                "Storage Ottoman",
                "Coffee Table",
                "Bookshelf",
                "Rug",
                "Bed Sheets",
                "Pillows",
                "Mattress",
                "Jewelry Box",
                "Picture Frames",
                "Door Mat",
                "Key Holder",
                "Magnetic Knife Strip",
                "Storage Baskets",
                "Decorative Mirror",
                "Canvas Wall Art",
                "Solar Panels",
                "Solar Powered Lantern",
                "Compost Bin",
                "Rain Barrel",
                "Bee House",
                "Worm Farm",
                "Meat Grinder",
                "Ice Cube Trays",
                "Preserving Jars",
            ];
            
            for($i = 0; $i < count($names); $i++) {  

                $name = Str::random();
                $randomCategory = rand(1, count($categories));
                $randomUnit = rand(1, count($units));

                Product::create([
                    'name'        => $names[$i],
                    'description' => fake()->sentence,
                    'stock'       => rand(1, 100),
                    'variations'  => json_encode(['size' => 'XL', 'price' => rand(1, 1000)]),
                    'category_id' => $randomCategory,
                    'unit_id'     => $randomUnit,
                    'created_by'  => 1
                ]);
            }

        }catch(Exception $e)
        {
            dd($e->getMessage(), $randomCategory, $randomUnit);
        }
      
    }
}
