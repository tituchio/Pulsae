<div ng-controller="CartsController">
	
	<div class="container" id="cnt1">
		<div class="col-md-6 col-md-offset-3" id="panel1">
			<ul class="list-group">
				<li ng-repeat="item in products" ng-show="item.num > 0" class="list-group-item">
					<div class="row">
						<div class="col-md-6">
							<a href="#" class="btn btn-sm btn-danger" ng-click="item.num=0; calcTotal();"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
							<b>{{item.name}}</b>
						</div>
						<div class="col-md-3">
							<div class="input-group">
							  <span class="input-group-btn">
						        <button class="btn btn-default" type="button" ng-click="item.num = item.num-1; calcTotal();">-</button>
						      </span>
						      <input type="text" class="form-control text-center" disabled="disabled" value="{{item.num}}">
						      <span class="input-group-btn">
						        <button class="btn btn-default" type="button" ng-click="item.num = item.num+1; calcTotal();">+</button>
						      </span>
						    </div><!-- /input-group -->
						</div>
						<div class="col-md-3 text-center">{{item.num * item.price}} KRW</div>
					</div>
				</li>
				<li class="list-group-item">
					<div class="row">
						<div class="col-md-6 col-md-offset-3">
							<select class="form-control input-lg btn-lg btn btn-primary" ng-options="product.id as product.name for product in products" ng-model="selectedItem" ng-change="selectItem()">
							</select>
						</div>
					</div>
				</li>
				<li class="list-group-item">
					<div class="row">
						<div class="col-md-7">
							<h3>Total</h3>
						</div>
						<div class="col-md-5 text-right"><h3>{{total}} KRW</h3></div>
					</div>
				</li>
			</ul>
		</div>
	</div>
	<h2>Cara Membayar</h2>
	<div class="well">
		<ol>
			<li>
				<h4>Transfer</h4>
				Pembayaran dapat dilakukan dengan transfer sejumlah <b>TOTAL (<u>{{total}}</u> KRW)</b> ke rekening berikut:
				<ol>
					<li>KB 123456789 a/n Titus Damaiyanti</li>
					<li>HANA Bank 123456789 a/n Titus Damaiyanti</li>
				</ol>
			</li>
			<li>
				<h4>Kode Konfirmasi</h4>
				Setelah pembayaran sukses, lakukan <b>konfirmasi</b> dengan mengirim pesan dengan format ini:
				<pre>{{code}}</pre> 
				<p>Contoh transaksi : <br/>
					Si Budi beli pulsa SK 20rb 2 biji, KT 10rb 1biji dengan total 100rb KRW.
					Budi membayar dengan transfer ke HANA BANK melalui rekening TONI
				</p>
				<a href="#">Lihat penjelasan di struk</a>
			</li>
			<li>
				<h4>Kirim Konfirmasi</h4>
				Kirimkan konfirmasi pembayaran ke : 
				<ol>
					<li>Kakao asdcvfghijk</li>
					<li>SMS 010-1234567890</li>
					<li>Email : konfirmasi@pulsae.com | dengan judul KONFIRMASI</li>
					<li>Langsung konfirmasi melalui form dibawah ini <a href="#konfirmasi">Konfirmasi sekarang</a></li>
				</ol>
			</li>
			<li><h4>Terimakasih telah berbelanja :)</h4></li>
		</ol>
	</div>
</div>
<script type="text/javascript">
	angular.module('pulsaeApp', [])
	.controller('CartsController', ['$scope', function($scope) {
		$scope.products = [
			{id:'-',name:'+ Tambah Produk',picture:'',price:10000,num:0,subtotal:0},
			{id:1,code:'SK10', name:'SK 10rb',picture:'',price:10000,num:0,subtotal:0},
			{id:2,code:'SK20', name:'SK 20rb',picture:'',price:20000,num:0,subtotal:0}
		];
		$scope.selectedItem = '-';
		$scope.total = 0;
		
		$scope.selectItem = function(){
			if($scope.selectedItem != '-'){
				
				var product = null;
				for(i in $scope.products)
					if($scope.products[i].id == $scope.selectedItem){
						product = $scope.products[i];
						product.num++;
						break; 
					}
				
				$scope.selectedItem = '-';
				
				if(!product){
					alert("ERROR : Produk tidak ketemu");
					return false;
				}
				
				// change total
				$scope.calcTotal();
			}
		}
		
		$scope.calcTotal = function(){
			var total = 0;
			for(i in $scope.products) total += ($scope.products[i].price * $scope.products[i].num);
			$scope.total = total;
			
			$scope.generateCode();
		}
		$scope.generateCode = function(){
			var code = 'CONF#';
			for(i in $scope.products) if($scope.products[i].num > 0) code += ($scope.products[i].code + ' ' + $scope.products[i].num + '#');
			code += 'NAMA KAMU#NOMER TRANSAKSI';
			$scope.code = code;
		}
	}]);
</script>
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