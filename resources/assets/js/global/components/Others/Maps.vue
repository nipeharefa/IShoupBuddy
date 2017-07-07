<template>
  <div class="map-place">
    <img :src="getMiniMap()" alt="minimap" />
  </div>
</template>
<script>
  export default {
    data () {
      return {
        getLocation: {
          lat: 3.6422756,
          lng: 98.5294045
        }
      }
    },
    methods: {
      getMiniMap () {
        const base = 'https://maps.googleapis.com/maps/api/staticmap?'
        const center = 'center=' + this.getLocation.lat + ',' + this.getLocation.lng
        const options = '&size=630x300&sensor=true&zoom=14&markers=-6.1823119,106.8014464&scale=1.5'
        const key = '&key=' + document.getElementById('google-key').content

        const image = base + center + options + key
        return image
      }
    }
  }
</script>
