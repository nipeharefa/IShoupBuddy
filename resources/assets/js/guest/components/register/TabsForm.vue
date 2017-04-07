<template>
	<div>
		<div class="tabs">
		  <ul class="tabs-register">
		    <li :class="{'is-active': activeTabs == 0}" @click="changeTabs(0)">
		    	<a>Member</a>
		    </li>
		    <li :class="{'is-active': activeTabs == 1}" @click="changeTabs(1)">
		    	<a>Vendor</a>
		    </li>
		  </ul>

		</div>
		<div>
			<div class="box-form" id="signNo">
				<member-form v-if="activeTabs == 0"></member-form>
				<vendor-form v-if="activeTabs == 1"></vendor-form>
			</div>
		</div>
	</div>
</template>

<style lang="scss">
	ul.tabs-register {
		display: flex;
    	justify-content: space-around;
	}
</style>

<script>

	import VendorForm from './VendorForm.vue'
	import MemberForm from './MemberForm.vue'

	export default {

		data() {
			return {
				activeTabs: 0
			}
		},
		components: {
			VendorForm,
			MemberForm
		},
		methods: {
			changeTabs(i) {
				this.activeTabs = i
			}
		}
	}
</script>