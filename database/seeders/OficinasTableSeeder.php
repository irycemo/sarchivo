<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OficinasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('oficinas')->delete();
        
        \DB::table('oficinas')->insert(array (
            0 => 
            array (
                'id' => 1,
                'municipio' => 1,
                'oficina' => 102,
                'nombre' => 'ACUITZIO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'municipio' => 2,
                'oficina' => 1402,
                'nombre' => 'AGUILILLA',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'municipio' => 3,
                'oficina' => 202,
                'nombre' => 'ALVARO OBREGON',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'municipio' => 4,
                'oficina' => 1902,
                'nombre' => 'ANGAMACUTIRO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'municipio' => 5,
                'oficina' => 502,
                'nombre' => 'ANGANGUEO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'municipio' => 6,
                'oficina' => 1401,
                'nombre' => 'APATZINGAN',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'municipio' => 7,
                'oficina' => 402,
                'nombre' => 'APORO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'municipio' => 8,
                'oficina' => 2202,
                'nombre' => 'AQUILA',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'municipio' => 9,
                'oficina' => 801,
                'nombre' => 'ARIO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'municipio' => 10,
                'oficina' => 901,
                'nombre' => 'ARTEAGA',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'municipio' => 11,
                'oficina' => 2002,
                'nombre' => 'BRISEÑAS',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'municipio' => 12,
                'oficina' => 1403,
                'nombre' => 'BUENAVISTA',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'municipio' => 13,
                'oficina' => 602,
                'nombre' => 'CARACUARO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'municipio' => 14,
                'oficina' => 2201,
                'nombre' => 'COAHUAYANA',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'municipio' => 15,
                'oficina' => 1501,
                'nombre' => 'COALCOMAN',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'municipio' => 16,
                'oficina' => 1102,
                'nombre' => 'COENEO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            16 => 
            array (
                'id' => 17,
                'municipio' => 17,
                'oficina' => 403,
                'nombre' => 'CONTEPEC',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            17 => 
            array (
                'id' => 18,
                'municipio' => 18,
                'oficina' => 103,
                'nombre' => 'COPANDARO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            18 => 
            array (
                'id' => 19,
                'municipio' => 19,
                'oficina' => 1302,
                'nombre' => 'COTIJA',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            19 => 
            array (
                'id' => 20,
                'municipio' => 20,
                'oficina' => 104,
                'nombre' => 'CUITZEO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            20 => 
            array (
                'id' => 21,
                'municipio' => 21,
                'oficina' => 1202,
                'nombre' => 'CHARAPAN',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            21 => 
            array (
                'id' => 22,
                'municipio' => 22,
                'oficina' => 105,
                'nombre' => 'CHARO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            22 => 
            array (
                'id' => 23,
                'municipio' => 23,
                'oficina' => 1602,
                'nombre' => 'CHAVINDA',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            23 => 
            array (
                'id' => 24,
                'municipio' => 24,
                'oficina' => 1203,
                'nombre' => 'CHERAN',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            24 => 
            array (
                'id' => 25,
                'municipio' => 25,
                'oficina' => 1702,
                'nombre' => 'CHILCHOTA',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            25 => 
            array (
                'id' => 26,
                'municipio' => 26,
                'oficina' => 1502,
                'nombre' => 'CHINICUILA',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            26 => 
            array (
                'id' => 27,
                'municipio' => 27,
                'oficina' => 106,
                'nombre' => 'CHUCANDIRO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            27 => 
            array (
                'id' => 28,
                'municipio' => 28,
                'oficina' => 1802,
                'nombre' => 'CHURINTZIO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            28 => 
            array (
                'id' => 29,
                'municipio' => 29,
                'oficina' => 802,
                'nombre' => 'CHURUMUCO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            29 => 
            array (
                'id' => 30,
                'municipio' => 30,
                'oficina' => 1703,
                'nombre' => 'ECUANDUREO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            30 => 
            array (
                'id' => 31,
                'municipio' => 31,
                'oficina' => 404,
                'nombre' => 'EPITACIO HUERTA',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            31 => 
            array (
                'id' => 32,
                'municipio' => 32,
                'oficina' => 1002,
                'nombre' => 'ERONGARICUARO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            32 => 
            array (
                'id' => 33,
                'municipio' => 33,
                'oficina' => 1204,
                'nombre' => 'GABRIEL ZAMORA',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            33 => 
            array (
                'id' => 34,
                'municipio' => 34,
                'oficina' => 301,
                'nombre' => 'HIDALGO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            34 => 
            array (
                'id' => 35,
                'municipio' => 35,
                'oficina' => 803,
                'nombre' => 'LA HUACANA',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            35 => 
            array (
                'id' => 36,
                'municipio' => 36,
                'oficina' => 107,
                'nombre' => 'HUANDACAREO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            36 => 
            array (
                'id' => 37,
                'municipio' => 37,
                'oficina' => 1103,
                'nombre' => 'HUANIQUEO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            37 => 
            array (
                'id' => 38,
                'municipio' => 38,
                'oficina' => 601,
                'nombre' => 'HUETAMO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            38 => 
            array (
                'id' => 39,
                'municipio' => 39,
                'oficina' => 1003,
                'nombre' => 'HUIRAMBA',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            39 => 
            array (
                'id' => 40,
                'municipio' => 40,
                'oficina' => 203,
                'nombre' => 'INDAPARAPEO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            40 => 
            array (
                'id' => 41,
                'municipio' => 41,
                'oficina' => 302,
                'nombre' => 'IRIMBO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            41 => 
            array (
                'id' => 42,
                'municipio' => 42,
                'oficina' => 1704,
                'nombre' => 'IXTLAN',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            42 => 
            array (
                'id' => 43,
                'municipio' => 43,
                'oficina' => 1705,
                'nombre' => 'JACONA',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            43 => 
            array (
                'id' => 44,
                'municipio' => 44,
                'oficina' => 1105,
                'nombre' => 'JIMENEZ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            44 => 
            array (
                'id' => 45,
                'municipio' => 45,
                'oficina' => 1601,
                'nombre' => 'JIQUILPAN',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            45 => 
            array (
                'id' => 46,
                'municipio' => 46,
                'oficina' => 503,
                'nombre' => 'JUAREZ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            46 => 
            array (
                'id' => 47,
                'municipio' => 47,
                'oficina' => 504,
                'nombre' => 'JUNGAPEO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            47 => 
            array (
                'id' => 48,
                'municipio' => 48,
                'oficina' => 1004,
                'nombre' => 'LAGUNILLAS',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            48 => 
            array (
                'id' => 49,
                'municipio' => 49,
                'oficina' => 108,
                'nombre' => 'MADERO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            49 => 
            array (
                'id' => 50,
                'municipio' => 50,
                'oficina' => 401,
                'nombre' => 'MARAVATIO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            50 => 
            array (
                'id' => 51,
                'municipio' => 51,
                'oficina' => 1603,
                'nombre' => 'MARCOS CASTELLANOS',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            51 => 
            array (
                'id' => 52,
                'municipio' => 52,
                'oficina' => 2301,
                'nombre' => 'LAZARO CARDENAS',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            52 => 
            array (
                'id' => 53,
                'municipio' => 53,
                'oficina' => 101,
                'nombre' => 'MORELIA',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            53 => 
            array (
                'id' => 54,
                'municipio' => 54,
                'oficina' => 1904,
                'nombre' => 'MORELOS',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            54 => 
            array (
                'id' => 55,
                'municipio' => 55,
                'oficina' => 1404,
                'nombre' => 'MUGICA',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            55 => 
            array (
                'id' => 56,
                'municipio' => 56,
                'oficina' => 1206,
                'nombre' => 'NAHUATZEN',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            56 => 
            array (
                'id' => 57,
                'municipio' => 57,
                'oficina' => 603,
                'nombre' => 'NOCUPETARO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            57 => 
            array (
                'id' => 58,
                'municipio' => 58,
                'oficina' => 1205,
                'nombre' => 'NUEVO PARANGARICUTIRO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            58 => 
            array (
                'id' => 59,
                'municipio' => 59,
                'oficina' => 804,
                'nombre' => 'NUEVO URECHO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            59 => 
            array (
                'id' => 60,
                'municipio' => 60,
                'oficina' => 1803,
                'nombre' => 'NUMARAN',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            60 => 
            array (
                'id' => 61,
                'municipio' => 61,
                'oficina' => 505,
                'nombre' => 'OCAMPO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            61 => 
            array (
                'id' => 62,
                'municipio' => 62,
                'oficina' => 2103,
                'nombre' => 'PAJACUARAN',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            62 => 
            array (
                'id' => 63,
                'municipio' => 63,
                'oficina' => 1104,
                'nombre' => 'PANINDICUARO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            63 => 
            array (
                'id' => 64,
                'municipio' => 64,
                'oficina' => 1405,
                'nombre' => 'PARACUARO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            64 => 
            array (
                'id' => 65,
                'municipio' => 65,
                'oficina' => 1207,
                'nombre' => 'PARACHO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            65 => 
            array (
                'id' => 66,
                'municipio' => 66,
                'oficina' => 1001,
                'nombre' => 'PATZCUARO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            66 => 
            array (
                'id' => 67,
                'municipio' => 67,
                'oficina' => 1804,
                'nombre' => 'PENJAMILLO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            67 => 
            array (
                'id' => 68,
                'municipio' => 68,
                'oficina' => 1303,
                'nombre' => 'PERIBAN',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            68 => 
            array (
                'id' => 69,
                'municipio' => 69,
                'oficina' => 1801,
                'nombre' => 'LA PIEDAD',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            69 => 
            array (
                'id' => 70,
                'municipio' => 70,
                'oficina' => 1706,
                'nombre' => 'PUREPERO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            70 => 
            array (
                'id' => 71,
                'municipio' => 71,
                'oficina' => 1901,
                'nombre' => 'PURUANDIRO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            71 => 
            array (
                'id' => 72,
                'municipio' => 72,
                'oficina' => 204,
                'nombre' => 'QUERENDARO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            72 => 
            array (
                'id' => 73,
                'municipio' => 73,
                'oficina' => 1005,
                'nombre' => 'QUIROGA',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            73 => 
            array (
                'id' => 74,
                'municipio' => 74,
                'oficina' => 2102,
                'nombre' => 'COJUMATLAN DE REGULES',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            74 => 
            array (
                'id' => 75,
                'municipio' => 75,
                'oficina' => 1301,
                'nombre' => 'LOS REYES',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            75 => 
            array (
                'id' => 76,
                'municipio' => 76,
                'oficina' => 2101,
                'nombre' => 'SAHUAYO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            76 => 
            array (
                'id' => 77,
                'municipio' => 77,
                'oficina' => 604,
                'nombre' => 'SAN LUCAS',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            77 => 
            array (
                'id' => 78,
                'municipio' => 78,
                'oficina' => 109,
                'nombre' => 'SANTA ANA MAYA',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            78 => 
            array (
                'id' => 79,
                'municipio' => 79,
                'oficina' => 1006,
                'nombre' => 'SALVADOR ESCALANTE',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            79 => 
            array (
                'id' => 80,
                'municipio' => 80,
                'oficina' => 405,
                'nombre' => 'SENGUIO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            80 => 
            array (
                'id' => 81,
                'municipio' => 81,
                'oficina' => 506,
                'nombre' => 'SUSUPUATO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            81 => 
            array (
                'id' => 82,
                'municipio' => 82,
                'oficina' => 701,
                'nombre' => 'TACAMBARO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            82 => 
            array (
                'id' => 83,
                'municipio' => 83,
                'oficina' => 1208,
                'nombre' => 'TANCITARO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            83 => 
            array (
                'id' => 84,
                'municipio' => 84,
                'oficina' => 1707,
                'nombre' => 'SANTIAGO TANGAMANDAPIO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            84 => 
            array (
                'id' => 85,
                'municipio' => 85,
                'oficina' => 1708,
                'nombre' => 'TANGANCICUARO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            85 => 
            array (
                'id' => 86,
                'municipio' => 86,
                'oficina' => 2001,
                'nombre' => 'TANHUATO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            86 => 
            array (
                'id' => 87,
                'municipio' => 87,
                'oficina' => 1209,
                'nombre' => 'TARETAN',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            87 => 
            array (
                'id' => 88,
                'municipio' => 88,
                'oficina' => 110,
                'nombre' => 'TARIMBARO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            88 => 
            array (
                'id' => 89,
                'municipio' => 89,
                'oficina' => 1406,
                'nombre' => 'TEPALCATEPEC',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            89 => 
            array (
                'id' => 90,
                'municipio' => 90,
                'oficina' => 1210,
                'nombre' => 'TINGAMBATO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            90 => 
            array (
                'id' => 91,
                'municipio' => 91,
                'oficina' => 1304,
                'nombre' => 'TINGUINDIN',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            91 => 
            array (
                'id' => 92,
                'municipio' => 92,
                'oficina' => 605,
                'nombre' => 'TIQUICHEO DE N R',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            92 => 
            array (
                'id' => 93,
                'municipio' => 93,
                'oficina' => 406,
                'nombre' => 'TLALPUJAHUA',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            93 => 
            array (
                'id' => 94,
                'municipio' => 94,
                'oficina' => 1805,
                'nombre' => 'TLAZAZALCA',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            94 => 
            array (
                'id' => 95,
                'municipio' => 95,
                'oficina' => 1305,
                'nombre' => 'TOCUMBO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            95 => 
            array (
                'id' => 96,
                'municipio' => 96,
                'oficina' => 902,
                'nombre' => 'TUMBISCATIO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            96 => 
            array (
                'id' => 97,
                'municipio' => 97,
                'oficina' => 702,
                'nombre' => 'TURICATO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            97 => 
            array (
                'id' => 98,
                'municipio' => 98,
                'oficina' => 507,
                'nombre' => 'TUXPAN',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            98 => 
            array (
                'id' => 99,
                'municipio' => 99,
                'oficina' => 508,
                'nombre' => 'TUZANTLA',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            99 => 
            array (
                'id' => 100,
                'municipio' => 100,
                'oficina' => 1007,
                'nombre' => 'TZINTZUNTZAN',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            100 => 
            array (
                'id' => 101,
                'municipio' => 101,
                'oficina' => 111,
                'nombre' => 'TZITZIO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            101 => 
            array (
                'id' => 102,
                'municipio' => 102,
                'oficina' => 1201,
                'nombre' => 'URUAPAN',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            102 => 
            array (
                'id' => 103,
                'municipio' => 103,
                'oficina' => 2104,
                'nombre' => 'VENUSTIANO CARRANZA',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            103 => 
            array (
                'id' => 104,
                'municipio' => 104,
                'oficina' => 1604,
                'nombre' => 'VILLAMAR',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            104 => 
            array (
                'id' => 105,
                'municipio' => 105,
                'oficina' => 2003,
                'nombre' => 'VISTA HERMOSA',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            105 => 
            array (
                'id' => 106,
                'municipio' => 106,
                'oficina' => 2004,
                'nombre' => 'YURECUARO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            106 => 
            array (
                'id' => 107,
                'municipio' => 107,
                'oficina' => 1101,
                'nombre' => 'ZACAPU',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            107 => 
            array (
                'id' => 108,
                'municipio' => 108,
                'oficina' => 1701,
                'nombre' => 'ZAMORA',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            108 => 
            array (
                'id' => 109,
                'municipio' => 109,
                'oficina' => 1806,
                'nombre' => 'ZINAPARO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            109 => 
            array (
                'id' => 110,
                'municipio' => 110,
                'oficina' => 201,
                'nombre' => 'ZINAPECUARO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            110 => 
            array (
                'id' => 111,
                'municipio' => 111,
                'oficina' => 1211,
                'nombre' => 'ZIRACUARETIRO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            111 => 
            array (
                'id' => 112,
                'municipio' => 112,
                'oficina' => 501,
                'nombre' => 'ZITACUARO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            112 => 
            array (
                'id' => 113,
                'municipio' => 113,
                'oficina' => 1903,
                'nombre' => 'JOSE SIXTO VERDUZCO',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}