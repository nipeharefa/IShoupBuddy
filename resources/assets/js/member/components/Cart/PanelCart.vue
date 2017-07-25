<template>
  <div>
    <input type="checkbox"
           value="1"
           @change="change" />
  </div>
</template>


<script>
  export default {
    model: {
      prop: 'checked',
      event: 'change'
    },
    methods: {
      change () {
          this.$emit('input', true);
      }
    }
  }
</script>
