<template>
  <div>
    <div id="mapsDetailCart"></div>
  </div>
</template>


<style lang="scss" scoped>
  #mapsDetailCart {
    width: 600px;
    height: 200px !important;
  }
</style>

<script>
  export default {
    props: {
      latitude: {
        required: true
      },
      longitude: {
        required: true
      }
    },
    mounted () {
      this.initMap();
    },
    watch: {
      latitude(a,b) {
        this.initMap();
      }
    },
    methods: {
      initMap () {
        const latlng = {
          lat: this.latitude || 3.590336,
          lng: this.longitude || 98.6774813
        }
        console.log(latlng)
        const map = new google.maps.Map(document.getElementById('mapsDetailCart'), {
          center: latlng,
          zoom: 14,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var marker = new google.maps.Marker({
          position: latlng,
          map: map
        })
      }
    }
  }
</script>
