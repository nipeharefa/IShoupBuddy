<template>
  <div class="modal" :class="{'is-active': isActive}">
    <div class="modal-background"></div>
    <div class="modal-content">
      <input id="pac-input" class="controls" type="text" placeholder="Search Box">
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
      longitude: Number,
      address: String
    },
    created () {
      this.location.latitude = this.latitude || 3.590336
      this.location.longitude = this.longitude || 98.677481
      this.location.address = this.address || '-'
    },
    mounted () {
      this.mapToData()
    },
    updated () {
      this.initMap()
    },
    data () {
      return {
        maps: null,
        location: {
          latitude: null,
          longitude: null,
          address: null
        }
      }
    },
    methods: {
      mapToData() {
         const latlng = {
          lat: this.latitude || 3.590336,
          lng: this.longitude || 98.6774813
        }
        const map = new google.maps.Map(document.getElementById('mapProfile'), {
          center: latlng,
          zoom: 14,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        this.map = map
      },
      initMap () {
        const latlng = {
          lat: this.latitude || 3.590336,
          lng: this.longitude || 98.6774813
        }
        const geocoder = new google.maps.Geocoder()

        const map = this.map

        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });

        let markers = [];

        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();

          if (places.length == 0) {
            return;
          }
          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }
            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
          });
          map.fitBounds(bounds);
        });

        const self = this

        var marker = new google.maps.Marker({
          position: latlng,
          map: map
        })

        markers.push(marker)
        console.log(latlng)
        this.getAddress(geocoder, latlng)

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

          geocoder.geocode({ 'latLng': e.latLng }, (results, status) => {
            if (status === google.maps.GeocoderStatus.OK) {
              const result = results[0]
              self.location.address = result.formatted_address
              console.log(result)
            } else {
              console.warn(result)
            }
          })

          markers.push(marker)
          this.location.latitude = e.latLng.lat()
          this.location.longitude = e.latLng.lng()
        })
      },
      getAddress(geocoder, latLng) {
        const self = this
        geocoder.geocode({ 'latLng': latLng }, (results, status) => {
          if (status === google.maps.GeocoderStatus.OK) {
            const result = results[0]
            self.location.address = result.formatted_address
            console.log(result)
          } else {
            console.warn(result)
          }
        })
      },
      hideModals () {
        this.$emit('update:isActive', false)
      },
      updateLocation () {
        console.log(this.location.latitude)
        this.$emit('update:latitude', this.location.latitude)
        this.$emit('update:longitude', this.location.longitude)
        this.$emit('update:address', this.location.address)
        this.hideModals()
      }
    }
  }
</script>
