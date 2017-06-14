<template>
  <div>
    <formEditProfile></formEditProfile>
  </div>
</template>


<style lang="scss" scoped>

  @import "~sassPages/vendor/profile/edit_profile.scss";

</style>

<script>
  const FormEditProfile = () => import('./FormEditProfile.vue')

  export default {
    components: {
      FormEditProfile
    }
  }
</script>
