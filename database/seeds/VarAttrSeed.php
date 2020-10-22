<?php

use Illuminate\Database\Seeder;

class VarAttrSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Attributes
        $att1 = \App\Attribute::create([
            'name' => 'Cannabionoide',
        ]);

        $att1->attributeValues()->create([
            'name' => 'CBD'
        ]);
        $att1->attributeValues()->create([
            'name' => 'THC'
        ]);
        $att1->attributeValues()->create([
            'name' => 'THC:CBD'
        ]);


        $att2 = \App\Attribute::create([
            'name' => 'Darreichsformen',
        ]);

        $att2->attributeValues()->create([
            'name' => 'Kapseln'
        ]);
        $att2->attributeValues()->create([
            'name' => 'Vollextrakte'
        ]);
        $att2->attributeValues()->create([
            'name' => 'Cannabisbluten'
        ]);


        $att3 = \App\Attribute::create([
            'name' => 'Genetik-typen',
        ]);

        $att3->attributeValues()->create([
            'name' => 'Indica'
        ]);
        $att3->attributeValues()->create([
            'name' => 'Indica Dominant Hybrid'
        ]);
        $att3->attributeValues()->create([
            'name' => 'Balance 50:50'
        ]);
        $att3->attributeValues()->create([
            'name' => 'Sativa Dominant Hybrid'
        ]);
        $att3->attributeValues()->create([
            'name' => 'Sativa'
        ]);


        // Variations

        $varr1 = \App\Variation::create([
            'name' => 'Pill'
        ]);

        $varr1->variationValues()->create([
            'name' => '30 Stk.'
        ]);
        $varr1->variationValues()->create([
            'name' => '30 Stk.'
        ]);


        $varr2 = \App\Variation::create([
            'name' => 'Weight'
        ]);

        $varr2->variationValues()->create([
            'name' => '5g'
        ]);
        $varr2->variationValues()->create([
            'name' => '15g'
        ]);


        $varr3 = \App\Variation::create([
            'name' => 'Drops'
        ]);

        $varr3->variationValues()->create([
            'name' => '10ml'
        ]);
        $varr3->variationValues()->create([
            'name' => '30ml'
        ]);
    }
}
