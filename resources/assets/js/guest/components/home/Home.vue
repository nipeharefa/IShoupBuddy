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

						    <div class="swiper-slide nusa" v-for="item in promo">
									<product-card :product="item"></product-card>
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
							<h1 class="is-4">Produk Lainnya </h1>
						</div>
					</div>
				</div>


				<div class="columns">
					<div class="column wrapping">
						<div class="nusa" v-for="item in products">
							<a href="/product/1" class="alinkto">
								<product-card :product="item"></product-card>
							</a>
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

	const FooterApps = () => import('otherComponents/Footer.vue')
	const NavbarApps = () => import('otherComponents/Navbar.vue')

	import ProductCard from 'otherComponents/ProductCard.vue'

	import { mapActions, mapGetters } from 'vuex'

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
				    480: {
				      slidesPerView: 1,
				      spaceBetween: 10
				    },
				    640: {
				      slidesPerView: 3,
				      spaceBetween: 10
				    }
    			}
			})

      this.getPromo()
      this.getProducts()
		},
		components: {
			FooterApps,
			ProductCard,
			NavbarApps
		},
    computed: {
      ...mapGetters([
        'products',
        'promo'
      ])
    },
    methods: {
      ...mapActions([
        'initPromo',
        'initProducts'
      ]),
      getPromo() {
        this.$http.get('api/promo').then(response => {
          const promo = response.data.promo

          this.initPromo(promo)
        })
      },
      getProducts() {
        this.$http.get('api/product').then(response => {
          const products = response.data.products

          this.initProducts(products)
        })
      }
    }
	}
</script>
