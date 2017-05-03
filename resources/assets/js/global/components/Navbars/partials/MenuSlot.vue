<template>
  <li class="is-fullwidth">
    <div class="okeoce">
      <slot name="content"></slot>
      <i class="fa fa-sort-down default-caret" v-if="hasChild" @click="showChild"
        :class="{'is-active': openend }"></i>
    </div>
    <slot name="child" v-if="openend"></slot>
  </li>
</template>


<script>
  export default {
    props: ['hasChild'],
    data () {
      return {
        openend: false
      }
    },
    methods: {
      showChild () {
        this.openend = !this.openend
        console.log('cared CLidked')
      }
    }
  }
</script>
<style lang="scss" scoped>
  .okeoce {
    width: 100%;
    justify-content: space-between;
  }
  .default-caret {
    transition: 250ms ease all;
    &.is-active {
      transform: rotate(180deg);
    }
  }
</style>
