<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\role;
use App\Models\transaksi;
use App\Models\user;
use App\Models\saldo;
use App\Models\barang;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create(['name' => 'Administrator']);
        $bank_mini = Role::create(['name' => 'bank mini']);
        $koperasi = Role::create(['name' => 'koperasi']);
        $siswa = Role::create(['name' => 'siswa']);

        User::create([
            'name' => 'faris',
            'email' => 'faris@gmail.com',
            'password' => Hash::make('faris123'),
            'role_id' => $admin->id
        ]);

        User::create([
            'name' => 'davina',
            'email' => 'davina@gmail.com',
            'password' => Hash::make('davina123'),
            'role_id' => $bank_mini->id
        ]);

        User::create([
            'name' => 'ernawati',
            'email' => 'ernawati@gmail.com',
            'password' => Hash::make('ernawati123'),
            'role_id' => $koperasi->id
        ]);

        $rehan = User::create([
            'name' => 'rehan',
            'email' => 'rehan@gmail.com',
            'password' => Hash::make('rehan123'),
            'role_id' => $siswa->id
        ]);

        $baju = Barang::create([
            'name' => 'baju sekolah',
            'price' => 150000,
            'stock' => 100,
            'desc' => 'baju sekolah hari senin-jumat'
        ]);

        Barang::create([
            'name' => 'dasi sekolah',
            'price' => 10000,
            'stock' => 100,
            'desc' => 'dasi sekolah kelas 7,8,9'
        ]);

        Barang::create([
            'name' => 'ikat pinggang',
            'price' => 10000,
            'stock' => 100,
            'desc' => 'ikat pinggang'
        ]);

        Barang::create([
            'name' => 'paket alat tulis',
            'price' => 15000,
            'stock' => 50,
            'desc' => 'paket alat tulis ada pulpen, pensil, penghapus, dll'
        ]);


        Saldo::create([
            'user_id' => $rehan->id,
            'saldo' => 300000
        ]);

        transaksi::create([
            'user_id' => $rehan->id,
            'barang_id' => null,
            'jumlah' => 100000,
            'invoice_id' => 'SAL_001'
        ]);

        transaksi::create([
            'user_id' => $rehan->id,
            'barang_id' => $baju->id,
            'jumlah' => 2,
            'invoice_id' => 'INV_001'
        ]);
    }
}
