<template>
  <div>
    <p>Maintenis</p>
    <input type="checkbox" name="" id="" value="1" v-model="cartChecked">
    <input type="checkbox" name="" id="" value="2" v-model="cartChecked">
  </div>
</template>


<script>
  import { mapGetters } from 'vuex'
  export default {
    data () {
      return {
        cartChecked: []
      }
    }
  }
</script>
