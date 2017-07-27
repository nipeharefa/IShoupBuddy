<template>
  <div class="modal" :class="{'is-active': isActive}">
    <div class="modal-background"></div>
    <div class="modal-content">
      <div id="mapProfile"></div>
      <button class="button is-primary buttonSaveLocation"
      @click="updateLocation">Simpan Lokasi</button>
    </div>
    <button class="modal-close" @click="hideModals"></button>
  </div>
</template>

<style lang="scss" scoped>
  .buttonSaveLocation {
    margin-top: 1rem;
  }
  #mapProfile {
    width: 600px;
    height: 400px !important;
  }
  .modal-background {
    background: rgba(255,255,255,1) !important;
  }
  .modal-close {
    background-color: rgba(0, 0, 0, 0.2) !important;
  }
</style>

<script>
  export default {
    props: {
      isActive: Boolean,
      latitude: Number,
      longitude: Number
    },
    created () {
      this.location.latitude = this.latitude || 3.590336
      this.location.longitude = this.longitude || 98.677481
    },
    mounted () {},
    updated () {
      this.initMap()
    },
    data () {
      return {
        location: {
          latitude: null,
          longitude: null
        }
      }
    },
    methods: {
      initMap () {
        const latlng = {
          lat: this.latitude || 3.590336,
          lng: this.longitude || 98.6774813
        }
        console.log(latlng)
        const map = new google.maps.Map(document.getElementById('mapProfile'), {
          center: latlng,
          zoom: 14,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        let markers = []

        const self = this

        var marker = new google.maps.Marker({
          position: latlng,
          map: map
        })

        markers.push(marker)

        google.maps.event.addListener(map, 'click', (e) => {
          if (markers.length > 0) {
            for (var i = 0; i < markers.length; i++) {
              markers[i].setMap(null)
            }
          }

          var marker = new google.maps.Marker({
            position: e.latLng,
            map: map
          })

          markers.push(marker)
          console.info(e.latLng.lat())
          this.location.latitude = e.latLng.lat()
          this.location.longitude = e.latLng.lng()
        })
      },
      hideModals () {
        this.$emit('update:isActive', false)
      },
      updateLocation () {
        this.$emit('update:latitude', this.location.latitude)
        this.$emit('update:longitude', this.location.longitude)
        this.hideModals()
      }
    }
  }
</script>
