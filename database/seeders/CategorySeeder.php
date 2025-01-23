<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // Level 1
        $manufacturing = $this->createCategory('Manufacturing');
        $technology = $this->createCategory('Technology');
        $healthcare = $this->createCategory('Healthcare');
        $financial = $this->createCategory('Financial Services');
        $energy = $this->createCategory('Energy');

        // Level 2
        $automotive = $this->createCategory('Automotive', $manufacturing->id);
        $industrialEquipment = $this->createCategory('Industrial Equipment', $manufacturing->id);

        $software = $this->createCategory('Software', $technology->id);
        $hardware = $this->createCategory('Hardware', $technology->id);

        $medicalDevices = $this->createCategory('Medical Devices', $healthcare->id);
        $pharmaceuticals = $this->createCategory('Pharmaceuticals', $healthcare->id);

        $banking = $this->createCategory('Banking', $financial->id);
        $insurance = $this->createCategory('Insurance', $financial->id);

        $renewableEnergy = $this->createCategory('Renewable Energy', $energy->id);
        $oilGas = $this->createCategory('Oil & Gas', $energy->id);

        // Level 3
        // Manufacturing > Automotive branch
        $vehicleParts = $this->createCategory('Vehicle Parts', $automotive->id);
        $assemblyPlants = $this->createCategory('Assembly Plants', $automotive->id);
        $automotiveElectronics = $this->createCategory('Automotive Electronics', $automotive->id);

        // Manufacturing > Industrial Equipment branch
        $this->createCategory('Heavy Machinery', $industrialEquipment->id);
        $this->createCategory('Precision Tools', $industrialEquipment->id);

        // Technology > Software branch
        $this->createCategory('Enterprise Solutions', $software->id);
        $this->createCategory('Mobile Applications', $software->id);

        // Technology > Hardware branch
        $this->createCategory('Semiconductors', $hardware->id);
        $this->createCategory('Computer Systems', $hardware->id);
        $this->createCategory('Network Equipment', $hardware->id);

        // Healthcare > Medical Devices branch
        $this->createCategory('Diagnostic Equipment', $medicalDevices->id);
        $this->createCategory('Surgical Tools', $medicalDevices->id);

        // Healthcare > Pharmaceuticals branch
        $this->createCategory('Research & Development', $pharmaceuticals->id);
        $this->createCategory('Manufacturing Facilities', $pharmaceuticals->id); // Changed name to avoid conflict

        // Financial > Banking branch
        $this->createCategory('Retail Banking', $banking->id);
        $this->createCategory('Investment Banking', $banking->id);

        // Financial > Insurance branch
        $this->createCategory('Life Insurance', $insurance->id);
        $this->createCategory('Property Insurance', $insurance->id);

        // Energy > Renewable Energy branch
        $this->createCategory('Solar', $renewableEnergy->id);
        $this->createCategory('Wind', $renewableEnergy->id);

        // Energy > Oil & Gas branch
        $this->createCategory('Exploration', $oilGas->id);
        $this->createCategory('Refining', $oilGas->id);

        // Level 4 (for the deepest branch)
        $powertrain = $this->createCategory('Powertrain Components', $vehicleParts->id);
        $this->createCategory('Body Components', $vehicleParts->id);

        // Level 5
        $this->createCategory('Electric Motor Systems', $powertrain->id);
        $this->createCategory('Transmission Systems', $powertrain->id);
    }

    private function createCategory(string $name, ?int $parentId = null): Category
    {
        $slug = Str::slug($name);
        
        // If there's a parent, prefix the slug with parent's slug to ensure uniqueness
        if ($parentId) {
            $parentSlug = Category::find($parentId)->slug;
            $slug = $parentSlug . '-' . $slug;
        }

        return Category::create([
            'name' => $name,
            'slug' => $slug,
            'parent_id' => $parentId
        ]);
    }
}