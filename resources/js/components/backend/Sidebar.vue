<template>
  <div>
    <div tabindex="-1" class="b-sidebar-outer">
      <div
        id="sidebar-variant"
        tabindex="-1"
        role="dialog"
        aria-modal="false"
        aria-labelledby="sidebar-variant___title__"
        class="b-sidebar shadow bg-dark text-light"
      >
        <header class="b-sidebar-header">
          <strong id="sidebar-variant___title__">後台管理</strong>
        </header>
        <div class="b-sidebar-body">
          <div class="px-3 py-2">
            <nav class="mb-3 items">
              <ul class="nav flex-column" style="color: white;">
                <li class="nav-item">
                  <b-link :to="{ name: 'admin.dashboard' }" class="nav-link">首頁</b-link>
                </li>
                <li class="nav-item">
                  <b-link class="nav-link" @click="logout">登出</b-link>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import api from "@/tools/api/admin.js";
import defined from "@/tools/defined.js";

export default {
  methods: {
    logout() {
      api.logout()
        .then((response) => {
          const { status, data } = response.data;

          if (status === defined.response.SUCCESS) {
            this.$router.push({ name: "admin.login" });
          }
        });
    }
  }
};
</script>

<style lang="scss" scoped>
.items {
  margin-top: 50px;
  font-size: 18px;
}

.b-sidebar {
  width: 250px;
}

a {
  color: #fff;
  text-decoration: none;
}
</style>
