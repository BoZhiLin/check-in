<template>
  <div>
    <Sidebar></Sidebar>

    <div class="content">
      <slot></slot>
    </div>
  </div>
</template>

<script>
import Sidebar from "./Sidebar";

export default {
  components: {
    Sidebar,
  },
}
</script>

<style lang="scss" scoped>
.content {
  margin-left: 250px !important;
}
</style>