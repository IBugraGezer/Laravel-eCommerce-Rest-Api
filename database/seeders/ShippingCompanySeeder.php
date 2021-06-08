<?php

namespace Database\Seeders;

use App\Models\ShippingCompany;
use Illuminate\Database\Seeder;

class ShippingCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ShippingCompany::create([
            'company_name' => 'CompanyA',
            'tracking_link' => '#'
        ]);

        ShippingCompany::create([
            'company_name' => 'CompanyB',
            'tracking_link' => '#'
        ]);

        ShippingCompany::create([
            'company_name' => 'CompanyC',
            'tracking_link' => '#'
        ]);

    }
}
