<template>
  <div class="card product-card animation-background">
    <div class="background-masker header-top"></div>
  </div>
</template>


<style lang="scss" scoped>
@keyframes placeHolderShimmer{
  0%{
      background-position: -468px 0
  }
  100%{
      background-position: 468px 0
  }
}
.animation-background {
    animation-duration: 1s;
    animation-fill-mode: forwards;
    animation-iteration-count: infinite;
    animation-name: placeHolderShimmer;
    animation-timing-function: linear;
    background: #f6f7f8;
    background: linear-gradient(to right, #eeeeee 8%, #dddddd 18%, #eeeeee 33%);
    background-size: 800px 104px;
    height: 96px;
    position: relative;

    .background-masker {
      background: #fff;
      position: absolute;
    }
    .background-masker.header-top,
    .background-masker.header-bottom,
    .background-masker.subheader-bottom {
      top: 0;
      left: 40px;
      right: 0;
      height: 10px;
    }
  }
</style>
