<template>
	<div>
		<div class="tabs">
			<ul>
			    <li :class="{'is-active': activeTabs == 1}" >
			    	<a @click="switchTabs(1)">Details</a>
			    </li>
			    <li :class="{'is-active': activeTabs == 2}" ><a @click="switchTabs(2)">Review</a></li>
			    <li :class="{'is-active': activeTabs == 3}" ><a @click="switchTabs(3)">Statistik</a></li>
		  	</ul>
		</div>

		<div>
	  		<div class="tabs-content-detail" v-if="activeTabs === 1">
	  			<content-tabs-detail></content-tabs-detail>
	  		</div>
	  		<div class="tabs-review" v-if="activeTabs === 2">
	  			<content-tabs-review></content-tabs-review>
	  		</div>
	  		<div class="tabs-statistik" v-if="activeTabs === 3">
	  			<content-tabs-graph></content-tabs-graph>
	  		</div>
	  	</div>
		
	</div>
</template>



<script>
	import ContentTabsDetail from './ContentTabsDetail.vue'
	import ContentTabsReview from './ContentTabsReview.vue'
	import ContentTabsGraph from './ContentTabsGraph.vue'

	export default {

		data() {
			return {
				activeTabs: 1
			}
		},
		components: {
			ContentTabsDetail,
			ContentTabsReview,
			ContentTabsGraph
		},
		methods: {
			switchTabs(key) {
				this.activeTabs = key
			}
		}
	}
</script>