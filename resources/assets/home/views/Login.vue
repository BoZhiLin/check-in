<template>
  <Layout>
    <div class="row d-flex justify-content-center">
      <b-card
        bg-variant="light"
        header="員工登入"
        class="text-center"
        style="max-width: 25rem"
      >
        <b-form @submit.stop.prevent>
          <b-input-group class="mb-2">
            <b-input-group-prepend is-text>
              <b-icon icon="person-fill"></b-icon>
            </b-input-group-prepend>
            <b-form-input
              id="username"
              name="username"
              placeholder="請輸入帳號"
              v-model="username"
            ></b-form-input>
          </b-input-group>

          <b-input-group class="mb-2">
            <b-input-group-prepend is-text>
              <b-icon icon="lock-fill"></b-icon>
            </b-input-group-prepend>
            <b-form-input
              id="password"
              name="password"
              type="password"
              placeholder="請輸入密碼"
              v-model="password"
            ></b-form-input>
          </b-input-group>
          <b-button type="submit" @click="login" variant="primary" block>
            登入
          </b-button>
        </b-form>
      </b-card>
    </div>
  </Layout>
</template>

<script>
import Layout from "~/components/Layout";

import api from "~/tools/api/api.js";
import defined from "~/tools/defined.js";

export default {
  components: {
    Layout,
  },
  data() {
    return {
      username: "",
      password: "",
    };
  },
  methods: {
    login() {
      api
        .userLogin({
          username: this.username,
          password: this.password,
        })
        .then(({ data }) => {
          const response = data;

          if (response.status === defined.response.SUCCESS) {
            localStorage.setItem("access_token", response.data.access_token);
            localStorage.setItem("expired_at", response.data.expired_at);

            this.$router.push({ name: "home" });
          } else {
            this.$swal("錯誤", "帳號或密碼錯誤", "error");
          }
        });
    },
  },
};
</script>

<style lang="scss" scoped>
.card {
  position: absolute;
  margin: 200px auto;
  box-shadow: 5px 5px 6px rgba(0, 0, 0, 0.6);
}


.col-form-label {
  font-weight: bold;
}
</style>
