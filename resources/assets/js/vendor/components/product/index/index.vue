<template>
  <div>
    <table class="table">

      <div class="tabs">
        <ul>
          <li :class="{'is-active': !activeTabs}" @click="switchTabs(0)"><a>My Product</a></li>
          <li :class="{'is-active': activeTabs}" @click="switchTabs(1)"><a>All Products</a></li>
        </ul>
      </div>

      <tableOwnProduct v-if="!activeTabs"></tableOwnProduct>
      <tableProduct v-if="activeTabs"></tableProduct>

    </table>
  </div>
</template>


<script>
  const TableProduct = () => import('./TableProduct.vue')
  const TableOwnProduct = () => import('./TableOwnProduct.vue')

  export default {
    components: {
      TableProduct,
      TableOwnProduct
    },
    data () {
      return {
        activeTabs: 0
      }
    },
    methods: {
      switchTabs (item) {
        this.activeTabs = item
      }
    }
  }
</script>
