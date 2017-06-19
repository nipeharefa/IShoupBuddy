<template>
  <div class="card product-card animation-background">
    <div class="background-masker header-top"></div>
    <div class="background-masker header-title"></div>
    <div class="background-masker header-price"></div>
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
    height: 150px;
    position: relative;

    .background-masker {
      background: #fff;
      position: absolute;
      &.header-top {
        top: 1px;
        left: 3px;
        width: 96%;
        height: 5rem;
      }
      &.header-title {
        height: 10px;
        left: 2px;
        width: 98%;
        top: 85px;
      }
      &.header-price {
        top: 125px;
        left: 3px;
        height: 10px;
        width: 98px;
      }
    }
  }
</style>
