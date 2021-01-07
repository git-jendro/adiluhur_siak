<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Siswa;
use Faker\Generator as Faker;

$factory->define(Siswa::class, function (Faker $faker) {
    return [
        'nama' => $faker->name,
        'jenis_kelamin' => 'Laki-laki',
        'alamat_siswa' => $faker->address,
        'tanggal_lahir' => $faker->date,
        'tempat_lahir' => 'Jakarta',
        'nama_ayah' => 'Ayah',
        'nama_ibu' => 'Ibu',
        'alamat_ortu' => $faker->address,
        'no_telp_ortu' => $faker->randomDigit(13),
        'no_telp_siswa' => $faker->randomDigit(13),
        'no_ijazah' => $faker->randomDigit(5),
        'sekolah_asal' => $faker->word,
        'kd_agama' => $faker->randomDigitNot(0),
        'kd_kelas' => 'IPAXI1',
        'status_siswa' => 'aktif',
        'email' => $faker->freeEmailDomain,
        'password' => '123123',
    ];
});
