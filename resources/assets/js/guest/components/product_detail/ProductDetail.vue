<template>
	<div>

		<div>
			<navbar-apps></navbar-apps>
		</div>
		
		<section class="section">
			<div class="container">
				<div class="columns">
					
					<div>
						<nav class="breadcrumb">
							<ul>
								<li>
									<a href="/">Halaman Depan</a>
								</li>
								<li class="">
									<a href="">Product</a>
								</li>
								<li class="is-active">
									<a href="">Nama Produk 1</a>
								</li>
							</ul>
						</nav>
					</div>	
				</div>


				<div class="columns is-flex-mobile">
					<div class="column">
						<div>
							<div class="main-thumbnail">
								
								<figure class="image is-4by3">
						      		<img src="https://source.unsplash.com/category/nature/800x450" alt="Image">
						    	</figure>
						    	<span class="icon">
							        <i class="fa fa-heart-o"></i>
							     </span>
							</div>
					    	<div>
					    		<b>
					    			<p>Indomie Super Goreng Bali, Indoenesia Gratis 1</p>
					    		</b>
					    	</div>

					    	<div class="discount-box">
					    		
						    	<div class="harga">
						    		<p class="after-discount title is-3">50.000</p>
						    		<p class="normal-price">100.000</p>

						    	</div>

						    	<div class="percent-discount">
						    		<p class="title is-4">38 %</p>	
						    	</div>
					    	</div>
						</div>

						<div class="box-add-to-cart">
							<button class="button is-primary">Tambahkan ke Keranjang Belanja</button>
						</div>

						<div class="box-tabs">
							<tabs></tabs>
						</div>
					</div>
				</div>
			</div>
		</section>

		<div>
			<footer-apps></footer-apps>
		</div>
	</div>
</template>



<script>

	import FooterApps from 'otherComponents/Footer.vue'
	import NavbarApps from 'otherComponents/Navbar.vue'
	import Tabs from './Tabs.vue'

	export default {
		components: {
			FooterApps,
			NavbarApps,
			Tabs
		}
	}
</script>