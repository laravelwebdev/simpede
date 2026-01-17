<?php
/**
 * Rekap detail page
 */

require_once dirname(__DIR__, 3).'/app/Helpers/database.php';

if (! isset($_GET['nus']) || ! isset($_GET['nks'])) {
    header('Location:index.php');
    exit;
}

try {
    $conn = getDbConnection();
    $nus = sanitizeInput($_GET['nus']);
    $nks = sanitizeInput($_GET['nks']);

    $query = 'SELECT data FROM cacah WHERE nus = ? AND nks = ?';
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'ss', $nus, $nks);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
} catch (Exception $e) {
    exit('Database error: '.$e->getMessage());
}
?>
<!DOCTYPE html>
<html lang='en' class=''>
    <head>
        <meta charset='UTF-8'>
        <title>iSusenas</title>
        <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
        <meta content="utf-8" http-equiv="encoding">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <div id="app">
        <form class="vue-form" action="api.php" method="post">
            <div class="error-message">
                <p>Rekapitulasi</p>
            </div>
            <fieldset>
                <div>
                    <h4>NKS</h4>
                    <p class="select">
                        <select class="budget" name="nks">
                        <?php
                            echo '<option value="'.$_GET['nks'].'">'.$_GET['nks'].'</option>';
?>
                        </select>
                    </p>
                </div>
                <div>
                    <h4>Nomor Urut Sampel</h4>
                    <p class="select">
                        <select class="budget"  name="nus">
                        <?php
