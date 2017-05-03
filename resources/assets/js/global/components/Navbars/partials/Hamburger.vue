<template>
  <div class="is-hidden-desktop">
    <span class="nav-toggle" @click="changeActiveStatus">
      <span></span>
      <span></span>
      <span></span>
    </span>
  </div>
</template>


<script>
  import { mapActions, mapGetters } from 'vuex'

  export default {

    methods: {
      ...mapActions([
        'setIsActive'
      ]),
      changeActiveStatus () {
        this.setIsActive(!this.isActive)
      }
    },
    computed: {
      ...mapGetters([
        'isActive'
      ])
    }
  }
</script>
