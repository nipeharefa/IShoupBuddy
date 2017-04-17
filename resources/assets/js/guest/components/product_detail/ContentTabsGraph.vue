<template>
	<div class="small chart-container">
		<chart-child></chart-child>
	</div>
</template>


<script>
	const ChartChild = () => import('./ChartChild')
	export default {
		components: {
			ChartChild
		}
	}
</script>