echo '<option value="'.$_GET['nus'].'">'.$_GET['nus'].'</option>';
?>
                        </select>
                    </p>
                </div>
                <div>

                <div class="warning">
                        <p>Langkah 1. Isi dari Lembar Pembantu</p>
                    </div>
                    <div class="warning">
                        <p>Blok IV.1 Makanan</p>
                    </div>
                    <table class="orange">
                        <tr>
                            <td class="noborder"><label class="label">U:</label></td>
                            <td class="noborder"><label class="label">T1A:</label></td>
                        </tr>
                        <tr>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="u1" id="u1" required="" v-model="u1" ref="u1"></currency>
                            </td>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="t1a1" id="t1a1" required="" v-model="t1a1" ref="t1a1"></currency>
                            </td>
                        </tr>
                        <tr>
                            <td class="noborder"><label class="label">T1B:</label></td>
                            <td class="noborder"><label class="label">T2:</label></td>
                        </tr>
                        <tr>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="t1b1" id="t1b1" required="" v-model="t1b1" ref="t1b1"></currency>
                            </td>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="t21" id="t21" required="" v-model="t21" ref="t21"></currency>
                            </td>
                        </tr>
                        <tr>
                            <td class="noborder"><label class="label">T3:</label></td>
                            <td class="noborder"><label class="label">T4:</label></td>
                        </tr>
                        <tr>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="t31" id="t31" required="" v-model="t31" ref="t31"></currency>
                            </td>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="t41" id="t41" required="" v-model="t41" ref="t41"></currency>
                            </td>
                        </tr>
                        <tr>
                            <td class="noborder"><label class="label">T5:</label></td>
                            <td class="noborder"><label class="label">L:</label></td>
                        </tr>
                        <tr>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="t51" id="t51" required="" v-model="t51" ref="t51"></currency>
                            </td>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="l1" id="l1" required="" v-model="l1" ref="l1"></currency>
                            </td>
                        </tr>
                    </table>
                    <div class="warning">
                        <p>Blok IV.2 Non Makanan kolom 4 (Sebulan)</p>
                    </div>
                    <table class="orange">
                        <tr>
                            <td class="noborder"><label class="label">U:</label></td>
                            <td class="noborder"><label class="label">K:</label></td>
                        </tr>
                        <tr>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="u2" id="u2" required="" v-model="u2" ref="u2"></currency>
                            </td>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="k2" id="k2" required="" v-model="k2" ref="k2"></currency>
                            </td>
                        </tr>
                        <tr>
                            <td class="noborder"><label class="label">T1A:</label></td>
                            <td class="noborder"><label class="label">T1B:</label></td>
                        </tr>
                        <tr>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="t1a2" id="t1a2" required="" v-model="t1a2" ref="t1a2"></currency>
                            </td>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="t1b2" id="t1b2" required="" v-model="t1b2" ref="t1b2"></currency>
                            </td>
                        </tr>
                        <tr>
                            <td class="noborder"><label class="label">T2:</label></td>
                            <td class="noborder"><label class="label">T3:</label></td>
                        </tr>
                        <tr>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="t22" id="t22" required="" v-model="t22" ref="t22"></currency>
                            </td>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="t32" id="t32" required="" v-model="t32" ref="t32"></currency>
                            </td>
                        </tr>
                        <tr>
                            <td class="noborder"><label class="label">T4:</label></td>
                            <td class="noborder"><label class="label">T5:</label></td>
                        </tr>
                        <tr>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="t42" id="t42" required="" v-model="t42" ref="t42"></currency>
                            </td>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="t52" id="t52" required="" v-model="t52" ref="t52"></currency>
                            </td>
                        </tr>
                        <tr>
                            <td class="noborder"><label class="label">L:</label></td>
                            <td class="noborder"></td>
                        </tr>
                        <tr>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="l2" id="l2" required="" v-model="l2" ref="l2"></currency>
                            </td>
                            <td></td>
                        </tr>
                    </table>

                    <div class="warning">
                        <p>Blok IV.2 Non Makanan kolom 5 (Setahun)</p>
                    </div>
                    <table class="orange">
                        <tr>
                            <td class="noborder"><label class="label">U:</label></td>
                            <td class="noborder"><label class="label">K:</label></td>
                        </tr>
                        <tr>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="u3" id="u3" required="" v-model="u3" ref="u3"></currency>
                            </td>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="k3" id="k3" required="" v-model="k3" ref="k3"></currency>
                            </td>
                        </tr>
                        <tr>
                            <td class="noborder"><label class="label">T1A:</label></td>
                            <td class="noborder"><label class="label">T1B:</label></td>
                        </tr>
                        <tr>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="t1a3" id="t1a3" required="" v-model="t1a3" ref="t1a3"></currency>
                            </td>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="t1b3" id="t1b3" required="" v-model="t1b3" ref="t1b3"></currency>
                            </td>
                        </tr>
                        <tr>
                            <td class="noborder"><label class="label">T2:</label></td>
                            <td class="noborder"><label class="label">T3:</label></td>
                        </tr>
                        <tr>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="t23" id="t23" required="" v-model="t23" ref="t23"></currency>
                            </td>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="t33" id="t33" required="" v-model="t33" ref="t33"></currency>
                            </td>
                        </tr>
                        <tr>
                            <td class="noborder"><label class="label">T4:</label></td>
                            <td class="noborder"><label class="label">T5:</label></td>
                        </tr>
                        <tr>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="t43" id="t43" required="" v-model="t43" ref="t43"></currency>
                            </td>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="t53" id="t53" required="" v-model="t53" ref="t53"></currency>
                            </td>
                        </tr>
                        <tr>
                            <td class="noborder"><label class="label">L:</label></td>
                            <td class="noborder"></td>
                        </tr>
                        <tr>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="l3" id="l3" required="" v-model="l3" ref="l3"></currency>
                            </td>
                            <td></td>
                        </tr>
                    </table> 
                    <div class="warning">
                        <p>Langkah 2. Tambahkan isian rincian berikut dengan isian hasil wawancara</p>
                    </div>
                    <div class="blue-message">
                        <p>BLOK VC</p>
                    </div>
                    <br><br>
                    <table>
                        <tr>
                            <td><label class="label-result">Tambahkan Blok VC Rincian 2 kolom 2 dengan:</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(jumlahl().toFixed(0))}}</label></td>
                        </tr>
                    </table>
                    <div class="blue-message">
                        <p>BLOK VE</p>
                    </div>
                    <br><br>
                    <table>
                        <tr>
                            <td><label class="label-result">Tambahkan Blok VE Rincian 1a kolom 2 dengan:</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(jumlaht1a().toFixed(0))}}</label></td>
                        </tr>
                        <tr>
                            <td><label class="label-result">Tambahkan Blok VE Rincian 1b kolom 3 dengan:</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(jumlaht1b().toFixed(0))}}</label></td>
                        </tr>
                        <tr>
                            <td><label class="label-result">Tambahkan Blok VE Rincian 2 kolom 3 dengan:</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(jumlaht2().toFixed(0))}}</label></td>
                        </tr>
                        <tr>
                            <td><label class="label-result">Tambahkan Blok VE Rincian 3 kolom 3 dengan:</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(jumlaht3().toFixed(0))}}</label></td>
                        </tr>
                        <tr>
                            <td><label class="label-result">Tambahkan Blok VE Rincian 4 kolom 3 dengan:</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(jumlaht4().toFixed(0))}}</label></td>
                        </tr>
                        <tr>
                            <td><label class="label-result">Tambahkan Blok VE Rincian 5 kolom 3 dengan:</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(jumlaht5().toFixed(0))}}</label></td>
                        </tr>
                    </table>
                    <div class="blue-message">
                        <p>BLOK VII</p>
                    </div>
                    <br><br>
                    <table>
                        <!-- <tr>
                            <td><label class="label-result">Tambahkan Blok VII Rincian 1 kolom 2 dengan:</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(jumlahdkeluar().toFixed(0))}}</label></td>
                        </tr> -->
                        <tr>
                            <td><label class="label-result">Tambahkan Blok VII Rincian 2 kolom 2 dengan:</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(jumlahk().toFixed(0))}}</label></td>
                        </tr>
                        <tr>
                            <td><label class="label-result">Tambahkan Blok VII Rincian 4 kolom 2 dengan:</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(jumlahu().toFixed(0))}}</label></td>
                        </tr>
                        <!-- <tr>
                            <td><label class="label-result">Tambahkan Blok VII Rincian 1 kolom 4 dengan:</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(jumlahdmasuk().toFixed(0))}}</label></td>
                        </tr> -->
                    </table>
                    <div class="warning">
                        <p>Langkah 3. Isi rincian berikut sesuai dokumen KP</p>
                    </div>
                    <div class="success">
                        <p>Diambil dari dokumen KP</p>
                    </div>
                    <div class="success">
                        <p>Blok IV.1</p>
                    </div>
                    <table class="blue">
                        <tr>
                            <td class="noborder" colspan="2"><label class="label">A. PADI - PADIAN (R1)</label></td>
                        </tr>
                        <tr>
                            <td class="noborder"><label class="label">Pembelian (Kolom 6)</label></td>
                            <td class="noborder"><label class="label">Produksi (Kolom 8)</label></td>
                        </tr>
                        <tr>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="r1b" id="r1b" required="" v-model="r1b" ref="r1b"></currency>
                            </td>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="r1p" id="r1p" required="" v-model="r1p" ref="r1p"></currency>
                            </td>
                        </tr>
                        <tr>
                            <td class="noborder" colspan="2"><label class="label">B. UMBI-UMBIAN (R8)</label></td>
                        </tr>
                        <tr>
                            <td class="noborder"><label class="label">Pembelian (Kolom 6)</label></td>
                            <td class="noborder"><label class="label">Produksi (Kolom 8)</label></td>
                        </tr>
                        <tr>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="r8b" id="r8b" required="" v-model="r8b" ref="r8b"></currency>
                            </td>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="r8p" id="r8p" required="" v-model="r8p" ref="r8p"></currency>
                            </td>
                        </tr>
                        <tr>
                            <td class="noborder" colspan="2"><label class="label">C. IKAN/UDANG/CUMI/KERANG (R16)</label></td>
                        </tr>
                        <tr>
                            <td class="noborder"><label class="label">Pembelian (Kolom 6)</label></td>
                            <td class="noborder"><label class="label">Produksi (Kolom 8)</label></td>
                        </tr>
                        <tr>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="r16b" id="r16b" required="" v-model="r16b" ref="r16b"></currency>
                            </td>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="r16p" id="r16p" required="" v-model="r16p" ref="r16p"></currency>
                            </td>
                        </tr>
                        <tr>
                            <td class="noborder" colspan="2"><label class="label">D. DAGING (R61)</label></td>
                        </tr>
                        <tr>
                            <td class="noborder"><label class="label">Pembelian (Kolom 6)</label></td>
                            <td class="noborder"><label class="label">Produksi (Kolom 8)</label></td>
                        </tr>
                        <tr>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="r52b" id="r52b" required="" v-model="r52b" ref="r52b"></currency>
                            </td>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="r52p" id="r52p" required="" v-model="r52p" ref="r52p"></currency>
                            </td>
                        </tr>
                        <tr>
                            <td class="noborder" colspan="2"><label class="label">E. TELUR DAN SUSU (R74)</label></td>
                        </tr>
                        <tr>
                            <td class="noborder"><label class="label">Pembelian (Kolom 6)</label></td>
                            <td class="noborder"><label class="label">Produksi (Kolom 8)</label></td>
                        </tr>
                        <tr>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="r62b" id="r62b" required="" v-model="r62b" ref="r62b"></currency>
                            </td>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="r62p" id="r62p" required="" v-model="r62p" ref="r62p"></currency>
                            </td>
                        </tr>
                        <tr>
                            <td class="noborder" colspan="2"><label class="label">F. SAYUR-SAYURAN (R85)</label></td>
                        </tr>
                        <tr>
                            <td class="noborder"><label class="label">Pembelian (Kolom 6)</label></td>
                            <td class="noborder"><label class="label">Produksi (Kolom 8)</label></td>
                        </tr>
                        <tr>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="r72b" id="r72b" required="" v-model="r72b" ref="r72b"></currency>
                            </td>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="r72p" id="r72p" required="" v-model="r72p" ref="r72p"></currency>
                            </td>
                        </tr>
                        <tr>
                            <td class="noborder" colspan="2"><label class="label">G. KACANG-KACANGAN (R121)</label></td>
                        </tr>
                        <tr>
                            <td class="noborder"><label class="label">Pembelian (Kolom 6)</label></td>
                            <td class="noborder"><label class="label">Produksi (Kolom 8)</label></td>
                        </tr>
                        <tr>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="r98b" id="r98b" required="" v-model="r98b" ref="r98b"></currency>
                            </td>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="r98p" id="r98p" required="" v-model="r98p" ref="r98p"></currency>
                            </td>
                        </tr>
                        <tr>
                            <td class="noborder" colspan="2"><label class="label">H. BUAH-BUAHAN (R129)</label></td>
                        </tr>
                        <tr>
                            <td class="noborder"><label class="label">Pembelian (Kolom 6)</label></td>
                            <td class="noborder"><label class="label">Produksi (Kolom 8)</label></td>
                        </tr>
                        <tr>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="r106b" id="r106b" required="" v-model="r106b" ref="r106b"></currency>
                            </td>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="r106p" id="r106p" required="" v-model="r106p" ref="r106p"></currency>
                            </td>
                        </tr>
                        <tr>
                            <td class="noborder" colspan="2"><label class="label">I. MINYAK DAN KELAPA (R154)</label></td>
                        </tr>
                        <tr>
                            <td class="noborder"><label class="label">Pembelian (Kolom 6)</label></td>
                            <td class="noborder"><label class="label">Produksi (Kolom 8)</label></td>
                        </tr>
                        <tr>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="r120b" id="r120b" required="" v-model="r120b" ref="r120b"></currency>
                            </td>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="r120p" id="r120p" required="" v-model="r120p" ref="r120p"></currency>
                            </td>
                        </tr>
                        <tr>
                            <td class="noborder" colspan="2"><label class="label">J. BAHAN MINUMAN (R159)</label></td>
                        </tr>
                        <tr>
                            <td class="noborder"><label class="label">Pembelian (Kolom 6)</label></td>
                            <td class="noborder"><label class="label">Produksi (Kolom 8)</label></td>
                        </tr>
                        <tr>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="r125b" id="r125b" required="" v-model="r125b" ref="r125b"></currency>
                            </td>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="r125p" id="r125p" required="" v-model="r125p" ref="r125p"></currency>
                            </td>
                        </tr>
                        <tr>
                            <td class="noborder" colspan="2"><label class="label">K. BUMBU-BUMBUAN (R167)</label></td>
                        </tr>
                        <tr>
                            <td class="noborder"><label class="label">Pembelian (Kolom 6)</label></td>
                            <td class="noborder"><label class="label">Produksi (Kolom 8)</label></td>
                        </tr>
                        <tr>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="r133b" id="r133b" required="" v-model="r133b" ref="r133b"></currency>
                            </td>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="r133p" id="r133p" required="" v-model="r133p" ref="r133p"></currency>
                            </td>
                        </tr>
                        <tr>
                            <td class="noborder" colspan="2"><label class="label">L. BAHAN MAKANAN LAINNYA (R182)</label></td>
                        </tr>
                        <tr>
                            <td class="noborder"><label class="label">Pembelian (Kolom 6)</label></td>
                            <td class="noborder"><label class="label">Produksi (Kolom 8)</label></td>
                        </tr>
                        <tr>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="r146b" id="r146b" required="" v-model="r146b" ref="r146b"></currency>
                            </td>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="r146p" id="r146p" required="" v-model="r146p" ref="r146p"></currency>
                            </td>
                        </tr>
                    </table>
                    <div class="success">
                        <p>Blok IV.2</p>
                    </div>
                    <table class="blue">
                        <tr>
                            <td class="noborder" colspan="2"><label class="label">A. PERUMAHAN DAN FASILITAS RUMAH TANGGA</label></td>
                        </tr>
                        <tr>
                            <td class="noborder"><label class="label">Sebulan (R226 kolom 4)</label></td>
                            <td class="noborder"><label class="label">Setahun (R226 kolom 5)</label></td>
                        </tr>
                        <tr>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="r189a" id="r189a" required="" v-model="r189a" ref="r189a"></currency>
                            </td>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="r189b" id="r189b" required="" v-model="r189b" ref="r189b"></currency>
                            </td>
                        </tr>
                        <tr>
                            <td class="noborder" colspan="2"><label class="label">B. ANEKA BARANG DAN JASA</label></td>
                        </tr>
                        <tr>
                            <td class="noborder"><label class="label">Sebulan (R268 kolom 4)</label></td>
                            <td class="noborder"><label class="label">Setahun (R268 kolom 5)</label></td>
                        </tr>
                        <tr>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="r231a" id="r231a" required="" v-model="r231a" ref="r231a"></currency>
                            </td>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="r231b" id="r231b" required="" v-model="r231b" ref="r231b"></currency>
                            </td>
                        </tr>
                        <tr>
                            <td class="noborder" colspan="2"><label class="label">C. PAKAIAN, ALAS KAKI DAN TUTUP KEPALA</label></td>
                        </tr>
                        <tr>
                            <td class="noborder"></td>
                            <td class="noborder"><label class="label">Setahun (R307 kolom 5)</label></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="r270" id="r270" required="" v-model="r270" ref="r270"></currency>
                            </td>
                        </tr>
                        <tr>
                            <td class="noborder" colspan="2"><label class="label">D. BARANG TAHAN LAMA</label></td>
                        </tr>
                        <tr>
                            <td class="noborder"></td>
                            <td class="noborder"><label class="label">Setahun (R316 kolom 5)</label></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="r279" id="r279" required="" v-model="r279" ref="r279"></currency>
                            </td>
                        </tr>
                        <tr>
                            <td class="noborder" colspan="2"><label class="label">E. PAJAK, PUNGUTAN DAN ASURANSI</label></td>
                        </tr>
                        <tr>
                            <td class="noborder"></td>
                            <td class="noborder"><label class="label">Setahun (R334 kolom 5)</label></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="r297" id="r297" required="" v-model="r297" ref="r297"></currency>
                            </td>
                        </tr>
                        <tr>
                            <td class="noborder" colspan="2"><label class="label">F. KEPERLUAN PESTA DAN UPACARA KENDURI</label></td>
                        </tr>
                        <tr>
                            <td class="noborder"></td>
                            <td class="noborder"><label class="label">Setahun (R341 kolom 5)</label></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="r304" id="r304" required="" v-model="r304" ref="r304"></currency>
                            </td>
                        </tr>
                    </table>
                    <div class="success">
                        <p>IV.3.1</p>
                    </div>
                    <table class="blue">
                        <tr>
                            <td class="noborder"><label class="label">Baris Jumlah Kolom 3</label></td>
                            <td class="noborder"><label class="label">Baris Jumlah Kolom 4</label></td>
                        </tr>
                        <tr>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="r431ab" id="r431ab" required="" v-model="r431ab" ref="r431ab"></currency>
                            </td>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="r431ap" id="r431ap" required="" v-model="r431ap" ref="r431ap"></currency>
                            </td>
                        </tr>
                        <tr>
                            <td class="noborder"><label class="label">Baris Jumlah Kolom 5</label></td>
                            <td class="noborder"><label class="label">Baris Jumlah Kolom 6</label></td>
                        </tr>
                        <tr>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="r431bb" id="r431bb" required="" v-model="r431bb" ref="r431bb"></currency>
                            </td>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="r431bp" id="r431bp" required="" v-model="r431bp" ref="r431bp"></currency>
                            </td>
                        </tr>
                    </table>
                    <div class="success">
                        <p>Blok VA</p>
                    </div>
                    <table class="blue">
                        <tr>
                            <td class="noborder"><label class="label">Baris Jumlah Kolom 5</label></td>
                            <td class="noborder"><label class="label">Baris Jumlah Kolom 6</label></td>
                        </tr>
                        <tr>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="r5ak5" id="r5ak5" required="" v-model="r5ak5" ref="r5ak5"></currency>
                            </td>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="r5ak6" id="r5ak6" required="" v-model="r5ak6" ref="r5ak6"></currency>
                            </td>
                        </tr>
                        <tr>
                            <td class="noborder"><label class="label">Baris Jumlah Kolom 7</label></td>
                            <td class="noborder"></td>
                        </tr>
                        <tr>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="r5ak7" id="r5ak7" required="" v-model="r5ak7" ref="r5ak7"></currency>
                            </td>
                            <td> </td>
                        </tr>
                    </table>
                    <div class="success">
                        <p>Blok VB</p>
                    </div>
                    <table class="blue">
                        <tr>
                            <td class="noborder"><label class="label">Baris Jumlah Kolom 5</label></td>
                            <td class="noborder"><label class="label">Baris Jumlah Kolom 6</label></td>
                        </tr>
                        <tr>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="r5bk5" id="r5bk5" required="" v-model="r5bk5" ref="r5bk5"></currency>
                            </td>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="r5bk6" id="r5bk6" required="" v-model="r5bk6" ref="r5bk6"></currency>
                            </td>
                        </tr>
                    </table>
                    <div class="success">
                        <p>Blok VC</p>
                    </div>
                    <table class="blue">
                        <tr>
                            <td class="noborder"><label class="label">Baris Jumlah Kolom 2</label></td>
                            <td class="noborder"><label class="label">Baris Jumlah Kolom 3</label></td>
                        </tr>
                        <tr>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="r5ck2" id="r5ck2" required="" v-model="r5ck2" ref="r5ck2"></currency>
                            </td>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="r5ck3" id="r5ck3" required="" v-model="r5ck3" ref="r5ck3"></currency>
                            </td>
                        </tr>
                    </table>
                    <div class="success">
                        <p>Blok VD</p>
                    </div>
                    <table class="blue">
                        <tr>
                            <td class="noborder"><label class="label">Baris Jumlah Kolom 2</label></td>
                            <td class="noborder"><label class="label">Baris Jumlah Kolom 3</label></td>
                        </tr>
                        <tr>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="r5dk2" id="r5dk2" required="" v-model="r5dk2" ref="r5dk2"></currency>
                            </td>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="r5dk3" id="r5dk3" required="" v-model="r5dk3" ref="r5dk3"></currency>
                            </td>
                        </tr>
                    </table>
                    <div class="success">
                        <p>Blok VE</p>
                    </div>
                    <table class="blue">
                        <tr>
                            <td class="noborder"><label class="label">Baris Jumlah Kolom 2</label></td>
                            <td class="noborder"><label class="label">Baris Jumlah Kolom 3</label></td>
                        </tr>
                        <tr>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="r5ek2" id="r5ek2" required="" v-model="r5ek2" ref="r5ek2"></currency>
                            </td>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="r5ek3" id="r5ek3" required="" v-model="r5ek3" ref="r5ek3"></currency>
                            </td>
                        </tr>
                        <tr>
                            <td class="noborder"><label class="label">Baris Jumlah Kolom 4</label></td>
                            <td class="noborder"><label class="label">Baris Jumlah Kolom 5</label></td>
                        </tr>
                        <tr>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="r5ek4" id="r5ek4" required="" v-model="r5ek4" ref="r5ek4"></currency>
                            </td>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="r5ek5" id="r5ek5" required="" v-model="r5ek5" ref="r5ek5"></currency>
                            </td>
                        </tr>
                    </table>
                    <div class="success">
                        <p>Blok VF</p>
                    </div>
                    <table class="blue">
                        <tr>
                            <td class="noborder"><label class="label">Baris Jumlah Kolom 2</label></td>
                            <td class="noborder"><label class="label">Baris Jumlah Kolom 3</label></td>
                        </tr>
                        <tr>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="r5fk2" id="r5fk2" required="" v-model="r5fk2" ref="r5fk2"></currency>
                            </td>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="r5fk3" id="r5fk3" required="" v-model="r5fk3" ref="r5fk3"></currency>
                            </td>
                        </tr>
                        <tr>
                            <td class="noborder"><label class="label">Baris Jumlah Kolom 4</label></td>
                            <td class="noborder"><label class="label">Baris Jumlah Kolom 5</label></td>
                        </tr>
                        <tr>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="r5fk4" id="r5fk4" required="" v-model="r5fk4" ref="r5fk4"></currency>
                            </td>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="r5fk5" id="r5fk5" required="" v-model="r5fk5" ref="r5fk5"></currency>
                            </td>
                        </tr>
                    </table>
                    <div class="success">
                        <p>Blok VG</p>
                    </div>
                    <table class="blue">
                        <tr>
                            <td class="noborder"><label class="label">Baris Jumlah Kolom 2</label></td>
                            <td class="noborder"><label class="label">Baris Jumlah Kolom 3</label></td>
                        </tr>
                        <tr>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="r5gk2" id="r5gk2" required="" v-model="r5gk2" ref="r5gk2"></currency>
                            </td>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="r5gk3" id="r5gk3" required="" v-model="r5gk3" ref="r5gk3"></currency>
                            </td>
                        </tr>
                    </table>

                    <div class="success">
                        <p>Blok VII</p>
                    </div>
                    <table class="blue">
                    <tr>
                            <td class="noborder"><label class="label">Rincian 1 Kolom 2</label></td>
                            <td class="noborder"><label class="label">Rincian 1 Kolom 4</label></td>
                        </tr>
                        <tr>
                            <td style='text-align:center;background-color:grey;'>
                            Tidak Diinput
                            </td>
                            <td style='text-align:center;background-color:grey;'>
                           Tidak Diinput
                            </td>
                        </tr>
                        <tr>
                            <td class="noborder"><label class="label">Rincian 2 Kolom 2</label></td>
                            <td class="noborder"><label class="label">Rincian 2 Kolom 4</label></td>
                        </tr>
                        <tr>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="rb72k2" id="rb72k2" required="" v-model="rb72k2" ref="rb72k2"></currency>
                            </td>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="rb72k4" id="rb72k4" required="" v-model="rb72k4" ref="rb72k4"></currency>
                            </td>
                        </tr>
                        <tr>
                            <td class="noborder"><label class="label">Rincian 3 Kolom 2</label></td>
                            <td class="noborder"><label class="label">Rincian 3 Kolom 4</label></td>
                        </tr>
                        <tr>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="rb73k2" id="rb73k2" required="" v-model="rb73k2" ref="rb73k2"></currency>
                            </td>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="rb73k4" id="rb73k4" required="" v-model="rb73k4" ref="rb73k4"></currency>
                            </td>
                        </tr>
                        <tr>
                            <td class="noborder"><label class="label">Rincian 4 Kolom 2</label></td>
                            <td class="noborder"><label class="label">Rincian 4 Kolom 4</label></td>
                        </tr>
                        <tr>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="rb74k2" id="rb74k2" required="" v-model="rb74k2" ref="rb74k2"></currency>
                            </td>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="rb74k4" id="rb74k4" required="" v-model="rb74k4" ref="rb74k4"></currency>
                            </td>
                        </tr>
                        <tr>
                            <td class="noborder"><label class="label">Rincian 5 Kolom 2</label></td>
                            <td class="noborder"><label class="label">Rincian 5 Kolom 4</label></td>
                        </tr>
                        <tr>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="rb75k2" id="rb75k2" required="" v-model="rb75k2" ref="rb75k2"></currency>
                            </td>
                            <td>
                                <currency inputmode="numeric" onClick="this.select()"  name="rb75k4" id="rb75k4" required="" v-model="rb75k4" ref="rb75k4"></currency>
                            </td>
                        </tr>
                    </table>
                    <div class="warning">
                        <p>Langkah 4. Salin Rekap Berikut</p>
                    </div>
                    <div class="blue-message">
                        <p>BLOK IV.3.2</p>
                    </div>
                    <table>
                        <tr>
                            <td>
                                <div class="success">
                                    <p>Pengeluaran</p>
                                </div>
                            </td>
                            <td>
                                <div class="success center-text">
                                    <p>Pembelian</p>
                                </div>
                            </td>
                            <td>
                                <div class="success center-text">
                                    <p>Produksi</p>
                                </div>
                            </td>
                            <td>
                                <div class="success center-text">
                                    <p>Total</p>
                                </div>
                            </td>
                        </tr>
                        <tr class="odd">
                            <td><label class="label-result">1. Padi...</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(r1b)}}</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(r1p)}}</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(1*r1b+1*r1p)}}</label></td>
                        </tr>
                        <tr>
                            <td><label class="label-result">2. Umbi...</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(r8b)}}</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(r8p)}}</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(1*r8b+1*r8p)}}</label></td>
                        </tr>
                        <tr class="odd">
                            <td><label class="label-result">3. Ikan...</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(r16b)}}</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(r16p)}}</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(1*r16b+1*r16p)}}</label></td>
                        </tr>
                        <tr>
                            <td><label class="label-result">4. Daging</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(r52b)}}</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(r52p)}}</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(1*r52b+1*r52p)}}</label></td>
                        </tr>
                        <tr class="odd">
                            <td><label class="label-result">5. Telur...</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(r62b)}}</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(r62p)}}</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(1*r62b+1*r62p)}}</label></td>
                        </tr>
                        <tr>
                            <td><label class="label-result">6. Sayur...</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(r72b)}}</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(r72p)}}</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(1*r72b+1*r72p)}}</label></td>
                        </tr>
                        <tr class="odd">
                            <td><label class="label-result">7. Kacang...</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(r98b)}}</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(r98p)}}</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(1*r98b+1*r98p)}}</label></td>
                        </tr>
                        <tr>
                            <td><label class="label-result">8. Buah...</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(r106b)}}</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(r106p)}}</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(1*r106b+1*r106p)}}</label></td>
                        </tr>
                        <tr class="odd">
                            <td><label class="label-result">9. Minyak...</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(r120b)}}</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(r120p)}}</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(1*r120b+1*r120p)}}</label></td>
                        </tr>
                        <tr>
                            <td><label class="label-result">10. Minuman</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(r125b)}}</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(r125p)}}</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(1*r125b+1*r125p)}}</label></td>
                        </tr>
                        <tr class="odd">
                            <td><label class="label-result">11. Bumbu...</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(r133b)}}</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(r133p)}}</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(1*r133b+1*r133p)}}</label></td>
                        </tr>
                        <tr>
                            <td><label class="label-result">12. Lainnya</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(r146b)}}</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(r146p)}}</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(1*r146b+1*r146p)}}</label></td>
                        </tr>
                        <tr class="odd">
                            <td><label class="label-result">13. Makanan...</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(r431ab)}}</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(r431ap)}}</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(1*r431ab+1*r431ap)}}</label></td>
                        </tr>
                        <tr>
                            <td><label class="label-result">14. Rokok...</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(r431bb)}}</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(r431bp)}}</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(1*r431bb+1*r431bp)}}</label></td>
                        </tr>
                        <tr class="sum">
                            <td><label class="label-result">15. SUB</label></td>
                            <td class="right"><label class="label-result">{{r4315b}}</label></td>
                            <td class="right"><label class="label-result">{{r4315p}}</label></td>
                            <td class="right"><label class="label-result">{{r4315}}</label></td>
                        </tr>
                        <tr class="sum">
                            <td><label class="label-result">16. RATA-RATA</label></td>
                            <td class="right"><label class="label-result">{{r4316b}}</label></td>
                            <td class="right"><label class="label-result">{{r4316p}}</label></td>
                            <td class="right"><label class="label-result">{{r4316}}</label></td>
                        </tr>
                    </table>
                    <div class="blue-message">
                        <p>BLOK IV.3.3</p>
                    </div>
                    <table>
                        <tr>
                            <td class="td-small">
                                <div class="success">
                                    <p>No</p>
                                </div>
                            </td>
                            <td>
                                <div class="success center-text">
                                    <p>Sebulan</p>
                                </div>
                            </td>
                            <td>
                                <div class="success center-text">
                                    <p>Setahun</p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label class="label-result">1A</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(r189a)}}</label></td>
                            <td class="grey"></td>
                        </tr>
                        <tr>
                            <td><label class="label-result">1B</label></td>
                            <td class="grey"></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(r189b)}}</label></td>
                        </tr>
                        <tr>
                            <td><label class="label-result">2A</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(r231a)}}</label></td>
                            <td class="grey"></td>
                        </tr>
                        <tr>
                            <td><label class="label-result">2B</label></td>
                            <td class="grey"></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(r231b)}}</label></td>
                        </tr>
                        <tr>
                            <td><label class="label-result">3</label></td>
                            <td class="grey"></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(r270)}}</label></td>
                        </tr>
                        <tr>
                            <td><label class="label-result">4</label></td>
                            <td class="grey"></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(r279)}}</label></td>
                        </tr>
                        <tr>
                            <td><label class="label-result">5</label></td>
                            <td class="grey"></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(r297)}}</label></td>
                        </tr>
                        <tr>
                            <td><label class="label-result">6</label></td>
                            <td class="grey"></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(r304)}}</label></td>
                        </tr>
                        <tr>
                            <td><label class="label-result">7A</label></td>
                            <td class="right"><label class="label-result">{{r437a}}</label></td>
                            <td class="grey"></td>
                        </tr>
                        <tr>
                            <td><label class="label-result">7B</label></td>
                            <td class="grey"></td>
                            <td class="right"><label class="label-result">{{r437b}}</label></td>
                        </tr>
                        <tr>
                            <td><label class="label-result">8</label></td>
                            <td class="right"><label class="label-result">{{r438}}</label></td>
                            <td class="grey"></td>
                        </tr>
                        <tr>
                            <td><label class="label-result">9</label></td>
                            <td class="right"><label class="label-result">{{r439}}</label></td>
                            <td class="grey"></td>
                        </tr>
                        <input type="hidden"  name="makanan" id="makanan" :value="totalmakanan" />
                        <input type="hidden"  name="nonmakanan" id="nonmakanan"  :value="totalnonmakanan" />
                    </table>

                    <div class="blue-message">
                        <p>BLOK VI</p>
                    </div>
                    <table>
                        <tr>
                            <td class="td-small">
                                <div class="success">
                                    <p>Rinc</p>
                                </div>
                            </td>
                            <td>
                                <div class="success center-text">
                                    <p>Kolom 2</p>
                                </div>
                            </td>
                            <td>
                                <div class="success center-text">
                                    <p>Kolom 4</p>
                                </div>
                            </td>
                        </tr>
                        <tr class="odd">
                            <td><label class="label-result">1</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(b6r1k2())}}</label></td>
                            <td class="right"><label class="label-result">{{total}}</label></td>
                        </tr>
                        <tr>
                            <td><label class="label-result">2</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(b6r2k2())}}</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(b6r2k4())}}</label></td>
                        </tr>
                        <tr class="odd">
                            <td><label class="label-result">3</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(b6r3k2())}}</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(b6r3k4())}}</label></td>
                        </tr>
                        <tr>
                            <td><label class="label-result">4</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(b6r4k2())}}</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(b6r4k4())}}</label></td>
                        </tr>
                        <tr class="odd">
                            <td><label class="label-result">5</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(b6r5k2())}}</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(b6r5k4())}}</label></td>
                        </tr>
                        <tr>
                            <td><label class="label-result">6</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(b6r6k2())}}</label></td>
                            <td class="grey"></td>
                        </tr>
                        <tr>
                            <td><label class="label-result">JL</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(jlhb6k2())}}</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(jlhb6k4())}}</label></td>
                        </tr>
                        <tr>
                            <td><label class="label-result">SL</label></td>
                            <td class="grey"></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(selisihb6())}}</label></td>
                        </tr>                        
                    </table>

                    <div class="blue-message">
                        <p>BLOK VII</p>
                    </div>
                    <table>
                        <tr>
                            <td class="td-small">
                                <div class="success">
                                    <p>Rinc</p>
                                </div>
                            </td>
                            <td>
                                <div class="success center-text">
                                    <p>Kolom 2</p>
                                </div>
                            </td>
                            <td>
                                <div class="success center-text">
                                    <p>Kolom 4</p>
                                </div>
                            </td>
                        </tr>
                        <tr class="odd"> 
                            <td><label class="label-result">1</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(totalmasuk())}}</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(totalkeluar())}}</label></td>
                        </tr>
                        <tr>
                            <td><label class="label-result">2</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(rb72k2)}}</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(rb72k4)}}</label></td>
                        </tr>
                        <tr class="odd">
                            <td><label class="label-result">3</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(rb73k2)}}</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(rb73k4)}}</label></td>
                        </tr>
                        <tr>
                            <td><label class="label-result">4</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(rb74k2)}}</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(rb74k4)}}</label></td>
                        </tr>
                        <tr class="odd">
                            <td><label class="label-result">5</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(rb75k2)}}</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(rb75k4)}}</label></td>
                        </tr>
                        <tr>
                            <td><label class="label-result">JL</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(jlhb7k2())}}</label></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(jlhb7k4())}}</label></td>
                        </tr>
                        <tr>
                            <td><label class="label-result">SL</label></td>
                            <td class="grey"></td>
                            <td class="right"><label class="label-result">{{thousandSeprator(selisihb7())}}</label></td>
                        </tr>                        
                    </table>

                    <br>
                    <input type="submit" nmae="submit" value="Simpan">
            </fieldset>
        </form>
        </div>
        <script src="../js/vue.min.js"></script>
        <script src="../js/currency.js"></script>
        <script src="../js/rekap.js"></script> 
        <script>
            <?php
                $data = null;
while ($row = mysqli_fetch_array($result)) {
    $data = isset($row['data']) ? json_decode($row['data'], true) : null;
}
if ($data && is_array($data)) {
    foreach ($data as $key => $value) {
        if (($key != 'nks') && ($key != 'nus') && ($key != 'makanan') && ($key != 'nonmakanan')) {
            $value = str_replace(' ', '', $value);
            echo '
                      let '.$key.' = document.getElementById("'.$key.'");
                          '.$key.'.value ='.$value.';    
                          '.$key.'.dispatchEvent(new Event("input"));';
        }
    }
}
?>
        </script>
    </body>
</html>