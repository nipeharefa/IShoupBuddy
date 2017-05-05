<template>
  <div>
  	<article class="media" v-for="review in product.recentReview">
    <figure class="media-left">
      <p class="image is-64x64">
        <img src="https://source.unsplash.com/category/nature/64x64">
      </p>
    </figure>
    <div class="media-content">
      <div class="content">
        <p>
          <strong>John Smith</strong> <small>@johnsmith</small> <small>3m</small>
          <br>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ornare magna eros, eu pellentesque tortor vestibulum ut. Maecenas non massa sem. Etiam finibus odio quis feugiat facilisis.
        </p>
      </div>
      <nav class="level is-mobile">
        <div class="level-left">
          <a class="level-item">
            <span class="icon is-small"><i class="fa fa-reply"></i></span>
          </a>
          <a class="level-item">
            <span class="icon is-small"><i class="fa fa-retweet"></i></span>
          </a>
          <a class="level-item">
            <span class="icon is-small"><i class="fa fa-heart"></i></span>
          </a>
        </div>
      </nav>
    </div>
  </article>
  </div>
</template>

<script>
  import { mapGetters } from 'vuex'

  export default {

    computed: {
      ...mapGetters([
        'product'
      ])
    }
  }
</script>
