<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="/public/img/Logo-PTCC.png">
    <title>Formulir Pendaftaran {{ ucwords($data->nm_lengkap) }}</title>
    <style>
        /* Atur gaya CSS Anda di sini */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            size: A4;
            /* Menentukan ukuran halaman A4 */
        }

        @page {
            size: A4;
            /* Menentukan ukuran halaman A4 */
            margin: 3mm 10mm;
            /* Atur margin kertas A4 */
        }

        .container {
            width: 100%;
        }

        h2 {
            text-align: center;
            position: relative;
        }

        table {
            width: 100%;
            /* border-collapse: collapse; */
        }

        th,
        td {
            padding: 1px;
            /* border-bottom: 1px solid #ddd; */
        }

        th {
            text-align: left;
        }
    </style>


</head>

<body>
    <div class="container">
        <h2 style="text-align: center;">FORMULIR PENDAFTARAN</h2>
        <table>
            <tr>
                <th>1. No. Induk </th>
                <td>.........................................</td>
            </tr>
            <tr>
                <th>2. Nama Peserta </th>
                <td><b>{{ ucwords($data->nm_lengkap) }}</b></td>
            </tr>
            <tr>
                <th>3. Jenis Kelamin </th>
                <td>
                    @if (strtoupper($data->gender) == 'L')
                        Laki-Laki
                    @elseif(strtoupper($data->gender) == 'P')
                        Perempuan
                    @else
                        Tidak Valid
                    @endif
                </td>
            </tr>
            <tr>
                <th>4. Tempat, Tgl. Lahir </th>
                <td>{{ ucwords($data->tmp_lahir) }},
                    {{ \Carbon\Carbon::parse($data->tgl_lahir)->isoFormat('DD MMMM YYYY') }}</td>
            </tr>
            <tr>
                <th>5. Agama </th>
                <td>{{ ucwords($data->agama) }}</td>
            </tr>
            <tr>
                <th>6. Kewarganegaraan </th>
                <td>{{ ucwords($data->kewarganegaraan) }}</td>
            </tr>
            <tr>
                <th>7. Status / Pekerjaan</th>
                <td>{{ ucwords($data->status_pekerjaan) }}</td>
            </tr>
            <tr>
                <th>8. Hobi </th>
                <td>{{ ucwords($data->hobi) }}</td>
            </tr>
            <tr>
                <th>9. No. HP </th>
                <td>{{ ucwords($data->no_hp) }}</td>
            </tr>
            <tr>
                <th>10. Alamat </th>
                <td>{{ ucwords($data->alamat) }}</td>
            </tr>
            <tr>
                <th>11. Pendidikan Terakhir </th>
                <td>{{ ucwords($data->pend_akhir) }}</td>
            </tr>
            <tr>
                <th>12. Nama Orang Tua </th>
                <td>{{ ucwords($data->nm_ortu) }}</td>
            </tr>
            <tr>
                <th>13. Pekerjaan Orang Tua </th>
                <td>{{ ucwords($data->pek_ortu) }}</td>
            </tr>
            <tr>
                <th>14. Alamat Orang Tua </th>
                <td>{{ ucwords($data->alamat_ortu) }}</td>
            </tr>
            <tr>
                <th>15. Program Kursus</th>
                <td>
                    <table>
                        <tr>
                            <td colspan="2">1. .............................................................&nbsp;(isi
                                program pilihan)</td>
                        </tr>
                        <tr>
                            <td>2. Paket I (2 bulan)</td>
                            <td>4. Paket III (4 bulan)</td>
                        </tr>
                        <tr>
                            <td>3. Paket II (3 bulan)</td>
                            <td>5. Paket IV (6 bulan)</td>
                        </tr>
                        <tr>
                            <td style="font-style: italic;" colspan="2">(Lingkari yang dipilih)</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <th>16. Pilih Jadwal Kursus</th>
                <td>
                    <table>
                        <tr>
                            <th>- Pagi</th>
                            <td colspan="2">a. 07.30 - 09.00 WIB <br>b. 09.00 - 10.30 WIB <br>c. 10.30 - 12.00 WIB
                            </td>
                        </tr>
                        <tr>
                            <th>- Siang</th>
                            <td>a. 13.30 - 15.00 WIB</td>
                            <td>b. 15.00 - 16.30 WIB</td>
                        </tr>
                        <tr>
                            <th>- Malam</th>
                            <td colspan="2">a. 18.30 - 20.00 WIB</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <th style="width: 250px;">17. Darimana Anda tahu PTCC?</th>
                <td>{{ ucwords($data->info_dari) }}</td>
            </tr>
            <tr>
                <th></th>
                <td style="text-align: center">Banyuwangi, {{ date('d F Y') }}<br>Calon Peserta,
                    <br><br><br><br><b>{{ ucwords($data->nm_lengkap) }}</b></td>
            </tr>
        </table>

        <!-- Keterangan diisi petugas -->
        <hr>
        <h3>KETERANGAN DIISI PETUGAS :</h3>
        <table>
            <tr>
                <td>1. Pendaftaran</td>
                <td>= Rp.</td>
                <td style="text-align: right">50.000,-</td>
            </tr>
            <tr>
                <td>2. Angsuran Uang Kursus</td>
                <td>= Rp.</td>
                <td style="text-align: right; width:10px;">...................................,-</td>
            </tr>
            <tr>
                <th style="text-align: right">Jumlah Bayar</th>
                <td>= Rp.</td>
                <td style="text-align: right">...................................,-</td>
            </tr>
            <tr>
                <th style="text-align: right">Total Biaya Kursus dan Pendaftaran</th>
                <td>= Rp.</td>
                <td style="text-align: right">...................................,-</td>
            </tr>
            <tr>
                <th style="text-align: right">Sisa</th>
                <td>= Rp.</td>
                <td style="text-align: right">...................................,-</td>
            </tr>
        </table>
    </div>
</body>

</html>
