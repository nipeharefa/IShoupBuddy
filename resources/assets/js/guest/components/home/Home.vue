<template>
	<div>
		<div>
			<navbar-apps></navbar-apps>
		</div>

		<section class="section">
      <div class="container">
        <h3 class="product-list-caption">Promo Produk Terbaru</h3>
        <listPromo />
        <h3 class="product-list-caption">Produk Lainnya</h3>
        <list-product></list-product>
      </div>
    </section>

		<div>
			<footer-apps></footer-apps>
		</div>
	</div>
</template>


<script>

	const FooterApps = () => import('otherComponents/Footer.vue')
	const NavbarApps = () => import('global/components/Navbars/GuestNavbar')
  const ListPromo = () => import('global/components/Home/SlidePromo.vue')
  const ListProduct = () => import('global/components/Home/ListProduct.vue')

	import { mapActions, mapGetters } from 'vuex'

	export default {
		mounted() {
      this.getPromo()
      this.getProducts()
		},
    data () {
      return {
        swiper: false
      }
    },
		components: {
			FooterApps,
			NavbarApps,
      ListPromo,
      ListProduct
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
