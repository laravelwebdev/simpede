<?php
require_once dirname(__DIR__, 2).'/app/Helpers/database.php';
date_default_timezone_set('Asia/Makassar');

$conn = getDbConnection();

$queryVersion = 'SELECT version FROM susenas_settings LIMIT 1';
$resultVersion = mysqli_query($conn, $queryVersion);
$version = mysqli_fetch_assoc($resultVersion)['version'];

$queryFitur = 'SELECT * FROM susenas_fiturs WHERE is_active = 1';
$resultFitur = mysqli_query($conn, $queryFitur);
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<style>
*{box-sizing:border-box;font-family:Segoe UI,Roboto,sans-serif}
body{
    margin:0;
    padding:12px;
    background:#f4f6f8;
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto,
    Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", Helvetica, Arial,
    sans-serif;
}

/* GRID 2 KOLOM */
.row{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:12px;
}

/* TILE */
.card{
    position:relative;
    height:102px;
    border-radius:8px;
    padding:12px;
    color:#fff;
    overflow:hidden;
    box-shadow:0 8px 18px rgba(0,0,0,.25);
}

/* TEXT */
.card h3{
    position:absolute;
    left:12px;
    bottom:12px;
    margin:0;
    font-size:13px;
    font-weight:500;
    z-index:2;
}

/* ICON IMAGE BESAR */
.card img{
    position:absolute;
    right:-28px;
    top:50%;
    transform:translateY(-50%);
    width:78px;
    height:78px;
    object-fit:contain;
    opacity:.25;
    z-index:1;
}

a{text-decoration:none}

/* RESPONSIVE TABLET */
@media(min-width:768px){
    .row{grid-template-columns:repeat(3,1fr)}
}
</style>
</head>
<body>

<div class="row">
<?php
$colors = [
    '#A4C400', '#60A917', '#008A00', '#00ABA9', '#1BA1E2',
    '#0050EF', '#6A00FF', '#AA00FF', '#F472D0', '#D80073',
    '#A20025', '#E51400', '#FA6800', '#F0A30A', '#E3C800',
];
$i = 0;

while ($row = mysqli_fetch_assoc($resultFitur)) {
    $bg = $colors[$i++ % count($colors)];
    ?>
<a href="<?= $row['path'] ?>">
    <div class="card" style="background:<?= $bg ?>">
        <h3><?= htmlspecialchars($row['nama_fitur']) ?></h3>
        <img src="<?= $row['image'] ?>" alt="">
    </div>
</a>
<?php } ?>

