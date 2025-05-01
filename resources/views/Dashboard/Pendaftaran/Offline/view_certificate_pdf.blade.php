<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
        /* CSS yang diperlukan */
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        /* Styling untuk sertifikat */
        /* Pastikan gaya ini sesuai dengan kebutuhan Anda */
        .page {
            margin: 0 auto;
            max-width: 1200px;
            page-break-after: always;
            /* Memisahkan setiap halaman */
        }

        .page:last-child {
            page-break-after: avoid;
            /* Hindari pemisahan setelah halaman terakhir */
        }

        .page hr {
            border: none;
            border-top: 1px solid #000;
            margin: 20px 0;
        }

        .arial {
            font-family: Arial, Helvetica, sans-serif;
        }

        .tahoma {
            font-family: Tahoma, Geneva, sans-serif;
        }

        #akreditasi {
            position: absolute;
            margin-top: -70px;
        }

        .garisdouble {
            border: solid;
        }

        .nilaiser {
            font-family: 'Comic Sans MS';
            border: solid 2px;
            padding: 5px;
        }

        .kop2 {
            border-bottom-style: inset;
            border-bottom-width: thick;
        }

        .namaser {
            font-size: 19px;
        }

        .sertifikat_komputer {
            font-family: "Bauhaus 93";
            font-size: 45px;
            font-weight: normal;
            line-height: 0px;
            color: #960001;
        }

        .nomor {
            font-family: "Bookman Old Style";
            font-size: 16px;
        }

        .kop {
            border-collapse: collapse;
        }

        .alamat {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 13px;
        }

        .NIS {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11px;
            font-weight: bold;
        }

        .lembaga_kursus {
            font-family: Microsoft Sans "MS Serif", "New York", serif;
            font-size: 33px;
        }

        .professional {
            font-family: arial "Lucida Sans Unicode", "Lucida Grande", sans-serif;
            font-size: 30px;
            color: red;
            -webkit-text-fill-color: red;
            -webkit-text-stroke: 1px black;
        }

        .ptcc {
            font-family: "Bookman Old style";
            font-size: 45px;
            font-weight: bold;
            -webkit-text-stroke: 1px black;
            background: -webkit-gradient(linear, left top, left bottom, color-stop(20%, #903), color-stop(53%, #009), color-stop(100%, #00F));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .sertifikat {
            font: Arial, Helvetica, sans-serif;
            font-size: 15px;
        }
    </style>
</head>

<body>
    <div class="page"> <!-- atur height sesuai kebutuhan -->
        <table align="center" border="0">
            <tr>
                <td align="center" bgcolor="#FFFFFF">
                    <table class="kop" width="1045" border="0">
                        <tr>
                            <td height="149" align="center"><img src="/img/kopsertifikat.png" width="1030"
                                    height="244" />
                            </td>
                        </tr>
                        <tr>
                            <td align="center">
                                <p><b class="sertifikat_komputer">SERTIFIKAT KOMPUTER</b><br>
                                    <strong class="nomor">No. {{ $data->merger_certificate }}</strong><br>
                            </td>
                        </tr>
                    </table>

                    <table style="font-family:'Trebuchet MS';font-size:16,5px;	line-height:20px;" width="1036"
                        border="0">
                        <tr>
                            <td width="47" colspan="4">
                                <center><strong
                                        style="font-size:16px; font-weight:700; text-shadow: 0 0 1px black;"><i>Diberikan
                                            Kepada:</i></strong><br>
                                    <strong class="namaser"
                                        style="font-size:30px; font-weight:700; text-shadow: 0 0 1px black; margin-top:10px; display:inline-block;">
                                        {{ strtoupper($data->nm_lengkap) }}
                                    </strong>
                                    <p>
                                </center>
                            </td>
                        </tr>
                </td>
            </tr>
            <tr style="font-size:16px;">
                <td width="47">&nbsp;</td>
                <td width="400"></td>
                <td width="340"><strong style="font-size:16px;">Tempat dan Tanggal Lahir</strong></td>
                <td width="739">
                    <strong>:
                        {{ ucwords($data->tmp_lahir) . ', ' . \Carbon\Carbon::parse($data->tgl_lahir)->isoFormat('D MMMM YYYY') }}</strong>
                </td>
            </tr>
            <tr style="font-size:16px;">
                <td>&nbsp;</td>
                <td></td>
                <td><strong>Nomor Induk Peserta</strong></td>
                <td><strong>: {{ $data->no_induk }}</strong></td>
            </tr>
            <tr style="font-size:16px;">
                <td height="22">&nbsp;</td>
                <td></td>
                <td><strong>Program Keahlian</strong></td>
                <td><strong>: Komputer</strong></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td valign="top"><strong>&nbsp; </strong></td>
                <td valign="top"><strong>&nbsp; </strong></td>
                <td valign="top"><strong>&nbsp;</strong>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td colspan="3" valign="top" style="font-size: 16px; text-align: justify">Sertifikat
                    ini diberikan setelah yang
                    bersangkutan &quot;<strong>LULUS</strong>&quot; dalam menempuh Ujian
                    Komputer yang diselenggarakan pada tanggal : <br>
                    {{ \Carbon\Carbon::parse($data->tgl_ujian)->isoFormat('D MMMM YYYY') }} di Banyuwangi,
                    dengan Daftar Nilai Mata Ujian
                    dibalik ini. <br>
                    <br>
                    Pemegang Sertifikat ini telah memenuhi syarat Olah Komputer sesuai
                    keahliannya.
                </td>
            </tr>
        </table>
        <div style="position: relative; width: 100%; height: 180px; margin-top: 14px;">
            <!-- Gambar background footer -->
            <img src='data:image/png;base64,{{ base64_encode(file_get_contents(public_path('img/footer.png'))) }}'
                style="position: absolute; bottom: 0; left: 0; width: 100%; z-index: 0;" />

            <!-- Teks tanda tangan -->
            <div style="position: relative; z-index: 1; text-align: center; padding-top: 3px; font-size:16px;"
                class="arial">
                <p>Banyuwangi, {{ \Carbon\Carbon::parse($data->tgl_pembuatan)->isoFormat('D MMMM YYYY') }}
                    <br>Direktur,
                </p>
                <br><br>
                <p><strong><u>SUNARTO, S.Pd., S.Kom.</u></strong></p>
            </div>
        </div>

        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <center>
            <table width="1010" border="0">
                <tr>
                    <td width="616" align="center" valign="top">
                        <p>&nbsp;</p>
                        <table width="510" border="1" style="border-collapse: collapse">
                            <tr class="garisdouble">
                                <td class="garisdouble" width="37" rowspan="2" align="center"><strong
                                        class="tahoma">NO</strong></td>
                                <td class="garisdouble" width="208" rowspan="2" align="center"><strong
                                        class="tahoma">MATA
                                        UJIAN</strong></td>
                                <td class="garisdouble" colspan="2" align="center">
                                    <strong class="tahoma">N I L A I</strong>
                                </td>
                            </tr>
                            <tr class="garisdouble">
                                <td class="garisdouble" width="78" align="center">
                                    <strong class="tahoma">Angka</strong>
                                </td>
                                <td class="garisdouble" width="159" align="center">
                                    <strong class="tahoma">Huruf</strong>
                                </td>
                            </tr>
                            @foreach ($programs as $index => $program)
                                @php
                                    $kd_program = $kd_programs[$index];
                                    $existing_score = $existing_scores->get($kd_program);
                                @endphp
                                @if ($existing_score && $existing_score->nilai != 0)
                                    <tr class="nilaiser">
                                        <td class="nilaiser" style="text-align: center">{{ $loop->iteration }}
                                        </td>
                                        <td style="padding-left: 10px;" class="nilaiser">{{ ucwords($program) }}
                                        </td>
                                        <td class="nilaiser" style="text-align: center">
                                            {{ $existing_score->nilai }}
                                        </td>
                                        <td style="padding-left: 10px;" class="nilaiser">
                                            {{ terbilang($existing_score->nilai) }}
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            <tr class="nilaiser">
                                <td class="nilaiser">&nbsp;</td>
                                <td class="nilaiser">&nbsp;</td>
                                <td class="nilaiser">&nbsp;</td>
                                <td class="nilaiser">&nbsp;</td>
                            </tr>
                            <tr class="nilaiser">
                                <td class="nilaiser">&nbsp;</td>
                                <td class="nilaiser">&nbsp;</td>
                                <td class="nilaiser">&nbsp;</td>
                                <td class="nilaiser">&nbsp;</td>
                            </tr>
                        </table>
                        </p>
                        <div style="position: relative;">
                            <img style="position: absolute; right: 450px; top: 170px; width: 20%; height: auto;"
                                src="{{ custom_storage_path($data->qrcode) }}" alt="QR Code">
                            <i style="position: absolute; font-size: 14px; right: 467px; top: 285px;">Scan to
                                Check</i>
                        </div>
                    </td>
                    <td style="font-family:Tahoma, Geneva, sans-serif;" width="384" align="left"
                        valign="top">
                        <p>&nbsp;</p>
                        <p><strong>KETERANGAN :<br>
                                PENGELOMPOKAN NILAI :</strong></p>
                        <p>yang bernilai terendah untuk lulus : &quot;60&quot;<br>
                            dikelompokkan sebagai berikut :</p>
                        <table class="tahoma" style="border-collapse:collapse" width="293" border="1">
                            <tbody>
                                <tr class="garisdouble" bgcolor="#FFFFFF">
                                    <td class="garisdouble" width="52" valign="middle" height="28"
                                        align="center">
                                        <strong>Huruf</strong>
                                    </td>
                                    <td class="garisdouble" width="75" valign="middle" align="center">
                                        <strong>Nilai</strong>
                                    </td>
                                    <td class="garisdouble"width="144" valign="middle" align="center">
                                        <strong>Keterangan</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="nilaiser" valign="middle" align="center">A</td>
                                    <td class="nilaiser" valign="middle" align="center">90 - 100</td>
                                    <td class="nilaiser" valign="middle">Sangat Memuaskan </td>
                                </tr>
                                <tr>
                                    <td class="nilaiser" valign="middle" align="center">B+</td>
                                    <td class="nilaiser" valign="middle" align="center">85 - 89</td>
                                    <td class="nilaiser" rowspan="3" valign="middle">Memuaskan
                                    </td>
                                </tr>
                                <tr>
                                    <td class="nilaiser" valign="middle" align="center">B</td>
                                    <td class="nilaiser" valign="middle" align="center">80 - 84</td>
                                </tr>
                                <tr>
                                    <td class="nilaiser" valign="middle" align="center">B-</td>
                                    <td class="nilaiser" valign="middle" align="center">75 - 79</td>
                                </tr>
                                <tr>
                                    <td class="nilaiser" valign="middle" align="center">C+</td>
                                    <td class="nilaiser" valign="middle" align="center">70 - 74</td>
                                    <td class="nilaiser" rowspan="3" valign="middle">Cukup
                                        Memuaskan</td>
                                </tr>
                                <tr>
                                    <td class="nilaiser" valign="middle" align="center">C</td>
                                    <td class="nilaiser" valign="middle" align="center">65 - 69</td>
                                </tr>
                                <tr>
                                    <td class="nilaiser" valign="middle" align="center">C-</td>
                                    <td class="nilaiser" valign="middle" align="center">60 - 64</td>
                                </tr>
                            </tbody>
                        </table>
                        </br>
                        <center>
                            <p style="font-size:15px">Banyuwangi,
                                {{ \Carbon\Carbon::parse($data->tgl_pembuatan)->isoFormat('D MMMM YYYY') }}
                                <br>
                                Direktur,
                            </p><br>
                            <p>&nbsp;</p>
                            <p><strong style="font-size:15px"><u>SUNARTO, S.Pd,
                                        S.Kom</u></strong></p>
                            <p>&nbsp;</p>
                        </center>
                    </td>
                </tr>
            </table>
        </center>
    </div>
</body>

</html>
