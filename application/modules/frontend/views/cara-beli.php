<div ng-controller="CartsController">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Produk</th>
						<th>Kode</th>
						<th class="text-right">Harga (KRW)</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>KT Olleh 10rb</td>
						<td>KT</td>
						<td class="text-right">10,000</td>
					</tr>
					<tr>
						<td>LG Yes 10rb</td>
						<td>LG</td>
						<td class="text-right">10,000</td>
					</tr>
					
					<tr>
						<td>SK Prepaid 10rb</td>
						<td>SK</td>
						<td class="text-right">10,000</td>
					</tr>
					<tr>
						<td>SK Eyes 10rb</td>
						<td>SKE</td>
						<td class="text-right">10,000</td>
					</tr>
					<tr>
						<td>SK Mobing 10rb</td>
						<td>SKM</td>
						<td class="text-right">10,000</td>
					</tr>
					<tr>
						<td>SK 7 10rb</td>
						<td>SK7</td>
						<td class="text-right">10,000</td>
					</tr>
					
					<tr>
						<td>161</td>
						<td>161</td>
						<td class="text-right">12,000</td>
					</tr>
					<tr>
						<td>Double</td>
						<td>DB</td>
						<td class="text-right">15,000</td>
					</tr>
					<tr>
						<td>Langit</td>
						<td>LGT</td>
						<td class="text-right">12,000</td>
					</tr>
					<tr>
						<td>Reog</td>
						<td>RG</td>
						<td class="text-right">12,000</td>
					</tr>
					<tr>
						<td>Super Warung</td>
						<td>SPW</td>
						<td class="text-right">12,000</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	
	<div  id="howto">
		<div class="row">
	        <div class="col-lg-12 text-center">
	            <h2>Cara Pembelian</h2>
	            <hr class="star-primary">
	        </div>
	    </div>
		<div class="well">
			<ol>
				<li>
					<h4>Transfer</h4>
					Transfer sejumlah total harga pulsa yang ingin dibeli.
					<ol>
						<li><b>Kookmin Bank (KB)</b> <br/>
							Account No : 733702-00-124921 | 
							a.n DAMAIYANTI TITUS IRMA</li>
						<li><b>NongHyup Bank (NH)</b> <br/>
							Account No : 302-0752-3333-11 | 
							a.n DAMAIYANTI TITUS IRMA</li>
						<li><b>Hana Bank</b> <br/>
							Account No : 880-910461-66007 | 
							a.n DAMAIYANTI TITUS IRMA</li>
					</ol>
				</li>
				<li>
					<h4>Kirim Konfirmasi Pembayaran</h4>
					Setelah pembayaran sukses, lakukan <b>konfirmasi</b> dengan mengirim pesan dengan format ini:
					<pre>CONF.[KODE PRODUK1]-[JUMLAH PRODUK1].[YYYYMMDD].[BANK YANG DIKIRIM].[NAMA PENGIRIM].</pre>
					<a href="#contoh-konfirmasi">[Lihat Contoh Kode Konfirmasi (klik disini)]</a>
					<br/>
					<h5>Kirim ke : </h5> 
					<ol>
						<li>Via Web : <a href="http://bit.ly/confirmPulsae">Konfirmasi sekarang</a></li>
						<li>Kakao titusid2504 (Senin-Jumat)</li>
						<li>SMS  010-84228825 (Senin-Minggu)</li>
						<li>Email : pulsaeshop@gmail.com | dengan judul KONFIRMASI</li>
					</ol>
				</li>
			</ol>
		</div>
		<div class="well" id="contoh-konfirmasi">
			<h4>Contoh transaksi pembelian <b>1 kartu</b>:</h4>
			<p>
				Roni beli pulsa LG 1 biji 10000 KRW. <br/>
				Roni membayar dengan transfer ke Kookmin BANK (KB) pada tanggal 17 bulan Agustus 2014 <br/>
				Maka code konfirmasinya :  <br/>
				<pre>CONF.LG-1.20140817.KB.RONI.</pre>
			</p>
			<h4>Contoh transaksi pembelian <b>banyak kartu</b>:</h4>
			<p>
				Jono beli pulsa KT 1 biji, Super Warung 2 biji dengan total 34000 KRW. <br/>
				Jono membayar dengan transfer ke HANA BANK pada tanggal 2 bulan Januari 2015 <br/>
				Maka code konfirmasinya :  <br/>
				<pre>CONF.KT-1.SPW-2.20150102.HANA.JONO SUTOPO.</pre>
			</p>
		</div>
	</div>
</div>

<style>
#cnt1 {
    background-color: rgba(215, 212, 212, 0.88);
    margin-bottom: 70px;
}

#panel1 {
    padding:20px;
}

.panel-body:not(.two-col) {
    padding: 0px;
}

.panel-body .radio, .panel-body .checkbox {
    margin-top: 0px;
    margin-bottom: 0px;
}

.panel-body .list-group {
    margin-bottom: 0;
}

.margin-bottom-none {
    margin-bottom: 0;
}
</style>