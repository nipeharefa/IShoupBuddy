<template>
  <figure class="media-left">
    <p class="image is-64x64">
      <img v-if="picture_url != null" :src="getSmallImage(picture_url)">
      <img v-else src="https://source.unsplash.com/category/nature/64x64">
    </p>
  </figure>
</template>


<script>
  export default {
    props: {
      picture_url: {
        required: true
      }
    },
    methods: {
      getSmallImage(value){
        return "/image/medium/" + value;
      }
    }
  }
</script>
