<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'BABY SCOOTER (With battery)',
                'sea_price_start' => 1000, 'sea_price_end' => 1040, 'air_price_start' => 1200, 'air_price_end' => 1290,
            ],
            [
                'name' => 'QUILT',
                'sea_price_start' => 900, 'sea_price_end' => 940, 'air_price_start' => 1100, 'air_price_end' => 1190,
            ],
            [
                'name' => 'PILLOW',
                'sea_price_start' => 900, 'sea_price_end' => 940, 'air_price_start' => 1100, 'air_price_end' => 1190,
            ],
            [
                'name' => 'NECK MASSAGER',
                'sea_price_start' => 1000, 'sea_price_end' => 1040, 'air_price_start' => 1200, 'air_price_end' => 1290,
            ],
            [
                'name' => 'MUSICAL STAND',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'MATRESS',
                'sea_price_start' => 900, 'sea_price_end' => 940, 'air_price_start' => 1100, 'air_price_end' => 1190,
            ],
            [
                'name' => 'FOOT EXCERCISE MACHINE',
                'sea_price_start' => 1000, 'sea_price_end' => 1040, 'air_price_start' => 1200, 'air_price_end' => 1290,
            ],
            [
                'name' => 'BABY CHAIR',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'BABY CARRIER',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'HARMONIUM',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'BICYCLE',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'LEG MASSAGER',
                'sea_price_start' => 1000, 'sea_price_end' => 1040, 'air_price_start' => 1200, 'air_price_end' => 1290,
            ],
            [
                'name' => 'NAPPYS',
                'sea_price_start' => 1000, 'sea_price_end' => 1040, 'air_price_start' => 1200, 'air_price_end' => 1290,
            ],
            [
                'name' => 'ARTIFICIAL PLANT',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'CLEANING EQUIPMENT',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'MOSQUITO TABLETS',
                'sea_price_start' => 900, 'sea_price_end' => 940, 'air_price_start' => 1100, 'air_price_end' => 1190,
            ],
            [
                'name' => 'WEB CAM',
                'sea_price_start' => 1200, 'sea_price_end' => 1240, 'air_price_start' => 1400, 'air_price_end' => 1490,
            ],
            [
                'name' => 'SWIMMING WEAR',
                'sea_price_start' => 900, 'sea_price_end' => 940, 'air_price_start' => 1100, 'air_price_end' => 1190,
            ],
            [
                'name' => 'T-SHIRT ',
                'sea_price_start' => 900, 'sea_price_end' => 940, 'air_price_start' => 1100, 'air_price_end' => 1190,
            ],
            [
                'name' => 'MEN’S SHIRT',
                'sea_price_start' => 900, 'sea_price_end' => 940, 'air_price_start' => 1100, 'air_price_end' => 1190,
            ],
            [
                'name' => 'TROUSER',
                'sea_price_start' => 900, 'sea_price_end' => 940, 'air_price_start' => 1100, 'air_price_end' => 1190,
            ],
            [
                'name' => 'BOYE’S JUMPER',
                'sea_price_start' => 900, 'sea_price_end' => 940, 'air_price_start' => 1100, 'air_price_end' => 1190,
            ],
            [
                'name' => 'SWEATER',
                'sea_price_start' => 900, 'sea_price_end' => 940, 'air_price_start' => 1100, 'air_price_end' => 1190,
            ],
            [
                'name' => 'SHAREE (ORDINARY)',
                'sea_price_start' => 900, 'sea_price_end' => 940, 'air_price_start' => 1100, 'air_price_end' => 1190,
            ],
            [
                'name' => 'THREE PCS (ORDINARY)',
                'sea_price_start' => 900, 'sea_price_end' => 940, 'air_price_start' => 1100, 'air_price_end' => 1190,
            ],
            [
                'name' => 'ORNA/ SCARF',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'LADIES DRESSES',
                'sea_price_start' => 900, 'sea_price_end' => 940, 'air_price_start' => 1100, 'air_price_end' => 1190,
            ],
            [
                'name' => 'NIGHTY',
                'sea_price_start' => 900, 'sea_price_end' => 940, 'air_price_start' => 1100, 'air_price_end' => 1190,
            ],
            [
                'name' => 'SHORT SHAWL',
                'sea_price_start' => 900, 'sea_price_end' => 940, 'air_price_start' => 1100, 'air_price_end' => 1190,
            ],
            [
                'name' => 'LINGERIE',
                'sea_price_start' => 900, 'sea_price_end' => 940, 'air_price_start' => 1100, 'air_price_end' => 1190,
            ],
            [
                'name' => 'BRA',
                'sea_price_start' => 900, 'sea_price_end' => 940, 'air_price_start' => 1100, 'air_price_end' => 1190,
            ],
            [
                'name' => 'SOCKS',
                'sea_price_start' => 900, 'sea_price_end' => 940, 'air_price_start' => 1100, 'air_price_end' => 1190,
            ],
            [
                'name' => 'HOODIE',
                'sea_price_start' => 900, 'sea_price_end' => 940, 'air_price_start' => 1100, 'air_price_end' => 1190,
            ],
            [
                'name' => 'TRACKSUIT',
                'sea_price_start' => 900, 'sea_price_end' => 940, 'air_price_start' => 1100, 'air_price_end' => 1190,
            ],
            [
                'name' => 'BABY WEAR',
                'sea_price_start' => 900, 'sea_price_end' => 940, 'air_price_start' => 1100, 'air_price_end' => 1190,
            ],
            [
                'name' => 'CAP（FABRIC)',
                'sea_price_start' => 900, 'sea_price_end' => 940, 'air_price_start' => 1100, 'air_price_end' => 1190,
            ],
            [
                'name' => 'TOWEL',
                'sea_price_start' => 900, 'sea_price_end' => 940, 'air_price_start' => 1100, 'air_price_end' => 1190,
            ],
            [
                'name' => 'BEDSHEET',
                'sea_price_start' => 900, 'sea_price_end' => 940, 'air_price_start' => 1100, 'air_price_end' => 1190,
            ],
            [
                'name' => 'PILLOW COVER',
                'sea_price_start' => 900, 'sea_price_end' => 940, 'air_price_start' => 1100, 'air_price_end' => 1190,
            ],
            [
                'name' => 'BLANKET',
                'sea_price_start' => 900, 'sea_price_end' => 940, 'air_price_start' => 1100, 'air_price_end' => 1190,
            ],
            [
                'name' => 'BUTTON',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'ZIPPER',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'WHEEL STAND',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'MEN’S KEDS/SHOE',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'LADIES FOOTWEAR',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'LADIES SLIPPER',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'BABY FOOTWEAR',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'LADIES HAND PURSE',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'SCHOOL BAG',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'LUNCH BAG',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'BACK PACK',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => "MEN'S WAIST BAG",
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'BABY BREAST PUMP',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'FISHING ROD',
                'sea_price_start' => 780, 'sea_price_end' => 820, 'air_price_start' => 980, 'air_price_end' => 1070,
            ],
            [
                'name' => 'MUSIC KEYBOARD (With Battery)',
                'sea_price_start' => 1200, 'sea_price_end' => 1240, 'air_price_start' => 1400, 'air_price_end' => 1490,
            ],
            [
                'name' => 'GEL PEN',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'PRESSURE MACHINE (BP)',
                'sea_price_start' => 1000, 'sea_price_end' => 1040, 'air_price_start' => 1200, 'air_price_end' => 1290,
            ],
            [
                'name' => 'MUSIC CD DISK',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'METER LEVEL',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'MEASURING INSTURMENT (withOut Battery)',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'WHEEL CHAIR',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'USB HAND FAN (withOut battery)',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'USB HAND FAN (with battery)',
                'sea_price_start' => 1000, 'sea_price_end' => 1040, 'air_price_start' => 1200, 'air_price_end' => 1290,
            ],
            [
                'name' => 'TESTER',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'HAIR STRIGHTNER',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'HAIR DRAYER',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'COOKING POT',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'HAND TOOLS',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'COFFEE MACHINE',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'VACUUM CLEANER',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'AIR FRYER',
                'sea_price_start' => 1000, 'sea_price_end' => 1040, 'air_price_start' => 1200, 'air_price_end' => 1290,
            ],
            [
                'name' => 'HEADPHONE(NO BLUETOOTH)',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'HAND BLANDER',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'RICE COOKER',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'PRESSURE COOKER',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'KETTLE ',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'ROOM HEATER',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'MIXER MACHINE 1800 W',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'MICRO OVEN',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'FOUR BURNER COOKER',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'PRAYER MATT',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'JUICE MACHINE (NO BATTERY)',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'MONITOR 27',
                'sea_price_start' => 1800, 'sea_price_end' => 1840, 'air_price_start' => 2000, 'air_price_end' => 2090,
            ],
            [
                'name' => 'TREAD MILL',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'FACIAL TONNER',
                'sea_price_start' => 1200, 'sea_price_end' => 1240, 'air_price_start' => 1400, 'air_price_end' => 1490,
            ],
            [
                'name' => 'BODY WASH',
                'sea_price_start' => 1150, 'sea_price_end' => 1190, 'air_price_start' => 1350, 'air_price_end' => 1440,
            ],
            [
                'name' => 'FACE WASH',
                'sea_price_start' => 1150, 'sea_price_end' => 1190, 'air_price_start' => 1350, 'air_price_end' => 1440,
            ],
            [
                'name' => 'HAIR WASH ',
                'sea_price_start' => 1150, 'sea_price_end' => 1190, 'air_price_start' => 1350, 'air_price_end' => 1440,
            ],
            [
                'name' => 'SOFT MOISTURE',
                'sea_price_start' => 1150, 'sea_price_end' => 1190, 'air_price_start' => 1350, 'air_price_end' => 1440,
            ],
            [
                'name' => 'CLEANSER',
                'sea_price_start' => 1150, 'sea_price_end' => 1190, 'air_price_start' => 1350, 'air_price_end' => 1440,
            ],
            [
                'name' => 'FACE FOUNDATION',
                'sea_price_start' => 1200, 'sea_price_end' => 1240, 'air_price_start' => 1400, 'air_price_end' => 1490,
            ],
            [
                'name' => 'CLEANSING BATH SOAP',
                'sea_price_start' => 1200, 'sea_price_end' => 1240, 'air_price_start' => 1400, 'air_price_end' => 1490,
            ],
            [
                'name' => 'EYE SHADOW',
                'sea_price_start' => 1150, 'sea_price_end' => 1190, 'air_price_start' => 1350, 'air_price_end' => 1440,
            ],
            [
                'name' => 'STICKY PAPER',
                'sea_price_start' => 1200, 'sea_price_end' => 1240, 'air_price_start' => 1400, 'air_price_end' => 1490,
            ],
            [
                'name' => 'LIP CARE ',
                'sea_price_start' => 1150, 'sea_price_end' => 1190, 'air_price_start' => 1350, 'air_price_end' => 1440,
            ],
            [
                'name' => 'OLIV OIL ',
                'sea_price_start' => 1150, 'sea_price_end' => 1190, 'air_price_start' => 1350, 'air_price_end' => 1440,
            ],
            [
                'name' => 'PERFUME',
                'sea_price_start' => 1250, 'sea_price_end' => 1290, 'air_price_start' => 1450, 'air_price_end' => 1540,
            ],
            [
                'name' => 'DEODURANT',
                'sea_price_start' => 1150, 'sea_price_end' => 1190, 'air_price_start' => 1350, 'air_price_end' => 1440,
            ],
            [
                'name' => 'MOUTH WASH ',
                'sea_price_start' => 1150, 'sea_price_end' => 1190, 'air_price_start' => 1350, 'air_price_end' => 1440,
            ],
            [
                'name' => 'SERUM ',
                'sea_price_start' => 1150, 'sea_price_end' => 1190, 'air_price_start' => 1350, 'air_price_end' => 1440,
            ],
            [
                'name' => 'BODY OIL ',
                'sea_price_start' => 1150, 'sea_price_end' => 1190, 'air_price_start' => 1350, 'air_price_end' => 1440,
            ],
            [
                'name' => 'PETROLEUM JELLY ',
                'sea_price_start' => 1150, 'sea_price_end' => 1190, 'air_price_start' => 1350, 'air_price_end' => 1440,
            ],
            [
                'name' => 'PAIN RELIF BALM',
                'sea_price_start' => 1150, 'sea_price_end' => 1190, 'air_price_start' => 1350, 'air_price_end' => 1440,
            ],
            [
                'name' => 'FACIAL MASSAGE CREAM',
                'sea_price_start' => 1150, 'sea_price_end' => 1190, 'air_price_start' => 1350, 'air_price_end' => 1440,
            ],
            [
                'name' => 'HAIR REMOVAL',
                'sea_price_start' => 1250, 'sea_price_end' => 1290, 'air_price_start' => 1450, 'air_price_end' => 1540,
            ],
            [
                'name' => 'GHEE',
                'sea_price_start' => 1150, 'sea_price_end' => 1190, 'air_price_start' => 1350, 'air_price_end' => 1440,
            ],
            [
                'name' => 'SOUCE',
                'sea_price_start' => 1150, 'sea_price_end' => 1190, 'air_price_start' => 1350, 'air_price_end' => 1440,
            ],
            [
                'name' => 'ORGANIC HONEY',
                'sea_price_start' => 1150, 'sea_price_end' => 1190, 'air_price_start' => 1350, 'air_price_end' => 1440,
            ],
            [
                'name' => 'CANDY WITH COCA BAR',
                'sea_price_start' => 1000, 'sea_price_end' => 1040, 'air_price_start' => 1200, 'air_price_end' => 1290,
            ],
            [
                'name' => 'BABY FORMULA',
                'sea_price_start' => 1000, 'sea_price_end' => 1040, 'air_price_start' => 1200, 'air_price_end' => 1290,
            ],
            [
                'name' => 'MIXED SPICE: R/P',
                'sea_price_start' => 900, 'sea_price_end' => 940, 'air_price_start' => 1100, 'air_price_end' => 1190,
            ],
            [
                'name' => 'TIN FISH/ SARDINE R/P',
                'sea_price_start' => 900, 'sea_price_end' => 940, 'air_price_start' => 1100, 'air_price_end' => 1190,
            ],
            [
                'name' => 'FOOD PREPARATION',
                'sea_price_start' => 900, 'sea_price_end' => 940, 'air_price_start' => 1100, 'air_price_end' => 1190,
            ],
            [
                'name' => 'DRINGKING POWDER',
                'sea_price_start' => 1200, 'sea_price_end' => 1240, 'air_price_start' => 1400, 'air_price_end' => 1490,
            ],
            [
                'name' => 'TEA',
                'sea_price_start' => 1000, 'sea_price_end' => 1040, 'air_price_start' => 1200, 'air_price_end' => 1290,
            ],
            [
                'name' => 'NESCAFE',
                'sea_price_start' => 1000, 'sea_price_end' => 1040, 'air_price_start' => 1200, 'air_price_end' => 1290,
            ],
            [
                'name' => 'CHIA SEED',
                'sea_price_start' => 1000, 'sea_price_end' => 1040, 'air_price_start' => 1200, 'air_price_end' => 1290,
            ],
            [
                'name' => 'DATES',
                'sea_price_start' => 1000, 'sea_price_end' => 1040, 'air_price_start' => 1200, 'air_price_end' => 1290,
            ],
            [
                'name' => 'DRY COOCKIES',
                'sea_price_start' => 1000, 'sea_price_end' => 1040, 'air_price_start' => 1200, 'air_price_end' => 1290,
            ],
            [
                'name' => 'MEXID NUTS',
                'sea_price_start' => 1000, 'sea_price_end' => 1040, 'air_price_start' => 1200, 'air_price_end' => 1290,
            ],
            [
                'name' => ' LIGHTLY SALTED CORN CAKES',
                'sea_price_start' => 1000, 'sea_price_end' => 1040, 'air_price_start' => 1200, 'air_price_end' => 1290,
            ],
            [
                'name' => 'AIR FRESHENER',
                'sea_price_start' => 1150, 'sea_price_end' => 1190, 'air_price_start' => 1350, 'air_price_end' => 1440,
            ],
            [
                'name' => 'SPEAKER(NO BATTARY)',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'MACHINERY SPARE PARTS',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => ' DOOR LOCK',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'STAND FAN (Without battery)',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'MAT',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'DRINK BOTTLE',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'BOOKS (PRINTED)',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'GUITER',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'LAPTOP',
                'sea_price_start' => 2520, 'sea_price_end' => 2560, 'air_price_start' => 2720, 'air_price_end' => 2810,
            ],
            [
                'name' => 'PHOTO FRAME',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'LIGHT STAND',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'PLASTIC BRUSH',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'BABY FEEDING BOTTLE',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'FACIAL WIPES',
                'sea_price_start' => 1150, 'sea_price_end' => 1190, 'air_price_start' => 1350, 'air_price_end' => 1440,
            ],
            [
                'name' => 'HAIR CLEANER',
                'sea_price_start' => 1150, 'sea_price_end' => 1190, 'air_price_start' => 1350, 'air_price_end' => 1440,
            ],
            [
                'name' => 'LADY SHAVER',
                'sea_price_start' => 1150, 'sea_price_end' => 1190, 'air_price_start' => 1350, 'air_price_end' => 1440,
            ],
            [
                'name' => 'LIGHT POWER SUPPLY',
                'sea_price_start' => 1150, 'sea_price_end' => 1190, 'air_price_start' => 1350, 'air_price_end' => 1440,
            ],
            [
                'name' => 'HAIR COMB',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'TAPE',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'UMBRELLA',
                'sea_price_start' => 900, 'sea_price_end' => 940, 'air_price_start' => 1100, 'air_price_end' => 1190,
            ],
            [
                'name' => 'LAMP SHADE',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'ROLLING BANNER',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'WALL PAPER',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'SACHET',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'SUITCASE',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'ARTIFICIAL FLOWERS',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'WALL CLOCK (without battery)',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'TOYS (BATTERY OPORETED)',
                'sea_price_start' => 1000, 'sea_price_end' => 1040, 'air_price_start' => 1200, 'air_price_end' => 1290,
            ],
            [
                'name' => 'WATCH (METAL)',
                'sea_price_start' => 1200, 'sea_price_end' => 1240, 'air_price_start' => 1400, 'air_price_end' => 1490,
            ],
            [
                'name' => 'MUSIC KEYBOARD',
                'sea_price_start' => 1000, 'sea_price_end' => 1040, 'air_price_start' => 1200, 'air_price_end' => 1290,
            ],
            [
                'name' => 'TABLE LIGHT(BATTERY)',
                'sea_price_start' => 1200, 'sea_price_end' => 1240, 'air_price_start' => 1400, 'air_price_end' => 1490,
            ],
            [
                'name' => 'BALL PUMPER',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'ENGINE PARTS/RING PISTON',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'SHAFT',
                'sea_price_start' => 1000, 'sea_price_end' => 1040, 'air_price_start' => 1200, 'air_price_end' => 1290,
            ],
            [
                'name' => 'TESTER',
                'sea_price_start' => 900, 'sea_price_end' => 940, 'air_price_start' => 1100, 'air_price_end' => 1190,
            ],
            [
                'name' => 'THERMOSTATE',
                'sea_price_start' => 870, 'sea_price_end' => 910, 'air_price_start' => 1070, 'air_price_end' => 1160,
            ],
            [
                'name' => 'GLOUCOSE METER',
                'sea_price_start' => 870, 'sea_price_end' => 910, 'air_price_start' => 1070, 'air_price_end' => 1160,
            ],
            [
                'name' => 'FLOWER VASE',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'ONE TIME RAZOR',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => ' LIGHT',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'PENCILS',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'RADIATOR',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'TABLE CLOCK(without battery)',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'TABLE CLOCK(with battery)',
                'sea_price_start' => 1000, 'sea_price_end' => 1040, 'air_price_start' => 1200, 'air_price_end' => 1290,
            ],
            [
                'name' => 'PRESSURE VALVE',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'PRESSURE TRANSMITTER',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'AUTO REGULATOR',
                'sea_price_start' => 800, 'sea_price_end' => 840, 'air_price_start' => 1000, 'air_price_end' => 1090,
            ],
            [
                'name' => 'MODULE',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'POSITIONER ( VALVE CONTROLLER)',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'SENSOR',
                'sea_price_start' => 1000, 'sea_price_end' => 1040, 'air_price_start' => 1200, 'air_price_end' => 1290,
            ],
            [
                'name' => 'TRIMMER',
                'sea_price_start' => 1000, 'sea_price_end' => 1040, 'air_price_start' => 1200, 'air_price_end' => 1290,
            ],
            [
                'name' => 'WRAPPING PAPER',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'FILE BAG',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'KITCHEN BOARD',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'WHEEL STAND',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'T-SHIRT',
                'sea_price_start' => 900, 'sea_price_end' => 940, 'air_price_start' => 1100, 'air_price_end' => 1190,
            ],
            [
                'name' => 'TROUSER',
                'sea_price_start' => 900, 'sea_price_end' => 940, 'air_price_start' => 1100, 'air_price_end' => 1190,
            ],
            [
                'name' => 'PANTS',
                'sea_price_start' => 900, 'sea_price_end' => 940, 'air_price_start' => 1100, 'air_price_end' => 1190,
            ],
            [
                'name' => 'JUMPERS',
                'sea_price_start' => 900, 'sea_price_end' => 940, 'air_price_start' => 1100, 'air_price_end' => 1190,
            ],
            [
                'name' => 'SWEATER',
                'sea_price_start' => 900, 'sea_price_end' => 940, 'air_price_start' => 1100, 'air_price_end' => 1190,
            ],
            [
                'name' => 'SCARF',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'BABY DRESS',
                'sea_price_start' => 900, 'sea_price_end' => 940, 'air_price_start' => 1100, 'air_price_end' => 1190,
            ],
            [
                'name' => 'TOWEL',
                'sea_price_start' => 900, 'sea_price_end' => 940, 'air_price_start' => 1100, 'air_price_end' => 1190,
            ],
            [
                'name' => 'BEDSHEET',
                'sea_price_start' => 900, 'sea_price_end' => 940, 'air_price_start' => 1100, 'air_price_end' => 1190,
            ],
            [
                'name' => 'ZIPPER',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'BUTTON',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'BLANKET',
                'sea_price_start' => 900, 'sea_price_end' => 940, 'air_price_start' => 1100, 'air_price_end' => 1190,
            ],
            [
                'name' => 'DAIPER',
                'sea_price_start' => 900, 'sea_price_end' => 940, 'air_price_start' => 1100, 'air_price_end' => 1190,
            ],
            [
                'name' => 'LADIES BAG',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'WALLET',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'MEN’S KEDS',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'LADIES FOOTWEAR',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'GENTS SLIPPER',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'PHOTO FRAME',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'CARPET',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'PRESSURE WASHER',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'HAND MACHINE',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'FLOWMETER',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'CHARGER',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'SPARE PARTS',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'HAIR DRYER',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'HAIR  CONDITIONER',
                'sea_price_start' => 1280, 'sea_price_end' => 1320, 'air_price_start' => 1480, 'air_price_end' => 1570,
            ],
            [
                'name' => 'CLEANSING BATH SOAP',
                'sea_price_start' => 920, 'sea_price_end' => 960, 'air_price_start' => 1120, 'air_price_end' => 1210,
            ],
            [
                'name' => 'FACE SERUM',
                'sea_price_start' => 1250, 'sea_price_end' => 1290, 'air_price_start' => 1450, 'air_price_end' => 1540,
            ],
            [
                'name' => ' VASELINE',
                'sea_price_start' => 920, 'sea_price_end' => 960, 'air_price_start' => 1120, 'air_price_end' => 1210,
            ],
            [
                'name' => 'OLIVE OIL',
                'sea_price_start' => 920, 'sea_price_end' => 960, 'air_price_start' => 1120, 'air_price_end' => 1210,
            ],
            [
                'name' => 'THERMAL PRINTER',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'AIR FILTER',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'TEMPERATURE MEASURING MACHINE',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'HELMET',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'GRILL MAKING MACHINE',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'CAKE CUTTING MACHINE',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'CHOCOLATE POWDER',
                'sea_price_start' => 1250, 'sea_price_end' => 1290, 'air_price_start' => 1450, 'air_price_end' => 1540,
            ],
            [
                'name' => 'SWEET BAR',
                'sea_price_start' => 1150, 'sea_price_end' => 1190, 'air_price_start' => 1350, 'air_price_end' => 1440,
            ],
            [
                'name' => 'MACARONI ',
                'sea_price_start' => 1000, 'sea_price_end' => 1040, 'air_price_start' => 1200, 'air_price_end' => 1290,
            ],
            [
                'name' => 'CHIA SEED',
                'sea_price_start' => 870, 'sea_price_end' => 910, 'air_price_start' => 1070, 'air_price_end' => 1160,
            ],
            [
                'name' => 'DRY COOCKIES',
                'sea_price_start' => 870, 'sea_price_end' => 910, 'air_price_start' => 1070, 'air_price_end' => 1160,
            ],
            [
                'name' => 'NUTS（MEXID ）',
                'sea_price_start' => 870, 'sea_price_end' => 910, 'air_price_start' => 1070, 'air_price_end' => 1160,
            ],
            [
                'name' => 'TEA',
                'sea_price_start' => 870, 'sea_price_end' => 910, 'air_price_start' => 1070, 'air_price_end' => 1160,
            ],
            [
                'name' => 'MAKE UP BOX',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'CAT FOOD',
                'sea_price_start' => 1200, 'sea_price_end' => 1240, 'air_price_start' => 1400, 'air_price_end' => 1490,
            ],
            [
                'name' => 'BEARING',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'MASSAGE MACHINE',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'WATER PUMP',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'WASHING LIQUID',
                'sea_price_start' => 920, 'sea_price_end' => 960, 'air_price_start' => 1120, 'air_price_end' => 1210,
            ],
            [
                'name' => 'COTTON BUDS',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'IRON MACHIE',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'MAKE UP BRUSH',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'PLASTIC BASKET',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'WATER PURIFIER CARTRIDGE',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'NECK MASSAGER',
                'sea_price_start' => 870, 'sea_price_end' => 910, 'air_price_start' => 1070, 'air_price_end' => 1160,
            ],
            [
                'name' => 'CONVAYER BELT',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'BABY CHAIR PLASTIC',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'BABY CARRIER',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'HARMONIUM',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'LEG MASSAGER',
                'sea_price_start' => 870, 'sea_price_end' => 910, 'air_price_start' => 1070, 'air_price_end' => 1160,
            ],
            [
                'name' => 'TOYS (NO BATTERIES)',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => ' MOP BUCKET',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'CLEANING EQUIPMENT(BUILD IN BATTERY)',
                'sea_price_start' => 1300, 'sea_price_end' => 1340, 'air_price_start' => 1500, 'air_price_end' => 1590,
            ],
            [
                'name' => 'WALLET',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'WHEEL CHAIR',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'WALL HOOK',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'TOOTH BRUSH HOLDER',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'CANDLE HOLDER',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'BELT',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'BABY FEEDER',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'LIGHT (battery)',
                'sea_price_start' => 1000, 'sea_price_end' => 1040, 'air_price_start' => 1200, 'air_price_end' => 1290,
            ],
            [
                'name' => 'FLASH LIGHT (battery)',
                'sea_price_start' => 1000, 'sea_price_end' => 1040, 'air_price_start' => 1200, 'air_price_end' => 1290,
            ],
            [
                'name' => 'LED LIGHT STRIP',
                'sea_price_start' => 1000, 'sea_price_end' => 1040, 'air_price_start' => 1200, 'air_price_end' => 1290,
            ],
            [
                'name' => 'REMOTE CONTROL',
                'sea_price_start' => 1000, 'sea_price_end' => 1040, 'air_price_start' => 1200, 'air_price_end' => 1290,
            ],
            [
                'name' => 'USB CABLE',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'IP CAMERA/WIFI CAMERA',
                'sea_price_start' => 1650, 'sea_price_end' => 1690, 'air_price_start' => 1850, 'air_price_end' => 1940,
            ],
            [
                'name' => 'ANDOID TV BOX',
                'sea_price_start' => 1000, 'sea_price_end' => 1040, 'air_price_start' => 1200, 'air_price_end' => 1290,
            ],
            [
                'name' => 'HAIR CUTTER',
                'sea_price_start' => 1000, 'sea_price_end' => 1040, 'air_price_start' => 1200, 'air_price_end' => 1290,
            ],
            [
                'name' => 'PLASTIC WATCH',
                'sea_price_start' => 1200, 'sea_price_end' => 1240, 'air_price_start' => 1400, 'air_price_end' => 1490,
            ],
            [
                'name' => 'SMART WATCH',
                'sea_price_start' => 1300, 'sea_price_end' => 1340, 'air_price_start' => 1500, 'air_price_end' => 1590,
            ],
            [
                'name' => 'BABY WATCH',
                'sea_price_start' => 1200, 'sea_price_end' => 1240, 'air_price_start' => 1400, 'air_price_end' => 1490,
            ],
            [
                'name' => 'WATCH STRAP',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'AUTO CAR ACCESSORIES',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'CAR BUMPER PARTS',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'AIR FILTER',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'WATER FILTER',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'MEMBRANE FILTER',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'CARTRIDGE FILTER',
                'sea_price_start' => 1000, 'sea_price_end' => 1040, 'air_price_start' => 1200, 'air_price_end' => 1290,
            ],
            [
                'name' => 'FILTER PARTS',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'PRINTER',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'BLANCER',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'THERMOREGULATOR ',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'GUIDE VALVE',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'FILM CUTTING CLUCH',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'SPROCKET',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'PINION FOR BAND',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'JOINT',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'SPRING',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'RUBBER GESKET',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'SEAL KIT',
                'sea_price_start' => 850, 'sea_price_end' => 890, 'air_price_start' => 1050, 'air_price_end' => 1140,
            ],
            [
                'name' => 'SKIN BALM',
                'sea_price_start' => 1150, 'sea_price_end' => 1190, 'air_price_start' => 1350, 'air_price_end' => 1440,
            ],
            [
                'name' => 'CLEANSING OIL',
                'sea_price_start' => 1150, 'sea_price_end' => 1190, 'air_price_start' => 1350, 'air_price_end' => 1440,
            ],
            [
                'name' => 'EYE CARE PREPARATION',
                'sea_price_start' => 1150, 'sea_price_end' => 1190, 'air_price_start' => 1350, 'air_price_end' => 1440,
            ],
            [
                'name' => 'CLAY MASK',
                'sea_price_start' => 1150, 'sea_price_end' => 1190, 'air_price_start' => 1350, 'air_price_end' => 1440,
            ],
            [
                'name' => 'ESSENTIAL OIL',
                'sea_price_start' => 1150, 'sea_price_end' => 1190, 'air_price_start' => 1350, 'air_price_end' => 1440,
            ],
            [
                'name' => 'EYESHADOW',
                'sea_price_start' => 1150, 'sea_price_end' => 1190, 'air_price_start' => 1350, 'air_price_end' => 1440,
            ],
            [
                'name' => 'ORAL SPRAY',
                'sea_price_start' => 1150, 'sea_price_end' => 1190, 'air_price_start' => 1350, 'air_price_end' => 1440,
            ],
            [
                'name' => 'MOUTH WASH',
                'sea_price_start' => 1150, 'sea_price_end' => 1190, 'air_price_start' => 1350, 'air_price_end' => 1440,
            ],
            [
                'name' => 'FACE POWDER',
                'sea_price_start' => 1150, 'sea_price_end' => 1190, 'air_price_start' => 1350, 'air_price_end' => 1440,
            ],
            [
                'name' => 'HARE CARE PREPARATION',
                'sea_price_start' => 1150, 'sea_price_end' => 1190, 'air_price_start' => 1350, 'air_price_end' => 1440,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