<!-- ABOUT TILE -->
<div onclick="about()" class="card" style="background:#87794E">
    <h3>Versi Aplikasi: <?= htmlspecialchars($version) ?></h3>
    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAQAAAAEACAYAAABccqhmAAAABHNCSV
                QICAgIfAhkiAAAAAlwSFlzAAAHYgAAB2IBOHqZ2wAAABl0RVh0U29mdHdhcmUAd3d3Lmlua3NjYX
                BlLm9yZ5vuPBoAACAASURBVHic7Z17mF1Vef+/71p7n3PmnLlmcgUpF8s1gNwviiAgULkEMgkBVA
                pahbZaK1Zti6ho1WJtqxXb36+iVqVW5SaKihckgFySTMI1IIKCNPdkJjNzZs59r/X2jyQaQibMnL
                32Xnufsz7PMw9PSPa7vnPOXt/97nV5F8GRengl8giwn5JyPyLeF8BcMPoBzCBwP0P0A9wHwAfQuf
                2yLIA81gAAygBq2///BIAGE20VrLcyaBjAVgDDADYw0UuS1Euo40VagkqMv6YjAsi2AMfU4ZWYF7
                B3uCB9BBjzGXQ4gfcHMKvpoGtCSdrMoN8R81MgPK1ZPOWpYDUtwcZQUR2x4QwgofAydAfSO0GQPp
                mYT2LQCQBmGm8onAFMxhARr2BNyzTEI54XLKcLMR5JS45QOANICPwECqoqTyfB5wA4DcB8ACLyhq
                MxgF1RAJ4B4T7W9FPZqe6jc1CKpWXHHnEGYBEexOGaxHnEfA6D3gAgE7uIeAxgV2oEfoiJfiqU/h
                EtxtNWVDicAcQNr8B8TeJiAEsAHGpbjyUDeDmMF0G4S0DfSgN40LacdsIZQAzwcuyvSbwDApeCca
                BtPS8jCQbwcn4NxneE0F+nhfidbTGtjjOAiODnkVVjcoHQ+k+Z6C0ApG1NuyV5BrADzaBHiPBN4a
                n/pgtQti2oFXEGYBgexAGaxPvA+FMAfbb1vCrJNYCd2QrCN4XWN9IivGBbTCvhDMAQvArHai3+Gs
                BlADzbeqZMOgxgB5rAP1Ys/81fFNxjW0wr4AwgBMwQapVcBMaHCXycbT1NkS4D+D0MGgThs/IidQ
                cR2LaetOIMoAmYQWpQnk/EnwBwtG09oUipAezE0wz6J/mk+m+6Htq2mLThDGAabO/4C4n44wCOtK
                3HCOk3gB08wUTXy4vU911GMHWcAUwRXoHjFcnPE/gNtrUYpXUMAMC2VwMJ9QG3nmBqOAN4FXgZXq
                Ol+AyAt6MVP68WM4DtMAG3EekPu7UEe6b1bmhD8MPo0J64FoS/AdBhW09ktKYB7KACwj+Lhv5Ht3
                V59zgD2A28AqdqEl8GcLBtLZHT2gawgxc0xJ/7A8HPbQtJGs4AdoKfRJ+uiRsAvBvt8tm0hwEAAA
                i4lQL9HlqCLba1JIXot5umhGBQXqpr4tcArkK7dP42g4GLtSdWB9+TS2xrSQptf6PzMnRrKT6HbR
                2//WijDGBnCLiVMvpqOh8jtrXYpK0NgJfjZC3EzQBea1uLNdrUAAAAhP8VrP+UBnC/bSm2aEsD4K
                XwdEH8AwgfRru/BrWzAWxDAbhBBPrjtATKtpi4aTsD4EcxixV9m0Fn2taSCJwBAAAY9IAM1CXtVt
                C0rZ5+vBzHaSUGXed37AqBT9WeWMl34GTbWuKkbQxADcqrtBAPAdjXthZHYtlbQzyg7hB/a1tIXL
                T8KwDfAqn3F/8G4D22tSQS9wowGV8RW/Rf0tVo2BYSJS1tAPw0OrlM32HQeba1JBZnAJNC4J9Rji
                +mc1G0rSUqWtYA+FHspZW4C8AxtrUkGmcAr8ZTItDn0xL8r20hUdCSYwC8CkdqJQbhOr8jPEdoTz
                zEd+II20KioOUMYHttvnsB7GVbi6NleI3W4n6+HSfZFmKaljIAXoU3bu/8/ba1OFqOPk3i5407vD
                NsCzFJyxhAY6V3utbixwC6bWtxtCydAvquxve8s20LMUVLGEAwKM8VrO8G0Glbi6PlyQvWPwhuk+
                faFmKC1BtAY5V3BoFvA5C1rcXRNmRJ8G2N273TbQsJS6oNgFfhJKH1nWjlkl2OpNIhSP+Q78QbbQ
                sJQ2rXAfByvE4LsRRpOH4rQbDoBjMBJMGiC3qdhlATACsQMYQaty0xbYwJ0mfSQqyyLaQZUmkAvB
                wHbV/XP9O2liShRS+UfxiU90dQ3j5Qch9ouTe06Nv+MwOgl59aNjY29rI/EweQahRSjUIEI/AaG+
                A31sFvrINXX4Ns7TlI9fJrHNgitH4DLcbztoVMl9QZAC9Hv5bikcQdsx0zLLrRyByLRvY4NPyjoP
                xDoOTcacfZ1QCmgtfYiEzteeQqq9FReQy5yhMucwBeEIE+KW31BlNlALwUOdUp72m5wzmmACODIH
                ciarnTUc+eisA/GCaGcJoxgFeK08jWnke+9DAKE79ErrwKxC29h2a3MOhBOabOonegalvLVEmNAT
                CD9CpxMxhvs60lLpjyqHe8GdWOBajnTgNT3ngbRgxgF4QuI196CF1jdyM/fh8Ep6Y/mOAWsVBfmp
                bjyVJjAGpQfArAR2zriB6BevaNqBQuQ73jzWCKdoIjCgPYGcEV5ItL0TN6B/LlZQC3wfmdhH+QC/
                XHbMuYCqkwgGBQLiDwnUiJ3mbQcjYq+ctQLVwG5e0TW7tRG8DO+I216B65Hd0jt8FTw7G1awFm0G
                JvQN1hW8irkfgOxctwoJZiEECPbS1RoPwDUC5ciWrhbWDKxd5+nAawA+IGOsfuRt/wV5GtpW7gfK
                qMC61PoMV41raQPZFoA+Cn0anLYhmA+ba1mKbhH4lSzwdRz50Bm1+DDQP4A4zCxP3o3/IlZCvPWN
                QRGU+Jgj6ZzkHJtpDJSLQBqEHxHQCX2NZhksA/FKWeD6GWOxtJ+PjtGsAOGJ3j92DG5huRrf3Gth
                jTfEsO6LfbFjEZ9u/ASQgG5Z8R+Cu2dZhCiz6Uuq9BpXAlQNK2nN+TDAPYDmt0jf0QMzd9rqXGCB
                h0pTegvmFbx+5IpAHwIA7QEI8D6LKtJTTkoVz4M5S63w8WydupnCgD2I5QRfQP/Qd6hr8Fao2zOi
                aE1sckcaVg4gyAl8JTnfIBAqe+PnvgH4bxvn9GI/M621ImJYkGsINs9VnM3vAx5CqrbUsJDTM9LJ
                U6NWmnDyVuN6DuFNelvfMzMpjouRZbZ9+d6M6fdGq5Q7B2/29jeM41YPJtywkFEb9e++LvbevYlU
                RlALwSx2gWywF4r/qPE0rgHYjx/i+h4R9uW8qUSHIGsDPZ2vOYs+7DyFZ/bVtKGBqC9Am0EI/bFr
                KDxGQAfAukZvllpLjzVzrfgZE5P0105yciCLHtRwoBTwpIKSCEACXqcfByatkDsWa/b2Os71LbUs
                LgK8ib+BYkZhQ4MV+5WiE+CMLnbOtoBqYcxvtuQDV/sW0pICJ4clvH9jwJKQSkJIjtHZ926eXVUv
                llf9bM0JqhlEagFAKl0QgU6kGAQClwAla4dxV/jNnrPgrBFdtSmoNxjVykv2BbBpAQA+BHsa9WYj
                VSWNNPeftjrP8mBP6hVtonImR8iYzvIeNL+N70Hi67GsCeYGY0AoVqvYFqvYFaPYC25AjZ6rOYt/
                b98OupPK+jLDx9OC3Ai7aFJMIA9CDdzaA/sa1jujSyx2Gs/2vQIt4q5J4UyGX933f8MEzHAHaFmV
                EPFKq1BkrVGhpBvAPcUo1h3tr3oaM0GGu7JiDwD8UAX2Bfh2WCQXnh9o0+qaLWcR6KM74Y2/p9IQ
                i5jI9c1gvd6XcmjAHsSiNQmKjUUKrWoFQ8u/6I65iz/iPoGvtRLO2ZhDWd5y1WP7apwaoB8Er4ms
                VqAAfZ1DFdyp1XYaL3Y4jj48tmPORzGWQz0YyNmjSAHTAzKvUGJspVVGpxFAZhzNp4A3q33hxDW0
                Z5VmzRR9o8gdjqLIBm8V6krfN3vQcTvR9H1J0/m/HQ31tAX3c+ss4fFUSEfDaD2X3dmDezF4Vc1B
                XbCVvm/j2GZn8g4naMc4ieLa62KcBaBsAPY4b2xXNI0TFeEz3Xotz1nkjbyGV9dOaz8GQ83hxFBr
                A7AqVRLFUwUamBIxw47Bu6CTM3fz6y+BEwIqAPpAFY2fxgLQPQnvg4UtT5Sz0fjrTzZ3yJmX0F9H
                Z1xNb548STAjO6C5jX34NcJrpVfSMz343hWdGatGH6NMS1thq3kgHwSszTLH6LlBzoUe58NyZ6r4
                8kthCErnwOHTk7S13jygB2pVytY2uxBKWjGSycuflf0TeUms2kVRHoP6YlWBd3w1YeNRriOqSk81
                cKl0fW+fO5DGb1dVnr/DbJ5zLYa1Yvugsdr1icZIKh2deg2LfYeNyIyGlPfMhGw7FnALwC+2gSzy
                MFZ/nVc6djtP/rrzhMIyxSCPR2d0x70U4U2MoAdqZWb2BorIRAGV5HwAp7rXkvChP3m40bDVaygN
                gzAE3iWqSg8wf+IRib8R/GO/+O0f0kdP6kkM34mDezB/lcxmxgktj4mn9GLXeI2bjRkNO++Nu4G4
                01A+BHsZdW4kUAhr9ps2gxEyNzfgIl5xmN21XIodCRrF89CRnAzhRLVYxOlI3OFPiNDdjnxYshg6
                3GYkZEVUi9H12ITXE1GGsGoLV4LxLe+UEexvr/n9HOLwShv7eQuM6fRLoLOcyd0Q1pcCak4c/Dhr
                3/JVGl2CYhp5X4yzgbjM0AeCXyYFwVV3vNMtFzLRrZ1xuLJ4VwKf80yfge5s7oMfqZVQonYmjW+4
                zFi5C/4FviGyCPzQA0xBVI+Lx/PXsayp3mPMr3JPp7C5Ci9eb1o8aTAnNndCNrcM3AyMx3odx1qr
                F4ETFLeTK2KsKx3JnMIDD+Ko62mkWLfhRnfAGmhkUyvsSMngKEsL7fKrUIITC7rwsdWVMmQNi016
                cRyEQ/h0Dgv+Hr4+mbsTQSrPLOAmBnw/wUKfb9C7ScbSRWNuOhrzuf6Ao7aUEQYVZvt7EZgkD2Y/
                Ne1xuJFSEHB0d4Z8TRUCwGIFm/K452mqWaX4R6x1lGYvmeRG9XNItb2hUiYGZvF7KGtkGXus7EeP
                e5RmJFhSD9zjjaifwu5eXo10KsQ0Ln/rWYga1z7zNS1MOTInVpf9KmAfeEZsam4THUDRQekWoE+/
                72giRPDVZFoPemJYhUYOQZgBbiciS08wPAeO8njXR+KQX6uvOp6vxpQxBh9oxuI5ullOzD0Bwrq2
                +nSk774q1RNxL9KwDhysjbaJJ65njU8heFjiMEoa+7w+jctWP3SCEwu6/byCtWsWcBKvnjDKiKCM
                a7o24i0juWB3E0GAk9GUOg1PdJmHgL6i7k4Ek3zx8Xvicxs9dE/VjC0Ny/Ayixxn0k34kjomwg0t
                9ck7BfJ3sSqoVL0fCPDB2n0JFFztg0lWOq5LMZdBfC12Os5g5DsXuBAUXRoLWIdEtjtNbHGIg0fp
                MwZVHqDl8+yvckOvNuea8tejvzRhYKDc95P1jEU9y1CS6JMnhkBsArcBSAg6OKH4ZK4YrQa/2FIP
                R2u+k+mxARZvYUIEKutAy82RjrXWRIlXEO5tswP6rgkRmApmhTl2ZhyqPcFX6/RVc+55b4JgBPSv
                R1hV86PzLzauiYSrxPFy2j60tR3sHhh9cjoFJ4O7ScFSpGxvdSW8WHAWzaovHkMw3c90gD9z6isO
                IJjTUbORHHfjVDZ0cudJ3BwJuZ3ApCjIVRhY4kf+VleI2WYk0UsUNBHobnPgwl924+BG3b2pu2wp
                2lMuPhlQ0MPt7AROkPPf2lDX8oSV/IE04+WuCcUyRm9Kbr1aYeBNg4XAxVR8BvrMO+z/8JCPGecD
                QFWLDemxZhg+nAkdzFSspzoogbllrH+aE6PwDkc37qOv9zv1X4wk1lLH2o/rLOvyulMuOehxQ++v
                k6HlwVz8k+psh4Hrry4VL4hr83St1mloQbhhTJSIRFcicLcCINoNwZbkuClAKd+cQuatwtz/4mwD
                dvq6BUnvqTsVoH/uu2Bu5dlrgn4R7p6ewIvR5jtP8KQ2rMQuCzo4hr3AD4FkgGzjQdNyyBfxgama
                NDxejsyKZq1H98gvHdH1TRbOXt79wVYO2m9AwMCCL0dIYbEKx0vA61XCI3rp4TxRZh8xnA/jgWwA
                zjcUNS6bw81PVSiNQN/N33cB21WvPXKw38aGlgTlAMFHKZ0K9oxd5ELl+ZicPNr6o1bgAa4g2mY4
                aFqQPVjnCTEoWULfjRDDz1bPjO++SvNIIgPVkAEaG7EC4LGO+9IJELg7Q037eMGwABJ5uOGZZ6x9
                lg0d309UKQwao08VAs6j0O+E2Vah0YKRoQFCOdHeHWaCjRjVLhjQYVGcN43zI/BpBAA6h2hFvrXe
                jIpOrdHwDKFXOxKlVzseKACKH3CYz3vMWQGoPohBsAP4q9ALzGZMywsOhEPfempq8ngvkDK2Kgw2
                Bd2e4uc7HiojOfgwhh2uWuN0FTwk6vI+zP38deJkMaNQClZOKe/vXcGeAQSzxzGT91T38A6O4SyB
                mYsezpIvR0pu/3F0ShjFtTDuXOUwwqMoMK5Ikm4xk1AAKHm2eLgFou3Ixk2kb+dyAFcOhB4WvoHT
                NfpLa4aaEjnAOWOpM3DkDER5mMZ9oADjcZLzyEerb5L1FKgYyhQpQ2OPOUDDzZfO/NeMC5p6W30E
                kuE27V5rYMIFnuZ7qPmR0DAEVavWS6NPzDoeWcpq9P28j/rszoFTjvrObSYCLg8gEvdXsCdiVMFh
                D4c1HLHmhQTXgYlEwD4CdQALCfqXgmCHvEV1rT/5058WgfC87JTisTyHjAlQM+Xn90ep/+OyiEHA
                ipFI43pMQYrzV5dJi5/LaO+bBw3PieaGSb//I8KVtmv/9Jx/jY/48klj7UwOpfNaAnWR4gBXD86y
                TOf5PEvNnpfvLvwPckPCkQqObWQ1c6jkEvvmVYVSgkJA4F8KiJYMYMQEEeTEjWirFG5pimr8346X
                /67cycmQKXXphF5ZwsXngpwOYhja0jjIP21+gsEPaeSzh4f0K+ozU6/s7kMj4mKs2tia4WjjWsJj
                wK8hBAJcsAiHi/JPV/5e0T6v2/1QxgBx05YP7BHuZvL9ZWLaVrx18zhDGAwJuNhj8PfsP4VvymIc
                H7moplLsdlGBNlgsAPV0YtzaP/jpcTtlpQPZuw0pYG+5oxAyCYcyUTBP5hTV/rSeFO+GkhpBTwve
                YzulruIINqwkPE+5mKZW4WALSfqVgmCPzm93S7p3/rESYLqGWTZQDMZOxha/JOT9QeAOW9tulr/R
                Z6/3/ymQaee2H37/lKA2PFybcMH/bHAscd0RozIWEygEb2AINKjJAsA+Bl6NZAojZQK695P0pbzb
                89sWY949GnJu/kL22YfBAwm0HLGEAmjAFkEvVsA4AO/ikKdA5KYQOZ+XYJ4Y/XNYgW/WAqNH19Kx
                mAYxt+iNc6LTqhQtSTiIQxM33OzJ3uJasEmPL2afpaISiVu/8ce0YQhRrYTVwW4Jvpc0YMIGAvUR
                kAy9lNX9sqq/8cryRMxWDthztMxjQBzPQ5I3c7MSfKALRo3hylS/9bljCvdoHoNagkPAQzfc7M3c
                4wcVi7MbToa/raMFVkHMkmTHanvebvqUgw1OfMZADEiaqZpamn6WvdAqDWJcx3q2TiMgAjfc5Uvp
                soA+AQtdycAbQuoTIAStyJUIkygGRtnBeJ8iNHC8CUrFscgBFHMrUOIFE9jkP4kZsCbF3CfLdMib
                rFgURlAGx0SXF4wrh1grY0O8wSxtoTlwGEecrthKkMIFmbyrnx6v9mMlwC0LKE8XYKc09FAcGIIF
                NjAHVDcYwQ5rNhdilAqxLmuyVO1C0OGOpzpl4BkvXp6GTJcaSfBGYACTKAxGUAzR9mpyermOlIPU
                o3VxgUAASHOGc9GpJjAMyUKAMQeqTpa50BtC5hvlupmr+nooBhps+ZGgQcNxLHEKEMwI0BtCxhMg
                CpRg0qMYKRPmcmAwANm4hjCqG3Nn2tarJ+vCP5NHs2AJDADIDJiCAjBuBRkCgDILWl6WvDPCUcyS
                ZQzc9Wi0aibnF4FDT/lNsJM68ADRgRYwoZrGn6Wq3ZTQW2IJo51BiAX2/+nooEaabPmTEAhUTZo9
                DDIG6+XFqYVNGRTBqNyesivhpCT0DqokE1BqgmyADoFIwDIebeIkAGa5u+1hlA61EPmk///Xrz91
                JE1HExjDiSyfI3ifqUZPCbpq9tNJK1stkRnkYIA8jUXzCoxAhrydBBnCZPBvqdqVgm8Bq/avraeo
                h00ZFMqvXmV/JlKr82qCQ8BH7JVCyTJwMZE2UCr/5M09cGSrsFQS2EUjpUBpCtPWdQTXgY9L+mYp
                l7BSAkywCC5g0AcFlAKxHm6Q8AmYQZAAjJMwBm+p2pWCaQwRoItanp6+tuHKBlCGMAXmNToo4GBw
                DWCcwAJFSyXpQA+PVVTV/rDKB1CGMAufKjBpWYQUpzfc3cK0AGTwNI1PyZXxts+tpAKbcqsAVoBC
                rUtG5HJXkGAInmR7h3wdwswOtQAvA7U/FM4NceCXV9pZqwPeCOaVOqhtvG21Fq/iESERvpAgyZCm
                b0GBwCP2UyXlj8xupQ4wCVmjOAtFOqNG8AXmMjsrXnDaoJD4HDjW7vglEDYNBqk/HCw8jUftn01U
                ppNxuQYqr1Rqj0Pz/xIJJWJZaJnjYZz7QBPG4yngmy1V+Eut69BqSXME9/AChMNP/wiApms33MqA
                FIqR42Gc8Emeq9IG5+m0K13nC7A1OIZka52nzRHMHV7RlAspBCLTMZz+wYwDFYDyBR+yZJTyBTXd
                r09cxuLCCNTJSroao75YtLIbhiUJERxvA4njUZ0PxZ2IRwQ+8RkKv8INT1E+WaywJSBDNQLIXbnN
                pVvNuQGnMQeDldb3aq3bwBcPIMIFP5OSjEfm6t2WUBKWKiUg1X/08XUSglL/1nouWmYxo3AAGduH
                EA4gpylTtDxSiVE1X42DEJzIxiKVzq3jV6F0gnqrwFAECzMN63zGcAL2IVkKwSYQDQMXFzqOuV1m
                5GIAWUqvXQBV26R+8wpMYoda8QGJ+WMG4AtASKgHBzbxHgNZ6BX38sVIyJihsLSDKaGWMT4Z7+uc
                oTyFaNrbQ1BoEfonPQfJ27STCfAQDQRD+LIm5Y8hNfCXW9UhoT5cSdEOPYzthEJVTlXwDoG/6GIT
                VmYaZ7oogbiQHIQP0kirhhyVbuggzC7aQsV8OtLnNEQz0IMF4O997uN9ahUPy5IUVmEdCRCPOiCE
                onYa0axNMA5kcRv2lYoWPia5jovb75EMwoTlQxoydvTleEHPLHEoVCdrd/pxSjWJzczPZ7TSTPh0
                gYKZZDv571Dn8jcSfdb2cICpFsS4zEAAAAjO+BEmYAADpK30K56z3QclbTMeqNAJVqAx0536CyaH
                jtfhKv3U9O+vfVUvr3OkxUqqGr/njBFnSP3GZIkWEY36cl0ThTZBYvWCfy0yQuIz/+76HjjJfDzT
                U7zBAohZHx8Cv2+rb8J0SIJeNRwkyRTUtEZgB0Ip4AzC5bNEVH6ZuQKlyZJ60Zo8WKmxWwCDNjaK
                wEHdKIvWAzesYSOfUHAONyXN0bVfCoX/IS+akS11Ao/mvoOI1AYcItELLG6EQZtZCpPwD0b/pCIh
                f+AAAId9E7ojt0J1IDEEjmawAA5ErfgV9/InScUqWGqlsmHDvlWj30en8AyFWfQXcx3F6RKGGm26
                OMH6kB0PF4DITwvSwSNAqjH4eJgg/FUjX0/LNj6jQChaHRCQORGDM3/iPAiR3L2Spz6kdRNhD9PA
                /j65G30SSZ+iCy5XB7BIBt4wEjxQqUWx8QOUprbB4ZNzL20j32A3SUm68cHTmM/6FzEenKs8gNQG
                h9MxDtLxGGrtGPQejwhxsrpTFSLLsThSJEM2Pz1qKRbEuqEczc9DkDqqJDsI58WWLkBkAnYpiAxL
                5kCb0VnaOfMBIr2G4CbmbAPAxg89ZiqFN+d2bWhk9DBonbs7Yzz9BirIy6kViWeikhvhpHO82SK9
                +OTMXMSstGoDA67qYHTcLMGBoZR81QgdbC+C/QVfyxkViRwfhaHM3EYgDeMcHPAHOHGURB98jfQK
                jNRmLV6sH2TMBIuLZGM2PL6DjKNTPTrZ4axuz11xuJFSFlofR/xdFQLAZABAbhxjjaahahh9G99f
                0wVQa63lDYOlZyYwIh0NsH/MxVY2LMWf8ReCr8mE+kEL5OS+KpqRHbbg8B/Q0Aif7kM7X7kR//T2
                PxGoHC8GjJLRlugkBpbNxaNLLQZwd9Q19BfvwBY/EiggXrL8XVWGwGQMehDMBc74qIzuJnkKmZu0
                mU1hgeLYU6n77dqDcCbNw6ZvQz6ygtw8wtXzQWLyoI/FMaiO91Odb9nkLqfweQ7LWzrNA9/Feh9w
                rsjNaM4dESSpVk/+pJYLxcxcatRaNrKvzGBsxb90GAk2/CiuTn42wvVgPYfm5ALKObYRB6CN1DV4
                LYbAWm8VLVrRWYhB2DfVuLJaMzKEKXMG/Ne5M+5QcAYKbl/sIg1mpasVd8EKw/gwQvDNqB31iNnu
                GrATa7X75WD9wrwS7UGwE2DI2GOslnt7DC3LUfSmSNv0n4h7gbjN0A6ASsASHR6wJ2kKkuRdfoR4
                3H3TEuUJyotvVU4Y4inhu3FiMos8aYs/GTKEzcZzhuRBAekwMq9sUJVmo+CehPAUjcuUu7o6P0TX
                SOXh9J7HK1ji0j421ZbrxcrWP9llGMTkSzcnLm5i+ge+RW43Gjgpk+QRT/UcRWDICOwwYwbrLRdj
                PkJ25CvhjNCLLW256CW8dKbbGjsBEobNpaxJbR8cimR2cM/X/0DaXm9gIzLZcLlZXl8mSjUQDgJ9
                Gna+J5AP22NEyXiZ7rUO76i0jbyGV9dOaz8GQ83lwtlWNpJ1AaxVIl8rMV+oa/ipmb/iWy+FEgoN
                9IA7ByFpk1AwAANSiuARC+NE+MlLveg4meayNvJ5vx0JnPwvcmL+hpgqgNoB4oFCcqKFWjH/ftG/
                oKZm5O1e0EYr5dLOLF1tq31TAA8Er4msVqAAfZ1DFdyp1XYaL3Y4jj48tmPORzGWQz0RRwjsIAmB
                nVeoCJStX8yP7uW8SsjTegd2u4498s0BBaz6fFeN6WAKsGAADBoFxA4O/b1jFdah3noTjji2DKxd
                KeEIRcxkcu6yHjmzMDkwbQCBQmKjWUqrXYiqMQ1zFn/UfQNRZp4ZxoIHxBLtTX2JWQAPQK+gkTnW
                NbmlI3ewAAC21JREFUx3RpZI/DWP/XoEW8wxieFMhlfWQzXuhXhDAGwMyoNxSq9QbK1TrqQbxnDE
                g1hnlr34eO0mCs7RpioyB9KC3EqE0RiTAAfhT7aiVWA+i0rWW6KG9/jPXfhMA/1Er7RISML5HxPW
                R8OW1DmK4B1BsBqvUGqvUGavUA2tJChmz1Wcxb+9fw62ustB8WZrrYW6SsF81NhAEAgBoUHwLwT7
                Z1NANTFuO9N6BaWGJbCogInhTbfjwJKQhSCggiCEEgevlXvqsBaGYwM5TSCJRGoBQagUI9UGg0gv
                gnqndD19iPMHv9RxN7kMerQeCfiAF+i20dQIIMgJfC051yGcDH2tbSLJXOKzHR89HYxgWagYhAtO
                2/YKBYHAMAaAZY60R08MkgXcWsTZ9Fz8h3bUsJQ0WwPpwW4QXbQoAEGQAA8Cocq7VYhijPLIyYwD
                sQ4/1fQsM/3LaUKTE2NmZbwpTI1p7HnHUfRrb6a9tSwsF4n1ykE1McJ1HHv9KxWAXg07Z1hMELnk
                fvpguQH/8P4xuJ2hGCQt/QTdjnhYtT3/mJ+B4xEF+xj6mQqAwA2PYqoDrlAwQ+2baWsASZ+Rjv/S
                c0MkfZljIpSc4AstVnMXvDx5CrrLYtxQSjQugj6SIkatQycQYAADyIAzTE4wC6bGsJDXkoF96JUv
                c1YNFtW80rSKIBSF3EjM3/jt6R/0lFEY+pwEyXeotU4gYvEmkAABCslO8i5vTs6HgVtOhFqfsDqB
                SuBCja5b3TIVEGwBpdYz/ErM2fgwwSXT5yejC+Lhfpd9iWsTsSawAAoAbFdwBcYluHSQL/UJR6Po
                Ra7mwk4eNPhgEwOsfvwYzNNyJb+41tMaZ5Uvj6ZLoA8ey6mib278A9wE+goOtiOYD5trWYpuEfiV
                LPB1HPnQGbX4NdA2AUJu5H/5YvIVt5xqKOyBgVpI+jhfitbSGTkWgDAABehgO1FIMAemxriQLlH4
                By4UpUC28HUzb29m0YAHEDnWN3o2/4q8jWrO2DiRpm0GJvQN1hW8ieSLwBAL/fMHQnUqK3GbScg0
                rhragWLoOSe8fWbpwG4DfWo3v0DnSP3Aov2BJbu1ZgfEou0ubryRkmNR1KDYpPA4h+I751BOq5U1
                HJX4p6x5vB1BFpa1EbgOAK8sWl6Bn7HvKlRwBu/UNSCLiVFupLbJT4mi6pMQBmkF4lbgbjbba1xA
                VTHvWON6PasQD13GlgyhtvIwoDELqMfOkhdI3djfz4falds98MDBqUvnpTUgf9diU1BgAAvBQ51S
                l/QeDX29YSN4wMgtwJqGVPRz13KgL/EJhYyGnEAFgjW3sO+dLDKEz8ErnyoyBuv0KnYLwoSJ9EAz
                BzymwMpMoAAICXo19L8QgYB9rWYhMW3WhkjkMjezwamaMQeAdBy7nTjtOMAXjBZmSqzyNXfQod5c
                eQqzwOocanHafF2Ly9tt9ztoVMh9QZAADwIA7WEA8CmGlbS5LQog/KPxTK2xfK2wdK/hG0tze06N
                v2Q32vWIT0CgNgBalGf//jNdbDb6yDX18Lr74G2dpzkCoJawcSxZhgfQYtwqO2hUyXVBoAAPAKHK
                VJ3Augz7aWNKGpGwCBRQEgH3qdBnEAUiUQAUIVbUtMG2UBfY6tqr5hSa0BAAAvx8laiJ8hhZWEEk
                OitqakjrrWYoG/OPipbSHNkqjtwNOFTsQjmsVFANpnmNmRFMqaxAVp7vxAyg0AAPwTgl8w0xIk/d
                hxR+vAKGmIC+I+yTcKUm8AAOCdoO7SLC5ESs4bdKSaMUH6LH8guNe2EBO0hAEAgH9C8BPB+k8AuF
                EsR1SMCNJn0wAesS3EFC1jAABAJ+ABofWZAFpoM7kjIWwUQp9GC7HCthCTtJQBAACdiJVC6DMArL
                WtxdEiMF4UWp9KF+Ep21JM03IGAAB0LJ4UUp8I4DHbWhypZ7VQ+o02z++LkpY0AACgY7Be5PWpBL
                7bthZHOmHQ/SLQp9ASrLOtJSpa1gAAgOZjgogvBKFlags64oHAP5CBegstQUuve071SsDpoAblVQ
                DfCCBjW0uicCsBXwnjy0Lpv6QlaI2SxHugbQwAAHgFXq9J3AZgnm0ticEZwM4wGJ+Ui/T1toXERV
                sZAADwo9hLKfldAp9iW0sicAawgxoTvcNbqL5tW0ictPQYwO6gY7BevqjeBOATQOuneI4pMSyg39
                xunR9owwxgZ3gVTtJa/A+A/W1rsUa7ZwCM3wjW57bqNN+r0XYZwM7QsVgmtD6egFtta3HED4MeEh
                l9crt2fqDNDQAA6EQMi+P1EmZaAGC9bT2OmGB8XQbqDLoAQ7al2KStXwF2hR9Drw7EZwFcZVtLbL
                TfKwCD8UkxoD+RhrLdUeMMYDcEK+V5xPxFAAfY1hI57WUANSZ6l7dQ/bdtIUnBGcAk8NPI6JL4Cx
                A+hVYuOdY+BrBVQA/QAO63LSRJOAN4FXg59mdB/8qgi2xriYT2MIBnhdYL2nmwbzKcAUwRXoWTlJ
                Y3EPg021qM0uIGQOC7ifittBCjtrUkkbafBZgqdCyWecerN2mIswA8aVuP41VhAJ+lJ/l81/knx2
                UATcC3QKoD5CXEfC2A+bb1hKI1M4AqM13lLVI32xaSdJwBhIAZpAbl+SBcR+ATbOtpitYzgLVC64
                W0GCttC0kDzgAM0Rj0zpKs3sdE5yJNr1YtZAAMelBKtZguxCbbWtKCMwDD8CAO0BBXAXg3gBm29b
                wqrWIAjC+LIf1euhpteCxx8zgDiAh+AgXVkIvB+koCnYakftbpN4AAjA/IRfpG20LSSDJvyhaDH8
                F+2hNXALgcwGtt63kZ6TaAIU36Yn8h7rMtJK04A4gZXoH5msTFIFwMxmG29aTYAB4XrC+iRXjJtp
                A04wzAIrwMh2lPLCDmsxn0BtioV5hGAyDcLBr6alrijoILizOAhMBPoKCq8nQSfDaA07BtfYGMvO
                F0GUAA4Do5oD9rW0ir4AwgofAydAfSO1FAv56YT2bQ0SDMNt5QegxgnYC+uJXO5UsCzgBSBK/A3E
                B4RwrWRwE4nJkOJPABoYwhBQbAoAdkoC6hJdhoW0ur4QygBeAH0QUfBygh9yPivcCYDcJsYt6LQU
                diT3UNkm0ADOBGsUV/0M3vR4MzgBZHDYqPA7h+0n+QXAMYZ6Z3eovUbbaFtDKebQEOx274tRB6gC
                7CM7aFtDrpWbPuaAuI+U6R0ye4zh8PLgNwJIUAwHViEbspvhhxBuBIAhuE0JfQRfilbSHthnsFcF
                iFwfcJ1se6zm8HZwAOWzCAz8qA30yLsMG2mHbFvQI4bDCkIS73B4Kf2BbS7jgDcMQKg34pA3WZXK
                LX2dbicK8AjvhgAF+UW9SZtASu8ycElwE44mCYma7wFqkf2RbieDnOAByRwkQrpVRLaAFetK3F8U
                rcK4AjKral/A31Btf5k4vLABxRsJVB7/QG1PdtC3HsGWcADqMwaIX01KXuqZ8O3CuAwxQ7RvlPcZ
                0/PbgMwGGCLUx0hbdQ3W1biGN6OANwhILAS0ny2+lCrLetxTF93CuAo1kUGJ+ggM9ynT+9uAzA0Q
                zrBOu30iI8YFuIIxwuA3BMCwJ/X0C/znX+1sBlAI6pUgXh7+gi/iIR2LYYhxmcATimwq8E9GW0EE
                /YFuIwi3sFcOwZws3C18fRgOv8rYjLAByTMcpMf+4NqO/aFuKIDmcAjlfA4Psk8+W0CGtta3FEi3
                sFcOxMA8B12+v0uc7fBrgMwLGD3wnWb6dFeMi2EEd8uAzAsW2gL9BHuM7ffrgMoL0ZZqKrvYXqdt
                tCHHZwBtCmEPO9pPkKWuje9dsZZwDtRwPAZ+h4/iQRtG0xDrs4A2gvfiWg30bH4zHbQhzJwA0Ctg
                83i4w+3nV+x864DKDVIWxi0Pneca4mv+OV/B/p5zWkHyBrxgAAAABJRU5ErkJggg==" />
</div>

</div>

<script>
function about(){
    alert("Aplikasi iSusenas\nVersi <?= $version ?>\nCreated by Muhlis Abdi");
}
</script>

</body>
</html>
