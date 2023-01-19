<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Governorate;
use Illuminate\Database\Seeder;

class CitiesTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $country=Country::create(['sort'=>'EG','country_name'=>['en'=>'Egypt','ar'=>'مصر'],'phoneCode'=>'20']);
        $cities=[
            [
                'governorate_name'=>['en'=>'Cairo','ar'=>'القاهرة'],
                'country'=>$country['id']
            ],
            [
                'governorate_name'=>['en'=>'Alexandria','ar'=>'الإسكندرية'],
                'country'=>$country['id']
            ],
            [
                'governorate_name'=>['en'=>'Giza','ar'=>'الجيزة'],
                'country'=>$country['id']
            ],
            [
                'governorate_name'=>['en'=>'Aswan','ar'=>'أسوان'],
                'country'=>$country['id']
            ],
            [
                'governorate_name'=>['en'=>'Port Said','ar'=>'بورسعيد'],
                'country'=>$country['id']
            ],
            [
                'governorate_name'=>['en'=>'South of Sinaa','ar'=>'جنوب سيناء'],
                'country'=>$country['id']
            ],
            [
                'governorate_name'=>['en'=>'Dakahlia','ar'=>'الدقهلية'],
                'country'=>$country['id']
            ],
            [
                'governorate_name'=>['en'=>'Damietta','ar'=>'دمياط'],
                'country'=>$country['id']
            ],
            [
                'governorate_name'=>['en'=>'Tanta','ar'=>'طنطا'],
                'country'=>$country['id']
            ],
            [
                'governorate_name'=>['en'=>'Asyut','ar'=>'أسيوط'],
                'country'=>$country['id']
            ],
            [
                'governorate_name'=>['en'=>'Fayoum','ar'=>'الفيوم'],
                'country'=>$country['id']
            ],
            [
                'governorate_name'=>['en'=>'Zagazig','ar'=>'الزقازيق'],
                'country'=>$country['id']
            ],
            [
                'governorate_name'=>['en'=>'Ismailia','ar'=>'الإسماعيلية'],
                'country'=>$country['id']
            ],
            [
                'governorate_name'=>['en'=>'Menoufia','ar'=>'المنوفية'],
                'country'=>$country['id']
            ],
            [
                'governorate_name'=>['en'=>'The Red Sea','ar'=>'البحر الأحمر'],
                'country'=>$country['id']
            ],
            [
                'governorate_name'=>['en'=>'El-baharah','ar'=>'البحيرة'],
                'country'=>$country['id']
            ],
            [
                'governorate_name'=>['en'=>'Luxor','ar'=>'الأقصر'],
                'country'=>$country['id']
            ],
            [
                'governorate_name'=>['en'=>'Suez','ar'=>'السويس'],
                'country'=>$country['id']
            ],
            [
                'governorate_name'=>['en'=>'North Sinai','ar'=>'شمال سيناء'],
                'country'=>$country['id']
            ],
            [
                'governorate_name'=>['en'=>'Sohag','ar'=>'سوهاج'],
                'country'=>$country['id']
            ],
            [
                'governorate_name'=>['en'=>'Eastern','ar'=>'الشرقية'],
                'country'=>$country['id']
            ],
            [
                'governorate_name'=>['en'=>'Qalyubia','ar'=>'القليوبية'],
                'country'=>$country['id']
            ],
            [
                'governorate_name'=>['en'=>'qana','ar'=>'قنا'],
                'country'=>$country['id']
            ],
            [
                'governorate_name'=>['en'=>'Western','ar'=>'الغربية'],
                'country'=>$country['id']
            ],
            [
                'governorate_name'=>['en'=>'Kafr El-Sheikh','ar'=>'كفر الشيخ'],
                'country'=>$country['id']
            ],
            [
                'governorate_name'=>['en'=>'matroh','ar'=>'مطروح'],
                'country'=>$country['id']
            ],
            [
                'governorate_name'=>['en'=>'Minya','ar'=>'المنيا'],
                'country'=>$country['id']
            ],
            [
                'governorate_name'=>['en'=>'al-wadi al-jadid','ar'=>'الوادي الجديد'],
                'country'=>$country['id']
            ],
            [
                'governorate_name'=>['en'=>'al-wahat','ar'=>'الواحات'],
                'country'=>$country['id']
            ],
        ];
        foreach ($cities as $k => $v)
            Governorate::create($v);
    }
}
