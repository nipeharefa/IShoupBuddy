<template>
	<div>
		<div>
			<navbar-apps></navbar-apps>
		</div>

		<section class="section">
			<div class="container">
				
				<div class="columns">
					<div class="column">
						<div class="caption-head">
							<h1 class="is-4">Promo Terbaru</h1>
						</div>
					</div>
				</div>
				<div class="columns">
					<div class="column wrapping">
						<div class="swiper-container">
							 <div class="swiper-wrapper">

						        <div class="swiper-slide nusa" v-for="item in 6">
									<product-card></product-card>
								</div>
						        
						    </div>
						    <div class="swiper-button-prev"></div>
						    <div class="swiper-button-next"></div>
						</div>
					</div>
				</div>

			</div>

			<div class="container">
				<div class="columns">
					<div class="column">
						<div class="caption-head">
							<h1 class="is-4">Produk Lainnya</h1>
						</div>
					</div>
				</div>


				<div class="columns">
					<div class="column wrapping">
						<div class="nusa" v-for="item in 16">
							<product-card></product-card>
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

	import NavbarApps from 'otherComponents/Navbar'
	import ProductCard from 'otherComponents/ProductCard.vue'
	import FooterApps from 'otherComponents/Footer.vue'

	export default {
		mounted() {

			var mySwiper = new Swiper ('.swiper-container', {
				nextButton: '.swiper-button-next',
    			prevButton: '.swiper-button-prev',
    			slidesPerView: 4,
    			spaceBetween: 10,
    			breakpoints: {
    				320: {
				      slidesPerView: 1,
				      spaceBetween: 10
				    },
				    // when window width is <= 480px
				    480: {
				      slidesPerView: 1,
				      spaceBetween: 10
				    },
				    // when window width is <= 640px
				    640: {
				      slidesPerView: 3,
				      spaceBetween: 10
				    }
    			}
			})        
		},
		components: {
			FooterApps,
			ProductCard,
			NavbarApps
		}
	}
</script>