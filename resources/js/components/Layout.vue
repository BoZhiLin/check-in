<template>
  <div class="main">
    <Navbar />
    <div class="divider"></div>

    <slot></slot>
  </div>
</template>

<script>
import Navbar from "./Navbar";

export default {
  components: {
    Navbar,
  },
  created() {
    // 
  },
  methods: {
    // 
  }
}
</script>

<style lang="scss" scoped>
.divider {
  padding: 5px;
}

.main {
  overflow-x: hidden;
}
</style>
