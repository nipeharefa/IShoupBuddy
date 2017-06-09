<template>
  <div>
    <table class="table">
      <div class="tabs">
        <ul>
          <li :class="{'is-active': !activeTabs}" @click="switchTabs"><a>My Product</a></li>
          <li :class="{'is-active': activeTabs}" @click="switchTabs"><a>All Products</a></li>
        </ul>
      </div>
      <tableProduct v-if="!activeTabs"></tableProduct>
      <p v-if="activeTabs">lorem</p>
    </table>
  </div>
</template>


<script>
  const TableProduct = () => import('./TableProduct.vue')

  export default {
    components: {
      TableProduct
    },
    data () {
      return {
        activeTabs: 0
      }
    },
    methods: {
      switchTabs () {
        this.activeTabs = !this.activeTabs
      }
    }
  }
</script>
