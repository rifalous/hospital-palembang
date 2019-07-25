<?php

use Illuminate\Database\Seeder;
use App\System;


class SystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        // check if table systems is empty
        if(DB::table('systems')->get()->count() == 0){

            DB::table('systems')->insert([
                [
                    'system_type' => 'config_multiply',
                    'system_code' => 'status',
                    'system_val' => '0, Non Active;1, Active'
                ],
                [
                    'system_type' => 'config_other',
                    'system_code' => 'dir_key',
                    'system_val' => 'ADMIN;PLANT'
                ],
                [
                    'system_type' => 'config_multiply',
                    'system_code' => 'religion',
                    'system_val' => 'islam,Islam;kristen,Kristen;budha,Budha;kataolik,Katolik;hindu,Hindu;kepercayaan,Kepercayaan'
                ],
                [
                    'system_type' => 'config_multiply',
                    'system_code' => 'education',
                    'system_val' => 'SD,SD;SMP,SMP;SMA,SMA;S1,S1;S2,S2'
                ],
                [
                    'system_type' => 'config_multiply',
                    'system_code' => 'gender',
                    'system_val' => 'Pria,Laki Laki; Perempuan,Perempuan'
                ],
                [
                    'system_type' => 'config_multiply',
                    'system_code' => 'work',
                    'system_val' => 'Pegawai Negeri,Pegawai Negeri;TNI/POLRI,TNI/POlRI;BUMN/BUMD,BUMN/BUMD;Guru,Guru;Pengusaha,Pengusaha,Karyawan Swasta,Karyawan Swasta;Petani,Petani;Peternak,Peternak;Wiraswasta,Wiraswasta'
                ],
                [
                    'system_type' => 'config_multiply',
                    'system_code' => 'blood_group',
                    'system_val' => 'A-,A Rh-;A+,A Rh+;AB-,AB Rh-;AB+,AB Rh+;B-,B Rh-;B+,B Rh+;O-,O Rh-;O+,O Rh+'
                ],
                [
                    'system_type' => 'config_multiply',
                    'system_code' => 'poliklinik',
                    'system_val' => 'Poli Klinik,Poli Klinik;Poli Bedah,Poli Bedah;Poli Anak, Poli Anak;Poli Gigi,Poli Gigi;Poli Kebidanan,Poli Kebidanan'
                ],
                [
                    'system_type' => 'config_multiply',
                    'system_code' => 'drug_class',
                    'system_val' => 'AKS,Alat Kesehatan;BBK,Bahan Baku;GEN,Generik;NAR,Narkotika;NGN,Non Generik'
                ],
                [
                    'system_type' => 'config_multiply',
                    'system_code' => 'type_of_medicine',
                    'system_val' => 'EXT,Penggunaan Luar;INF,Infus;INJ,Injeksi;ORA,Oral'
                ],
                [
                    'system_type' => 'config_multiply',
                    'system_code' => 'disease',
                    'system_val' => '01,Paru-Paru;02,Kusta'
                ],
                [
                    'system_type' => 'config_multiply',
                    'system_code' => 'marital_status',
                    'system_val' => 'Lajang,Lajang;Kawin,Kawin;Duda,Duda;Janda,Janda'
                ],
                [
                    'system_type' => 'config_multiply',
                    'system_code' => 'family_relationship',
                    'system_val' => '01,Ayah/Ibu;02,Paman/Bibi;03,Kakak/Adik;04,Saudara'
                ],
                [
                    'system_type' => 'config_multiply',
                    'system_code' => 'entry_procedure',
                    'system_val' => '01,Melalui Rawat Jalan;02,Melalui UGD;03,Kiriman Dokter;04,Rujukan RS Lain;05,Dari Puskesmas;06,Masuk Langsung'
                ],
                [
                    'system_type' => 'config_multiply',
                    'system_code' => 'payment',
                    'system_val' => '01,Tunai/Sendiri;02,Askes;03,Tanggungan Perusahaan;04,Kartu Kredit'
                ],
                [
                    'system_type' => 'config_multiply',
                    'system_code' => 'discount',
                    'system_val' => 'JAMST,Jamsostek;JPS,Jaring Pengaman Sos;KARY,Karyawan RS;PERSH,Perusahaan Langganan'
                ],
                [
                    'system_type' => 'config_multiply',
                    'system_code' => 'way_out',
                    'system_val' => '01,Kemauan Sendiri;02,Pulang Paksa;03,Melarikan Diri'
                ],
                [
                    'system_type' => 'config_multiply',
                    'system_code' => 'exit_state',
                    'system_val' => '01,Sembuh;02,Perbaikan;03,Masih Sakit;04,Meninggal Dunia'
                ],
                [
                    'system_type' => 'config_other',
                    'system_code' => 'person_in_charge',
                    'system_val' => 'Orang Tua;Teman'
                ],
                [
                    'system_type' => 'config_other',
                    'system_code' => 'entry_procedure',
                    'system_val' => 'Rumah;Puskesmas'
                ] 
            ]);

        } else { echo "\eTable is not empty."; }

    }
}

