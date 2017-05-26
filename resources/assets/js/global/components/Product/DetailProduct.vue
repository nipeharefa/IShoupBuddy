<template>
  <div>
    <div class="container-navbar">
      <slot name="navbar"></slot>
    </div>
    <section class="section product-default-section">
      <div class="container">
       <slot name="slot-touch"></slot>
       <slot name="slot-desktop"></slot>
      </div>
    </section>
    <div>
      <slot name="footer"></slot>
    </div>
    <div>
      <slot name="otherComponents"></slot>
    </div>
  </div>
</template>

<style lang="scss" scoped>
  .container-navbar {
    // height: 50px;
  }
</style>
