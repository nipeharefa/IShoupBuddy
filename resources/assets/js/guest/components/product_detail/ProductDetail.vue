
<template>
	<div>

		<div>
			<navbar-apps></navbar-apps>
		</div>
		
		<section class="section">
			<div class="container">

				<div class="columns is-hidden-touch">
					<div class="column is-one-third">
						<main-thumbnail></main-thumbnail>
					</div>
					<div class="column">
						<favorite-button></favorite-button>
						<h1 class="title is-5 dekstop-detail">CSS Bulma everhing is gone be ok</h1>
						<ratings></ratings>
						<discount-box></discount-box>

						<div class="column is-one-third desktop-controls-2 is-paddingless">
							<div class="input-cart">
								<button class="button">
									<i class="fa fa-plus"></i>
								</button>
								<input type="text" class="input" placeholder="Jumlah">
								<button class="button">
									<i class="fa fa-minus"></i>
								</button>
							</div>
							<div class="container-controls-2">
								<button class="button is-danger">
									<i class="fa fa-shopping-cart"></i>
								</button>
								<button class="button is-primary">
									Compare Product
								</button>
							</div>
						</div>
					</div>
				</div>

				<div class="columns is-hidden-touch">
					<div class="column">
						<tabs></tabs>
					</div>
				</div>

				<div class="columns is-hidden-desktop">
					<div class="column ">
						<div>
							<main-thumbnail></main-thumbnail>

					    	<div>
					    		<b>
					    			<p>Indomie Super Goreng Bali, Indoenesia Gratis 1 Stand 10</p>
					    		</b>
					    	</div>
							
							<ratings></ratings>

							<discount-box></discount-box>

						</div>	

						<button-control-touch></button-control-touch>

						
						<tabs></tabs>

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
	import Ratings from './Ratings.vue'
	import MainThumbnail from './MainThumbnail.vue'
	import DiscountBox from './DiscountBox.vue'
	import ButtonControlTouch from './ButtonControlTouch'
	import FavoriteButton from './FavoriteButton.vue'

	export default {
		components: {
			FooterApps,
			NavbarApps,
			Tabs,
			Ratings,
			MainThumbnail,
			DiscountBox,
			ButtonControlTouch,
			FavoriteButton
		}
	}
</script>