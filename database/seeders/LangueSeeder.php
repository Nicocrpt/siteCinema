<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LangueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement("
            INSERT INTO langues (langue, iso_2, iso_3) VALUES
                ('Anglais', 'en', 'eng'),
                ('Français', 'fr', 'fra'),
                ('Espagnol', 'es', 'spa'),
                ('Allemand', 'de', 'deu'),
                ('Italien', 'it', 'ita'),
                ('Néerlandais', 'nl', 'nld'),
                ('Portugais', 'pt', 'por'),
                ('Russe', 'ru', 'rus'),
                ('Chinois', 'zh', 'chi'),
                ('Japonais', 'ja', 'jpn'),
                ('Coréen', 'ko', 'kor'),
                ('Arabe', 'ar', 'ara'),
                ('Turc', 'tr', 'tur'),
                ('Suédois', 'sv', 'swe'),
                ('Danois', 'da', 'dan'),
                ('Norvégien', 'no', 'nor'),
                ('Finnois', 'fi', 'fin'),
                ('Polonais', 'pl', 'pol'),
                ('Hongrois', 'hu', 'hun'),
                ('Tchèque', 'cs', 'ces'),
                ('Roumain', 'ro', 'ron'),
                ('Grec', 'el', 'ell'),
                ('Hébreu', 'he', 'heb'),
                ('Indonésien', 'id', 'ind'),
                ('Thaïlandais', 'th', 'tha'),
                ('Vietnamien', 'vi', 'vie'),
                ('Malais', 'ms', 'msa'),
                ('Filipino', 'tl', 'fil'),
                ('Tok Pisin', 'tpi', 'tpi'),  
                ('Lingala', 'lin', 'lin'),     
                ('Wolof', 'wol', 'wol'),       
                ('Guarani', 'grn', 'grn'),     
                ('Maori', 'mi', 'mi');
        ");
    }
}
