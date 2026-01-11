<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Facility;
use App\Models\User;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Znajdź admina jako właściciela placówek
        $admin = User::where('email', 'admin@oaza.pl')->first();
        
        if (!$admin) {
            // Jeśli admin nie istnieje, użyj pierwszego dostępnego użytkownika
            $admin = User::first();
        }

        $facilities = [
            [
                'name' => 'Fundacja Synapsis',
                'address' => 'ul. Ondraszka 3',
                'city' => 'Warszawa',
                'province' => 'mazowieckie',
                'postal_code' => '02-085',
                'phone' => '(+ 48 22) 825 87 42',
                'email' => 'fundacja@synapsis.org.pl',
                'website' => 'https://synapsis.org.pl/',
                'description' => 'Misją Fundacji SYNAPSIS jest niesienie profesjonalnej pomocy dzieciom i dorosłym osobom z autyzmem i ich rodzinom oraz wypracowywanie systemowych rozwiązań, które poprawią jakość ich życia.',
            ],
            [
                'name' => 'Stowarzyszenie Innowacji Społecznych Mary&Max',
                'address' => 'ul. Marszałkowska 84/92 lok. 201',
                'city' => 'Warszawa',
                'province' => 'mazowieckie',
                'postal_code' => '00-514',
                'phone' => '+ 48 516 735 521',
                'email' => 'kontakt@maryimax.pl',
                'website' => 'https://maryimax.pl/',
                'description' => 'Placówka zapewnia wsparcie dla młodzieży(od 14 lat) i dorosłych w spektrum autyzmu organizując warsztaty rozwijania umiejętności społecznych, klub spotkań oraz wolontariat koleżeński',
            ],
            [
                'name' => 'Szpital dla Nerwowo i Psychicznie Chorych',
                'address' => 'al. Tysiąclecia 30',
                'city' => 'Bolesławiec',
                'province' => 'dolnośląskie',
                'postal_code' => '59-700',
                'phone' => '756162648',
                'email' => 'sekretariat@szpitalpsychiatryczny.pl',
                'website' => 'https://www.szpitalpsychiatryczny.pl',
                'description' => '',
            ],
            [
                'name' => 'Wojewódzki Szpital Psychiatryczny w Złotoryi',
                'address' => 'ul. Szpitalna 9',
                'city' => 'Złotoryja',
                'province' => 'dolnośląskie',
                'postal_code' => '59-500',
                'phone' => '768779300',
                'email' => 'sekretariat.wszp@gmail.com',
                'website' => 'https://wsp.szpitalna9.pl',
                'description' => '',
            ],
            [
                'name' => 'Dolnośląskie Centrum Zdrowia Psychicznego',
                'address' => 'wyb. Józefa Conrada-Korzeniowskiego 18',
                'city' => 'Wrocław',
                'province' => 'dolnośląskie',
                'postal_code' => '50-226',
                'phone' => '717766212',
                'email' => 'sekretariat@dczp.wroclaw.pl',
                'website' => 'https://dczp.wroclaw.pl',
                'description' => '',
            ],
            [
                'name' => 'Wojewódzki Szpital Specjalistyczny im. J. Gromkowskiego',
                'address' => 'ul. Koszarowa 5',
                'city' => 'Wrocław',
                'province' => 'dolnośląskie',
                'postal_code' => '51-149',
                'phone' => '713261325',
                'email' => 'gromkowski@szpital.wroc.pl',
                'website' => 'https://www.szpital.wroc.pl',
                'description' => '',
            ],
            [
                'name' => 'Katedra Psychiatrii Uniwersytetu Medycznego we Wrocławiu',
                'address' => 'ul. Wybrzeże L. Laustera 10',
                'city' => 'Wrocław',
                'province' => 'dolnośląskie',
                'postal_code' => '50-367',
                'phone' => '717331100',
                'email' => 'psychiatria@umed.wroc.pl',
                'website' => 'https://www.usk.wroc.pl/',
                'description' => '',
            ],
            [
                'name' => 'Specjalistyczny Szpital im. Dra Alfreda Sokołowskiego',
                'address' => 'ul. Stefana Batorego 4',
                'city' => 'Wałbrzych',
                'province' => 'dolnośląskie',
                'postal_code' => '58-309',
                'phone' => '746489600',
                'email' => 'szpitalsokolowski@zdrowie.walbrzych.pl',
                'website' => 'https://www.zdrowie.walbrzych.pl',
                'description' => '',
            ],
            [
                'name' => 'Wojewódzki Szpital dla Nerwowo i Psychicznie Chorych w Świeciu',
                'address' => 'ul. Sądowa 18',
                'city' => 'Świecie',
                'province' => 'kujawsko-pomorskie',
                'postal_code' => '86-100',
                'phone' => '523308305',
                'email' => 'sekretariat@szpital-psychiatryczny.swiecie.pl',
                'website' => 'https://www.szpital-psychiatryczny.swiecie.pl/',
                'description' => '',
            ],
            [
                'name' => 'Wojewódzki Szpital Zespolony im. L. Rydygiera w Toruniu',
                'address' => 'ul. Marii Skłodowskiej-Curie 27/29',
                'city' => 'Toruń',
                'province' => 'kujawsko-pomorskie',
                'postal_code' => '87-100',
                'phone' => '566793500',
                'email' => 'sekretariat@wszz.torun.pl',
                'website' => 'https://www.wszz.torun.pl/',
                'description' => '',
            ],
            [
                'name' => 'Szpital Neuropsychiatryczny im. prof. M. Kaczyńskiego',
                'address' => 'ul. Abramowicka 2',
                'city' => 'Lublin',
                'province' => 'lubelskie',
                'postal_code' => '20-442',
                'phone' => '817441079',
                'email' => 'sekretariat@snzoz.lublin.pl',
                'website' => 'https://www.snzoz.lublin.pl',
                'description' => '',
            ],
            [
                'name' => 'Samodzielny Publiczny Wojewódzki Szpital Specjalistyczny w Chełmie',
                'address' => 'ul. Ceramiczna 1',
                'city' => 'Chełm',
                'province' => 'lubelskie',
                'postal_code' => '22-100',
                'phone' => '825623223',
                'email' => 'szpital@szpital.chelm.pl',
                'website' => 'https://www.szpital.chelm.pl',
                'description' => '',
            ],
            [
                'name' => 'Wojewódzki Szpital Specjalistyczny dla Nerwowo i Psychicznie Chorych w Ciborzu',
                'address' => 'Cibórz 5',
                'city' => 'Cibórz',
                'province' => 'lubuskie',
                'postal_code' => '66-213',
                'phone' => '683419350',
                'email' => 'szpital@ciborz.eu',
                'website' => 'https://www.ciborz.eu',
                'description' => '',
            ],
            [
                'name' => 'Wielospecjalistyczny Szpital Wojewódzki w Gorzowie Wlkp.',
                'address' => 'ul. Franciszka Walczaka 42',
                'city' => 'Gorzów Wielkopolski',
                'province' => 'lubuskie',
                'postal_code' => '66-400',
                'phone' => '957331600',
                'email' => 'sekretariat@szpital.gorzow.pl',
                'website' => 'https://www.szpital.gorzow.pl',
                'description' => '',
            ],
            [
                'name' => 'Specjalistyczny Psychiatryczny Zespół Opieki Zdrowotnej - Szpital im. dr. J. Babińskiego',
                'address' => 'ul. Aleksandrowska 159',
                'city' => 'Łódź',
                'province' => 'łódzkie',
                'postal_code' => '91-229',
                'phone' => '426529401',
                'email' => 'sekretariat@babinski.home.pl',
                'website' => 'https://www.babinski.home.pl/',
                'description' => '',
            ],
            [
                'name' => 'Centralny Szpital Kliniczny Uniwersytetu Medycznego w Łodzi',
                'address' => 'ul. Pomorska 51',
                'city' => 'Łódź',
                'province' => 'łódzkie',
                'postal_code' => '92-213',
                'phone' => '426757272',
                'email' => 'poczta@csk.umed.pl',
                'website' => 'https://www.csk.umed.pl/',
                'description' => '',
            ],
            [
                'name' => 'Centrum Psychiatryczne w Warcie',
                'address' => 'ul. Sieradzka 3',
                'city' => 'Warta',
                'province' => 'łódzkie',
                'postal_code' => '98-290',
                'phone' => '438294013',
                'email' => 'szpitalwarta@szpitalwarta.pl',
                'website' => 'https://www.szpitalwarta.regiony.pl/',
                'description' => '',
            ],
            [
                'name' => 'Szpital Kliniczny im. dr Józefa Babińskiego',
                'address' => 'ul. Babińskiego 29',
                'city' => 'Kraków',
                'province' => 'małopolskie',
                'postal_code' => '30-393',
                'phone' => '12524347',
                'email' => 'biuro@babinski.pl',
                'website' => 'https://babinski.pl/',
                'description' => '',
            ],
            [
                'name' => 'Wojewódzki Szpital Specjalistyczny im. Ludwika Rydygiera',
                'address' => 'Osiedle Złotej Jesieni 1',
                'city' => 'Kraków',
                'province' => 'małopolskie',
                'postal_code' => '31-826',
                'phone' => '126468502',
                'email' => 'rydygier@rydygierkrakow.pl',
                'website' => 'https://www.szpitalrydygier.pl/',
                'description' => '',
            ],
            [
                'name' => 'Wojewódzki Szpital Psychiatryczny w Andrychowie',
                'address' => 'ul. Dąbrowskiego 19',
                'city' => 'Andrychów',
                'province' => 'małopolskie',
                'postal_code' => '34-120',
                'phone' => '338752446',
                'email' => 'szpital@szpital.info.pl',
                'website' => 'https://www.szpital.info.pl',
                'description' => '',
            ],
            [
                'name' => 'Szpital Uniwersytecki w Krakowie',
                'address' => 'ul. Mikołaja Kopernika 36',
                'city' => 'Kraków',
                'province' => 'małopolskie',
                'postal_code' => '31-501',
                'phone' => '124247000',
                'email' => 'info@su.krakow.pl',
                'website' => 'https://www.su.krakow.pl',
                'description' => '',
            ],
            [
                'name' => 'Podhalański Szpital Specjalistyczny im. Jana Pawła II w Nowym Targu',
                'address' => 'ul. Szpitalna 14',
                'city' => 'Nowy Targ',
                'province' => 'małopolskie',
                'postal_code' => '34-400',
                'phone' => '182633000',
                'email' => 'sekretariat@pszs.eu',
                'website' => 'https://www.pszs.eu',
                'description' => '',
            ],
        ];

        foreach ($facilities as $facilityData) {
            $facilityData['user_id'] = $admin->id;
            Facility::create($facilityData);
        }
    }
}
