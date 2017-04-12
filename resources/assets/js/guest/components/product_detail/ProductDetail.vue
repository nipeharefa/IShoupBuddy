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
					    			<p>Indomie Super Goreng Bali, Indoenesia Gratis 1 Stnd 10</p>
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