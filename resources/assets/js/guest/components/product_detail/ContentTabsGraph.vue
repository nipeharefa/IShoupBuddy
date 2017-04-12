<template>
	<div class="small">
		<chart-child></chart-child>
	</div>
</template>


<script>
	import ChartChild from './ChartChild'
	export default {
		components: {
			ChartChild
		}
	}
</script>


<style>
  .small {
    max-width: 98%;
  }
</style>