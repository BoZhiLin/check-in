<template>
  <div id="wrapper">
    <Sidebar />

    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <Topbar />

        <div class="container-fluid">
          <slot></slot>
        </div>
      </div>

      <Footer />
    </div>
  </div>
</template>

<script>
import Sidebar from "./Sidebar";
import Footer from "./Footer";
import Topbar from "./Topbar";

export default {
  components: {
    Sidebar,
    Footer,
    Topbar,
  },
};
</script>

<style lang="scss" scoped>
.content {
  margin-left: 250px !important;
}
</style>