<template>
  <div>
    <span class="caption">Total Review : {{ reviews.length || 0 }}</span>

    <div class="columns reviews-box">
      <div class="column is-half" v-for="item in reviews">
        <article class="media" >
          <figure class="media-left">
            <p class="image is-64x64">
              <img :src="generateImage(item.user.picture_url)">
            </p>
          </figure>
          <div class="media-content">
            <div class="content">
              <p>
                <strong>{{ item.user.name }}</strong>
                <br>
                {{ item.body }}
              </p>
              <star-rating :rating="item.rating"
                :star-size="10" :read-only="true"
                :showRating="false"
                :activeColor="'#f7d120'" />
            </div>
          </div>
        </article>
      </div>
    </div>
  </div>
</template>

<style lang="scss" scoped>
  .caption {
    font-size: 0.8rem
  }
  .reviews-box {
    margin-top: 1rem;
    flex-wrap: wrap;
  }
  .media {
    border: 1px solid #dbdbdb;
    padding: 1rem;
    border-radius: 4px;
  }
</style>

<script>
  import { mapGetters } from 'vuex'
  import StarRating from 'vue-star-rating'

  export default {
    components: {
      StarRating
    },
    computed: {
      ...mapGetters([
        'reviews'
      ]),
    },
    methods: {
      generateImage (picture) {
        if (picture) {
          return '/image/medium/' + picture
        }
      }
    }
  }
</script>
