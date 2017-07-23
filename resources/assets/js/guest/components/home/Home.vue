<template>
	<div>
		<div>
			<navbar-apps></navbar-apps>
		</div>

		<section class="section">
      <div class="container">
        <h3 class="product-list-caption">Produk Terbaru</h3>
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
      getProducts() {
        this.$http.get('api/product?perpage=50').then(response => {
          this.initProducts(response.data.products)
        }).catch(err => {
          this.initProducts([])
        })
      },
      getPromo() {
        this.$http.get('api/product/newest?perpage=10&page=1').then(response => {
          const promo = response.data.products
          this.initPromo(promo)
        })
      }
    }
	}
</script>
