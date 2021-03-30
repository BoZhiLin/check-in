<template>
  <Layout>
    <b-row align="center">
      <b-col xl="3"></b-col>
      <b-col xl="6">
        <b-card
          align="center"
          header="請假申請"
          header-text-variant="white"
          header-tag="header"
          header-bg-variant="dark"
          footer-tag="footer"
          footer-border-variant="dark"
        >
          <b-form @submit.stop.prevent>
            <b-form-group label="假別" label-align="left">
              <b-form-select v-model="leave.type" :options="leave_types"></b-form-select>
            </b-form-group>

            <b-form-group label="請假日期" label-align="left">
              <b-form-datepicker v-model="leave.date" class="mb-2"></b-form-datepicker>
            </b-form-group>

            <b-form-group label="開始時間" label-align="left">
              <b-form-timepicker v-model="leave.started_time" locale="zh"></b-form-timepicker>
            </b-form-group>

            <b-form-group label="結束時間" label-align="left">
              <b-form-timepicker v-model="leave.ended_time" locale="zh"></b-form-timepicker>
            </b-form-group>

            <b-button variant="primary" class="confirm-btn" @click="submit">送出</b-button>
          </b-form>
          <b-card-text>
            
          </b-card-text>
        </b-card>
      </b-col>
      <b-col xl="3"></b-col>
    </b-row>
  </Layout>
</template>

<script>
import api from "@/tools/api/api.js";
import defined from "@/tools/defined.js";

import Layout from "@/components/frontend/Layout";

export default {
  components: {
    Layout,
  },
  data() {
    return {
      leave_types: [
        { value: "PERSONAL", text: "事假" },
        { value: "SICK", text: "病假" },
        { value: "SPECIAL", text: "特休" },
        { value: "RECOUP", text: "補休" },
      ],
      leave: {
        type: "PERSONAL",
        date: "",
        started_time: "",
        ended_time: "",
      }
    };
  },
  created() {

  },
  methods: {
    submit() {
      if (!this.leave.type) {
        this.$swal({ type: "error", title: "請選擇假別" });
      } else if (!this.leave.date) {
        this.$swal({ type: "error", title: "請選擇日期" });
      } else if (!this.leave.started_time) {
        this.$swal({ type: "error", title: "請選擇開始時間" });
      } else if (!this.leave.ended_time) {
        this.$swal({ type: "error", title: "請選擇結束時間" });
      } else {
        api
          .leave(this.leave)
          .then((response) => {
            const { status } = response.data;

            if (status === defined.response.SUCCESS) {
              this.$swal({
                type: "success",
                title: "已送出！請等待審核結果",
                confirmButtonText: "確定"
              }).then(() => {
                this.$router.push({ name: "home" });
              });
            }
          });
      }
    }
  },
};
</script>

<style lang="scss" scoped>
.check-group {
  padding: 5px;
}

.confirm-btn {
  width: 150px;
}
</style>
