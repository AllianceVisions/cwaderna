<?php

use Illuminate\Database\Seeder;
use App\Models\Nationality;

class NationailtySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $i = 1;
        $nationalities = [
            [
                'id' => $i++,
                'name_en' => 'Abha',
                'name_ar' => 'ابها',
            ], 
            [
                'id' => $i++,
                'name_en' => "Afghan",
                'name_ar' =>        "أفغاني",
            ],
            [
                'id' => $i++,
                'name_en' => "Albanian",
                'name_ar' =>        "الألبانية",
            ],
            [
                'id' => $i++,
                'name_en' => "Algerian",
                'name_ar' =>        "جزائري",
            ],
            [
                'id' => $i++,
                'name_en' => "American",
                'name_ar' =>        "أمريكي",
            ],
            [
                'id' => $i++,
                'name_en' => "Andorran",
                'name_ar' =>        "أندورا",
            ],
            [
                'id' => $i++,
                'name_en' => "Angolan",
                'name_ar' =>        "الأنغولية",
            ],
            [
                'id' => $i++,
                'name_en' => "Antiguans",
                'name_ar' =>        "أنتيجوان",
            ],
            [
                'id' => $i++,
                'name_en' => "Argentinean",
                'name_ar' =>        "الأرجنتيني",
            ],
            [
                'id' => $i++,
                'name_en' => "Armenian",
                'name_ar' =>        "أرميني",
            ],
            [
                'id' => $i++,
                'name_en' => "Australian",
                'name_ar' =>        "الاسترالية",
            ],
            [
                'id' => $i++,
                'name_en' => "Austrian",
                'name_ar' =>        "النمساوي",
            ],
            [
                'id' => $i++,
                'name_en' => "Azerbaijani",
                'name_ar' =>        "أذربيجان",
            ],
            [
                'id' => $i++,
                'name_en' => "Bahamian",
                'name_ar' =>        "جزر البهاما",
            ],
            [
                'id' => $i++,
                'name_en' => "Bahraini",
                'name_ar' =>        "بحريني",
            ],
            [
                'id' => $i++,
                'name_en' => "Bangladeshi",
                'name_ar' =>        "بنجلاديشية",
            ],
            [
                'id' => $i++,
                'name_en' => "Barbadian",
                'name_ar' =>        "بربادوس",
            ],
            [
                'id' => $i++,
                'name_en' => "Barbudans",
                'name_ar' =>        "باربودان",
            ],
            [
                'id' => $i++,
                'name_en' => "Batswana",
                'name_ar' =>        "باتسوانا",
            ],
            [
                'id' => $i++,
                'name_en' => "Belarusian",
                'name_ar' =>        "البيلاروسية",
            ],
            [
                'id' => $i++,
                'name_en' => "Belgian",
                'name_ar' =>        "بلجيكي",
            ],
            [
                'id' => $i++,
                'name_en' => "Belizean",
                'name_ar' =>        "بليز",
            ],
            [
                'id' => $i++,
                'name_en' => "Beninese",
                'name_ar' =>        "بنين",
            ],
            [
                'id' => $i++,
                'name_en' => "Bhutanese",
                'name_ar' =>        "بوتاني",
            ],
            [
                'id' => $i++,
                'name_en' => "Bolivian",
                'name_ar' =>        "بوليفي",
            ],
            [
                'id' => $i++,
                'name_en' => "Bosnian",
                'name_ar' =>        "البوسنية",
            ],
            [
                'id' => $i++,
                'name_en' => "Brazilian",
                'name_ar' =>        "برازيلي",
            ],
            [
                'id' => $i++,
                'name_en' => "British",
                'name_ar' =>        "بريطاني",
            ],
            [
                'id' => $i++,
                'name_en' => "Bruneian",
                'name_ar' =>        "بروناي",
            ],
            [
                'id' => $i++,
                'name_en' => "Bulgarian",
                'name_ar' =>        "البلغارية",
            ],
            [
                'id' => $i++,
                'name_en' => "Burkinabe",
                'name_ar' =>        "بوركينا فاسو",
            ],
            [
                'id' => $i++,
                'name_en' => "Burmese",
                'name_ar' =>        "البورمية",
            ],
            [
                'id' => $i++,
                'name_en' => "Burundian",
                'name_ar' =>        "بوروندي",
            ],
            [
                'id' => $i++,
                'name_en' => "Cambodian",
                'name_ar' =>        "كمبودي",
            ],
            [
                'id' => $i++,
                'name_en' => "Cameroonian",
                'name_ar' =>        "الكاميروني",
            ],
            [
                'id' => $i++,
                'name_en' => "Canadian",
                'name_ar' =>        "كندي",
            ],
            [
                'id' => $i++,
                'name_en' => "Cape Verdean",
                'name_ar' =>        "الرأس الأخضر",
            ],
            [
                'id' => $i++,
                'name_en' => "Central African",
                'name_ar' =>        "أفريقيا الوسطى",
            ],
            [
                'id' => $i++,
                'name_en' => "Chadian",
                'name_ar' =>        "التشادية",
            ],
            [
                'id' => $i++,
                'name_en' => "Chilean",
                'name_ar' =>        "تشيلي",
            ],
            [
                'id' => $i++,
                'name_en' => "Chinese",
                'name_ar' =>        "صينى",
            ],
            [
                'id' => $i++,
                'name_en' => "Colombian",
                'name_ar' =>        "الكولومبي",
            ],
            [
                'id' => $i++,
                'name_en' => "Comoran",
                'name_ar' =>        "جزر القمر",
            ],
            [
                'id' => $i++,
                'name_en' => "Congolese",
                'name_ar' =>        "الكونغولية",
            ],
            [
                'id' => $i++,
                'name_en' => "Costa Rican",
                'name_ar' =>        "كوستاريكا",
            ],
            [
                'id' => $i++,
                'name_en' => "Croatian",
                'name_ar' =>        "الكرواتية",
            ],
            [
                'id' => $i++,
                'name_en' => "Cuban",
                'name_ar' =>        "الكوبي",
            ],
            [
                'id' => $i++,
                'name_en' => "Cypriot",
                'name_ar' =>        "القبرصي",
            ],
            [
                'id' => $i++,
                'name_en' => "Czech",
                'name_ar' =>        "التشيكية",
            ],
            [
                'id' => $i++,
                'name_en' => "Danish",
                'name_ar' =>        "دانماركي",
            ],
            [
                'id' => $i++,
                'name_en' => "Djibouti",
                'name_ar' =>        "جيبوتي",
            ],
            [
                'id' => $i++,
                'name_en' => "Dominican",
                'name_ar' =>        "الدومينيكان",
            ],
            [
                'id' => $i++,
                'name_en' => "Dutch",
                'name_ar' =>        "هولندي",
            ],
            [
                'id' => $i++,
                'name_en' => "East Timorese",
                'name_ar' =>        "التيموريون الشرقيون",
            ],
            [
                'id' => $i++,
                'name_en' => "Ecuadorean",
                'name_ar' =>        "الاكوادوري",
            ],
            [
                'id' => $i++,
                'name_en' => "Egyptian",
                'name_ar' =>        "مصري",
            ],
            [
                'id' => $i++,
                'name_en' => "Emirian",
                'name_ar' =>        "أميركي",
            ],
            [
                'id' => $i++,
                'name_en' => "Equatorial Guinean",
                'name_ar' =>        "غينيا الاستوائية",
            ],
            [
                'id' => $i++,
                'name_en' => "Eritrean",
                'name_ar' =>        "اريتريا",
            ],
            [
                'id' => $i++,
                'name_en' => "Estonian",
                'name_ar' =>        "الإستونية",
            ],
            [
                'id' => $i++,
                'name_en' => "Ethiopian",
                'name_ar' =>        "الاثيوبية",
            ],
            [
                'id' => $i++,
                'name_en' => "Fijian",
                'name_ar' =>        "فيجي",
            ],
            [
                'id' => $i++,
                'name_en' => "Filipino",
                'name_ar' =>        "الفلبينية",
            ],
            [
                'id' => $i++,
                'name_en' => "Finnish",
                'name_ar' =>        "الفنلندية",
            ],
            [
                'id' => $i++,
                'name_en' => "French",
                'name_ar' =>        "فرنسي",
            ],
            [
                'id' => $i++,
                'name_en' => "Gabonese",
                'name_ar' =>        "الغابونية",
            ],
            [
                'id' => $i++,
                'name_en' => "Gambian",
                'name_ar' =>        "غامبي",
            ],
            [
                'id' => $i++,
                'name_en' => "Georgian",
                'name_ar' =>        "الجورجية",
            ],
            [
                'id' => $i++,
                'name_en' => "German",
                'name_ar' =>        "ألمانية",
            ],
            [
                'id' => $i++,
                'name_en' => "Ghanaian",
                'name_ar' =>        "الغانية",
            ],
            [
                'id' => $i++,
                'name_en' => "Greek",
                'name_ar' =>        "اليونانية",
            ],
            [
                'id' => $i++,
                'name_en' => "Grenadian",
                'name_ar' =>        "غرينادا",
            ],
            [
                'id' => $i++,
                'name_en' => "Guatemalan",
                'name_ar' =>        "غواتيمالا",
            ],
            [
                'id' => $i++,
                'name_en' => "Guinea-Bissauan",
                'name_ar' =>        "غينيا بيساوان",
            ],
            [
                'id' => $i++,
                'name_en' => "Guinean",
                'name_ar' =>        "غينيا",
            ],
            [
                'id' => $i++,
                'name_en' => "Guyanese",
                'name_ar' =>        "جوياني",
            ],
            [
                'id' => $i++,
                'name_en' => "Haitian",
                'name_ar' =>        "الهايتي",
            ],
            [
                'id' => $i++,
                'name_en' => "Herzegovinian",
                'name_ar' =>        "هيرزيغوفينيان",
            ],
            [
                'id' => $i++,
                'name_en' => "Honduran",
                'name_ar' =>        "هندوراس",
            ],
            [
                'id' => $i++,
                'name_en' => "Hungarian",
                'name_ar' =>        "المجرية",
            ],
            [
                'id' => $i++,
                'name_en' => "I-Kiribati",
                'name_ar' =>        "آي كيريباتي",
            ],
            [
                'id' => $i++,
                'name_en' => "Icelander",
                'name_ar' =>        "آيسلندي",
            ],
            [
                'id' => $i++,
                'name_en' => "Indian",
                'name_ar' =>        "هندي",
            ],
            [
                'id' => $i++,
                'name_en' => "Indonesian",
                'name_ar' =>        "الأندونيسية",
            ],
            [
                'id' => $i++,
                'name_en' => "Iranian",
                'name_ar' =>        "إيراني",
            ],
            [
                'id' => $i++,
                'name_en' => "Iraqi",
                'name_ar' =>        "عراقي",
            ],
            [
                'id' => $i++,
                'name_en' => "Irish",
                'name_ar' =>        "إيرلندي",
            ],
            [
                'id' => $i++,
                'name_en' => "Israeli",
                'name_ar' =>        "إسرائيلي",
            ],
            [
                'id' => $i++,
                'name_en' => "Italian",
                'name_ar' =>        "إيطالي",
            ],
            [
                'id' => $i++,
                'name_en' => "Ivorian",
                'name_ar' =>        "ساحل العاج",
            ],
            [
                'id' => $i++,
                'name_en' => "Jamaican",
                'name_ar' =>        "جامايكا",
            ],
            [
                'id' => $i++,
                'name_en' => "Japanese",
                'name_ar' =>        "اليابانية",
            ],
            [
                'id' => $i++,
                'name_en' => "Jordanian",
                'name_ar' =>        "أردني",
            ],
            [
                'id' => $i++,
                'name_en' => "Kazakhstani",
                'name_ar' =>        "الكازاخستانية",
            ],
            [
                'id' => $i++,
                'name_en' => "Kenyan",
                'name_ar' =>        "كيني",
            ],
            [
                'id' => $i++,
                'name_en' => "Kittian and Nevisian",
                'name_ar' =>        "كيتيان ونيفيسيان",
            ],
            [
                'id' => $i++,
                'name_en' => "Kuwaiti",
                'name_ar' =>        "كويتي",
            ],
            [
                'id' => $i++,
                'name_en' => "Kyrgyz",
                'name_ar' =>        "قيرغيزستان",
            ],
            [
                'id' => $i++,
                'name_en' => "Laotian",
                'name_ar' =>        "اللاوسي",
            ],
            [
                'id' => $i++,
                'name_en' => "Latvian",
                'name_ar' =>        "لاتفيا",
            ],
            [
                'id' => $i++,
                'name_en' => "Lebanese",
                'name_ar' =>        "لبناني",
            ],
            [
                'id' => $i++,
                'name_en' => "Liberian",
                'name_ar' =>        "الليبيرية",
            ],
            [
                'id' => $i++,
                'name_en' => "Libyan",
                'name_ar' =>        "ليبي",
            ],
            [
                'id' => $i++,
                'name_en' => "Liechtensteiner",
                'name_ar' =>        "ليختنشتاينر",
            ],
            [
                'id' => $i++,
                'name_en' => "Lithuanian",
                'name_ar' =>        "الليتوانية",
            ],
            [
                'id' => $i++,
                'name_en' => "Luxembourger",
                'name_ar' =>        "لوكسمبورج",
            ],
            [
                'id' => $i++,
                'name_en' => "Macedonian",
                'name_ar' =>        "المقدونية",
            ],
            [
                'id' => $i++,
                'name_en' => "Malagasy",
                'name_ar' =>        "مدغشقر",
            ],
            [
                'id' => $i++,
                'name_en' => "Malawian",
                'name_ar' =>        "مالاوي",
            ],
            [
                'id' => $i++,
                'name_en' => "Malaysian",
                'name_ar' =>        "ماليزي",
            ],
            [
                'id' => $i++,
                'name_en' => "Maldivan",
                'name_ar' =>        "مالديفان",
            ],
            [
                'id' => $i++,
                'name_en' => "Malian",
                'name_ar' =>        "مالي",
            ],
            [
                'id' => $i++,
                'name_en' => "Maltese",
                'name_ar' =>        "المالطية",
            ],
            [
                'id' => $i++,
                'name_en' => "Marshallese",
                'name_ar' =>        "مارشال",
            ],
            [
                'id' => $i++,
                'name_en' => "Mauritanian",
                'name_ar' =>        "موريتاني",
            ],
            [
                'id' => $i++,
                'name_en' => "Mauritian",
                'name_ar' =>        "موريشيوس",
            ],
            [
                'id' => $i++,
                'name_en' => "Mexican",
                'name_ar' =>        "مكسيكي",
            ],
            [
                'id' => $i++,
                'name_en' => "Micronesian",
                'name_ar' =>        "ميكرونيزي",
            ],
            [
                'id' => $i++,
                'name_en' => "Moldovan",
                'name_ar' =>        "مولدوفا",
            ],
            [
                'id' => $i++,
                'name_en' => "Monacan",
                'name_ar' =>        "موناكان",
            ],
            [
                'id' => $i++,
                'name_en' => "Mongolian",
                'name_ar' =>        "المنغولية",
            ],
            [
                'id' => $i++,
                'name_en' => "Moroccan",
                'name_ar' =>        "مغربي",
            ],
            [
                'id' => $i++,
                'name_en' => "Mosotho",
                'name_ar' =>        "موسوتو",
            ],
            [
                'id' => $i++,
                'name_en' => "Motswana",
                'name_ar' =>        "موتسوانا",
            ],
            [
                'id' => $i++,
                'name_en' => "Mozambican",
                'name_ar' =>        "موزمبيقى",
            ],
            [
                'id' => $i++,
                'name_en' => "Namibian",
                'name_ar' =>        "الناميبي",
            ],
            [
                'id' => $i++,
                'name_en' => "Nauruan",
                'name_ar' =>        "ناورو",
            ],
            [
                'id' => $i++,
                'name_en' => "Nepalese",
                'name_ar' =>        "النيبالية",
            ],
            [
                'id' => $i++,
                'name_en' => "New Zealander",
                'name_ar' =>        "نيوزيلندي",
            ],
            [
                'id' => $i++,
                'name_en' => "Nicaraguan",
                'name_ar' =>        "نيكاراغوا",
            ],
            [
                'id' => $i++,
                'name_en' => "Nigerian",
                'name_ar' =>        "نيجيري",
            ],
            [
                'id' => $i++,
                'name_en' => "Nigerien",
                'name_ar' =>        "النيجر",
            ],
            [
                'id' => $i++,
                'name_en' => "North Korean",
                'name_ar' =>        "كوري شمالي",
            ],
            [
                'id' => $i++,
                'name_en' => "Northern Irish",
                'name_ar' =>        "شمالية إيرلندية",
            ],
            [
                'id' => $i++,
                'name_en' => "Norwegian",
                'name_ar' =>        "النرويجية",
            ],
            [
                'id' => $i++,
                'name_en' => "Omani",
                'name_ar' =>        "عماني",
            ],
            [
                'id' => $i++,
                'name_en' => "Pakistani",
                'name_ar' =>        "باكستاني",
            ],
            [
                'id' => $i++,
                'name_en' => "Palauan",
                'name_ar' =>        "بالاوان",
            ],
            [
                'id' => $i++,
                'name_en' => "Panamanian",
                'name_ar' =>        "بنمي",
            ],
            [
                'id' => $i++,
                'name_en' => "Papua New Guinean",
                'name_ar' =>        "بابوا غينيا الجديدة",
            ],
            [
                'id' => $i++,
                'name_en' => "Paraguayan",
                'name_ar' =>        "باراغواي",
            ],
            [
                'id' => $i++,
                'name_en' => "Peruvian",
                'name_ar' =>        "بيرو",
            ],
            [
                'id' => $i++,
                'name_en' => "Polish",
                'name_ar' =>        "تلميع",
            ],
            [
                'id' => $i++,
                'name_en' => "Portuguese",
                'name_ar' =>        "البرتغالية",
            ],
            [
                'id' => $i++,
                'name_en' => "Qatari",
                'name_ar' =>        "قطري",
            ],
            [
                'id' => $i++,
                'name_en' => "Romanian",
                'name_ar' =>        "روماني",
            ],
            [
                'id' => $i++,
                'name_en' => "Russian",
                'name_ar' =>        "الروسية",
            ],
            [
                'id' => $i++,
                'name_en' => "Rwandan",
                'name_ar' =>        "رواندا",
            ],
            [
                'id' => $i++,
                'name_en' => "Saint Lucian",
                'name_ar' =>        "سانت لوسيان",
            ],
            [
                'id' => $i++,
                'name_en' => "Salvadoran",
                'name_ar' =>        "السلفادورية",
            ],
            [
                'id' => $i++,
                'name_en' => "Samoan",
                'name_ar' =>        "ساموا",
            ],
            [
                'id' => $i++,
                'name_en' => "San Marinese",
                'name_ar' =>        "سان مارينيزي",
            ],
            [
                'id' => $i++,
                'name_en' => "Sao Tomean",
                'name_ar' =>        "ساو توميان",
            ],
            [
                'id' => $i++,
                'name_en' => "Saudi",
                'name_ar' =>        "سعودي",
            ],
            [
                'id' => $i++,
                'name_en' => "Scottish",
                'name_ar' =>        "اسكتلندي",
            ],
            [
                'id' => $i++,
                'name_en' => "Senegalese",
                'name_ar' =>        "سنغالي",
            ],
            [
                'id' => $i++,
                'name_en' => "Serbian",
                'name_ar' =>        "الصربية",
            ],
            [
                'id' => $i++,
                'name_en' => "Seychellois",
                'name_ar' =>        "سيشيل",
            ],
            [
                'id' => $i++,
                'name_en' => "Sierra Leonean",
                'name_ar' =>        "سيراليوني",
            ],
            [
                'id' => $i++,
                'name_en' => "Singaporean",
                'name_ar' =>        "سنغافوري",
            ],
            [
                'id' => $i++,
                'name_en' => "Slovakian",
                'name_ar' =>        "السلوفاكية",
            ],
            [
                'id' => $i++,
                'name_en' => "Slovenian",
                'name_ar' =>        "السلوفينية",
            ],
            [
                'id' => $i++,
                'name_en' => "Solomon Islander",
                'name_ar' =>        "جزر سليمان",
            ],
            [
                'id' => $i++,
                'name_en' => "Somali",
                'name_ar' =>        "الصومالية",
            ],
            [
                'id' => $i++,
                'name_en' => "South African",
                'name_ar' =>        "جنوب افريقيا",
            ],
            [
                'id' => $i++,
                'name_en' => "South Korean",
                'name_ar' =>        "كوريا الجنوبية",
            ],
            [
                'id' => $i++,
                'name_en' => "Spanish",
                'name_ar' =>        "الأسبانية",
            ],
            [
                'id' => $i++,
                'name_en' => "Sri Lankan",
                'name_ar' =>        "سري لانكا",
            ],
            [
                'id' => $i++,
                'name_en' => "Sudanese",
                'name_ar' =>        "سوداني",
            ],
            [
                'id' => $i++,
                'name_en' => "Surinamer",
                'name_ar' =>        "سورينامير",
            ],
            [
                'id' => $i++,
                'name_en' => "Swazi",
                'name_ar' =>        "سوازي",
            ],
            [
                'id' => $i++,
                'name_en' => "Swedish",
                'name_ar' =>        "السويدية",
            ],
            [
                'id' => $i++,
                'name_en' => "Swiss",
                'name_ar' =>        "سويسري",
            ],
            [
                'id' => $i++,
                'name_en' => "Syrian",
                'name_ar' =>        "سوري",
            ],
            [
                'id' => $i++,
                'name_en' => "Taiwanese",
                'name_ar' =>        "تايوانية",
            ],
            [
                'id' => $i++,
                'name_en' => "Tajik",
                'name_ar' =>        "طاجيك",
            ],
            [
                'id' => $i++,
                'name_en' => "Tanzanian",
                'name_ar' =>        "التنزانية",
            ],
            [
                'id' => $i++,
                'name_en' => "Thai",
                'name_ar' =>        "التايلاندية",
            ],
            [
                'id' => $i++,
                'name_en' => "Togolese",
                'name_ar' =>        "التوغو",
            ],
            [
                'id' => $i++,
                'name_en' => "Tongan",
                'name_ar' =>        "تونغا",
            ],
            [
                'id' => $i++,
                'name_en' => "Trinidadian or Tobagonian",
                'name_ar' =>        "ترينيدادية أو توباغونية",
            ],
            [
                'id' => $i++,
                'name_en' => "Tunisian",
                'name_ar' =>        "تونسي",
            ],
            [
                'id' => $i++,
                'name_en' => "Turkish",
                'name_ar' =>        "اللغة التركية",
            ],
            [
                'id' => $i++,
                'name_en' => "Tuvaluan",
                'name_ar' =>        "توفالوان",
            ],
            [
                'id' => $i++,
                'name_en' => "Ugandan",
                'name_ar' =>        "أوغندا",
            ],
            [
                'id' => $i++,
                'name_en' => "Ukrainian",
                'name_ar' =>        "الأوكرانية",
            ],
            [
                'id' => $i++,
                'name_en' => "Uruguayan",
                'name_ar' =>        "أوروغواي",
            ],
            [
                'id' => $i++,
                'name_en' => "Uzbekistani",
                'name_ar' =>        "أوزبكستان",
            ],
            [
                'id' => $i++,
                'name_en' => "Venezuelan",
                'name_ar' =>        "فنزويلية",
            ],
            [
                'id' => $i++,
                'name_en' => "Vietnamese",
                'name_ar' =>        "الفيتنامية",
            ],
            [
                'id' => $i++,
                'name_en' => "Welsh",
                'name_ar' =>        "ويلزي",
            ],
            [
                'id' => $i++,
                'name_en' => "Yemenite",
                'name_ar' =>        "يمني",
            ],
            [
                'id' => $i++,
                'name_en' => "Zambian",
                'name_ar' =>        "زامبيا",
            ],
            [
                'id' => $i++,
                'name_en' => "Zimbabwean",
                'name_ar' =>        "زمبابوي"
            ]
        ];

        Nationality::insert($nationalities);
    }
}
