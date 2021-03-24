<template>
  <div>
    <Navbar />
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
// .main { 
//   display: grid;
//   grid-template-columns: 1fr 5fr;
//   background-color: #252a30;
//   height: 100vh;
//   width: 100vw;
// }

// .content {
//   background-color: white;
//   border-radius: 10px;
//   margin: 6px 6px 6px 0px;
// }
</style>
