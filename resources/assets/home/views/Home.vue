<template>
  <Layout>
    <b-row align="center">
      <b-col xl="3"></b-col>
      <b-col xl="6" class="main-content">
        <b-link :to="{ name: 'check' }" class="btn btn-primary link-btn">打卡上/下班</b-link>
        <b-link :to="{ name: 'leave' }" class="btn btn-primary link-btn">請假申請</b-link>

        <div class="divider"></div>

        <b-tabs content-class="mt-3" fill>
          <b-tab title="基本資料" active>
            <b-form @submit.stop.prevent>
              <b-form-group label="員工序號" label-align="left">
                <b-form-input type="text" :value="user_info.id" disabled></b-form-input>
              </b-form-group>

              <b-form-group label="員工姓名" label-align="left">
                <b-form-input type="text" :value="user_info.name" disabled></b-form-input>
              </b-form-group>

              <b-form-group label="員工帳號" label-align="left">
                <b-form-input type="text" :value="user_info.username" disabled></b-form-input>
              </b-form-group>

              <b-form-group label="聯絡電話" label-align="left">
                <b-form-input type="text" :value="user_info.phone" disabled></b-form-input>
              </b-form-group>

              <b-form-group label="到職日期" label-align="left">
                <b-form-input type="text" :value="user_info.report_date" disabled></b-form-input>
              </b-form-group>

              <b-form-group label="備註" label-align="left">
                <b-form-input type="text" :value="user_info.remark" disabled></b-form-input>
              </b-form-group>
            </b-form>
          </b-tab>
          <b-tab title="打卡紀錄">
            <b-table striped responsive="sm" hover :items="check_records" :fields="check_fields"></b-table>
          </b-tab>
          <b-tab title="請假查詢">
            <div class="mt-3">
              <b-card-group deck>
                <b-card bg-variant="info" header="特休額度" class="text-center">
                  <b-card-text>{{ user_info.special_leave_amount }}</b-card-text>
                </b-card>

                <b-card bg-variant="warning" header="補休額度" class="text-center">
                  <b-card-text>{{ user_info.recoup_leave_amount }}</b-card-text>
                </b-card>
              </b-card-group>
            </div>

            <div class="divider"></div>

            <b-table striped responsive="sm" hover :items="leave_records" :fields="leave_fields">
              <template #cell(type)="data">
                {{ leave_mapping[data.item.type] }}
              </template>

              <template #cell(status)="data">
                {{ status_mapping[data.item.status] }}
              </template>
            </b-table>
          </b-tab>
        </b-tabs>
      </b-col>
      <b-col xl="3"></b-col>
    </b-row>
  </Layout>
</template>

<script>
import api from "~/tools/api/api.js";
import defined from "~/tools/defined.js";

import Layout from "~/components/Layout";

export default {
  components: {
    Layout,
  },
  data() {
    return {
      user_info: {},
      leave_records: [],
      check_records: [],

      leave_fields: [
        { key: "date", label: "日期" },
        { key: "type", label: "假別" },
        { key: "started_time", label: "上班時間" },
        { key: "ended_time", label: "下班時間" },
        { key: "duration_time", label: "休假時數" },
        { key: "status", label: "審核結果" },
      ],
      check_fields: [
        { key: "date", label: "日期" },
        { key: "started_time", label: "上班時間" },
        { key: "ended_time", label: "下班時間" },
        { key: "duration_time", label: "工時" },
      ],

      leave_mapping: {
        "PERSONAL": "事假",
        "SICK": "病假",
        "SPECIAL": "特休",
        "RECOUP": "補休",
      },
      status_mapping: {
        "PROGRESSING": "審核中",
        "PASSED": "已通過",
        "REJECT": "駁回"
      },
    };
  },
  created() {
    this.userInfo();
    this.getCheckRecords();
    this.getLeaveRecords();
  },
  methods: {
    userInfo() {
      api.userInfo()
        .then((response) => {
          const { status, data } = response.data;

          if (status === defined.response.SUCCESS) {
            this.user_info = data.user;
          }
        });
    },
    getCheckRecords() {
      api.getCheckRecords()
        .then((response) => {
          const { status, data } = response.data;

          if (status === defined.response.SUCCESS) {
            this.check_records = data.records;
          }
        });
    },
    getLeaveRecords() {
      api.getLeaveRecords()
        .then((response) => {
          const { status, data } = response.data;

          if (status === defined.response.SUCCESS) {
            this.leave_records = data.records;
          }
        });
    }
  },
};
</script>

<style lang="scss" scoped>
.check-group {
  padding: 5px;
}

.link-btn {
  width: 150px;
}

.divider {
  padding: 10px;
}

.main-content {
  padding: 20px;
}
</style>
