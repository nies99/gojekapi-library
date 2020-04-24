# UN-OFFICIAL GOJEK API WRAPPER LIBRARY

| Method  | Status  | Keterangan  |
|---|---|---|
| `loginPhone`  | OK | Login menggunakan Nomor Handphone ( Return `loginToken` ) |
| `loginEmail`  | OK | Login menggunakan Email ( Return `loginToken` ) |
| `loginGojek`  | OK  | Login menggunakan Kode OTP ( Return `authToken` ) |
| `checkBalance`  | OK  | Menampilkan Data Saldo |
| `bookingHistory`  | OK  | Menampilkan Data History Transaksi GO-JEK |
| `getCustomer`  | OK  | Menampilkan Informasi Akun |
| `editAccount`  | OK  | Melakukan Perubahan pada Informasi Akun |
| `editAccountVerify`  | OK  | Melakukan Perubahan pada Informasi Akun |
| `logout`  | OK  | Logout Akun |
| `gopayDetail`  | OK  | Menampilkan Informasi Akun GO-PAY secara Detil |
| `gopayHistory`  | OK  | Menampilkan Data History Transaksi GO-PAY |
| `checkWalletCode`  | OK  | Mengambil Data Wallet Code `qrId` |
| `gopayTransfer`  | OK  | Melakukan Transfer Saldo sesama Pengguna GO-PAY |

## Dokumentasi

### Instalasi
#### Native
```php
require 'class.php';

$gojek = new Gojek();
```

### Login
#### Langkah 1
```php
$gojek = new Gojek();
echo json_encode($gojek->loginPhone('NOMOR_HANDPHONE')->getResult());
```
atau

```php
$gojek = new Gojek();
echo json_encode($gojek->loginEmail('EMAIL')->getResult());
```

#### Langkah 2
```php
$gojek = new Gojek();
echo json_encode($gojek->loginGojek('LOGIN_TOKEN', 'KODE_OTP')->getResult());
```

### Penggunaan Method
#### checkBalance : Menampilkan Data Saldo
```php
$gojek->setAuthToken('AUTH_TOKEN');
$result = $gojek->checkBalance()->getResult();
echo json_encode($result);
```
#### bookingHistory : Menampilkan Data Transaksi GO-JEK
```php
$gojek->setAuthToken('AUTH_TOKEN');
$result = $gojek->bookingHistory()->getResult();
echo json_encode($result);
```

#### getCustomer : Menampilkan Informasi Akun
```php
$gojek->setAuthToken('AUTH_TOKEN');
$result = $gojek->getCustomer()->getResult();
echo json_encode($result);
```

#### editAccount : Melakukan Perubahan pada Informasi Akun
```php
$gojek->setAuthToken('AUTH_TOKEN');
$result = $gojek->editAccount('NOMOR_HANDPHONE', 'EMAIL', 'NAMA')->getResult();
echo json_encode($result);
```
#### logout : Logout Akun
```php
$gojek->setAuthToken('AUTH_TOKEN');
$result = $gojek->logout();
```

#### gopayDetail : Menampilkan Informasi Akun GO-PAY secara Detil
```php
$gojek->setAuthToken('AUTH_TOKEN');
$result = $gojek->gopayDetail()->getResult();
echo json_encode($result);
```

#### gopayHistory : Menampilkan Data History Transaksi GO-PAY
```php
$gojek->setAuthToken('AUTH_TOKEN');
$result = $gojek->gopayHistory('PAGE', 'LIMIT_ROWS')->getResult();
echo json_encode($result);
```

#### checkWalletCode : Mengambil Data Wallet Code `qrId`
```php
$gojek->setAuthToken('AUTH_TOKEN');
$result = $gojek->checkWalletCode('NOMOR_HANDPHONE_TUJUAN')->getResult();
echo json_encode($result);
```
#### gopayTransfer : Melakukan Transfer sesama Pengguna GO-PAY
```php
$gojek->setAuthToken('AUTH_TOKEN');
$result = $gojek->gopayTransfer('QR_ID', 'PIN', 'JUMLAH_TRANSFER', 'DESKRIPSI')->getRef();
echo json_encode($result);
```
