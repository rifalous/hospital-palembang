<?php

use Illuminate\Database\Seeder;
use App\Menu;


class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        // check if table menus is empty
        if(DB::table('menus')->get()->count() == 0){

            DB::table('menus')->insert([
                [
                    'name' => 'Dashboard',
                    'url' => 'dashboard',
                    'icon' => 'mdi mdi-view-dashboard',
                    'is_showed' => 1,
                    'method' => 'dashboard'
                ],
                [
                    'name' => 'Master Data',
                    'url' => 'dashboard',
                    'icon' => 'mdi mdi-book',
                    'is_showed' => 1,
                    'method' => 'dashboard'                
                ],
                [
                    'name' => 'User',
                    'url' => 'user',
                    'icon' => 'mdi mdi-account',
                    'is_showed' => 1,
                    'method' => 'pengguna'                
                ],
                [
                    'name' => 'Divisi',
                    'url' => 'division',
                    'icon' => 'fa fa-users',
                    'is_showed' => 1,
                    'method' => 'dashboard'                
                ],
                [
                    'name' => 'Perusahaan',
                    'url' => 'company',
                    'icon' => 'fa fa-briefcase',
                    'is_showed' => 1,
                    'method' => 'dashboard'                
                ],
                [
                    'name' => 'Departemen',
                    'url' => 'department',
                    'icon' => 'fa fa-university',
                    'is_showed' => 1,
                    'method' => 'dashboard'                
                ],
                [
                    'name' => 'Pasien',
                    'url' => 'pasien',
                    'icon' => 'fa fa-wheelchair',
                    'is_showed' => 1,
                    'method' => 'dashboard'                
                ],
                [
                    'name' => 'Dokter',
                    'url' => 'doctor',
                    'icon' => 'fa fa-user-md',
                    'is_showed' => 1,
                    'method' => 'dashboard'                
                ],
                [
                    'name' => 'Tindakan/Tarif',
                    'url' => 'action',
                    'icon' => 'fa fa-usd',
                    'is_showed' => 1,
                    'method' => 'dashboard'                
                ],
                [
                    'name' => 'Kelas',
                    'url' => 'level',
                    'icon' => 'fa fa-level-up',
                    'is_showed' => 1,
                    'method' => 'dashboard'                
                ],
                [
                    'name' => 'Ruangan',
                    'url' => 'room',
                    'icon' => 'fa fa-bed',
                    'is_showed' => 1,
                    'method' => 'dashboard'                
                ],
                [
                    'name' => 'Supplier',
                    'url' => 'supplier',
                    'icon' => 'fa fa-balance-scale',
                    'is_showed' => 1,
                    'method' => 'dashboard'                
                ],
                [
                    'name' => 'Bahan & Obat ',
                    'url' => 'material',
                    'icon' => 'fa fa-medkit',
                    'is_showed' => 1,
                    'method' => 'dashboard'                
                ],
                [
                    'name' => 'Rawat Inap',
                    'url' => 'inpatient',
                    'icon' => 'fa fa-hospital-o',
                    'is_showed' => 1,
                    'method' => 'dashboard'                
                ],
                [
                    'name' => 'Registrasi',
                    'url' => 'registration_inpatient',
                    'icon' => 'fa fa-user-plus',
                    'is_showed' => 1,
                    'method' => 'dashboard'                
                ],
                [
                    'name' => 'Pemeriksaan',
                    'url' => 'examination_inpatient',
                    'icon' => 'fa fa-stethoscope',
                    'is_showed' => 1,
                    'method' => 'dashboard'                
                ],
                [
                    'name' => 'Rawat Jalan',
                    'url' => 'outpatient',
                    'icon' => 'fa fa-ambulance',
                    'is_showed' => 1,
                    'method' => 'dashboard'                
                ],
                [
                    'name' => 'Registrasi',
                    'url' => 'registration_outpatient',
                    'icon' => 'fa fa-user-plus',
                    'is_showed' => 1,
                    'method' => 'dashboard'                
                ],
                [
                    'name' => 'Pemeriksaan',
                    'url' => 'examination_outpatient',
                    'icon' => 'fa fa-stethoscope',
                    'is_showed' => 1,
                    'method' => 'dashboard'                
                ],
                [
                    'name' => 'Pasien Keluar',
                    'url' => 'comes_out',
                    'icon' => 'fa fa-wheelchair-alt',
                    'is_showed' => 1,
                    'method' => 'dashboard'                
                ],
                [
                    'name' => 'Pembayaran',
                    'url' => 'payment',
                    'icon' => 'fa fa-usd',
                    'is_showed' => 1,
                    'method' => 'dashboard'                
                ],
                [
                    'name' => 'Settings',
                    'url' => 'settings',
                    'icon' => 'mdi mdi-settings',
                    'is_showed' => 1,
                    'method' => 'dashboard'                
                ],
                [
                    'name' => 'Roles',
                    'url' => 'settings/role',
                    'icon' => 'fa fa-universal-access',
                    'is_showed' => 1,
                    'method' => 'dashboard'                
                ],
                [
                    'name' => 'Permissions',
                    'url' => 'settings/permission',
                    'icon' => 'fa fa-key',
                    'is_showed' => 1,
                    'method' => 'dashboard'                
                ],
                [
                    'name' => 'System',
                    'url' => 'system',
                    'icon' => 'fa fa-cogs',
                    'is_showed' => 1,
                    'method' => 'dashboard'                
                ],
                [
                    'name' => 'Menu',
                    'url' => 'menu',
                    'icon' => 'mdi mdi-menu',
                    'is_showed' => 1,
                    'method' => 'dashboard'                
                ]

            ]);

        } else { echo "\eTable is not empty."; }

    }
}

