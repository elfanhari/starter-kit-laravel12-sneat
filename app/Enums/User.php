<?php

namespace App\Enums;

enum User: string
{
  // Jenis Kelamin
  case LAKI_LAKI = 'Laki-laki';
  case PEREMPUAN = 'Perempuan';

    // Role User
  case ADMIN = 'Admin';
  case CUSTOMER = 'Customer';

  // Method untuk mendapatkan opsi jenis kelamin
  public static function jk(): array
  {
    return [
      'L' => self::LAKI_LAKI->value,
      'P' => self::PEREMPUAN->value,
    ];
  }

  // Method untuk mendapatkan opsi role user
  public static function role(): array
  {
    return [
      'admin' => self::ADMIN->value,
      'customer' => self::CUSTOMER->value,
    ];
  }
}
