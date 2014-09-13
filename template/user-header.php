
  <div id="logo">
    <a href="#" style="text-decoration: none;"><img src="../sekretariat/template/images/logo-only.png">
    <h4>
      <span>Biro Hukum dan Organisasi</span>
      <span>Kementerian Pendidikan dan Kebudayaan </span>
      <span>Republik Indonesia</span>
    </h4>
    </a>
  </div>


  <?php //if($_GET['act'] == 'step1'){$val = "form_pinjam.serial_no";}else{$val = "form_member.id_member";}?>
<!--  <body onLoad='setFocus(document.--><?php//// echo $val;?><!--)'>-->

  <?php /* Fungsi Set Tanggal Indo */
  $hari = array( "Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu","Minggu");
  $bulan= array(1=> "January", "February","Maret","April", "Mei","Juni","Juli","Agustus", "September", "Oktober", "November", "Desember" );
  $tgl= date("d");
  $bln=date("n");
  $hr=date("w");
  $thn=date("Y");
  ?>
  <div id="content-title span24">
      <h1 id="content-title-heading" class="span14" style="text-align: left"></h1>
    <h5 class="span4"  style="text-align: right; margin: 65px 0 -15px 0;"> <?php echo ("$hari[$hr], $tgl $bulan[$bln] $thn"); ?></h5>
  </div>
